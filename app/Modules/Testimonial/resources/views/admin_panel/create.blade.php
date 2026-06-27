@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <testimonial-form :testimonial="{{ isset($testimonial) ? json_encode($testimonial) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">{{ last(meta('breadcrumbs')) }}</h3>
                                </div>
                            </div>
                            @include('admin_panel.partials.buttons.back')
                        </div>
                        <div class="m-portlet__body">
                            <form class="m-form m-form--label-align-left- m-form--state-">

                                <div class="col-md-12 pb-4">
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans_module_testimonial('admin.full_name') }}</label>
                                        <input type="text" v-model="full_name" class="form-control"/>
                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.full_name">@{{ form.validation.full_name[0] }}</span>
                                    </div>
                                </div>
{{--                                <div class="col-md-12 pb-4">--}}
{{--                                    <div class="form-group m-form__group">--}}
{{--                                        <label for="">{{ trans_module_testimonial('admin.job_title') }}</label>--}}
{{--                                        <input type="text" v-model="job_title" class="form-control"/>--}}
{{--                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.job_title">@{{ form.validation.job_title[0] }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12 pb-4">
                                    <div class="form-group m-form__group">
                                        <label for="">{{ trans_module_testimonial('admin.testimonial_text') }}</label>
                                        <textarea v-model="testimonial_text" class="form-control"></textarea>
                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.testimonial_text">@{{ form.validation.testimonial_text[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12 pb-4">
                                    <div class="form-group m-form__group">
                                        <label for="avatar">{{ trans_module_testimonial('admin.avatar') }}</label>
                                        @include('admin_panel.partials.image_upload',['url' => route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]),'width' => 80,'height'=> 80, 'key' => null])

                                        {{--                                        <upload-file :file.sync="image"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_testimonial('admin.avatar') }}"--}}
{{--                                                     upload="{{$DIR_UPLOADS}}"--}}
{{--                                                     id="avatar"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_testimonial('avatar') }}',path:image_url}">--}}
{{--                                        </upload-file>--}}
{{--                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.image">@{{ form.validation.image[0] }}</span>--}}
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions" style="padding: 16px;">
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </testimonial-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/testimonial.js') }}"></script>
@endpush
