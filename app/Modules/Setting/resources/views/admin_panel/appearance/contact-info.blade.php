@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-contact-info :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
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
                                <div class="form-group row  pb-4">
                                    <div class="col-lg-6">
                                        <label>{{ trans('admin.email') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="contact_info.email" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-envelope"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.email">@{{ form.validation.email[0] }}</span>
                                    </div>
                                    <div class="col-lg-6" >
                                        <label>{{ trans('admin.phone') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="contact_info.phone" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-phone"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.phone">@{{ form.validation.phone[0] }}</span>
                                    </div>
                                </div>
                                {!! build_fields('address',trans_admin('address')) !!}
                                <div class="form-group row  pb-4">
                                    <div class="col-lg-12">
                                        <label>{{ trans('admin.global_website') }}</label>
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" v-model="contact_info.global_website" class="form-control m-input"/>
                                            <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="la la-link"></i></span></span>
                                        </div>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.global_website">@{{ form.validation.global_website[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label> {{  trans_admin('location') }}  :
                                            <a href="https://www.embedgooglemap.net/" target="_blank">{{ trans_admin('click') }}</a>
                                        </label>
                                        <br/>
                                        <textarea  name="google_map" v-model="contact_info.google_map" rows="6" class="form-control"></textarea>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.google_map">@{{ form.validation.google_map[0] }}</span>
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
    </appearance-contact-info>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
