@extends('admin_panel.layouts.app')

@push('page-title')
 {{last(meta('breadcrumbs'))}}
@endpush

@section('content')
    <role-form :role="{{ isset($role) ? $role : 'null' }}" inline-template>
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
                            @include('admin_panel.partials.buttons.back')
                        </div>
                        <div class="col-xl-12">
                            <div class="m-portlet--tab">
                                <form class="m-form m-form--fit m-form--label-align-right m-form--state">
                                    <div class="m-portlet__body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div :class="{'form-group m-form__group pb-5': true, 'has-danger': (form.validation&&form.validation.name)}">
                                                    <label for="name">@lang('admin.role_name')</label>
                                                    <input type="text" id="name" v-model="name" placeholder="@lang('admin.role_name')" class="form-control m-input">
                                                    <span class="form-control-feedback" v-if="form.validation&&form.validation.name">@{{ form.validation.name[0] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group m-form__group pt-5">
                                                <span class="form-control-feedback" v-if="form.validation&&form.validation.permissions">@{{ form.validation.permissions[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="row form-group m-form__group pb-5  pt-3">
                                            <div class="col-4" v-for="(permissionsGroup,index) in allPermissions">
                                                <div class="card" style="margin-bottom: 10px">
                                                    <div class="card-header" :id="'headingOne'+index">
                                                        <h5 class="mb-0">
                                                            <a href="javascript:;" data-toggle="collapse" :data-target="'#collapseOne'+index" aria-expanded="true" :aria-controls="'#collapseOne'+index">@{{index}}</a>
                                                        </h5>
                                                    </div>

                                                    <div :id="'headingOne'+index" class="collapse show" aria-labelledby="headingOne" :data-parent="'#accordion'+index">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <!----------Dynamic--------->
                                                                <div class="col-12">
                                                                    <div class="list-group-item" v-for="permission in permissionsGroup">
                                                                        <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                                            <input type="checkbox" v-model="checkedPermissions" :value="permission.id">
                                                                            <span class="pl-1 pr-1">@{{permission.show_name}}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                        </div>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </role-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
