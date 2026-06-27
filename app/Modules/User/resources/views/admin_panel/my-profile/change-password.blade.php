<change-password-form inline-template>
    <div class="col-xl-9 col-lg-8">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title"><span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                        <h3 class="m-portlet__head-text">{{ trans_admin('change_password') }}</h3>
                    </div>
                </div>
            </div>
            <form class="m-form m-form--label-align-right">
                <div class="m-portlet__body">
                    <div class="m-form__heading pt-25">
                        <h3 class="m-form__heading-title"></h3>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-12">
                            <label>{{ trans_admin('current_password') }}</label>
                            <input type="password" v-model="current_password" class="form-control m-input" placeholder="{{ trans_admin('current_password') }}">
                            <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.current_password">@{{ form.validation.current_password[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-lg-6">
                            <label>{{ trans_admin('new_password') }}</label>
                            <input type="password" v-model="new_password" class="form-control m-input" placeholder="{{trans_admin('new_password')}}">
                            <span class="form-control-feedback error-block" v-if="form.validation && form.validation.new_password">@{{ form.validation.new_password[0] }}</span>
                        </div>
                        <div class="col-lg-6">
                            <label>{{ trans_admin('new_password_confirm') }}</label>
                            <input type="password" v-model="new_password_confirm" class="form-control m-input" placeholder="{{trans_admin('new_password_confirm')}}">
                            <span class="form-control-feedback" v-if="form.validation && form.validation.new_password_confirm">@{{ form.validation.new_password_confirm[0] }}</span>
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
</change-password-form>
