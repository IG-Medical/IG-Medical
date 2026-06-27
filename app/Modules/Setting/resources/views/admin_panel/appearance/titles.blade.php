@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-titles-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}" inline-template>
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
                                                    <span class="m-nav__link-text">{{ trans_module_setting('admin.home_page_section1') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="m-tabs-content" id="m_sections">
                                        <div class="m-tabs-content__item m-tabs-content__item--active" id="about_us_section1">
                                            <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.about_us_section') }}</h4>
                                            {!! html_entity_decode(build_fields('home_page_about_us_section.title',trans_module_setting('admin.title'))) !!}
                                            {!! html_entity_decode(build_fields('home_page_about_us_section.sub_title',trans_module_setting('admin.sub_title'))) !!}
                                            {!! html_entity_decode(build_fields('home_page_about_us_section.content',trans_module_setting('admin.content'))) !!}
                                            <hr>

                                            <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.home_page_product_section') }}</h4>
                                            {!! html_entity_decode(build_fields('home_page_product_section.title',trans_module_setting('admin.title'))) !!}
                                            {!! html_entity_decode(build_fields('home_page_product_section.sub_title',trans_module_setting('admin.sub_title'))) !!}


                                             <h4 class="m--font-bold m--margin-top-15 m--margin-bottom-20">{{ trans_module_setting('admin.home_page_companies_section') }}</h4>
                                            {!! html_entity_decode(build_fields('home_page_companies_section.title',trans_module_setting('admin.title'))) !!}
                                            {!! html_entity_decode(build_fields('home_page_companies_section.sub_title',trans_module_setting('admin.sub_title'))) !!}

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
    </appearance-titles-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush

