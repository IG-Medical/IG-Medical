@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-logo :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="favicon">{{ trans_admin('favicon') }}</label>
                                        <upload-file :file.sync="favicon"
                                                     :type-extension="['jpg', 'jpeg', 'png','svg','ico']"
                                                     placeholder="{{ trans_module_setting('favicon') }}"
                                                     upload="{{\Setting\Models\Setting::DIR_LOGO_UPLOADS}}"
                                                     id="favicon"
                                                     :value-prop="{name:'{{ trans_module_setting('favicon') }}',path:favicon_url}">
                                        </upload-file>
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="headerLogo">{{ trans_admin('header_logo') }}</label>
                                        <upload-file :file.sync="header_logo"
                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"
                                                     placeholder="{{ trans_module_setting('header_logo') }}"
                                                     upload="{{\Setting\Models\Setting::DIR_LOGO_UPLOADS}}"
                                                     id="headerLogo"
                                                     :value-prop="{name:'{{ trans_module_setting('header_logo') }}',path:header_logo_url}">
                                        </upload-file>
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="footer_logo">{{ trans_admin('footer_logo') }}</label>
                                        <upload-file :file.sync="footer_logo"
                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"
                                                     placeholder="{{ trans_module_setting('footer_logo') }}"
                                                     upload="{{\Setting\Models\Setting::DIR_LOGO_UPLOADS}}"
                                                     id="footer_logo"
                                                     :value-prop="{name:'{{ trans_module_setting('footer_logo') }}',path:footer_logo_url}">
                                        </upload-file>
                                    </div>
                                </div>
                                <br>
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
    </appearance-logo>
@endsection
@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush


