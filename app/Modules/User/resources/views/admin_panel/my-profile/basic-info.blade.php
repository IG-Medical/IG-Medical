<basic-info-form :admin="{{ isset($admin) ? $admin : 'null' }}" inline-template>
    <div class="col-xl-9 col-lg-8">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                        <h3 class="m-portlet__head-text">{{ trans_admin('basic_info') }}</h3>
                    </div>
                </div>
            </div>
            <form class="m-form m-form--label-align-right">
                <div class="m-portlet__body">
                    <div class="m-form__heading pt-25">
                        <h3 class="m-form__heading-title"></h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{ trans_admin('first_name') }}</label>
                            <input type="text" v-model="first_name" class="form-control m-input" placeholder="{{ trans_admin('first_name') }}">
                            <span class="form-control-feedback error-block" v-if="form.validation && form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                        </div>
                        <div class="col-lg-6">
                            <label>{{ trans_admin('last_name') }}</label>
                            <input type="text" v-model="last_name" class="form-control m-input" placeholder="{{ trans_admin('last_name') }}">
                            <span class="form-control-feedback error-block" v-if="form.validation && form.validation.last_name">@{{ form.validation.last_name[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{ trans_admin('email') }}</label>
                            <input type="email" v-model="email" class="form-control m-input" placeholder="{{ trans_admin('email') }}">
                            <span class="form-control-feedback" v-if="form.validation && form.validation.email">@{{ form.validation.email[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{trans_admin('role')}}</label>
                            <select class="form-control" v-model="role">
                                <option value="">{{ trans_admin('select_role') }}</option>
                                <option v-for="role in roles" :value="role.id">@{{ role.name }}</option>
                            </select>
                            <span class="form-control-feedback" v-if="form.validation && form.validation.role">@{{ form.validation.role[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            @include('admin_panel.partials.image_upload',['label' => trans_admin('personal_photo'), 'key' => null])
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-6">
                                @include($asRoute.'::admin_panel.partials.buttons.save')
                                @include($asRoute.'::admin_panel.partials.buttons.reset')
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</basic-info-form>
