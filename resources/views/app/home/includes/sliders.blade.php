@php
    $sliderVideo = getSetting('slider_video');
@endphp

@if($sliderVideo)
    {{-- Display slider video if available --}}
    <section id="hero" class="d-flex flex-column align-items-center">
        <div class="slider-video-container">
            <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: inherit;" id="sliderVideo">
                <source src="{{ $sliderVideo }}" type="video/mp4">
                <source src="{{ $sliderVideo }}" type="video/webm">
                <source src="{{ $sliderVideo }}" type="video/ogg">
            </video>
        </div>
    </section>
@else
    {{-- Display sliders carousel if no video --}}
    <section id="hero" class="d-flex flex-column align-items-center">
        <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">
            <div class="carousel-inner">

                @php $i= 0; @endphp
                @foreach($sliders_1 as $index => $slider)

                <div class="carousel-item {{ $i === 0 ? 'active' :'' }}">
                    <div data-type="image" data-url="{{ $slider->show_background_url }}" class="d-none backgrounds"></div>
                    <div class="carousel-container">
                        <h1 class="animate__animated animate__fadeInDown" style="color: #fff;">{{$slider->caption_1}}</h1>
                        <h1 class="animate__animated animate__fadeInUp" style="color: #fff;">{{$slider->caption_2}}</h1>
                        <div class="hero-links animate__animated animate__fadeInUp">
                            @if($slider->call_to_action_text_1)
                                <a href="{{ $slider->call_to_action_url_1 }}" class="btn btn-warning border-radius-25 mr-md-4 mr-0 mt-4">{{$slider->call_to_action_text_1}}</a>
                            @endif
                            @if($slider->call_to_action_text_2)
                                <a href="{{ $slider->call_to_action_url_2 }}" class="btn btn-light border-radius-25 mr-md-4 mr-0 mt-4">{{$slider->call_to_action_text_2}}</a>
                            @endif
                            @if($slider->call_to_action_url_3)
                                <a href="javascript:;" class="btn btn-warning border-radius-25 mr-4 mt-4 video-btn" data-toggle="modal" data-src="{{$slider->call_to_action_url_3}}" data-target="#videoModal"><i class="fa fa-play"></i>{{ trans('app.watch_video') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                    @php $i++; @endphp

                @endforeach
            </div>

            <!-- Control prev -->
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">{{trans('app.previous')}}</span>
            </a>
            <!-- Control next -->
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">{{trans('app.next')}}</span>
            </a>

        </div>
    </section>
@endif
