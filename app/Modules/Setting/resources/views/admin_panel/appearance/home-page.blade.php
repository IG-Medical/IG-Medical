@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')


        <div class="m-content">
            <div class="row">
                <div class="col-md-12">

                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title"></div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_video_how_it_works" role="tab" aria-selected="false">{{ trans_module_setting('admin.video_how_it_works') }}</a>
                                    </li>
{{--                                    <li class="nav-item m-tabs__item">--}}
{{--                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_job_selection" role="tab" aria-selected="false">{{ trans_module_setting('admin.job_selection') }}</a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="tab-content">
                                <div class="tab-pane active " id="m_video_how_it_works">
                                    <appearance-how-it-work :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
                                        <form class="m-form m-form--label-align-right">
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-12" >
                                                        <label>{{ trans_module_setting('admin.video_how_it_works') }}</label>
                                                        <input type="url" v-model="video_how_it_works" class="form-control m-input"/>
                                                        <span class="form-control-feedback" v-if="form.validation&&form.validation.video_how_it_works">@{{ form.validation.video_how_it_works[0] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                                <div class="m-form__actions m-form__actions--solid">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                                            @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </appearance-how-it-work>
                                </div>
{{--                                <div class="tab-pane" id="m_job_selection">--}}
{{--                                </div>--}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection


@php $is_module = true; @endphp
@push('js_module')

    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endpush
