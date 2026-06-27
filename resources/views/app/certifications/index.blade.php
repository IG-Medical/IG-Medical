@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    <main id="main">
        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <section class="mt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @isset($certification['title'][getAppLocale()])
                        <h5 class="mb-4 text-1A5468">{!! $certification['title'][getAppLocale()] !!}</h5>
                        @endisset
                        <div class="w-100 mb-4">
                            @isset($certification['content'][getAppLocale()])
                            <p>{!! $certification['content'][getAppLocale()] !!}</p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="certification-slider pt-5 pb-5 mt-3 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="certification-owl-carousel owl-carousel">
                            @if(isset($certification['images'])&&count($certification['images'])>0)
                                @foreach($certification['images'] as $image)
                                    <div class="item">
                                        @isset($image['image_url'][getAppLocale()])
                                            <div class="certification-img">
                                                <img src="{{$image['image_url'][getAppLocale()]}}" class="img-fluid"  alt="">
                                            </div>
                                        @endisset
                                        @isset($image['name'][getAppLocale()])
                                            <h5 class="text-1A5468 pt-3 pb-3 certification-name text-center">
                                                {!! $image['name'][getAppLocale()] !!}
                                            </h5>
                                        @endisset
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection

@push('js')
<script>
    $(".certification-owl-carousel").owlCarousel({
        autoplay: true,
        dots: false,
        loop: true,
        autoplayTimeout:1000,
        autoplayHoverPause: true,
        items: 4,
        // rtl: true,
        margin:10,
        responsive: {
            0: {
                items: 2,
                loop: true,
                nav:true,
                margin: 5,
            },
            767: {
                items: 1,
                loop: true,
                nav:true,
                margin: 5,
            },
            768: {
                items: 4,
                loop: true,
                nav:true,
                dots: false,
                margin: 10,
            }
        }
    });
</script>
@endpush
