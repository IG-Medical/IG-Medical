@extends('admin_panel.layouts.app')

@push('page-title')
    {{last(meta('breadcrumbs'))}}
@endpush

@section('content')
    <admins-show inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon"><i class="flaticon-users"></i></span>
                                    <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
                                    <li class="m-portlet__nav-item">
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.create')
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table-component :data="fetchData" :show-caption="false" ref="table">
                                        <table-column label="" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                <img class="user_profile" :src="`${row.image300}`" width="30" height="30">
                                            </template>
                                        </table-column>
                                        <table-column  show="full_name" label="{{trans_admin('full_name')}}"></table-column>
                                        <table-column show="email" label="{{trans_admin('email')}}"></table-column>
                                        <table-column show="last_login" label="{{trans_admin('last_login')}}"></table-column>
                                        <table-column show="created_at" label="{{trans_admin('created_at')}}"></table-column>
                                        <table-column label="{{trans_admin('action')}}" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                @include($moduleNamespace.'::admin_panel.admins.includes.actions')
                                            </template>
                                        </table-column>
                                    </table-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admins-show>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
