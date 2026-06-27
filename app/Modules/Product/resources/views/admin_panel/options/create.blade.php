@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <option-form :option="{{ isset($option) ? json_encode($option) : 'null' }}" inline-template>
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
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12 pb-4">
                                        <label>{{trans_module_product('admin.type')}}</label>
                                        <select class="form-control" v-model="type">
                                            <option value="">{{ trans_module_product('admin.select_option') }}</option>
                                            <option value="{{ \Product\Models\Option::TYPE_CHECKBOX }}">CheckBox</option>
                                            <option value="{{ \Product\Models\Option::TYPE_RADIO }}">Radio Button</option>
                                        </select>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.type">@{{ form.validation.type[0] }}</span>
                                    </div>
                                </div>
                                {!! html_entity_decode(build_fields('name',trans_module_product('admin.name'))) !!}

                                <div class="form-group m-form__group">
                                    <label>{{trans_module_product('admin.values')}}</label>
                                </div>
                                <div v-for="(value, index) in values" :key="index" class="form-group m-form__group row">
                                    @php $i = 0; @endphp
                                    @foreach(languages() as $key => $value)
                                        @php ++$i; @endphp
                                        <div class="col-md-{{ $i === 1 ? '6' : '5'}}">
                                            <label for="main_image">{{ trans_module_product('admin.label') . ' ' .trans('admin.language').' '. $value}}</label>
                                            <input type="text" v-model="value.label.{{$key}}" :name="`value[${index}][label]`" class="form-control" placeholder="{{ trans_module_product('admin.label') . ' ' .trans('admin.language').' '. $value }}"></input>
                                        </div>
                                    @endforeach
                                    <div class="col-md-1" v-if="index>0">
                                        <label class="mt-3"></label>
                                        <button @click="deleteRow(index)" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill"><span><i class="la la-trash-o"></i><span>{{ trans_module_product('admin.delete') }}</span></span></button>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label>{{ trans_module_product('admin.price') }}</label>
                                        <input type="number" v-model="value.price" class="form-control" placeholder="{{ trans_module_product('admin.price') }}"></input>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-md-10 col-form-label"></label>
                                    <div class="col-md-2 pl-0">
                                        <button @click="addRow" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                                            <span><i class="la la-plus"></i><span>{{ trans_module_product('admin.add') }}</span></span>
                                        </button>
                                    </div>
                                </div>
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
    </option-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endpush
