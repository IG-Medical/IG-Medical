@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-breadcrumbs-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
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
                        <div class="m-portlet__body">
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_contact_us">{{ trans_module_setting('admin.breadcrumb_contact_us') }}</label>
{{--                                        <upload-file :file.sync="breadcrumb_contact_us"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_contact_us') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_contact_us"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_contact_us') }}',path:breadcrumb_contact_us_url}">--}}
{{--                                        </upload-file>--}}
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageContactUs" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageContactUs"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageContactUs"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageContactUs"
                                                       v-model.bool="showBreadcrumbImageContactUs"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgContactUsBreadcrumbImageDataUrl" :src="imgContactUsBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_ig_world">{{ trans_module_setting('admin.breadcrumb_ig_world') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageIGWorld" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageIGWorld"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageIGWorld"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageIGWorld"
                                                       v-model.bool="showBreadcrumbImageIGWorld"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgIGWorldBreadcrumbImageDataUrl" :src="imgIGWorldBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
{{--                                        <upload-file :file.sync="breadcrumb_ig_world"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_ig_world') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_ig_world"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_ig_world') }}',path:breadcrumb_ig_world_url}">--}}
{{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_job">{{ trans_module_setting('admin.breadcrumb_job') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageJob" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageJob"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageJob"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageJob"
                                                       v-model.bool="showBreadcrumbImageJob"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgJobBreadcrumbImageDataUrl" :src="imgJobBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
{{--                                        <upload-file :file.sync="breadcrumb_job"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_job') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_job"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_ig_world') }}',path:breadcrumb_job_url}">--}}
{{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_news">{{ trans_module_setting('admin.breadcrumb_news') }}</label>
{{--                                        <upload-file :file.sync="breadcrumb_news"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_news') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_news"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_news') }}',path:breadcrumb_news_url}">--}}
{{--                                        </upload-file>--}}
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageNews" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageNews"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageNews"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageNews"
                                                       v-model.bool="showBreadcrumbImageNews"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgNewsBreadcrumbImageDataUrl" :src="imgNewsBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_public_page">Breadcrumb R&D, QM</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImagePublicPage" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImagePublicPage"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImagePublicPage"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImagePublicPage"
                                                       v-model.bool="showBreadcrumbImagePublicPage"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgPublicPageBreadcrumbImageDataUrl" :src="imgPublicPageBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
{{--                                        <upload-file :file.sync="breadcrumb_public_page"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_news') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_public_page"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_public_page') }}',path:breadcrumb_public_page_url}">--}}
{{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_certifications">{{ trans_module_setting('admin.breadcrumb_certifications') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageCertifications" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageCertifications"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageCertifications"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageCertifications"
                                                       v-model.bool="showBreadcrumbImageCertifications"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgCertificationsBreadcrumbImageDataUrl" :src="imgCertificationsBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
{{--                                        <upload-file :file.sync="breadcrumb_certifications"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_news') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_certifications"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_certifications') }}',path:breadcrumb_certifications_url}">--}}
{{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_about_us">{{ trans_module_setting('admin.breadcrumb_about_us') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageAboutUs" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageAboutUs"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageAboutUs"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageAboutUs"
                                                       v-model.bool="showBreadcrumbImageAboutUs"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgAboutUsBreadcrumbImageDataUrl" :src="imgAboutUsBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
{{--                                        <upload-file :file.sync="breadcrumb_about_us"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_setting('breadcrumb_about_us') }}"--}}
{{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
{{--                                                     id="breadcrumb_about_us"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_about_us') }}',path:breadcrumb_about_us_url}">--}}
{{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>

                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_about_us">{{ trans_module_setting('admin.breadcrumb_sales') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageSales" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageSales"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageSales"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageSales"
                                                       v-model.bool="showBreadcrumbImageSales"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgSalesBreadcrumbImageDataUrl" :src="imgSalesBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
                                        {{--                                        <upload-file :file.sync="breadcrumb_about_us"--}}
                                        {{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
                                        {{--                                                     placeholder="{{ trans_module_setting('breadcrumb_about_us') }}"--}}
                                        {{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
                                        {{--                                                     id="breadcrumb_about_us"--}}
                                        {{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_about_us') }}',path:breadcrumb_about_us_url}">--}}
                                        {{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>

                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_about_us">{{ trans_module_setting('admin.breadcrumb_technical') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageTechnical" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageTechnical"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageTechnical"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageTechnical"
                                                       v-model.bool="showBreadcrumbImageTechnical"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgTechnicalBreadcrumbImageDataUrl" :src="imgTechnicalBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
                                        {{--                                        <upload-file :file.sync="breadcrumb_about_us"--}}
                                        {{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
                                        {{--                                                     placeholder="{{ trans_module_setting('breadcrumb_about_us') }}"--}}
                                        {{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
                                        {{--                                                     id="breadcrumb_about_us"--}}
                                        {{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_about_us') }}',path:breadcrumb_about_us_url}">--}}
                                        {{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <br>

                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="breadcrumb_about_us">{{ trans_module_setting('admin.breadcrumb_customized') }}</label>
                                        <div>
                                            <button @click="toggleShowBreadcrumbImageCustomized" type="button" class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger">
                                                <span><i class="la la-cloud-upload"></i></span>{{ 'Upload'}}
                                            </button>
                                            <my-upload field="img"
                                                       @crop-success="cropSuccessBreadcrumbImageCustomized"
                                                       @crop-upload-success="cropUploadSuccessBreadcrumbImageCustomized"
                                                       @crop-upload-fail="cropUploadFailBreadcrumbImageCustomized"
                                                       v-model.bool="showBreadcrumbImageCustomized"
                                                       :width="1349"
                                                       :height="390"
                                                       url="{{ route('upload.uploadFileOnCrop',['dir' => \Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS]) }}"
                                                       :headers="headers"
                                                       lang-type="{{ getAppLocale() }}"
                                                       :no-square="true">
                                            </my-upload>
                                            <div class="form-control-feedback" v-if="form.validation && form.validation.img">@{{ form.validation.img[0] }}</div>
                                            <img class="user_profile" v-if="imgCustomizedBreadcrumbImageDataUrl" :src="imgCustomizedBreadcrumbImageDataUrl" width="100" height="100" style="margin-left: 5%;">
                                        </div>
                                        {{--                                        <upload-file :file.sync="breadcrumb_about_us"--}}
                                        {{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
                                        {{--                                                     placeholder="{{ trans_module_setting('breadcrumb_about_us') }}"--}}
                                        {{--                                                     upload="{{\Setting\Models\Setting::DIR_BREADCRUMBS_UPLOADS}}"--}}
                                        {{--                                                     id="breadcrumb_about_us"--}}
                                        {{--                                                     :value-prop="{name:'{{ trans_module_setting('breadcrumb_about_us') }}',path:breadcrumb_about_us_url}">--}}
                                        {{--                                        </upload-file>--}}
                                    </div>
                                </div>
                                <br><hr>
                                <br>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions" style="padding: 16px;">
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </appearance-breadcrumbs-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
