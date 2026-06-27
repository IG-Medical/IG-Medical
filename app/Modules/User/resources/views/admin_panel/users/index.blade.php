@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <users-show :filter-id="{{ request()->has('id') ? request()->id : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon"><i class="flaticon-users"></i></span>
                                    <h3 class="m-portlet__head-text">{{ meta('breadcrumbs-title') }}</h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="m-portlet__nav">
{{--                                    <li class="m-portlet__nav-item">--}}
{{--                                        <button @click="showAdvancedSearch" class="btn btn-secondary m-btn m-btn--icon" style="float: right;">--}}
{{--                                            <span><i class="la la-filter"></i><span>Filters</span></span>--}}
{{--                                        </button>--}}
{{--                                    </li>--}}
{{--                                    <li class="m-portlet__nav-item">--}}
{{--                                        <a href="{{ route_admin($asRoute.'.export') }}" class="btn m-btn m-btn--gradient-from-success m-btn--gradient-to-info"><span><i class="fa fa-file-excel"></i><span> Export  </span></span></a>--}}
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
                            @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.users.includes.advanced-filters')
                            <div class="m-section">
                                <div class="m-section__content">
                                    <div class="m-form__group form-group">
                                        <div class="m-checkbox-inline">
{{--                                            <label class="m-checkbox" v-if="!openAdvancedSearch">--}}
{{--                                                All Page <input type="checkbox" v-model="checkAllPage[pagination.currentPage]" @change="checkAllPageHandler">--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                            <label class="m-checkbox" v-if="openAdvancedSearch">--}}
{{--                                                All Result <input type="checkbox" v-model="checkAll"  @change="checkAllHandler">--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                            <div class="btn-group" role="group">--}}
{{--                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>--}}
{{--                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start">--}}
{{--                                                    <a @click="showModalSendEmail" class="dropdown-item" href="javascript:;"> Send Email</a>--}}
{{--                                                    <a @click="showModalSendSMS" class="dropdown-item" href="javascript:;">Send SMS</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                    <table-component :data="fetchData" :show-caption="false" ref="table">
{{--                                        <table-column label="" :sortable="false" :filterable="false">--}}
{{--                                            <template slot-scope="row">--}}
{{--                                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">--}}
{{--                                                    <input type="checkbox" :value="row.id" v-model="userChecked">--}}
{{--                                                    <span></span>--}}
{{--                                                </label>--}}
{{--                                            --}}{{--<img class="user_profile" :src="`${row.image}`" width="30" height="30">--}}
{{--                                            </template>--}}
{{--                                        </table-column>--}}
                                        <table-column show="id" label="ID"></table-column>
                                    {{--<table-column show="wallet_account_id" label="WalletID" :sortable="false" :filterable="false"></table-column>--}}
                                        <table-column  show="full_name" label="Full Name" :sortable="false" :filterable="false"></table-column>
                                        <table-column show="email" label="Email"></table-column>
                                        <table-column show="mobile" label="Mobile"></table-column>
                                        <table-column label="Status" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::PENDING }}" class="m-badge m-badge--primary m-badge--wide">@{{ row.status.name }}</span>
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::REJECTED }}" class="m-badge m-badge--danger m-badge--wide">@{{ row.status.name }}</span>
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::ACTIVATED }}" class="m-badge m-badge--success m-badge--wide">@{{ row.status.name }}</span>
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::ACCEPTED }}" class="m-badge m-badge--success m-badge--wide">@{{ row.status.name }}</span>
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::DEACTIVATED }}" class="m-badge m-badge--success m-badge--wide">@{{ row.status.name }}</span>
                                                <span v-if="row.status.id=={{ \User\Models\UserStatus::BLOCKED }}" class="m-badge m-badge--danger m-badge--wide">@{{ row.status.name }}</span>
                                            </template>
                                        </table-column>
                                        <table-column show="created_at" label="Date of Registration"></table-column>
                                        <table-column label="Action" :sortable="false" :filterable="false">
                                            <template slot-scope="row">
                                                @include($moduleNamespace.'::.'.ADMIN_VIEWS_DIR.'.users.includes.actions')
                                            </template>
                                        </table-column>
                                    </table-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <el-dialog :visible.sync="dialogVisibleSendEmail" title="Send Email">
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label>Subject</label>
                            <input type="text" v-model="emailContent.subject" class="form-control">
                            <span class="form-control-feedback" v-if="form.validation && form.validation.subject">@{{ form.validation.subject[0] }}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <label>Content</label>
                            <tinymce id="content_message" v-model="emailContent.content"></tinymce>
                            <span class="form-control-feedback" v-if="form.validation && form.validation.emailContent">@{{ form.validation.emailContent[0] }}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <div class="alert alert-danger" v-if="form.validation && form.validation.ids">@{{ form.validation.ids[0] }}</div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">

                        <div class="m-form__actions">
                            <button type="button" @click="sendEmail" :disabled="form.disabledButton" class="btn btn-primary" >
                                <loading-button :loading-display="form.loadingDisplay"></loading-button>
                                Send
                            </button>
                            <button type="button" @click="dialogVisibleSendEmail=false" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>

            </el-dialog>

            <el-dialog :visible.sync="dialogVisibleSendSMS" title="Send SMS">
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <label>Content</label>
                            <textarea v-model="smsContent.content" class="form-control" rows="6"></textarea>
                            <span class="form-control-feedback" v-if="form.validation && form.validation.emailContent">@{{ form.validation.smsContent[0] }}</span>
                        </div>
                        <div class="form-group m-form__group">
                            <div class="alert alert-danger" v-if="form.validation && form.validation.ids">@{{ form.validation.ids[0] }}</div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">

                        <div class="m-form__actions">
                            <button type="button" @click="sendSMS" :disabled="form.disabledButton" class="btn btn-primary" >
                                <loading-button :loading-display="form.loadingDisplay"></loading-button>
                                Send
                            </button>
                            <button type="button" @click="dialogVisibleSendSMS=false" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </el-dialog>
        </div>
    </users-show>
@endsection
@php $is_module = true; @endphp
@push('js')
<script src="{{ asset('js/admin/user.js') }}"></script>
@endpush
