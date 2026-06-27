@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <jobs-show :filter-id="{{ request()->has('id') ? json_encode(request()->id) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon"><i class="m-menu__link-icon flaticon-web"></i></span>
                                    <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
{{--                                    <li class="m-portlet__nav-item">--}}
{{--                                        <button @click="showAdvancedSearch" class="btn btn-secondary m-btn m-btn--icon" style="float: right;">--}}
{{--                                            <span>--}}
{{--                                                <i class="la la-filter"></i>--}}
{{--                                                <span>Filters</span>--}}
{{--                                            </span>--}}
{{--                                        </button>--}}
{{--                                    </li>--}}
{{--                                    <li class="m-portlet__nav-item">--}}
{{--                                        <a href="{{ route_admin($asRoute.'.export') }}" class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-info">--}}
{{--                                            <span><i class="fa fa-file-excel"></i><span> Export  </span></span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                    <li class="m-portlet__nav-item">
                                        <a href="{{ route_admin($asRoute.'.create') }}" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info">
                                            <span><i class="fa fa-plus"></i><span> Create  {{ $singleTitle }}  </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
{{--                                @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.jobs.includes.advanced-filters')--}}
                                <div class="m-section__content">
                                    <table-component
                                        :data="fetchData"
                                        :show-caption="false"
                                        ref="table">
                                        <table-column show="id" label="Job ID"></table-column>

                                        <table-column show="job_title" label="Job Title" :sortable="false"></table-column>
{{--                                        <table-column show="country" label="Country" :sortable="false" :filterable="false"></table-column>--}}
                                        <table-column show="location" label="Location" :sortable="false" :filterable="false"></table-column>
{{--                                        <table-column label="Status" :sortable="false" :filterable="false">--}}
{{--                                            <template slot-scope="row">--}}
{{--                                                <span v-if="row.status.id=={{ \Job\Models\CareerStatus::OPEN }}" class="m-badge m-badge--info m-badge--wide">@{{ row.status.name }}</span>--}}
{{--                                                <span v-if="row.status.id=={{ \Job\Models\CareerStatus::CLOSED }}" class="m-badge m-badge--focus m-badge--wide">@{{ row.status.name }}</span>--}}
{{--                                            </template>--}}
{{--                                        </table-column>--}}
                                        <table-column show="created_at" label="Created At"></table-column>
                                        <table-column label="" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.jobs.includes.actions')
                                            </template>
                                        </table-column>
                                    </table-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <el-dialog :visible.sync="dialogVisibleAddUsersToSpecialJob" title="Add Users to Special Job" v-cloak>
                @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.jobs.includes.modal-add-users-to-special-job')
            </el-dialog>
        </div>
    </jobs-show>
@endsection
@php $is_module = true; @endphp
@push('js')
<script src="{{ asset('js/admin/job.js') }}"></script>
@endpush
