@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <user-form :user="{{ isset($user) ? json_encode($user) : 'null' }}" inline-template>
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
                            @include(ADMIN_VIEWS_DIR.'.partials.buttons.back')
                        </div>
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>First Name</label>
                                        <input type="text" v-model="first_name" class="form-control m-input" placeholder="First Name">
                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Last Name</label>
                                        <input type="text" v-model="last_name" class="form-control m-input" placeholder="Last Name">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.last_name">@{{ form.validation.last_name[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row" v-if="!id">
                                    <div class="col-lg-6">
                                        <label>Password</label>
                                        <input type="password" v-model="password" class="form-control m-input" placeholder="Password">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.password">@{{ form.validation.password[0] }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Confirm Password</label>
                                        <input type="password" v-model="password_confirmation"class="form-control m-input" placeholder="Confirm Password">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.password_confirmation">@{{ form.validation.password_confirmation[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>Email</label>
                                        <input type="email" v-model="email" class="form-control m-input" placeholder="Email">
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.email">@{{ form.validation.email[0] }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Mobile</label>
                                        <vue-tel-input v-model="showMobile"
                                                       @input="onInput"
                                                       :ignored-countries="['IL']"
                                                       :auto-default-country="false"
                                                       :dropdown-options="{showDialCodeInSelection:true,showFlags:true}"
                                                       :valid-characters-only="true"
                                                       :preferred-countries="['DE']">
                                        </vue-tel-input>
                                        <span class="form-control-feedback" v-if="form.validation && form.validation.mobile">@{{ form.validation.mobile[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
{{--                                        @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.partials.image_upload',['label' => ' Personal Photo','key'=>null])--}}
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
    </user-form>
@endsection

@php $is_module = true; @endphp
@push('js')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
