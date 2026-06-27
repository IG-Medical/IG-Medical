@extends('admin_panel.layouts.auth')

@push('page-title')
    @lang('admin.sign_in')
@endpush

@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-3" id="m_login" style="background-image: url({{ asset_admin('assets/app/media/img/bg/bg-2.jpg') }});">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="{{$data['header_logo']}}">
                        </a>
                    </div>
                    <admin-login-form inline-template>
                        <div class="m-login__signin">
                            <div class="m-login__head">
                                <h3 class="m-login__title">@lang('admin.sign_in_to_admin')</h3>
                            </div>
                            <div class="m-login__form m-form" action="#">
                                <div class="form-group m-form__group">
                                    <input v-model="email" class="form-control m-input" type="text" placeholder="{{ trans('admin.email') }}" name="email" autocomplete="off">
                                    <span v-if="form.validation && form.validation.email" class="error-block" v-text="form.validation.email[0]"></span>
                                </div>
                                <div class="form-group m-form__group">
                                    <input v-model="password" class="form-control m-input m-login__form-input--last" type="password" placeholder="{{ trans('admin.password') }}" name="password" autocomplete="">
                                    <span v-if="form.validation && form.validation.password" class="error-block" v-text="form.validation.password[0]"></span>
                                </div>
                                <div class="row m-login__form-sub">
                                    <div class="col m--align-left m-login__form-left">
                                        <label class="m-checkbox  m-checkbox--light">
                                            <input type="checkbox" v-model="remember" name="remember"> @lang('admin.remember_me')
                                            <span></span>
                                        </label>
                                    </div>
{{--                                    <div class="col m--align-right m-login__form-right">--}}
{{--                                        <a href="javascript:;" id="m_login_forget_password" class="m-link">@lang('admin.forget_password')</a>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="m-login__form-action">
                                    <button @click="login" :disabled="form.disabledButton" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                                        <i v-if="form.loadingDisplay" class="m-loader m-loader--right m-loader--light" v-if="form.loadingDisplay"></i>@lang('admin.sign_in')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </admin-login-form>
                    @include('admin_panel.auth.passwords.email')
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
@endsection

