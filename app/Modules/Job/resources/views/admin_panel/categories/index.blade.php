@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <categories-show inline-template>
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
                                <div class="m-section__content">
                                    <table-component
                                        :data="fetchData"
                                        :show-caption="false"
                                        :show-filter="false"
                                        ref="table">
                                        <table-column show="title" label="{{ trans_module_job('admin.title') }}"></table-column>
                                        <table-column show="created_at" label="{{ trans_module_job('admin.created_at') }}"></table-column>
                                        <table-column label="" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.categories.includes.actions')
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
    </categories-show>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/job.js') }}"></script>
@endpush
