@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <slider-form :slider="{{ isset($slider) ? json_encode($slider) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                    <h3 class="m-portlet__head-text">{{ last(meta('breadcrumbs')) }}</h3>
                                </div>
                            </div>
                            @include('admin_panel.partials.buttons.back')
                        </div>
                        <div class="col-xl-12">
                            <div class="m-portlet--tab">
                                <form class="m-form m-form--fit m-form--label-align-right m-form--state">
                                    <div class="m-portlet__body">
                                        <div class="row">
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="form-group m-form__group">--}}
{{--                                                <div class="m-alert m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">--}}
{{--                                                    <strong>{{ trans_module_banner('admin.warning!') }}</strong>--}}
{{--                                                    {{ trans_module_banner('admin.preferred_upload_image_dimensions') }}--}}
{{--                                                    855 * 400--}}
{{--                                                </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            @foreach(languages() as $key => $value)
                                                <div class="col-md-6 pb-4">
                                                    <div class="form-group m-form__group">
                                                        <label for="image_{{$key}}">{{ trans_module_slider('admin.background') . ' '.trans_module_slider('admin.language') . ' '. $value}}</label>
{{--                                                        <upload-file :file.sync="background_image.{{$key}}"--}}
{{--                                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                                     placeholder="{{ trans_module_slider('admin.background') . ' '.trans_module_slider('admin.language') . ' '. $value }}"--}}
{{--                                                                     upload="{{$DIR_SLIDER_UPLOADS}}"--}}
{{--                                                                     id="background_{{$key}}"--}}
{{--                                                                     :value-prop="{name:'{{ trans_module_slider('admin.background') . ' '.trans_module_slider('admin.language') . ' '. $value }}',path:background_image_url.{{$key}}}">--}}
{{--                                                        </upload-file>--}}
                                                        @include('admin_panel.partials.image_upload',['url' => route('upload.uploadFileOnCrop',['dir' => $DIR_SLIDER_UPLOADS]),'width' => 1349,'height'=> 526])
                                                        {{--<span class="form-control-feedback error-block" v-if="form.validation&&form.validation.image.{{$key}}">@{{ form.validation.image }}</span>--}}
                                                    </div>
                                                </div>
                                            @endforeach

{{--                                            <div class="col-md-6 pb-4">--}}
{{--                                                <div class="form-group m-form__group">--}}
{{--                                                    <label for="background">{{ trans_admin('background') }}</label>--}}
{{--                                                    <upload-file :file.sync="background_image"--}}
{{--                                                                 :type-extension="['jpg', 'jpeg', 'png']"--}}
{{--                                                                 placeholder="{{ trans_admin('background') }}"--}}
{{--                                                                 upload="{{$DIR_SLIDER_UPLOADS}}"--}}
{{--                                                                 id="background"--}}
{{--                                                                 :value-prop="{name:'{{ trans_admin('background') }}',path:background_image_url}">--}}
{{--                                                    </upload-file>--}}
{{--                                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.background_image">@{{ form.validation.background_image[0] }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12 12">--}}
{{--                                                <div class="form-group m-form__group">--}}
{{--                                                    <label for="">{{ trans_module_slider('admin.call_to_action_url_3') }}</label>--}}
{{--                                                    <input type="text" v-model="call_to_action_url_3" class="form-control"/>--}}
{{--                                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.call_to_action_url_3">@{{ form.validation.call_to_action_url_3[0] }}</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        {!! build_fields('caption_1',trans_module_slider('admin.caption_1')) !!}

                                        {!! build_fields('caption_2',trans_module_slider('admin.caption_2')) !!}

                                        {!! build_fields('call_to_action_text_1',trans_module_slider('admin.call_to_action_text_1')) !!}

                                       <div class="row">
                                           <div class="col-md-12 pb-4">
                                               <div class="form-group m-form__group">
                                                   <label for="">{{trans_module_slider('admin.call_to_action_url_1')}}</label>
                                                   <input type="text" v-model="call_to_action_url_1" class="form-control"/>
                                               </div>
                                           </div>
                                       </div>

                                        {!! build_fields('call_to_action_text_2',trans_module_slider('admin.call_to_action_text_2')) !!}

                                        <div class="row">
                                            <div class="col-md-12 pb-4">
                                                <div class="form-group m-form__group">
                                                    <label for="">{{trans_module_slider('admin.call_to_action_url_2')}}</label>
                                                    <input type="text" v-model="call_to_action_url_2" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12 pb-4">
                                                <div class="form-group m-form__group">
                                                    <label for="">{{trans_module_slider('admin.video')}}</label>
                                                    <input type="text" v-model="call_to_action_url_3" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 pb-4">
                                                <div class="form-group m-form__group">
                                                    <label class="m-checkbox">
                                                        <input type="checkbox" v-model="home_page_center"> home page center
                                                        <span></span>
                                                    </label>
                                                    <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.home_page_center">@{{ form.validation.home_page_center[0] }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-4">
                                                <div class="form-group m-form__group">
                                                    <label class="m-checkbox">
                                                        <input type="checkbox" v-model="home_page_top"> home page top
                                                        <span></span>
                                                    </label>
                                                    <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.home_page_top">@{{ form.validation.home_page_top[0] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </slider-form>
@endsection



@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/slider.js') }}"></script>
@endpush
