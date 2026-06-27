@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ last(meta('breadcrumbs')) }}
@endpush

@section('content')
    <distributor-form :distributor ="{{ isset($distributor ) ? json_encode($distributor) : 'null' }}" inline-template>
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
                            @include('admin_panel.partials.buttons.back')
                        </div>
                        <div class="m-portlet__body">
                            <form class="m-form m-form--label-align-left- m-form--state-">
                                {!! build_fields('title',trans_module_distributor('admin.title')) !!}

                                <div class="row">
                                @foreach(languages() as $key => $value)
                                    <div class="col-md-6 pb-4">
                                        <div class="form-group m-form__group">
                                            <label for="{{'description'.$key}}">{{ trans_module_setting('admin.content') }}</label>
                                            <tinymce id="{{'description'.$key}}" v-model="description.{{$key}}" :other_options="options"></tinymce>
                                        </div>
                                    </div>
                                @endforeach
                                </div>

                                <div class="col-md-12 pb-4">
                                    <div class="form-group m-form__group">
                                        <label for="avatar">{{ trans_module_distributor('admin.image') }}</label>
{{--                                        <upload-file :file.sync="image"--}}
{{--                                                     :type-extension="['jpg', 'jpeg', 'png','svg']"--}}
{{--                                                     placeholder="{{ trans_module_distributor('admin.image') }}"--}}
{{--                                                     upload="{{$DIR_UPLOADS}}"--}}
{{--                                                     id="avatar"--}}
{{--                                                     :value-prop="{name:'{{ trans_module_distributor('image') }}',path:image_url}">--}}
{{--                                        </upload-file>--}}
                                        @include('admin_panel.partials.image_upload',['url' => route('upload.uploadFileOnCrop',['dir' => $DIR_UPLOADS]),'width' => 580,'height'=> 480, 'key' => null])

{{--                                        <span class="form-control-feedback error-block" v-if="form.validation && form.validation.image">@{{ form.validation.image[0] }}</span>--}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label for="City" class="fw-regular">Country</label>
                                    <select name="" v-model="country" id="Country" class="form-control">
                                        <option value="" disabled selected>Country name</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>'
                                        @endforeach
                                    </select>
                                    <span class="error" v-if="form.validation&&form.validation.country">@{{ form.validation.country[0] }}</span>
                                </div>
                                <div class="col-md-12 pb-4">
                                <map-location-single-marker :lat.sync="LocationLat" :lng.sync="LocationLng" ref="EventLocation"></map-location-single-marker>
                                </div>
                                <div class="col-md-12 pb-4">
                                    <label class="m-checkbox">
                                        <input type="checkbox" v-model="show_map"> {{ trans_module_distributor('admin.show_map') }}
                                        <span></span>
                                    </label>
                                    <span class="form-control-feedback error-block" v-if="form.validation&&form.validation.show_map">@{{ form.validation.show_map[0] }}</span>
                                </div>

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
    </distributor-form>
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{getSetting("google_map_api_key")}}&v=1&libraries=geometry"></script>
    <script src="{{ asset('js/admin/distributor.js') }}"></script>
@endpush
