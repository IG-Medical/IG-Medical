@extends('admin_panel.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <news-form :news="{{ isset($news) ? json_encode($news) : 'null' }}" inline-template>
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
                                                        <label for="example_input_full_name">{{ trans_module_news('admin.title') }} <span class="error-block">*</span></label>
                                                        <input type="text" v-model="title.{{$key}}" class="form-control m-input" placeholder="{{ trans_module_news('admin.enter_title') }}">
                                                    </div>

                                                    <div class="form-group m-form__group">
                                                        <label for="example_input_full_name">{{ trans_module_news('admin.short_content') }} <span class="error-block">*</span></label>
                                                        <textarea type="text" v-model="short_content.{{$key}}" class="form-control m-input"></textarea>
                                                    </div>

                                                    <div class="form-group m-form__group">
                                                        <label for="example_input_content">{{ trans_module_news('admin.content') }} <span class="error-block">*</span></label>
                                                        <tinymce id="{{'content_'.$key}}" v-model="content.{{$key}}" :other_options="options"></tinymce>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pb-4">
                                                    <div class="form-group m-form__group">
                                                        <label for="image_{{$key}}">{{ trans_module_news('admin.image') . ' '.trans_module_news('admin.language') . ' '. $value}}</label>
{{--                                                        <upload-file :file.sync="image.{{$key}}"--}}
{{--                                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                                     placeholder="{{ trans_module_news('admin.image') . ' '.trans_module_news('admin.language') . ' '. $value }}"--}}
{{--                                                                     upload="{{$DIR_UPLOADS}}"--}}
{{--                                                                     id="image_{{$key}}"--}}
{{--                                                                     :value-prop="{name:'{{ trans_module_news('admin.image') . ' '.trans_module_news('admin.language') . ' '. $value }}',path:image_url.{{$key}}}">--}}
{{--                                                        </upload-file>--}}
                                                        @include('admin_panel.partials.image_upload',['url' => route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]),'width' => 350,'height'=> 277])

                                                        {{--<span class="form-control-feedback error-block" v-if="form.validation&&form.validation.image.{{$key}}">@{{ form.validation.image }}</span>--}}
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
    </news-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/news.js') }}"></script>
@endpush
