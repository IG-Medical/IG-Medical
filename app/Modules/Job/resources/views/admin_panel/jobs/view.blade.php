@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <job-details :career="{{ isset($career) ? json_encode($career) : 'null' }}"  inline-template>
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title"></div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_job_info" role="tab" aria-selected="false">Info</a>
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_applications" role="tab" aria-selected="false">Applications</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active " id="m_job_info">
                                    @include($asRoute.'::'.ADMIN_VIEWS_DIR.'.jobs.includes.info')
                                </div>
                                <div class="tab-pane " id="m_applications">
                                    @include($asRoute.'::'.ADMIN_VIEWS_DIR.'.jobs.includes.applications')
                                </div>
                            </div>
                        </div>
                    </div>
                </job-details>
            </div>
        </div>
    </div>
@endsection
@php $is_module = true; @endphp
@push('js')
<script src="{{ asset('js/admin/job.js') }}"></script>
@endpush
