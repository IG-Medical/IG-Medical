@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-certifications-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
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
                                {!! build_fields('certifications.title',trans_module_setting('admin.certifications_title')) !!}
                                <div class="row">
                                    @foreach(languages() as $key => $value)
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group m-form__group">
                                                <label for="certifications_content{{$key}}">{{ trans_module_setting('admin.content') }}</label>
                                                <tinymce id="certifications_content{{$key}}" v-model="certifications.content.{{$key}}" :other_options="options"></tinymce>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row" v-for="(row,index) in certifications.images">
                                    @foreach(languages() as $key => $value)
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group m-form__group">
                                                <label>{{ trans_module_setting('admin.certification_name') }}</label>
                                                <input type="text" v-model="row.name.{{$key}}" class="form-control"></input>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach(languages() as $key => $value)
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group m-form__group">
                                                <label :for="'image_'+index+'{{$key}}'">{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value}}</label>
                                                <upload-file :file.sync="row.image.{{$key}}"
                                                             :type-extension="['jpg', 'jpeg', 'png','svg']"
                                                             placeholder="{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value }}"
                                                             upload="{{$DIR_CERTIFICATIONS_UPLOADS}}"
                                                             :id="'image_'+index+'{{$key}}'"
                                                             :value-prop="{name:'{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value }}',path:certifications.images[index].image_url.{{$key}}}">
                                                </upload-file>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-md-12" style="margin-top: 24px;">
                                        <button type="button" @click="deleteRow(index)" class="btn m-btn m-btn--gradient-from-danger m-btn--gradient-to-danger" style="float: right;">
                                            <span><i class="fa fa-trash"></i><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 24px; float: right;">
                                        <button type="button" @click="addRow()" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" style="float: right;">
                                            <span><i class="fa fa-plus"></i><span></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__action">
                                    <div class="row">
                                        <div class=""></div>
                                        <div class="row col-md-6">
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                            @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </appearance-certifications-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
