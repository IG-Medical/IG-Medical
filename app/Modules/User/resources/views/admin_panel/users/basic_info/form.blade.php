<form class="m-form m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="m-form__heading pt-25">
                <h3 class="m-form__heading-title">Personal Information</h3>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>First Name</label>
                    <input type="text" v-model="first_name" class="form-control m-input" placeholder="First Name">
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                </div>
                <div class="col-lg-6">
                    <label>Last Name</label>
                    <input type="text" v-model="last_name" class="form-control m-input" placeholder="Last Name">
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.last_name">@{{ form.validation.last_name[0] }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Date of Birth</label>
                    <el-date-picker
                        v-model="date_birth"
                        type="date"
                        style="width: 100%;"
                        value-format="yyyy-MM-dd"
                        placeholder="Date of Birth">
                    </el-date-picker>
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.date_birth">@{{ form.validation.date_birth[0] }}</span>
                </div>
                <div class="col-lg-6">
                    <label>Nationality</label>
                    <multiselect :options="{{ $countries->toJson() }}"
                                 v-model="nationality"
                                 label="name"
                                 track-by="id"
                                 :multiple="false"
                                 :show-label="false"
                                 :searchable="true"
                                 :close-on-select="true"
                                 placeholder="Choose the Country">
                    </multiselect>
                    <span class="form-control-feedback" v-if="form.validation && form.validation.nationality">@{{ form.validation.nationality[0] }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Gender</label>
                    <select id="gender" v-model="gender" class="form-control">
                        <option value="">Choose the gender</option>
                        @foreach(genders() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.gender">@{{ form.validation.gender[0] }}</span>
                </div>

                <div class="col-lg-6" v-if="user.as_login!='{{\User\Models\UserType::FL}}'">
                    <label>Bio</label>
                    <textarea v-model="bio" class="form-control m-input" row="3"></textarea>
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.bio">@{{ form.validation.bio[0] }}</span>
                </div>
            </div>
            <div class="m-form__seperator m-form__seperator--dashed m-hr"></div>
            <div class="m-form__heading pt-25">
                <h3 class="m-form__heading-title">Contact Details</h3>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Phone number</label>
                    <vue-tel-input v-model="showMobile"
                                   @input="onInput"
                                   :ignored-countries="['IL']"
                                   :dropdown-options="{showDialCodeInSelection:true,showFlags:true}"
                                   :auto-default-country="false"
                                   :valid-characters-only="true"
                                   :preferred-countries="['DE']">
                    </vue-tel-input>
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.mobile">@{{ form.validation.mobile[0] }}</span>
                </div>
                <div class="col-lg-6">
                    <label>Email</label>
                    <input type="email" v-model="email" class="form-control m-input" placeholder="Email">
                    <span class="form-control-feedback" v-if="form.validation && form.validation.email">@{{ form.validation.email[0] }}</span>
                </div>
            </div>

            <div class="m-form__seperator m-form__seperator--dashed m-hr"></div>
            <div class="m-form__heading pt-25">
                <h3 class="m-form__heading-title">Residence Address</h3>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Country</label>
                    <multiselect :options="{{ $countries->toJson() }}"
                                 v-model="country"
                                 label="name"
                                 track-by="id"
                                 :multiple="false"
                                 :show-label="false"
                                 :searchable="true"
                                 :close-on-select="true"
                                 placeholder="Choose the Country">
                    </multiselect>
                    <span class="form-control-feedback" v-if="form.validation && form.validation.country">@{{ form.validation.country[0] }}</span>
                </div>
                <div class="col-lg-4">
                    <label>City</label>
                    <input type="text" v-model="city" class="form-control m-input" placeholder="City">
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.city">@{{ form.validation.city[0] }}</span>
                </div>
                <div class="col-lg-2">
                    <label>Postal Code</label>
                    <input type="text" v-model="postal_code" class="form-control m-input" placeholder="Postal Code">
                    <span class="form-control-feedback" v-if="form.validation && form.validation.postal_code">@{{ form.validation.postal_code[0] }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    <label>Address 1</label>
                    <input type="text" v-model="address1" class="form-control m-input" placeholder="Address 1">
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.address1">@{{ form.validation.address1[0] }}</span>
                </div>
                <div class="col-lg-6">
                    <label>Address 2</label>
                    <input type="text" v-model="address2" class="form-control m-input" placeholder="Address 2">
                    <span class="form-control-feedback" v-if="form.validation && form.validation.address2">@{{ form.validation.address2[0] }}</span>
                </div>
            </div>
            <div class="m-form__seperator m-form__seperator--dashed m-hr"></div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6" v-if="user.as_login=='{{\User\Models\UserType::FL}}'">
                    <div class="form-group m-form__group" v-if="show_upload_file">
                        <label>Upload CV</label>
                        <upload-file :file.sync="cv"
                                     :type-extension="['pdf','docx','doc']"
                                     placeholder="CV"
                                     upload="{{ $DIR_CVS_UPLOADS }}"
                                     id="cv"
                                     :value-prop="{name:'CV',path:cv_url}">
                        </upload-file>
                    </div>
                    <span class="form-control-feedback error-block" v-if="form.validation && form.validation.cv">@{{ form.validation.cv[0] }}</span>
                </div>
                <div class="col-lg-6">
                    @include(ADMIN_VIEWS_DIR.'.partials.image_upload',['label' => ' Personal Photo','key'=>null])
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        @include(ADMIN_VIEWS_DIR.'.partials.buttons.save')
                        @include(ADMIN_VIEWS_DIR.'.partials.buttons.v_reset')
                    </div>
                </div>
            </div>
        </div>
    </form>


@push('css')
<style>
    .m-hr {
        margin-top: 30px;
        margin-bottom: 10px;
    }
    .pt-25 {
        padding-top: 25px!important;
    }
</style>
@endpush
