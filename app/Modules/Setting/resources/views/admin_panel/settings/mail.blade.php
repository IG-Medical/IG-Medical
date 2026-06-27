
@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <setting-email-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
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
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group">
                                    <label for="from_address">Mail From Addresss</label>
                                    <input type="email" v-model="email.from_address" class="form-control m-input m-input--square" id="from_address" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_from_address">@{{ form.validation.mail_from_address[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="from_name">Mail From Name</label>
                                    <input type="text" v-model="email.from_name" class="form-control m-input m-input--square" id="from_name" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_from_name">@{{ form.validation.mail_from_name[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="host">Mail Host</label>
                                    <input type="text" v-model="email.host" class="form-control m-input m-input--square" id="host" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_host">@{{ form.validation.mail_host[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="port">Mail Port</label>
                                    <input type="text" v-model="email.port" class="form-control m-input m-input--square" id="port" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_port">@{{ form.validation.mail_port[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="username">Mail Username</label>
                                    <input type="text" v-model="email.username" class="form-control m-input m-input--square" id="username" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_username">@{{ form.validation.mail_username[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="password">Mail Password</label>
                                    <input type="text" v-model="email.password" class="form-control m-input m-input--square" id="password" aria-describedby="emailHelp" placeholder="Enter ">
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_password">@{{ form.validation.mail_password[0] }}</span>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="encryption">Mail Encryption</label>
                                    <select v-model="email.encryption" class="form-control m-input m-input--square" id="encryption">
                                        <option value="">Please Select</option>
                                        <option value="ssl">SSL</option>
                                        <option value="tls">TLS</option>
                                    </select>
                                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mail_encryption">@{{ form.validation.mail_encryption[0] }}</span>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </setting-email-form>
@endsection




@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush

