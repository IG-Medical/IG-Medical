@extends('admin_panel.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <appearance-features-form :page="'{{$page}}'" :settings="{{ isset($settings) ? json_encode($settings) : 'null' }}"  inline-template>
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
                                @php $i = 1; @endphp
                                @for($i; $i <= 5; $i++)
                                    <h3>{{trans_admin('feature_'.$i)}}</h3>
                                    {!! build_fields('feature_'.$i.'.caption_1',trans_admin('caption')) !!}
                                    {!! build_fields('feature_'.$i.'.caption_2',trans_admin('about'),null,'textarea') !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group m-form__group">
                                                <label for="feature_{{$i}}">{{ trans_admin('icon') }}</label>
                                                <upload-file :file.sync="feature_{{$i}}.icon"
                                                             :type-extension="['jpg', 'jpeg', 'png','svg']"
                                                             placeholder="{{ trans_admin('icon') }}"
                                                             upload="{{\App\Models\Setting::DIR_FEATURE_UPLOADS}}"
                                                             id="feature_{{$i}}"
                                                             :value-prop="{name:'{{ trans_admin('icon') }}',path:icon_{{$i}}_url}">
                                                </upload-file>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endfor
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @include('admin_panel.partials.buttons.save')
                                            @include('admin_panel.partials.buttons.reset')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </appearance-features-form>
@endsection


