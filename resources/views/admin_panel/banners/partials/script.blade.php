@php
    $isEdit = !empty($banner);
    $route = $isEdit ? route_admin('banners.update', $banner) : route_admin('banners.store');
@endphp

<script>
    (function () {
        if (!window.Vue) return;

        new Vue({
            el: '#banner-form',
            data: function () {
                return {
                    form: {
                        title: @json($isEdit ? ($banner->title ?? '') : ''),
                        image: @json($isEdit ? ($banner->image ?? '') : ''),
                        link: @json($isEdit ? ($banner->link ?? '') : ''),
                        position: {{ $isEdit ? (int)($banner->position ?? 0) : 0 }},
                        is_active: {{ $isEdit ? ((int)($banner->is_active ?? 1) === 1 ? 'true' : 'false') : 'true' }},
                        product_ids: @json($isEdit ? $banner->products->pluck('id')->map(fn($id)=> (int)$id)->values() : []),
                        disabledButton: false,
                        validation: {}
                    },

                    imgDataUrl: '',
                    imageFile: null
                };
            },

            mounted() {
                // Initialize preview for edit mode (existing image)
                @if($isEdit && !empty($banner->image))
                    this.imgDataUrl = @json(assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $banner->image));
                @endif

                // If you use select2, keep it synced with v-model
                this.$nextTick(() => {
                    if (window.$ && $.fn.select2) {
                        const $select = $(this.$el).find('select.select2');
                        $select.select2();

                        // Update v-model when select2 changes
                        $select.on('change', () => {
                            const values = $select.val() || [];
                            this.form.product_ids = values.map(v => parseInt(v, 10));
                        });

                        // Update select2 when v-model changes (simple case)
                        this.$watch('form.product_ids', (val) => {
                            $select.val((val || []).map(String)).trigger('change.select2');
                        }, { deep: true });

                        // Set initial value
                        $select.val((this.form.product_ids || []).map(String)).trigger('change.select2');
                    }
                });
            },

            methods: {
                triggerFilePicker() {
                    if (this.$refs.imageInput) {
                        this.$refs.imageInput.click();
                    }
                },

                handleImageChange(event) {
                    const file = event.target.files && event.target.files[0];
                    if (!file) return;

                    if (!file.type || !file.type.match('image.*')) {
                        alert(@json(trans('admin.invalid_image_type')));
                        return;
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        alert(@json(trans('admin.image_too_large')));
                        return;
                    }

                    this.imageFile = file;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imgDataUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                removeImage() {
                    this.imgDataUrl = '';
                    this.form.image = '';
                    this.imageFile = null;

                    if (this.$refs.imageInput) {
                        this.$refs.imageInput.value = '';
                    }
                },

                async uploadImageBase64() {
                    if (!this.imageFile) {
                        return this.form.image || '';
                    }

                    const base64 = await new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.onload = (e) => resolve(e.target.result);
                        reader.onerror = reject;
                        reader.readAsDataURL(this.imageFile);
                    });

                    const url = '{{ url("uploads/image") }}/{{ \App\Models\Banner::DIR_UPLOADS }}';

                    const res = await axios.post(url, { img: base64 }, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (res.data && res.data.location) {
                        return res.data.location;
                    }

                    throw new Error('Upload failed');
                },

                async save() {
                    this.form.validation = {};
                    this.form.disabledButton = true;

                    @if(!$isEdit)
                        if (!this.imageFile && !this.form.image) {
                            alert(@json(trans('admin.image_required')));
                            this.form.disabledButton = false;
                            return;
                        }
                    @endif

                    try {
                        let imageValue = this.form.image;

                        if (this.imageFile) {
                            imageValue = await this.uploadImageBase64();
                        }

                        const payload = {
                            title: this.form.title || null,
                            image: imageValue || null,
                            link: this.form.link || null,
                            position: this.form.position || 0,
                            is_active: this.form.is_active ? 1 : 0,
                            product_ids: this.form.product_ids || []
                        };

                        @if($isEdit)
                            payload._method = 'PUT';
                            const response = await axios.post('{{ $route }}', payload, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                        @else
                            const response = await axios.post('{{ $route }}', payload, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                        @endif

                        if (response.data && response.data.status) {
                            window.location.href = '{{ route_admin("banners.index") }}';
                            return;
                        }

                        this.form.validation = (response.data && response.data.errors) ? response.data.errors : {};
                        this.form.disabledButton = false;

                    } catch (error) {
                        this.form.validation = error?.response?.data?.errors || {};
                        this.form.disabledButton = false;
                        alert(error?.response?.data?.message || @json(trans('admin.error_occurred')));
                    }
                }
            }
        });
    })();
</script>
