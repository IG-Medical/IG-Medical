@extends('app.layouts.app')

@push('page-title',$pageTitle)

@section('content')
    @include('app.home.includes.sliders')
    @include('app.home.includes.fetchers')
    <main id="main">
        <!-- ======= ig-medical Section ======= -->
        <section class="ig-medical">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title pb-0">
                            @isset($home_page_about_us_section['title'][getAppLocale()])
                                <p>{{ $home_page_about_us_section['title'][getAppLocale()] }}</p>
                            @endisset
                            @isset($home_page_about_us_section['sub_title'][getAppLocale()])
                                <h2 style="padding-top: 0;padding-bottom: 0;">{{$home_page_about_us_section['sub_title'][getAppLocale()]}}</h2>
                            @endisset
                            @isset($home_page_about_us_section['content'][getAppLocale()])
                                <h2 style="padding-top: 0;">{{$home_page_about_us_section['content'][getAppLocale()]}}</h2>
                            @endisset
                        </div>
                        <div class="row  mb-4">
                            <div class="col-md-10 mx-auto">
                                <div class="w-100">
                                    <iframe width="100%" class="iframe-youtube-video"  src="{{$video_how_it_works}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
{{--                                    <video width="100%" controls="">--}}
{{--                                        <source src="assets/video/gettyimages.mp4" type="video/mp4">--}}
{{--                                        <source src="assets/video/gettyimages.mp4" type="video/ogg">--}}
{{--                                        Your browser does not support the video tag.--}}
{{--                                    </video>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End ig-medical Section -->


        {{-- @include('app.home.includes.banners') --}}
        @include('app.home.includes.products')
        @include('app.home.includes.testimonials')
        @include('app.home.includes.news')

    </main><!-- End #main -->
@endsection

@push('js')
<script>
    // Intro carousel
    var heroCarousel = $("#heroCarousel").carousel({
        interval: 4000
    });
    //
    if (document.getElementById("heroCarousel")) {
        var init_type = null;
        var init_url = null;
        init_type = heroCarousel.find('.active .backgrounds')[0].dataset.type;
        init_url = heroCarousel.find('.active .backgrounds')[0].dataset.url;
        if (init_type == 'video') {
            $('section#hero').css('background-image', "linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%)");
            $('section#hero #bgvid').attr('src', init_url).show();
        } else {
            $('section#hero #bgvid').hide();
            $('section#hero').css("animation", "")
            setTimeout(()=>{
                $('section#hero').css('background-image', "linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%), url(" + init_url + ")").css("animation", "imageBg 4s alternate");
            }, 10);
        }
    }

    heroCarousel.on('slid.bs.carousel', function (e) {
        console.log();
        let _index = $(e.relatedTarget).index();
        let _anim = 'imageBg';
        let array_anim = ['imageBg','imageBgTop'];
        if(_index ==0 || _index ==1){
            _anim = array_anim[_index];
        }
        let _type = null;
        let _url = null;
        _type = $(this).find('.active .backgrounds')[0].dataset.type;
        _url = $(this).find('.active .backgrounds')[0].dataset.url;
        if (_type == 'video') {
            $('section#hero').css('background-image', "linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%)");
            $('section#hero #bgvid').attr('src', _url).show();
        } else {
            $('section#hero #bgvid').hide();
            // $('section#hero').css('background-image', "linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%), url(" + _url + ")");
            $('section#hero').css("animation", "")
            setTimeout(()=>{
                $('section#hero').css('background-image', "linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.2) 100%), url(" + _url + ")").css("animation", _anim+" 4s alternate");
            }, 10);
        }
    });




    var $videoSrc;
    $('.video-btn').click(function () {
        $videoSrc = $(this).data("src");
    });
    // when the modal is opened autoplay it
    $('#videoModal').on('shown.bs.modal', function (e) {
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })
    // stop playing the youtube video when I close the modal
    $('#videoModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#videoModal iframe#video").attr('src', '');
    });


    function OnDD() {
        $('.owl-carousel.owl-drag .owl-item').css({width: '224px'})
    }
    // Testimonials carousel (uses the Owl Carousel library)
    $(".testimonials-carousel").owlCarousel({
        onDragged: OnDD,
        // autoplay: true,
        dots: false,
        // loop: true,
        items: 4,
        stagePadding: 100,
        // autoWidth: true,
        startPosition: 1,
        responsive: {
            0: {
                items: 1,
                stagePadding: 0,
                autoWidth: true,
            },
            768: {
                items: 1,
                stagePadding: 0,
                autoWidth: true,
            },
            1024: {
                items: 3,
                stagePadding: 115,
            },
            1140: {
                items: 4,
                stagePadding: 100,
            }
        }
    });


</script>
@endpush
