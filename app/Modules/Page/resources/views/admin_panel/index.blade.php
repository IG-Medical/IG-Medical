@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <pages-show inline-template>
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
{{--                            <div class="m-portlet__head-tools">--}}
{{--                                <ul class="m-portlet__nav">--}}
{{--                                    <li class="m-portlet__nav-item">--}}
{{--                                        @include($asRoute.'::admin_panel.partials.buttons.create')--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-section">
                                <div class="m-section__content">
                                    <table-component
                                        :data="fetchData"
                                        :show-caption="false"
                                        ref="table">
                                        <table-column show="title" label="{{ trans_module_page('admin.title') }}"></table-column>
                                        <table-column show="created_at" label="{{ trans_module_page('admin.created_at') }}"></table-column>
                                        <table-column label="" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                @include($asRoute.'::admin_panel.includes.actions')
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
    </pages-show>
@endsection

@php $is_module = true; @endphp
@push('js_module')
<script src="{{ asset('js/admin/page.js') }}"></script>
@endpush
