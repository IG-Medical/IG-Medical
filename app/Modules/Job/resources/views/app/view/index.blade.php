@extends(APP_VIEWS_DIR.'.layouts.app')

@push('page-title', $pageTitle)


@section('content')

    <main id="main">
        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <job-view :career-id="{{ $career->id }}" inline-template>
            <section id="careerDetails" class="careerDetails">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="career-left-details">
                                <div class="pr-4 pl-4 pb-1 pt-4">
                                    <h3 class="text-1A5468">{{$career->job_title}}</h3>
                                    <div class="text-muted d-md-flex d-block">
                                        <span class="time d-inline-block mt-md-0 mt-3" style="line-height: 1">{{$career->status}}</span>
                                        <span class="d-inline-block mt-md-0 mt-3"><i class="ri-time-line" style="line-height: 1.2"></i>{{$career->humans_date_publication}}</span>
                                        <span class="d-inline-block mt-md-0 mt-3"><i class='bx bxs-map'></i>{{$career->location}}</span>

                                {{--<span class="d-inline-block mt-md-0 mt-3">{{$career->count_applicants ? $career->count_applicants .' '.trans_module_job('admin.applicants') : null}} </span>--}}
                                    </div>
                                </div>
                                <hr>
                                <div class="pr-4 pl-4 pb-4 pt-1">
                                    <h6 class="font-weight-bold content-title">{{ trans_module_job('app.job_description') }}</h6>
                                    {!! $career->description !!}
                                </div>
                                <div class="row p-4">
                                    <div class="col-md-6 mb-3">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalApplayApplicant" class="btn btn-warning-search btn-sm d-block text-uppercase border-radius-10">{{ trans_module_job('app.apply_now') }}</a>
                                    </div>
                                    <div class="col-md-6 d-flex my-auto justify-content-center">
                                        <span class="font-size-12 pr-2 my-auto">{{ trans_module_job('app.share_job_on') }}:</span>
                                        <div class="social-links font-size-20">
                                            <a href="{{share_social_media('twitter')}}" target="_blank" class="twitter m-2"><i class="bx bxl-twitter"></i></a>
                                            <a href="{{share_social_media('facebook')}}" target="_blank" class="facebook m-2"><i class="bx bxl-facebook"></i></a>
                                            <a href="{{share_social_media('instagram')}}" target="_blank" class="instagram m-2"><i class="bx bxl-instagram"></i></a>
                                            <a href="{{share_social_media('linkedin')}}" target="_blank" class="linkedin m-2"><i class="bx bxl-linkedin"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="career-right-details-1">
                                <div class="p-3 dash">
                                    <h6 class="font-weight-bold career-right-details-title m-0">{{ trans_module_job('app.job_overview') }}</h6>
                                </div>
                                <hr class="m-0">
                                <div class="pr-3 pl-3 pb-3 pt-1">
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.published_on') }}: </span><span><b>{{$career->published_on}}</b></span>
                                    </div>
                                    @if($career->gender)
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.gender') }}: </span><span><b>{{genders(true)[$career->gender]}}</b></span>
                                    </div>
                                    @endif
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_app('status') }}: </span><span><b>{{$career->status}}</b></span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.experience') }}: </span><span><b>{{$career->experience}}</b></span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.application_deadline') }}: </span><span><b>{{$career->show_deadline}}</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="career-right-details-2">
                                <div class="p-3 dash">
                                    <h6 class="font-weight-bold career-right-details-title m-0">{{ trans_module_job('app.any_question') }} </h6>
                                </div>
                                <hr class="m-0">
                                <div class="pr-3 pl-3 pb-3 pt-1">
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.phone') }}: </span><span>
                                            <a href="tel:{{ $career->phone }}"><b>{{$career->phone}}</b></a>
                                        </span>
                                    </div>
                                    <div class="pt-2">
                                        <span class="text-muted">{{ trans_module_job('app.email') }}: </span><span>
                                           <a href="mailto:{{ $career->email }}"><b>{{ $career->email }}</b></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalApplayApplicant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ trans_module_job('app.apply_applicant') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.salutation') }} <b style="color: red;">*</b></label>
                                            <select v-model="salutation" class="form-control">{{ trans_module_job('app.salutation') }}
                                                <option value="">{{ trans_module_job('app.salutation') }}</option>
                                                @foreach(\Job\Models\CareerApplication::salutations() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" v-if="form.validation&&form.validation.salutation">@{{ form.validation.salutation[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.first_name') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="first_name" class="form-control fs-14" id="first_name" placeholder="{{ trans_module_job('app.first_name') }}">
                                            <span class="error" v-if="form.validation&&form.validation.first_name">@{{ form.validation.first_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.last_name') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="last_name" class="form-control fs-14" id="last_name" placeholder="{{ trans_module_job('app.last_name') }}">
                                            <span class="error" v-if="form.validation&&form.validation.last_name">@{{ form.validation.last_name[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.email') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="email" class="form-control fs-14" id="email" placeholder="{{ trans_module_job('app.email') }}">
                                            <span class="error" v-if="form.validation&&form.validation.email">@{{ form.validation.email[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.email_confirmation') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="email_confirmation" class="form-control fs-14" id="email_confirmation" placeholder="{{ trans_module_job('app.email_confirmation') }}">
                                            <span class="error" v-if="form.validation&&form.validation.email_confirmation">@{{ form.validation.email_confirmation[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.phone') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="phone" class="form-control fs-14" id="phone" placeholder="{{ trans_module_job('app.phone') }}">
                                            <span class="error" v-if="form.validation&&form.validation.phone">@{{ form.validation.phone[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ 'Street, Nr' }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="street" class="form-control fs-14" id="street" placeholder="{{ trans_module_job('app.street') }}">
                                            <span class="error" v-if="form.validation&&form.validation.street">@{{ form.validation.street[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ 'Telephone Number'}} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="number" class="form-control fs-14" id="street" placeholder="{{ trans_module_job('app.number') }}">
                                            <span class="error" v-if="form.validation&&form.validation.number">@{{ form.validation.number[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.plz') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="plz" class="form-control fs-14" id="street" placeholder="{{ trans_module_job('app.plz') }}">
                                            <span class="error" v-if="form.validation&&form.validation.plz">@{{ form.validation.plz[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.place_of_residence') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="place_of_residence" class="form-control fs-14" id="place_of_residence" placeholder="{{ trans_module_job('app.place_of_residence') }}">
                                            <span class="error" v-if="form.validation&&form.validation.place_of_residence">@{{ form.validation.place_of_residence[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.land') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="land" class="form-control fs-14" id="land" placeholder="{{ trans_module_job('app.land') }}">
                                            <span class="error" v-if="form.validation&&form.validation.land">@{{ form.validation.land[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.salary_expectations') }} <b style="color: red;">*</b></label>
                                            <input type="text" v-model="salary_expectations" class="form-control fs-14" id="salary_expectations" placeholder="{{ trans_module_job('app.salary_expectations') }}">
                                            <span class="error" v-if="form.validation&&form.validation.salary_expectations">@{{ form.validation.salary_expectations[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.earliest_start_of_work') }} <b style="color: red;">*</b></label>
                                            <div>
                                                <el-date-picker
                                                    v-model="earliest_start_of_work"
                                                    type="date"
                                                    placeholder="{{ trans_module_job('app.earliest_start_of_work') }}">
                                                </el-date-picker>
                                            </div>
                                            <span class="error" v-if="form.validation&&form.validation.earliest_start_of_work">@{{ form.validation.earliest_start_of_work[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.write_to') }}</label>
                                            <input type="file" v-on:change="uploadFileWriteTo" class="form-control fs-14"  placeholder="{{ trans_module_job('app.write_to') }}" id="write_to">
                                            <span class="error" v-if="form.validation&&form.validation.write_to">@{{ form.validation.write_to[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.curriculum_vitae') }} <b style="color: red;">*</b></label>
                                            <input type="file"  v-on:change="uploadFileCurriculum" class="form-control fs-14"  placeholder="{{ trans_module_job('app.curriculum_vitae') }}" id="curriculum_vitae">
                                            <span class="error" v-if="form.validation&&form.validation.file_curriculum">@{{ form.validation.file_curriculum[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Testimonials/Certificates</label>
                                            <input type="file" @change="uploadFileTestimonials" class="form-control fs-14"  placeholder="{{ trans_module_job('app.testimonials') }}" id="testimonials">
                                            <span class="error" v-if="form.validation&&form.validation.miscellaneous">@{{ form.validation.miscellaneous[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.miscellaneous') }}</label>
                                            <input type="file" v-on:change="uploadFileMiscellaneous" class="form-control fs-14"  placeholder="{{ trans_module_job('app.miscellaneous') }}" id="miscellaneous">
                                            <span class="error" v-if="form.validation&&form.validation.miscellaneous">@{{ form.validation.miscellaneous[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ trans_module_job('app.total_package') }}:</label>
                                            <input type="file" v-on:change="uploadFileTotalPackage" class="form-control fs-14"  placeholder="{{ trans_module_job('app.total_package') }}" id="total_package">
                                            <span class="error" v-if="form.validation&&form.validation.total_package">@{{ form.validation.total_package[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ 'How did you hear about this position?' }} <b style="color: red;">*</b></label>
                                            <select v-model="attentive_to_business_through" class="form-control">{{ trans_module_job('app.attentive_to_business_through') }}
                                                <option value="">{{ '' }}</option>
                                                @foreach(\Job\Models\CareerApplication::attentiveToBusinessThrough() as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" v-if="form.validation&&form.validation.attentive_to_business_through">@{{ form.validation.attentive_to_business_through[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" v-model="internal_application"> {{trans_module_job('app.internal_application')}}
                                            <span class="error" v-if="form.validation&&form.validation.internal_application">@{{ form.validation.internal_application[0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>
                                        {{ trans_module_job('app.i_have_read_the') }}
                                        <a href="{{route('page.index',['page' => 'privacy-policy'])}}">
                                            {{ trans_module_job('app.privacy_policy') }}</a>
                                        {{ trans_module_job('app.privacy_policy_desrip') }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" v-model="data_protection"> {{trans_module_job('app.data_protection')}}
                                    <b style="color: red;">*</b>
                                    <br>
                                    <span class="error" v-if="form.validation&&form.validation.data_protection">@{{ form.validation.data_protection[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <p>
                                    {{ trans_module_job('app.data_protection_desrip') }}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" v-model="admission_to_talent_pool"> {{trans_module_job('app.admission_to_talent_pool')}}
                                    <span class="error" v-if="form.validation&&form.validation.admission_to_talent_pool">@{{ form.validation.admission_to_talent_pool[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <p>
                                        {{ trans_module_job('app.admission_to_talent_pool_desrip') }} <b>{{ trans_module_job('app.bold') }}</b> {{ trans_module_job('app.are_mandatory') }}
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans_module_job('app.close') }}</button>
                                <button type="button" @click="applayAppliction" :disabled="form.disabledButton" class="btn btn-primary">{{ trans_module_job('app.submit') }} </button>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </job-view>
    </main>
@endsection

@php $is_module = true; @endphp
@push('js')
    <script src="{{ asset('js/app/job.js') }}"></script>
@endpush
