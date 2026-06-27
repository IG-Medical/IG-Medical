<section class="subHero">
    <div class="container">
        <div class="row d-md-flex d-block sub-hero">
            @foreach($categories as $category)
            <div class="card" style="">
                <div class="sub-hero-img">
                    <img src="{{$category->icon_url}}" class="mx-auto" alt="">
                </div>
                <h6 class="pt-3">{{ $category->name }}</h6>
                <a href="{{route('product.category',['category' => $category->slug])}}" class="btn btn-primary border-radius-25 fs-14">{{ trans('app.read_more') }}</a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@push('css')
    <style>
        @media (max-width: 576px) {
            .subHero {
                display: none !important;
            }
        }
    </style>
@endpush
