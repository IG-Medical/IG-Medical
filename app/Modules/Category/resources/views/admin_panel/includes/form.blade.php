<div class="col-md-8">
    <div class="m-portlet m-portlet--full-height ">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">@{{ page_title }}</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <form class="m-form m-form--label-align-left- m-form--state-">
                <div class="row" v-if="root_id">
                    <div class="col-md-12 pb-4">
                        <div class="form-group m-form__group">
                            <label for="icon">{{ trans_module_category('admin.parent_category') }}</label>
                            <input type="text" v-model="root_name" disabled class="form-control">
                        </div>
                    </div>
                </div>

                {!! html_entity_decode(build_fields('name',trans_module_category('admin.name'))) !!}
                {!! html_entity_decode(build_fields('short_description',trans_module_category('admin.short_description'),null,'textarea')) !!}

                <div class="row">
                    @foreach(languages() as $key => $value)
                        <div class="col-md-6 pb-4">
                            <div class="form-group m-form__group">
                                <label for="{{'description'.$key}}">{{ trans_module_category('admin.description') }}</label>
                                <tinymce id="{{'description'.$key}}" v-model="description.{{$key}}" :other_options="options"></tinymce>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6 pb-4">
                        <div class="form-group m-form__group">
                            <label for="icon">{{ trans_module_category('admin.icon') }}</label>
                            <div>
                                <button @click="toggleShowIcon" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                    <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                </button>
                                <my-upload field="img"
                                           @crop-success="cropSuccessIcon"
                                           @crop-upload-success="cropUploadSuccessIcon"
                                           @crop-upload-fail="cropUploadFailIcon"
                                           v-model.bool="showIcon"
                                           :width="70"
                                           :height="70"
                                           url="{{ route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]) }}"
                                           :headers="headers"
                                           lang-type="{{ getAppLocale() }}"
                                           :no-square="true">
                                </my-upload>
                                <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                <img class="user_profile" v-if="iconDataUrl" :src="iconDataUrl" width="100" height="100" style="margin-left: 5%;">
                            </div>

{{--                            <upload-file :file.sync="icon"--}}
{{--                                         :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                         placeholder="{{ trans_module_category('admin.icon') }}"--}}
{{--                                         upload="{{$DIR_UPLOADS}}"--}}
{{--                                         id="icon"--}}
{{--                                         :value-prop="{name:'{{ trans_module_category('admin.icon') }}',path:icon_url}">--}}
{{--                            </upload-file>--}}
{{--                            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.icon">@{{ form.validation.icon[0] }}</span>--}}
                        </div>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="form-group m-form__group">
                            <label for="image">{{ trans_module_category('admin.image') }}</label>
{{--                            <div>--}}
{{--                                <button @click="toggleShowImage" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">--}}
{{--                                    <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}--}}
{{--                                </button>--}}
{{--                                <my-upload field="img"--}}
{{--                                           @crop-success="cropSuccessImage"--}}
{{--                                           @crop-upload-success="cropUploadSuccessImage"--}}
{{--                                           @crop-upload-fail="cropUploadFailImage"--}}
{{--                                           v-model.bool="showImage"--}}
{{--                                           :width="270"--}}
{{--                                           :height="180"--}}
{{--                                           url="{{ route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]) }}"--}}
{{--                                           :headers="headers"--}}
{{--                                           lang-type="{{ getAppLocale() }}"--}}
{{--                                           :no-square="true">--}}
{{--                                </my-upload>--}}
{{--                                <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>--}}
{{--                                <img class="user_profile" v-if="imgDataUrl" :src="imgDataUrl" width="100" height="100" style="margin-left: 5%;">--}}
{{--                            </div>--}}

                            <upload-file :file.sync="image"
                                         :type-extension="['jpg', 'jpeg', 'png','svg']"
                                         placeholder="{{ trans_module_category('admin.image') }}"
                                         upload="{{$DIR_UPLOADS}}"
                                         id="image"
                                         :value-prop="{name:'{{ trans_module_category('admin.image') }}',path:image_url}">
                            </upload-file>
                            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.image">@{{ form.validation.image[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="form-group m-form__group">
                            <label for="breadcrumb_image">{{ trans_module_category('admin.breadcrumb_image') }}</label>
                            <div>
                                <button @click="toggleShowBreadcrumbImage" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                    <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                </button>
                                <my-upload field="img"
                                           @crop-success="cropSuccessBreadcrumbImage"
                                           @crop-upload-success="cropUploadSuccessBreadcrumbImage"
                                           @crop-upload-fail="cropUploadFailBreadcrumbImage"
                                           v-model.bool="showBreadcrumbImage"
                                           :width="1349"
                                           :height="390"
                                           url="{{ route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]) }}"
                                           :headers="headers"
                                           lang-type="{{ getAppLocale() }}"
                                           :no-square="true">
                                </my-upload>
                                <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                <img class="user_profile" v-if="imgBreadcrumbDataUrl" :src="imgBreadcrumbDataUrl" width="100" height="100" style="margin-left: 5%;">
                            </div>

{{--                            <upload-file :file.sync="breadcrumb_image"--}}
{{--                                         :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                         placeholder="{{ trans_module_category('admin.breadcrumb_image') }}"--}}
{{--                                         upload="{{$DIR_UPLOADS}}"--}}
{{--                                         id="breadcrumb_image"--}}
{{--                                         :value-prop="{name:'{{ trans_module_category('admin.breadcrumb_image') }}',path:breadcrumb_image_url}">--}}
{{--                            </upload-file>--}}
{{--                            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.breadcrumb_imgage">@{{ form.validation.breadcrumb_image[0] }}</span>--}}
                        </div>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="form-group m-form__group">
                            <label for="breadcrumb_video_upload">{{ trans_module_category('admin.breadcrumb_video_upload') }}</label>
                            <upload-file :file.sync="breadcrumb_video_upload"
                                         @remove-video="listenerBreadcrumbVideoUpload"
                                         :type-extension="['mp4']"
                                         placeholder="{{ trans_module_category('admin.breadcrumb_video_upload') }}"
                                         upload="{{$DIR_UPLOADS}}"
                                         id="breadcrumb_video_upload"
                                         :value-prop="{name:'{{ trans_module_category('admin.breadcrumb_video_upload') }}',path:breadcrumb_video_upload_url}">
                            </upload-file>
                            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.breadcrumb_video">@{{ form.validation.breadcrumb_video_upload[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="form-group m-form__group">
                            <label for="breadcrumb_image">{{ trans_module_category('admin.breadcrumb_video_url') }}</label>
                            <input type="text" v-model="breadcrumb_video" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 pb-4">
                        <label class="m-checkbox">
                            <input type="checkbox" v-model="is_featured"> {{ trans_module_category('admin.is_featured') }}
                            <span></span>
                        </label>
                        <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.is_featured">@{{ form.validation.is_featured[0] }}</span>
                    </div>
                    <div class="col-md-12 pb-4">
                        <label class="m-checkbox">
                            <input type="checkbox" v-model="is_active"> {{ trans_module_category('admin.is_enable') }}
                            <span></span>
                        </label>
                        <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.is_active">@{{ form.validation.is_active[0] }}</span>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions pl-1">
                        @include($asRoute.'::admin_panel.partials.buttons.save')
                        @include($asRoute.'::admin_panel.partials.buttons.reset')
                        @include($asRoute.'::admin_panel.partials.buttons.delete')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
