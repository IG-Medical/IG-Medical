@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@push('css')
    <style>
        .sortable-item {
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 6px;
        }

        .sortable-item:hover {
            background: #f7f7f7;
        }

        .sortable-ghost {
            opacity: .4;
        }

        .children-list {
            margin-left: 30px;
            margin-top: 10px;
            padding-left: 18px;
            border-left: 2px solid #e0e0e0;
        }

        .item-actions {
            display: flex;
            gap: 6px;
        }

        .badge-active {
            background-color: #1dc9b7;
            color: #fff;
        }

        .badge-inactive {
            background-color: #fd27eb;
            color: #fff;
        }

        .drag-handle {
            cursor: move;
            user-select: none;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            border: 1px solid #eee;
            background: #fafafa;
            margin-right: 10px;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet m-portlet--full-height">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon"><i class="flaticon-menu"></i></span>
                                <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                <i class="la la-plus"></i> {{ trans('admin.add_navbar_item') }}
                            </button> --}}

                            <button type="button" class="btn btn-success" id="saveOrderBtn" style="display:none;">
                                <i class="la la-save"></i> {{ trans('admin.save_order') }}
                            </button>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">

                                <div id="navbarItemsList">
                                    @foreach($rootItems as $item)
                                        <div class="sortable-item" data-id="{{ $item->id }}" data-parent-id="">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="drag-handle">☰</span>
                                                    <strong>{{ $item->title }}</strong>
                                                    <span class="ml-2">({{ $item->slug ?? '#' }})</span>

                                                    {{-- @if($item->is_active)
                                                        <span class="badge badge-active ml-2">{{ trans('admin.active') }}</span>
                                                    @else
                                                        <span class="badge badge-inactive ml-2">{{ trans('admin.inactive') }}</span>
                                                    @endif --}}
                                                </div>

                                                <div class="item-actions">
                                                    <button type="button"
                                                            class="btn btn-sm btn-info edit-item"
                                                            data-id="{{ $item->id }}"
                                                            data-title="{{ $item->title }}">
                                                        <i class="la la-edit"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- Children --}}
                                            <div class="children-list mt-3" data-parent-id="{{ $item->id }}">
                                                @foreach($item->children as $child)
                                                    <div class="sortable-item" data-id="{{ $child->id }}" data-parent-id="{{ $item->id }}">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="drag-handle">☰</span>
                                                                <strong>{{ $child->title }}</strong>
                                                                <span class="ml-2">({{ $child->slug ?? '#' }})</span>

                                                                {{-- @if($child->is_active)
                                                                    <span class="badge badge-active ml-2">{{ trans('admin.active') }}</span>
                                                                @else
                                                                    <span class="badge badge-inactive ml-2">{{ trans('admin.inactive') }}</span>
                                                                @endif --}}
                                                            </div>

                                                            <div class="item-actions">
                                                                <button type="button"
                                                                        class="btn btn-sm btn-info edit-item"
                                                                        data-id="{{ $child->id }}"
                                                                        data-title="{{ $child->title }}">
                                                                    <i class="la la-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    {{-- <div class="modal fade" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('admin.add_navbar_item') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form id="createForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="form-group">
                            <label>{{ trans('admin.slug') }}</label>
                            <input type="text" class="form-control" name="slug" placeholder="/about or #">
                        </div>

                        <div class="form-group">
                            <label>{{ trans('admin.parent_item') }}</label>
                            <select class="form-control" name="parent_id">
                                <option value="">{{ trans('admin.none') }}</option>
                                @foreach($allItems as $it)
                                    <option value="{{ $it->id }}">{{ $it->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="m-checkbox">
                                <input type="checkbox" name="is_active" value="1" checked>
                                {{ trans('admin.is_active') }}
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('admin.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ trans('admin.edit_navbar_item') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form id="editForm">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ trans('admin.title') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="edit_title" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('admin.update') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        /**
         * Simple fetch wrapper with JSON + CSRF.
         */
        function api(url, method = 'GET', data = null) {
            const headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': (typeof TOKN !== 'undefined') ? TOKN : '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            };

            return fetch(url, {
                method: method,
                headers: headers,
                body: data ? JSON.stringify(data) : null,
            }).then(async (res) => {
                const json = await res.json().catch(() => ({}));

                if (!res.ok) {
                    const msg =
                        json.message ||
                        (json.errors ? JSON.stringify(json.errors) : null) ||
                        `Request failed (${res.status})`;
                    throw new Error(msg);
                }

                return json;
            });
        }

        let orderChanged = false;

        function showSaveButton() {
            orderChanged = true;
            const btn = document.getElementById('saveOrderBtn');
            if (btn) btn.style.display = 'inline-block';
        }

        // Root sortable
        const rootList = document.getElementById('navbarItemsList');
        if (rootList) {
            new Sortable(rootList, {
                animation: 150,
                draggable: '.sortable-item',
                handle: '.drag-handle',
                group: { name: 'root', pull: false, put: false }, // prevent moving in/out
                onEnd: showSaveButton
            });
        }

        // Children sortable (prevent moving between parents)
        document.querySelectorAll('.children-list').forEach(function (childrenList) {
            new Sortable(childrenList, {
                animation: 150,
                draggable: '.sortable-item',
                handle: '.drag-handle',
                group: { name: 'children-' + childrenList.dataset.parentId, pull: false, put: false },
                onEnd: showSaveButton
            });
        });

        function buildReorderPayload() {
            const items = [];
            let rootOrder = 0;

            const rootItems = document.querySelectorAll('#navbarItemsList > .sortable-item');

            rootItems.forEach(function (rootItem) {
                const rootId = parseInt(rootItem.dataset.id, 10);
                if (!rootId) return;

                items.push({ id: rootId, order: rootOrder++, parent_id: null });

                const childrenList = rootItem.querySelector(':scope > .children-list');
                if (!childrenList) return;

                let childOrder = 0;
                const childItems = childrenList.querySelectorAll(':scope > .sortable-item');

                childItems.forEach(function (childItem) {
                    const childId = parseInt(childItem.dataset.id, 10);
                    if (!childId) return;

                    items.push({ id: childId, order: childOrder++, parent_id: rootId });
                });
            });

            return { items };
        }

        // Save order
        document.getElementById('saveOrderBtn')?.addEventListener('click', function () {
            const payload = buildReorderPayload();

            if (!payload.items.length) {
                alert('{{ trans("admin.no_items_to_save") }}');
                return;
            }

            const btn = this;
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="la la-spinner la-spin"></i> {{ trans("admin.saving") }}...';

            api('{{ route_admin("navbar-items.reorder") }}', 'POST', payload)
                .then(() => location.reload())
                .catch((e) => {
                    btn.disabled = false;
                    btn.innerHTML = original;
                    alert('Error: ' + e.message);
                });
        });

        // Create
        document.getElementById('createForm')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const fd = new FormData(this);
            const data = {
                title: fd.get('title'),
                slug: fd.get('slug') || null,
                parent_id: fd.get('parent_id') || null,
                is_active: fd.has('is_active') ? 1 : 0,
            };

            api('{{ route_admin("navbar-items.store") }}', 'POST', data)
                .then(() => location.reload())
                .catch((e) => alert('Error: ' + e.message));
        });

        // Open edit modal
        document.querySelectorAll('.edit-item').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('edit_id').value = this.dataset.id;
                document.getElementById('edit_title').value = this.dataset.title;

                $('#editModal').modal('show');
            });
        });

        // Update
        document.getElementById('editForm')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const fd = new FormData(this);
            const id = fd.get('id');

            const data = {
                title: fd.get('title'),
            };

            const url = '{{ route_admin("navbar-items.update", ["navbarItem" => "__id__"]) }}'.replace('__id__', id);

            api(url, 'PUT', data)
                .then(() => location.reload())
                .catch((e) => alert('Error: ' + e.message));
        });

        // Delete
        document.querySelectorAll('.delete-item').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (!confirm('{{ trans("admin.are_you_sure") }}')) return;

                const id = this.dataset.id;
                const url = '{{ route_admin("navbar-items.destroy", ["navbarItem" => "__id__"]) }}'.replace('__id__', id);

                api(url, 'DELETE')
                    .then(() => location.reload())
                    .catch((e) => alert('Error: ' + e.message));
            });
        });
    </script>
@endpush

