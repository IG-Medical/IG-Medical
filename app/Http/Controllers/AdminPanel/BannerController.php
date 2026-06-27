<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Upload\UploadTrait;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Category\Models\Category;

class BannerController extends CoreController
{
    use UploadTrait;
    public function __construct()
    {
        $this->viewPath = 'admin_panel.banners';
        $this->asRoute = 'banner';
        $this->route = 'banners';
    }

    public function index()
    {
        meta_data(trans('admin.banners'), trans('admin.banners'), [
            '#' => trans('admin.banners'),
        ]);

        $banners = Banner::orderBy('position')->orderBy('id')->get();
        $categories = Category::where('is_active', 1)->orderBy('name')->get();

        return view($this->viewPath . '.index', compact('banners', 'categories'));
    }

    public function create()
    {
        // Check if maximum banners limit reached
        // if (Banner::count() >= 2) {
            // return redirect(route_admin('banners.index'))
            //     ->with('error', trans('admin.max_banners_reached'));
        // }

        meta_data(trans('admin.add_banner'), trans('admin.add_banner'), [
            route_admin($this->route . '.index') => trans('admin.banners'),
            '#' => trans('admin.add_banner'),
        ]);

        $categories = Category::where('is_active', 1)->whereNotNull('parent_id')->orderBy('name')->get();

        return view($this->viewPath . '.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Check if maximum banners limit reached
        // if (Banner::count() >= 2) {
            // if ($request->expectsJson()) {
            //     return $this->errorResponse([], trans('admin.max_banners_reached'), 422);
            // }
            // return redirect(route_admin('banners.index'))
            //     ->with('error', trans('admin.max_banners_reached'));
        // }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1',
            'category_ids' => 'nullable|array|max:2',
            'category_ids.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->errorResponse($validator->errors(), trans('admin.validation_error'), 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            // Handle file upload
            $file = $request->file('image');
            if (aws_is_s3()) {
                $imageName = $this->uploadToS3($file, Banner::DIR_UPLOADS);
            } else {
                $imageName = $this->saveFile($file, Banner::DIR_UPLOADS);
            }
        } elseif ($request->has('image') && is_string($request->image) && strpos($request->image, 'data:image') === 0) {
            // Handle base64 image (from AJAX)
            $imageName = $this->saveBase64Image($request->image, Banner::DIR_UPLOADS);
        }

        $banner = Banner::create([
            'title' => $request->title,
            'page' => 'home',
            'image' => $imageName,
            'link' => $request->link,
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        if ($request->has('category_ids') && is_array($request->category_ids)) {
            $sync = [];
            foreach ($request->category_ids as $index => $categoryId) {
                $sync[$categoryId] = ['position' => $index];
            }
            $banner->categories()->sync($sync);
        }

        if ($request->expectsJson()) {
            return $this->response($banner, null, trans('admin.banner_created_successfully'), 200);
        }

        return redirect(route_admin('banners.index'))
            ->with('success_message', trans('admin.banner_created_successfully'));
    }

    public function edit(Banner $banner)
    {
        meta_data(trans('admin.edit_banner'), trans('admin.edit_banner'), [
            route_admin($this->route . '.index') => trans('admin.banners'),
            '#' => trans('admin.edit_banner'),
        ]);

        $banner->load('categories');
        $categories = Category::where('is_active', 1)->whereNotNull('parent_id')->orderBy('name')->get();

        return view($this->viewPath . '.edit', compact('banner', 'categories'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1',
            'category_ids' => 'nullable|array|max:2',
            'category_ids.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->errorResponse($validator->errors(), trans('admin.validation_error'), 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'title' => $request->title,
            'page' => $banner->page ?? 'home',
            'link' => $request->link,
            'position' => $request->position ?? $banner->position,
            'is_active' => $request->is_active ?? $banner->is_active,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (aws_is_s3()) {
                $updateData['image'] = $this->uploadToS3($file, Banner::DIR_UPLOADS);
            } else {
                $updateData['image'] = $this->saveFile($file, Banner::DIR_UPLOADS);
            }
        } elseif ($request->has('image') && is_string($request->image)) {
            // Handle base64 image (from AJAX)
            if (strpos($request->image, 'data:image') === 0) {
                $updateData['image'] = $this->saveBase64Image($request->image, Banner::DIR_UPLOADS);
            } elseif (!empty($request->image)) {
                // Keep existing image if it's just a filename string
                $updateData['image'] = $request->image;
            }
        }

        $banner->update($updateData);

        if ($request->has('category_ids') && is_array($request->category_ids)) {
            $sync = [];
            foreach ($request->category_ids as $index => $categoryId) {
                $sync[$categoryId] = ['position' => $index];
            }
            $banner->categories()->sync($sync);
        } else {
            $banner->categories()->sync([]);
        }

        if ($request->expectsJson()) {
            return $this->response($banner, null, trans('admin.banner_updated_successfully'), 200);
        }

        return redirect(route_admin('banners.index'))
            ->with('success_message', trans('admin.banner_updated_successfully'));
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        if (request()->expectsJson()) {
            return $this->response(null, null, trans('admin.banner_deleted_successfully'), 200);
        }

        return redirect(route_admin('banners.index'))
            ->with('success_message', trans('admin.banner_deleted_successfully'));
    }
}
