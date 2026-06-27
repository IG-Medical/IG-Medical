@php
    $isEdit = !empty($banner);
    $route  = $isEdit ? route_admin('banners.update', $banner) : route_admin('banners.store');
@endphp

@push('css')
    <style>
        .product-select-wrapper {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
        }
        .banner-image-upload-wrapper {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #e9ecef;
        }
        .preview-container { text-align: center; }
        .preview-container img { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
@endpush

<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon"><i class="flaticon-picture"></i></span>
                            <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        {{-- IMAGE --}}
                        <div class="form-group">
                            <label>{{ trans('admin.image') }} @if(!$isEdit)<span class="text-danger">*</span>@endif</label>

                            <div class="banner-image-upload-wrapper">
                                <input
                                    type="file"
                                    name="image"
                                    id="banner_image"
                                    accept="image/*"
                                    class="form-control-file mb-3"
                                    @if(!$isEdit) required @endif
                                >

                                @error('image')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror

                                {{-- preview placeholder (JS will fill) --}}
                                <div class="banner-image-preview mb-3" id="newPreview" style="display:none;">
                                    <div class="preview-container">
                                        <img id="newPreviewImg" src="" alt="Banner Preview" class="img-fluid"
                                             style="max-width:100%;max-height:300px;border:1px solid #ddd;border-radius:4px;padding:5px;">
                                        <button type="button" class="btn btn-sm btn-danger mt-2" id="removePreviewBtn">
                                            <i class="la la-trash"></i> {{ trans('admin.remove_image') }}
                                        </button>
                                    </div>
                                </div>

                                @if($isEdit && !empty($banner->image))
                                    <div class="current-image-preview mb-3" id="currentPreview">
                                        <div class="preview-container">
                                            <img src="{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $banner->image) }}"
                                                alt="Current Banner" class="img-fluid"
                                                style="max-width:100%;max-height:300px;border:1px solid #ddd;border-radius:4px;padding:5px;">
                                            <p class="text-muted mt-2"><small>{{ trans('admin.current_image') }}</small></p>
                                        </div>
                                    </div>
                                @endif

                                <small class="form-text text-muted d-block mt-2">
                                    {{ trans('admin.recommended_size') }}: 800x400px
                                </small>
                            </div>
                        </div>

                        {{-- CATEGORIES --}}
                        <div class="form-group">
                            <label>{{ trans('admin.categories') }} <small class="text-muted">({{ trans('admin.max_2_categories') }})</small></label>
                            <div class="product-select-wrapper">
                                <select multiple name="category_ids[]" id="category_ids" class="form-control" size="10">
                                    @php
                                        $selectedIds = [];
                                        if ($isEdit && isset($banner) && $banner->categories) {
                                            $selectedIds = $banner->categories->pluck('id')->map(fn($v) => (int)$v)->toArray();
                                        }
                                        $oldIds = old('category_ids', null);
                                        if (is_array($oldIds) && !empty($oldIds)) {
                                            $selectedIds = array_map('intval', $oldIds);
                                        }
                                    @endphp

                                    @forelse($categories ?? [] as $category)
                                        <option value="{{ $category->id }}"{{ in_array((int)$category->id, $selectedIds, true) ? ' selected' : '' }}>
                                            {{ $category->name ?? trans('admin.unnamed_category') }}
                                        </option>
                                    @empty
                                        <option disabled>{{ trans('admin.no_categories_available') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            <small class="form-text text-muted">{{ trans('admin.max_2_categories_selected') }}</small>

                            @error('category_ids')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            @error('category_ids.*')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ $isEdit ? trans('admin.update') : trans('admin.save') }}
                            </button>
                            <a href="{{ route_admin('banners.index') }}" class="btn btn-secondary">
                                {{ trans('admin.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        (function () {
            const input = document.getElementById('banner_image');
            if (!input) return;

            const newPreview = document.getElementById('newPreview');
            const newPreviewImg = document.getElementById('newPreviewImg');
            const removeBtn = document.getElementById('removePreviewBtn');
            const currentPreview = document.getElementById('currentPreview');

            function clearNewPreview() {
                input.value = '';
                if (newPreview) newPreview.style.display = 'none';
                if (newPreviewImg) newPreviewImg.src = '';
                if (currentPreview) currentPreview.style.display = '';
            }

            input.addEventListener('change', function () {
                const file = input.files && input.files[0];
                if (!file) {
                    clearNewPreview();
                    return;
                }

                if (!file.type || !file.type.match(/^image\//)) {
                    alert(@json(trans('admin.invalid_image_type')));
                    clearNewPreview();
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert(@json(trans('admin.image_too_large')));
                    clearNewPreview();
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    if (newPreviewImg) newPreviewImg.src = e.target.result;
                    if (newPreview) newPreview.style.display = '';
                    if (currentPreview) currentPreview.style.display = 'none';
                };
                reader.readAsDataURL(file);
            });

            if (removeBtn) {
                removeBtn.addEventListener('click', function () {
                    clearNewPreview();
                });
            }

            // Initialize category select with max 2 selection limit
            const categorySelect = document.getElementById('category_ids');
            if (categorySelect) {
                // Ensure selected options are properly displayed on page load
                @if(!empty($selectedIds))
                    const selectedValues = @json($selectedIds);
                    // The @selected directive should handle this, but ensure it's set
                    selectedValues.forEach(function(value) {
                    const option = categorySelect.querySelector('option[value="' + value + '"]');
                    if (option) {
                        option.selected = true;
                    }
                });
                @endif

                // Limit selection to max 2 categories
                categorySelect.addEventListener('change', function(e) {
                    const selected = Array.from(this.selectedOptions).map(opt => opt.value);
                    
                    if (selected.length > 2) {
                        alert(@json(trans('admin.max_2_categories_allowed')));
                        // Keep only the last 2 selected (most recent)
                        const toKeep = selected.slice(-2);
                        Array.from(this.options).forEach(function(option) {
                            option.selected = toKeep.includes(option.value);
                        });
                        // Trigger change event to update any listeners
                        this.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });

                // Prevent selecting more than 2 with Ctrl/Cmd click
                categorySelect.addEventListener('mousedown', function(e) {
                    const selected = Array.from(this.selectedOptions).map(opt => opt.value);
                    if (selected.length >= 2 && !e.target.selected) {
                        // If 2 already selected and trying to select another, prevent it
                        if (!e.ctrlKey && !e.metaKey) {
                            // If not using Ctrl/Cmd, allow normal behavior (will deselect others)
                            return;
                        }
                        // If using Ctrl/Cmd and already have 2, prevent adding more
                        e.preventDefault();
                        alert(@json(trans('admin.max_2_categories_allowed')));
                    }
                });
            }
        })();
    </script>
@endpush
