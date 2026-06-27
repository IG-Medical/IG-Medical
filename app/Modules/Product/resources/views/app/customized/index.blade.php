@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    <main id="main">

        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image' => $breadcrumb])
        
{{--        @include('app.layouts.includes.breadcrumbs')--}}
        <customized-index :product="`{{request('id')}}`" v-cloak inline-template>
            <section class="contact-us-page mb-5">
                <div class="container">
                    <div class="section-title">
                        <p>{{ trans_module_product('app.customized') }}</p>
                    </div>
                    <section id="contact-us" class="contact-us pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div>
                                        <img src="{{ asset_app('img/contact us-01.jpg') }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12 d-flex justify-content-between flex-wrap">
                                           <a href="tel:{{ $data['phone'] }}" class="text-9fa5a8-hover" style="color: #000;">
                                               <span class="d-block mt-2"><span class="circle-icon mr-2"><i class="bx bxs-phone"></i></span> {{ $data['phone'] }}</span>
                                           </a>
                                            <a href="mailto:{{ $data['email'] }}" class="text-9fa5a8-hover" style="color: #000;">
                                                <span class="d-block mt-2"><span class="circle-icon mr-2"><i class="bx bxs-envelope"></i></span>{{ $data['email'] }}</span>
                                            </a>
                                        </div>
                                        <div class="col-md-12 col-12 mb-3">
                                            <a href="javascript:;" class="text-9fa5a8-hover" style="color: #000;">
                                            <span class="d-block mt-2"><span class="circle-icon mr-2"><i class="icofont icofont-location-pin"></i></span>{{ $data['address'] }}</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <input type="text" v-model="company_name" class="form-control fs-14" id="company" placeholder="{{ trans_module_product('app.your_company_name') }}">
                                        <span class="error" v-if="form.validation&&form.validation.company_name">@{{ form.validation.company_name[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="country" class="form-control fs-14" id="country" placeholder="{{ trans_module_product('app.your_country') }}">
                                        <span class="error" v-if="form.validation&&form.validation.country">@{{ form.validation.country[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="email" class="form-control fs-14" id="Email" placeholder="{{ trans_module_product('app.email_address') }}">
                                        <span class="error" v-if="form.validation&&form.validation.email">@{{ form.validation.email[0] }}</span>
                                    </div>
                                    <div class="form-group mt-4">
                                        <input type="text" v-model="full_name" class="form-control fs-14" id="FullName" placeholder="{{ trans_module_product('app.your_full_name') }}">
                                        <span class="error" v-if="form.validation&&form.validation.full_name">@{{ form.validation.full_name[0] }}</span>
                                    </div>

                                    <div class="form-group mt-4">
                                        <input type="text" v-model="phone" class="form-control fs-14" id="Mobile" placeholder="{{ trans_module_product('app.phone_number') }}">
                                        <span class="error" v-if="form.validation&&form.validation.phone">@{{ form.validation.phone[0] }}</span>
                                    </div>

                                    <div class="form-group mt-4">
                                        <textarea name="" v-model="message"  id="Message" class="form-control fs-14" rows="5" placeholder="{{ trans_module_product('app.your_massage_to_us') }}"> </textarea>
                                        <span class="error" v-if="form.validation&&form.validation.message">@{{ form.validation.message[0] }}</span>
                                    </div>
                                    <div class="form-group custom-class-recaptcha">
                                        <vue-recaptcha ref="recaptcha" @verify="onVerify" sitekey="{{ config('recaptcha.key') }}"></vue-recaptcha>
                                        <span class="error" v-if="form.validation&&form.validation.recaptcha">@{{ form.validation.recaptcha[0] }}</span>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-12 pt-4 text-right">
                                            <button type="button"  @click="sendMessage" :disabled="form.disabledButton" class="btn btn-warning pl-5 pr-5 pt-2 pb-2 border-radius-25">{{ trans_module_product('app.send') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </customized-index>
        <div class="map-container mb-5">
            {!! $google_map !!}
        </div>
    </main><!-- End #main -->
@endsection


@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/product.js') }}"></script>
@endpush
