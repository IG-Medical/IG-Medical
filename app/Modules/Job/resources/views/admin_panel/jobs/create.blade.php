@extends(ADMIN_VIEWS_DIR.'.layouts.app')

@push('page-title')
    {{ meta('breadcrumbs-title') }}
@endpush

@section('content')
    <job-form :job="{{ isset($job) ? json_encode($job) : 'null' }}" inline-template>
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
                            @include(ADMIN_VIEWS_DIR.'.partials.buttons.back')
                        </div>

                        <div class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                {!! build_fields('job_title',trans_module_job('admin.job_title') ) !!}
                                <div class="row">
                                    @foreach(languages() as $key => $value)
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group m-form__group ">
                                                <label for="example_input_content">{{ trans_module_job('admin.description') }} <span class="error-block">*</span></label>
                                                <tinymce id="{{'description'.$key}}" v-model="description.{{$key}}" :other_options="options"></tinymce>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-md-12">
                                        <label for="">{{ trans_module_job('admin.categories') }}</label>
                                        <select class="form-control" v-model="category_id">
                                            <option v-for="category in categories" :value="category.id">@{{category.title}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-md-6">
                                        <label for="">{{ trans_module_job('admin.genders') }}</label>
                                        <select class="form-control" v-model="gender">
                                            @foreach($genders as $key=> $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 pb-4">
                                        <div class="form-group m-form__group ">
                                            <label for="example_input_content">{{ trans_module_job('admin.deadline') }} <span class="error-block">*</span></label>
                                            <input v-model="deadline" type="date" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                {!! build_fields('location',trans_module_job('admin.location') ) !!}
                                {!! build_fields('experience',trans_module_job('admin.experience') ) !!}
                                {!! build_fields('status',trans_module_job('admin.status') ) !!}
                                <div class="row">
                                        <div class="col-md-6 pb-4">
                                            <div class="form-group m-form__group ">
                                                <label for="example_input_content">{{ trans_module_job('admin.phone') }} <span class="error-block">*</span></label>
                                                <input v-model="phone" class="form-control"></input>
                                            </div>
                                        </div>
                                    <div class="col-md-6 pb-4">
                                        <div class="form-group m-form__group ">
                                            <label for="example_input_content">{{ trans_module_job('admin.email') }} <span class="error-block">*</span></label>
                                            <input v-model="email" class="form-control"></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.save')
                                        @include($moduleNamespace.'::admin_panel.partials.buttons.reset')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </job-form>
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/admin/job.js') }}"></script>
@endpush


