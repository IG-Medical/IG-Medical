@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
   <setting-custom-css-js :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
       <div class="m-content">
           <div class="row">
               <div class="col-xl-12 col-lg-12">
                   <div class="m-portlet">
                       <div class="m-portlet__head">
                           <div class="m-portlet__head-caption">
                               <div class="m-portlet__head-title"><span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                   <h3 class="m-portlet__head-text"> {{ meta('breadcrumbs-title') }}</h3>
                               </div>
                           </div>
                       </div>
                       <form class="m-form m-form--label-align-right">
                           <div class="m-portlet__body">
                               <div class="form-group m-form__group row">
                                   <div class="col-lg-12" >
                                       <label>{{ trans('admin.header') }}</label>
                                       <textarea v-model="asset_custom.header" class="form-control m-input" rows="12"></textarea>
                                       <span class="form-control-feedback" v-if="form.validation&&form.validation.header">@{{ form.validation.header[0] }}</span>
                                   </div>
                               </div>
                           </div>
                           <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                               <div class="m-form__actions m-form__actions--solid">
                                   <div class="row">
                                       <div class="col-lg-12">
                                           <label>{{ trans('admin.footer') }}</label>
                                           <textarea v-model="asset_custom.footer" class="form-control m-input" rows="12"></textarea>
                                           <span class="form-control-feedback" v-if="form.validation&&form.validation.footer">@{{ form.validation.footer[0] }}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                               <div class="m-form__actions m-form__actions--solid">
                                   <div class="row">
                                       <div class="col-lg-6">
                                           <button type="button" @click="save" :disabled="form.disabledButton" class="btn btn-primary" >{{trans('admin.save')}}</button>
                                           <button type="button" @click="reset" class="btn btn-secondary">{{trans('admin.cancel')}}</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </setting-custom-css-js>
@endsection



@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush

