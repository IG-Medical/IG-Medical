@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-social-links :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title"><span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                    <h3 class="m-portlet__head-text"> {{ meta('breadcrumbs-title') }}</h3>
                                </div>
                            </div>
                        </div>
                        <form class="m-form m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12" >
                                        <label>{{ trans('admin.facebook') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="social_links.facebook" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-facebook"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.facebook">@{{ form.validation.facebook[0] }}</span>
                                    </div>
                                </div>
{{--                                <div class="form-group m-form__group row">--}}
{{--                                    <div class="col-lg-12" >--}}
{{--                                        <label>{{ trans('admin.twitter') }}</label>--}}
{{--                                        <div class="m-input-icon m-input-icon--left">--}}
{{--                                            <input type="text" v-model="social_links.twitter" class="form-control m-input"/>--}}
{{--                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-twitch"></i></span></span>--}}
{{--                                        </div>--}}
{{--                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.twitter">@{{ form.validation.twitter[0] }}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12" >
                                        <label>{{ trans('admin.youtube') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="social_links.youtube" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-youtube"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.youtube">@{{ form.validation.youtube[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12" >
                                        <label>{{ trans('admin.instagram') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="social_links.instagram" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-instagram"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.instagram">@{{ form.validation.instagram[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12" >
                                        <label>{{ trans('admin.linkedin') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="social_links.linkedin" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-linkedin"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.linkedin">@{{ form.validation.linkedin[0] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </appearance-social-links>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
