<!-- ======= companies Section ======= -->
<section id="companies" class="companies" style="padding: 0 !important;">
    <div class="">

        @php $j= 0; @endphp

        <div class="">
            <div id="companiesCarousel" class="carousel carousel-fade" data-ride="carousel" >
                <div class="carousel-inner" style="max-width: unset !important;">
                    @foreach($sliders_2 as $index=>$testimonial)

                        <div class="carousel-item {{$j ==0 ? 'active' : ''}}">
                            <div class="testimonials-image-container">
                                <img src="{{$testimonial->show_background_url}}" class="testimonials-image animate__animated animate__fadeIn" style="width: 100%; height: 100%" alt="">
                            </div>
                        </div>
                        @php $j++; @endphp

                    @endforeach
                </div>

                <!-- Control prev -->
                <a class="carousel-control-prev" href="#companiesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">{{ trans('app.previous') }}</span>
                </a>
                <!-- Control next -->
                <a class="carousel-control-next" href="#companiesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">{{ trans('app.next') }}</span>
                </a>
            </div>
        </div>
    </div>
</section><!-- End companies Section -->
