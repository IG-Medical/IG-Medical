@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <attribute-form :attribute="{{ isset($attribute) ? json_encode($attribute) : 'null' }}" inline-template>
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
                                        <label>{{trans_module_product('admin.attribute_set_name')}}</label>
                                        <select class="form-control" v-model="attribute_set">
                                            <option value="">{{ trans_module_product('admin.select_option') }}</option>
                                            <option v-for="set in attributes_sets" :value="set.id">@{{ set.name }}</option>
                                        </select>
                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.attribute_set">@{{ form.validation.attribute_set[0] }}</span>
                                    </div>
                                </div>
                                {!! html_entity_decode(build_fields('name',trans_module_product('admin.attribute_name'))) !!}

                                <div class="form-group m-form__group">
                                    <label>{{trans_module_product('admin.values')}}</label>
                                </div>
                                <div v-for="(value, index) in attribute_values" :key="index" class="form-group m-form__group row">
                                    @php $i = 0; @endphp
                                    @foreach(languages() as $key => $value)
                                        @php ++$i; @endphp
                                        <div class="col-md-{{ $i === 1 ? '6' : '5'}}">
                                            <input type="text" v-model="value.name.{{$key}}" :name="`value[${index}][name]`" class="form-control" placeholder="{{ trans_module_product('admin.value') . ' ' .trans('admin.language').' '. $value}}"></input>
                                        {{--<span class="form-control-feedback" v-if="form.validation&&form.validation['values.'+index+'.name.{{$key}}']">@{{ form.validation['values.'+index+'.name.{{$key}}'][0] }}</span>--}}
                                        </div>
                                    @endforeach
                                    <div class="col-md-1">
                                        <button v-if="index>0" @click="deleteRow(index)" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill"><span><i class="la la-trash-o"></i><span>{{ trans_module_product('admin.delete') }}</span></span></button>
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
    </attribute-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endpush
