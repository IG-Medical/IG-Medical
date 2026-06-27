@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <category-form :category="{{ isset($category) ? json_encode($category) : 'null' }}" inline-template>
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
                        <div class="m-portlet__body">
                            <div class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    {!! html_entity_decode(build_fields('title',trans_module_job('admin.title'))) !!}
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <button type="button" @click="save" :disabled="form.disabledButton" class="btn btn-primary">
                                            <loading-button :loading-display="form.loadingDisplay"></loading-button>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </category-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/job.js') }}"></script>
@endpush
