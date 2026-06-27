@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <contact-us-admin-show :id="'{{ request('id') }}'" inline-template>
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">{{ trans_module_contact_us('admin.open') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">{{ trans_module_contact_us('admin.archived') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                                    <div class="m-section">
                                        <div class="m-section__content">
                                            <table-component
                                                :data="fetchData"
                                                :show-caption="false"
                                                ref="table">
                                                <table-column show="id" label="{{ trans_module_contact_us('admin.id') }}"></table-column>
                                                <table-column show="company_name" label="{{ trans_module_contact_us('admin.company_name') }}"></table-column>
                                                <table-column show="country" label="{{ trans_module_contact_us('admin.country') }}"></table-column>
                                                <table-column show="email" label="{{ trans_module_contact_us('admin.email') }}"></table-column>
                                                <table-column show="full_name" label="{{ trans_module_contact_us('admin.company_name') }}"></table-column>
                                                <table-column show="phone" label="{{ trans_module_contact_us('admin.phone') }}"></table-column>
                                                <table-column show="product.name" label="{{ trans_module_contact_us('admin.favorite_product') }}"></table-column>
                                                <table-column show="created_at" label="{{ trans_module_contact_us('admin.created_at') }}"></table-column>
                                                <table-column show="message" label="{{ trans_module_contact_us('admin.message') }}"></table-column>
                                                <table-column label="{{ trans_module_contact_us('admin.action') }}" :sortable="false" :filterable="false">
                                                    <template slot-scope="row">
                                                        <button @click="archive(row.id, row.full_name)"
                                                                title="Archive"
                                                                class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                            <i class="la la-archive"></i>
                                                        </button>
                                                    </template>
                                                </table-column>
                                            </table-component>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                                    <div class="m-section">
                                        <div class="m-section__content">
                                            <table-component
                                                :data="fetchArchivedData"
                                                :show-caption="false"
                                                ref="table1">
                                                <table-column show="id" label="{{ trans_module_contact_us('admin.id') }}"></table-column>
                                                <table-column show="company_name" label="{{ trans_module_contact_us('admin.company_name') }}"></table-column>
                                                <table-column show="country" label="{{ trans_module_contact_us('admin.country') }}"></table-column>
                                                <table-column show="email" label="{{ trans_module_contact_us('admin.email') }}"></table-column>
                                                <table-column show="full_name" label="{{ trans_module_contact_us('admin.company_name') }}"></table-column>
                                                <table-column show="phone" label="{{ trans_module_contact_us('admin.phone') }}"></table-column>
                                                <table-column show="product.name" label="{{ trans_module_contact_us('admin.favorite_product') }}"></table-column>
                                                <table-column show="created_at" label="{{ trans_module_contact_us('admin.created_at') }}"></table-column>
                                                <table-column show="message" label="{{ trans_module_contact_us('admin.message') }}"></table-column>
                                            </table-component>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </contact-us-admin-show>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/contact_us.js') }}"></script>
@endpush
