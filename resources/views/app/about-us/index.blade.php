@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
<main id="main">
    @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
    <section class="mt-5">
        <div class="container">
            <div class="section-title d-flex flex-column">
                @isset($aboutUs['section1']['title'][getAppLocale()])

                    {!! $aboutUs['section1']['title'][getAppLocale()]  !!}

                    <p class="mx-w-500 mx-auto special-border-bottom"></p>
                @endisset
                @isset($aboutUs['section1']['content'][getAppLocale()])
                <h2 class="fs-14 text-MontserratMedium fs-14">{!! $aboutUs['section1']['content'][getAppLocale()] !!}</h2>
                @endisset
{{--                <h2 class="fs-14 text-MontserratMedium fs-14">--}}
{{--                    <span class="text-1A5468">IG MEDICAL</span> is a leading full-service provider for innovative energy-based surgical--}}
{{--                    systems Made in Germany with a <span class="text-MontserratBold">high level of vertical integration</span> , an <span class="text-MontserratBold">extensive mix</span> of technologies--}}
{{--                    and passionate engineering. In close interdisciplinary networking with the world's leading--}}
{{--                    universities, clinics and institutes, we develop new solutions for <span class="text-MontserratBold">ultrasound</span> and <span class="text-MontserratBold">HF surgery</span>.--}}
{{--                </h2>--}}
{{--                <h2 class="fs-14 fs-14">--}}
{{--                    Our generators and instruments score with ergonomics and usability as well as with the highest level of economy and durability.--}}
{{--                </h2>--}}
            </div>
        </div>
    </section>

    <section class="mt-5 about-us-content-details">
        <div class="container pt-0">
            <div class="section-title pt-5">
                @isset($aboutUs['section2']['title'][getAppLocale()])
               {!! $aboutUs['section2']['title'][getAppLocale()] !!}

                    <p class="mx-w-500 mx-auto special-border-bottom"></p>
                @endisset
                @isset($aboutUs['section2']['sub_title'][getAppLocale()])
                <h2 class="font-size-20 text-1A5468 text-center"> {!! $aboutUs['section2']['sub_title'][getAppLocale()] !!}</h2>
                @endisset
            </div>
            @isset($aboutUs['section2']['feather'][0])
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{$aboutUs['section2']['feather'][0]['image_url'][getAppLocale()]}}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-content d-flex mb-4 align-items-center h-100">
                        <div class="about-content-data my-auto">
                            @isset($aboutUs['section2']['feather'][0]['title'][getAppLocale()])
                            <h2 class="font-size-20 text-2DAFE6">{!! $aboutUs['section2']['feather'][0]['title'][getAppLocale()] !!}</h2>
                            @endisset
                            @isset($aboutUs['section2']['feather'][0]['content'][getAppLocale()])
                            <p class="fs-14">{!! $aboutUs['section2']['feather'][0]['content'][getAppLocale()] !!}</p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            @endisset
            @isset($aboutUs['section2']['feather'][1])
            <div class="row mt-5">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="about-content d-flex mb-4 align-items-center h-100">
                        <div class="about-content-data my-auto">
                            @isset($aboutUs['section2']['feather'][1]['title'][getAppLocale()])
                            <h2 class="font-size-20 text-2DAFE6">{!! $aboutUs['section2']['feather'][1]['title'][getAppLocale()] !!}</h2>
                            @endisset
                            @isset($aboutUs['section2']['feather'][1]['content'][getAppLocale()])
                            <p class="fs-14">{!! $aboutUs['section2']['feather'][1]['content'][getAppLocale()] !!}</p>
                            @endisset
                        </div>
                    </div>
                </div>
                @isset($aboutUs['section2']['feather'][1]['image_url'][getAppLocale()])
                <div class="col-md-6" data-aos="fade-left">
                    <img src="{{$aboutUs['section2']['feather'][1]['image_url'][getAppLocale()]}}" class="img-fluid" alt="">
                </div>
                @endisset
            </div>
            @endisset
            @isset($aboutUs['section2']['feather'][2])
            <div class="row mt-5">
                @isset($aboutUs['section2']['feather'][2]['image_url'][getAppLocale()])
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{$aboutUs['section2']['feather'][2]['image_url'][getAppLocale()]}}" class="img-fluid" alt="">
                </div>
                @endisset
                <div class="col-md-6" data-aos="fade-left">
                    <div class="about-content d-flex mb-4 align-items-center h-100">
                        <div class="about-content-data my-auto">
                            @isset($aboutUs['section2']['feather'][2]['title'][getAppLocale()])
                                <h2 class="font-size-20 text-2DAFE6">{!! $aboutUs['section2']['feather'][2]['title'][getAppLocale()] !!}</h2>
                            @endisset
                            @isset($aboutUs['section2']['feather'][2]['content'][getAppLocale()])
                                <p class="fs-14">{!! $aboutUs['section2']['feather'][2]['content'][getAppLocale()] !!}</p>
                           @endisset
                        </div>
                    </div>
                </div>
            </div>
            @endisset
        </div>
    </section>

    <section class="mt-2 pb-5 about-us-category">
        <div class="container">
            <div class="row">
                @if(isset($aboutUs['section3']) && count($aboutUs['section3'])>0)
                    @foreach($aboutUs['section3'] as $about)
                        <div class="col-md-4 mt-2">
                            <div class="cat-view">
                                <div class="cat-view-header text-center">
                                    <h5 class="text-white">{!! $about['title'][getAppLocale()] !!}</h5>
                                    <a href="{!! $about['url'] !!}" target="_blank"><h5 class="text-2DAFE6">{!! $about['link_name'][getAppLocale()] !!}</h5></a>
                                </div>
                                <div class="cat-view-content">
                                    {!! $about['content'][getAppLocale()] !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

</main>
@endsection

@push('js')

@endpush
