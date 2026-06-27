@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <attribute-set-form :attribute="{{ isset($attributeSet) ? json_encode($attributeSet) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">{{ last(meta('breadcrumbs')) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                {!! html_entity_decode(build_fields('name',trans_module_product('admin.attribute_set_name'))) !!}
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                    @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </attribute-set-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endpush
