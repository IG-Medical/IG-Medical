@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <product-form :product="{{ isset($product) ? json_encode($product) : 'null' }}" inline-template>
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
                                                <a class="m-nav__link m-tabs__item m-tabs__item--active" data-tab-target="#general" href="#">
                                                    <span class="m-nav__link-text">{{ trans_module_product('admin.general') }}</span>
                                                </a>
                                            </li>

                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#images" href="#images">
                                                    <span class="m-nav__link-text">{{ trans_module_product('admin.images') }}</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#attributes" href="#attributes">
                                                    <span class="m-nav__link-text">{{ trans_module_product('admin.attributes') }}</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link  m-tabs__item" data-tab-target="#basic_configuration" href="#basic_configuration">
                                                    <span class="m-nav__link-text">{{ trans_module_product('admin.basic_configuration') }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-9">
                                    <div class="m-tabs-content" id="m_sections">
                                        @include($asRoute.'::admin_panel.products.create-includes.general')
                                        @include($asRoute.'::admin_panel.products.create-includes.images')
                                        @include($asRoute.'::admin_panel.products.create-includes.attributes')
                                        @include($asRoute.'::admin_panel.products.create-includes.basic-configuration')
                                    </div>
                                </div>
                            </div>
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__action">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="row col-md-6">
                                                @include($asRoute.'::admin_panel.partials.buttons.save')
                                                @include($asRoute.'::admin_panel.partials.buttons.reset')
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
    </product-form>
@endsection

@push('css')
    <style>
        .border-options {
            border: 1px solid #ccc!important;
            padding: 22px;
            border-radius: 16px;
            margin-bottom: 3rem;
        }
    </style>
@endpush
@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endpush
