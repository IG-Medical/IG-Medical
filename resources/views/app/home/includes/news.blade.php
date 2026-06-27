<section class="lastNews gallery">
    <div class="container">
        <div class="row">
            @foreach($news as $new)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    @isset($new->image_url[getAppLocale()])
                    <div class="member-img p-0 max-h-245">
                        <a href="{{route('news.index')}}/{{$new->slug}}">
                            <img src="{{$new->image_url[getAppLocale()]}}" class="img-fluid max-h-unset" alt="">
                        </a>
                    </div>
                    @endif

                    <div class="member-info border-0">
                        <a href="{{route('news.index')}}/{{$new->slug}}">
                        <h4 class="font-size-20 line-1-ellipsis">{{ $new->title }}</h4>
                        </a>
                        <p class="text-muted">{{ $new->date }}</p>
                        <span class="details line-4-ellipsis">{!! $new->short_content !!}</span>
                        <p class="d-flex justify-content-between mb-0 pt-3">
                            <a class="text-1492E6" href="{{route('news.index')}}/{{$new->slug}}">{{ trans('app.read_more') }}</a>
                            <a class="text-1492E6"  href="{{route('news.index')}}/{{$new->slug}}"><i class="ri-arrow-right-line"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
