@extends('admin_panel.layouts.app')

@push('page-title')
    {{last(meta('breadcrumbs'))}}
@endpush

@section('content')
    <admin-form :admin="{{ isset($admin) ? json_encode($admin) : 'null'}}" inline-template>
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
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>{{ trans_admin('first_name') }}</label>
                                        <input type="text" v-model="first_name" class="form-control m-input" placeholder="{{ trans_admin('first_name') }}">
                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{ trans_admin('last_name') }}</label>
                                        <input type="text" v-model="last_name" class="form-control m-input" placeholder="{{ trans_admin('last_name') }}">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.last_name">@{{ form.validation.last_name[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row" v-if="!id">
                                    <div class="col-lg-6">
                                        <label>{{ trans_admin('password') }}</label>
                                        <input type="password" v-model="password" class="form-control m-input" placeholder="{{ trans_admin('password') }}">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.password">@{{ form.validation.password[0] }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{ trans_admin('password_confirm') }}</label>
                                        <input type="password" v-model="password_confirmation"class="form-control m-input" placeholder="{{ trans_admin('password_confirm') }} ">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.password_confirmation">@{{ form.validation.password_confirmation[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>{{ trans_admin('email') }}</label>
                                        <input type="email" v-model="email" class="form-control m-input" placeholder="{{ trans_admin('email') }}">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.email">@{{ form.validation.email[0] }}</span>
                                    </div>
{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>Mobile</label>--}}
{{--                                        <vue-tel-input v-model="showMobile"--}}
{{--                                                       @input="onInput"--}}
{{--                                                       :ignored-countries="['IL']"--}}
{{--                                                       :auto-default-country="false"--}}
{{--                                                       :dropdown-options="{showDialCodeInSelection:true,showFlags:true}"--}}
{{--                                                       :valid-characters-only="true"--}}
{{--                                                       :preferred-countries="['PS']">--}}
{{--                                        </vue-tel-input>--}}
{{--                                        <span class="form-control-feedback" v-if="form.validation && form.validation.mobile">@{{ form.validation.mobile[0] }}</span>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>{{trans_admin('role')}}</label>
                                        <select class="form-control" v-model="role">
                                            <option value="">{{ trans_admin('select_role') }}</option>
                                            <option v-for="role in roles" :value="role.id">@{{ role.name }}</option>
                                        </select>
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.role">@{{ form.validation.role[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.partials.image_upload',['label' => ' Personal Photo','key'=>null])
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
