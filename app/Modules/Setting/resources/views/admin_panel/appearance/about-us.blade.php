@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-about-us-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">{{ last(meta('breadcrumbs')) }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="m-tabs" data-tabs="true" data-tabs-contents="#m_sections">
                                        <ul class="m-nav m-nav--active-bg m-nav--active-bg-padding-lg m-nav--font-lg m-nav--font-bold m--margin-bottom-20 m--margin-top-10 m--margin-right-40" id="m_nav" role="tablist">
                                            <li class="m-nav__item">
                                                <a class="m-nav__link m-tabs__item m-tabs__item--active" data-tab-target="#about_us_section1" href="about_us_section1">
                                                    <span class="m-nav__link-text">{{ trans_module_setting('admin.about_us_section1') }}</span>
                                                </a>
                                            </li>

                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#about_us_section2" href="#about_us_section2">
                                                    <span class="m-nav__link-text">{{ trans_module_setting('admin.about_us_section2') }}</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#about_us_section3" href="#about_us_section3">
                                                    <span class="m-nav__link-text">{{ trans_module_setting('admin.about_us_section3') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="m-tabs-content" id="m_sections">
                                        <div class="m-tabs-content__item m-tabs-content__item--active" id="about_us_section1">
                                            <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.about_us_section1') }}</h4>
{{--                                            {!! html_entity_decode(build_fields('aboutUs.section1.title',trans_module_setting('admin.title'))) !!}--}}
                                            <div class="row">
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label for="{{'section1_title'.$key}}">{{ trans_module_setting('admin.about_us_section1') }}</label>
                                                            <tinymce id="{{'section1_title'.$key}}" v-model="aboutUs.section1.title.{{$key}}" :other_options="options2"></tinymce>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label for="{{'content_'.$key}}">{{ trans_module_setting('admin.content') }}</label>
                                                            <tinymce id="{{'content_'.$key}}" v-model="aboutUs.section1.content.{{$key}}" :other_options="options"></tinymce>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="m-tabs-content__item m-tabs-content__item" id="about_us_section2">
                                            <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.about_us_section2') }}</h4>
                                            <div class="row">
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label for="{{'section2_title'.$key}}">{{ trans_module_setting('admin.about_us_section2_title') }}</label>
                                                            <tinymce id="{{'section2_title'.$key}}" v-model="aboutUs.section2.title.{{$key}}" :other_options="options2"></tinymce>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
{{--                                            {!! html_entity_decode(build_fields('aboutUs.section2.title',trans_module_setting('admin.title'))) !!}--}}

                                            {!! html_entity_decode(build_fields('aboutUs.section2.sub_title',trans_module_setting('admin.sub_title'))) !!}
                                            <hr>
                                            @for($i=0;$i<=2;$i++)
                                                {!! html_entity_decode(build_fields('aboutUs.section2.feather['.$i.'].title',trans_module_setting('admin.title'.$i))) !!}
                                                <div class="row">
                                                    @foreach(languages() as $key => $value)
                                                        <div class="col-md-6 pb-4">
                                                            <div class="form-group m-form__group">
                                                                <label for="{{'aboutUs_content_'.$i.$key}}">{{ trans_module_setting('admin.content') }}</label>
                                                                <tinymce id="{{'aboutUs_content_'.$i.$key}}" v-model="aboutUs.section2.feather[{{$i}}].content.{{$key}}" :other_options="options"></tinymce>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @foreach(languages() as $key => $value)
                                                        <div class="col-md-6 pb-4">
                                                            <div class="form-group m-form__group">
                                                                <label for="image_{{$i.$key}}">{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value}}</label>
                                                                <upload-file :file.sync="aboutUs.section2.feather[{{$i}}].image.{{$key}}"
                                                                             :type-extension="['jpg', 'jpeg', 'png','svg']"
                                                                             placeholder="{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value }}"
                                                                             upload="{{$DIR_ABOUT_US_UPLOADS}}"
                                                                             id="image_{{$i.$key}}"
                                                                             :value-prop="{name:'{{ trans_module_setting('admin.image') . ' '.trans_module_setting('admin.language') . ' '. $value }}',path:aboutUs.section2.feather[{{$i}}].image_url.{{$key}}}">
                                                                </upload-file>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            <hr>
                                            @endfor
                                        </div>
                                        <div class="m-tabs-content__item m-tabs-content__item" id="about_us_section3">
                                            <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.about_us_section3') }}</h4>
                                            <div class="row" v-for="(row,index) in aboutUs.section3">
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label>{{ trans_module_setting('admin.title') }}</label>
                                                            <input type="text" v-model="row.title.{{$key}}" class="form-control"></input>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label>{{ trans_module_setting('admin.link_name') }}</label>
                                                            <input type="text" v-model="row.link_name.{{$key}}" class="form-control"></input>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                    <div class="col-md-12 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label>{{ trans_module_setting('admin.url') }}</label>
                                                            <input type="url" v-model="row.url" class="form-control"></input>
                                                        </div>
                                                    </div>
                                                @foreach(languages() as $key => $value)
                                                    <div class="col-md-6 pb-4">
                                                        <div class="form-group m-form__group">
                                                            <label :for="'aboutUs_section3_'+index+'{{$key}}'">{{ trans_module_setting('admin.content') }}</label>
                                                            <tinymce :id="'aboutUs_section3_'+index+'{{$key}}'" v-model="row.content.{{$key}}" :other_options="options"></tinymce>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-12" style="margin-top: 24px;">
                                                    <button type="button" @click="deleteRowSection3Box(index)" class="btn m-btn m-btn--gradient-from-danger m-btn--gradient-to-danger" style="float: right;">
                                                        <span><i class="fa fa-trash"></i><span></span></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <button type="button" @click="addRowSection3Box" class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" style="float: right;">
                                                <span><i class="fa fa-plus"></i><span></span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__action">
                                        <div class="row">
                                            <div class="col-md-3"></div>
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
        </div>
    </appearance-about-us-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
