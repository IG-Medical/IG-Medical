@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
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

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route_admin('setting.store') }}" class="m-form m-form--label-align-right" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="{{ $page }}">

                        <div class="m-portlet__body">
                            @php
                                $productPdf = $settings->where('key', 'product_pdf')->first();
                                $productPdfValue = $productPdf ? $productPdf->value : '1';
                                $googleMapApiKey = $settings->where('key', 'google_map_api_key')->first();
                                $googleMapApiKeyValue = $googleMapApiKey ? $googleMapApiKey->value : '';
                                $sliderVideo = $settings->where('key', 'slider_video')->first();
                                $sliderVideoValue = $sliderVideo ? $sliderVideo->value : null;
                            @endphp

                            <div class="m-form__group form-group row">
                                <div class="col-12">
                                    <div class="m-form__group form-group">
                                        <label for="">Product PDF</label>
                                        <div class="m-radio-list">
                                            <label class="m-radio">
                                                <input type="radio" name="product_pdf" value="1" id="one" {{ old('product_pdf', $productPdfValue) == '1' ? 'checked' : '' }}>  Direct download
                                                <span></span>
                                            </label>
                                            <label class="m-radio">
                                                <input type="radio" name="product_pdf" value="2" id="two" {{ old('product_pdf', $productPdfValue) == '2' ? 'checked' : '' }}>  Agree before downloading Product PDF
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="google_map_api_key">google_map_api_key</label>
                                <input type="text" name="google_map_api_key" value="{{ old('google_map_api_key', $googleMapApiKeyValue) }}" class="form-control m-input m-input--square" id="google_map_api_key" aria-describedby="emailHelp" placeholder="Enter ">
                                @error('google_map_api_key')
                                    <span class="form-control-feedback error-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group m-form__group">
                                <label for="slider_video">Slider Video</label>
                                <input type="file" name="slider_video" id="slider_video" accept="video/mp4,video/webm,video/ogg" class="form-control"/>
                                @error('slider_video')
                                    <span class="form-control-feedback error-block">{{ $message }}</span>
                                @enderror

                                @if($sliderVideoValue)
                                    <div class="mt-3">
                                        <video controls style="max-width: 100%; height: auto;">
                                            <source src="{{ $sliderVideoValue }}" type="video/mp4">
                                            <source src="{{ $sliderVideoValue }}" type="video/webm">
                                            <source src="{{ $sliderVideoValue }}" type="video/ogg">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="mt-2">
                                            <label class="m-checkbox">
                                                <input type="checkbox" name="remove_slider_video" value="1"> Remove current video
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">{{ trans_module_page('admin.save') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ trans_module_page('admin.reset') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

