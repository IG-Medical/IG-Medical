@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <page-form :page="{{ isset($page) ? json_encode($page) : 'null' }}" inline-template>
        <div class="m-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                    <h3 class="m-portlet__head-text">{{ last(meta('breadcrumbs')) }}</h3>
                                </div>
                            </div>
                            @include($asRoute.'::admin_panel.partials.buttons.back')
                        </div>
                        <div class="m-portlet__body">
                            @include($asRoute.'::admin_panel.partials.nav-tabs')
                            <div class="tab-content">
                                @php $i = 0; @endphp
                                @foreach(languages() as $key => $value)
                                    @php ++$i; @endphp
                                    <div class="tab-pane {{ $key == getAppLocale() ? 'active' : '' }}" id="m_tabs_{{$key}}" role="tabpanel">
                                        <form class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group">
                                                        <label for="example_input_full_name">{{ trans_module_page('admin.title') }} <span class="error-block">*</span></label>
                                                        <input type="text" v-model="title.{{$key}}" class="form-control m-input" placeholder="{{ trans_module_page('admin.enter_title') }}">

{{--                                                        @if($key == 'en')--}}
{{--                                                            <slug :lang="`{{$key}}`"--}}
{{--                                                                  :page="{{ isset($page) ? json_encode($page) : 'null' }}"--}}
{{--                                                                  :text="title"  :base-Url="`{{ url('/') }}`" :slugging.sync="slug"--}}
{{--                                                                  @slug="setNewSlug($event,`{{$key}}`)">--}}
{{--                                                            </slug>--}}
{{--                                                        @endif--}}
                                                    </div>

                                                    <div class="form-group m-form__group">
                                                        <label for="example_input_content">{{ trans_module_page('admin.content') }} <span class="error-block">*</span></label>
                                                        <tinymce id="{{'content_'.$key}}" v-model="content.{{$key}}" :other_options="options"></tinymce>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(count(languages()) == $i || isset($page))
                                            <div class="m-portlet__foot m-portlet__foot--fit">
                                                <div class="m-form__actions m-form__actions">
                                                    @include($asRoute.'::admin_panel.partials.buttons.save')
                                                    @include($asRoute.'::admin_panel.partials.buttons.reset')
                                                </div>
                                            </div>
                                            @endif
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </page-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/page.js') }}"></script>
@endpush
