@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-footer-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
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
                                {!! build_fields('footer_about_site',trans_admin('footer_about_site'), null, 'textarea') !!}
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
    </appearance-footer-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush

