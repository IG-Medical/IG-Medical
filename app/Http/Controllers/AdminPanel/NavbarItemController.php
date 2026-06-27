<?php

namespace App\Http\Controllers\AdminPanel;

use App\Models\NavbarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NavbarItemController extends CoreController
{
    public function __construct()
    {
        $this->viewPath = 'admin_panel.navbar-items';
        $this->asRoute = 'navbar-item';
        $this->route = 'navbar-items';
    }

    public function index()
    {
        meta_data(trans('admin.navbar_items'), trans('admin.navbar_items'), [
            '#' => trans('admin.navbar_items'),
        ]);

        $rootItems = NavbarItem::query()
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with(['children' => function ($q) {
                $q->orderBy('order');
            }])
            ->get();

        $allItems = NavbarItem::query()->orderBy('order')->get();

        return view($this->viewPath . '.index', compact('rootItems', 'allItems'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:navbar_items,id',
            'is_active' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('admin.validation_error'), 422);
        }

        $parentId = $request->filled('parent_id') ? (int) $request->parent_id : null;

        $maxOrder = NavbarItem::query()
            ->where('parent_id', $parentId)
            ->max('order');

        $navbarItem = NavbarItem::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $parentId,
            'order' => is_null($maxOrder) ? 0 : ($maxOrder + 1),
            'is_active' => (int) $request->input('is_active', 1) === 1,
        ]);

        NavbarItem::clearCache();

        return $this->response(
            ['navbar_item' => $navbarItem],
            null,
            trans('admin.navbar_item_created_successfully'),
            200
        );
    }

    public function update(Request $request, NavbarItem $navbarItem)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:navbar_items,id',
            'is_active' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('admin.validation_error'), 422);
        }

        // Only update title (name) - preserve all other fields
        $navbarItem->title = $request->title;
        
        // Only update slug if provided in request
        if ($request->has('slug')) {
            $navbarItem->slug = $request->slug;
        }
        
        // Only update parent_id if provided in request
        if ($request->has('parent_id')) {
            $parentId = $request->filled('parent_id') ? (int) $request->parent_id : null;
            
            // Prevent setting itself as parent
            if (!is_null($parentId) && $parentId === (int) $navbarItem->id) {
                return $this->errorResponse([], trans('admin.cannot_set_self_as_parent'), 422);
            }
            
            // If parent changed: move item to end of new parent group
            if (($navbarItem->parent_id ?? null) !== $parentId) {
                $maxOrder = NavbarItem::query()
                    ->where('parent_id', $parentId)
                    ->max('order');

                $navbarItem->order = is_null($maxOrder) ? 0 : ($maxOrder + 1);
            }
            
            $navbarItem->parent_id = $parentId;
        }
        
        // Only update is_active if provided in request
        if ($request->has('is_active')) {
            $navbarItem->is_active = (int) $request->input('is_active') === 1;
        }
        
        $navbarItem->save();

        NavbarItem::clearCache();

        return $this->response(
            ['navbar_item' => $navbarItem->fresh()],
            null,
            trans('admin.navbar_item_updated_successfully'),
            200
        );
    }

    public function destroy(NavbarItem $navbarItem)
    {
        // If you want: children become roots instead of deleting them
        NavbarItem::query()
            ->where('parent_id', $navbarItem->id)
            ->update(['parent_id' => null]);

        $navbarItem->delete();

        NavbarItem::clearCache();

        return $this->response(
            null,
            null,
            trans('admin.navbar_item_deleted_successfully'),
            200
        );
    }

    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:navbar_items,id',
            'items.*.order' => 'required|integer|min:0',
            'items.*.parent_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), trans('admin.validation_error'), 422);
        }

        try {
            $updatedCount = 0;

            DB::transaction(function () use ($request, &$updatedCount) {
                foreach ($request->items as $row) {
                    $id = (int) ($row['id'] ?? 0);
                    $order = (int) ($row['order'] ?? 0);

                    $parentId = null;
                    if (array_key_exists('parent_id', $row) && $row['parent_id'] !== null && $row['parent_id'] !== '' && $row['parent_id'] !== 'null') {
                        $parentId = (int) $row['parent_id'];
                    }

                    // Prevent self parent
                    if ($parentId !== null && $parentId === $id) {
                        continue;
                    }

                    // If parentId not null, ensure it exists
                    if ($parentId !== null && !NavbarItem::query()->where('id', $parentId)->exists()) {
                        continue;
                    }

                    $affected = NavbarItem::query()
                        ->where('id', $id)
                        ->update([
                            'order' => $order,
                            'parent_id' => $parentId,
                        ]);

                    if ($affected) {
                        $updatedCount++;
                    }
                }
            });

            NavbarItem::clearCache();

            return $this->response(
                ['updated_count' => $updatedCount],
                null,
                trans('admin.navbar_items_reordered_successfully'),
                200
            );
        } catch (\Throwable $e) {
            return $this->errorResponse(
                ['error' => $e->getMessage()],
                trans('admin.failed_to_reorder_items'),
                500
            );
        }
    }
}
