@if(isset($banners) && $banners->count() > 0)
    @php
        $firstBanner = $banners->first();
        $secondBanner = $banners->skip(1)->first();
    @endphp

    {{-- First Banner Section: col-md-12 --}}
    @if($firstBanner)
        <section class="banner-section mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-block">
                            @if($firstBanner->link)
                                <a href="{{ $firstBanner->link }}">
                            @endif
                            @if($firstBanner->image)
                                <img src="{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $firstBanner->image) }}" alt="{{ $firstBanner->title ?? '' }}" class="img-fluid w-100 mb-3">
                            @endif
                            @if($firstBanner->link)
                                </a>
                            @endif

                            @if($firstBanner->categories->count() > 0)
                                <div class="row mt-3">
                                    @foreach($firstBanner->categories as $category)
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <div class="card">
                                                @if($category->image)
                                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="card-img-top" style="max-height: 150px; object-fit: cover;">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $category->name }}</h5>
                                                    <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-primary">{{ trans('app.view_category') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Second Banner Section: col-md-4 --}}
    @if($secondBanner)
        <section class="banner-section mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="banner-block">
                            @if($secondBanner->link)
                                <a href="{{ $secondBanner->link }}">
                            @endif
                            @if($secondBanner->image)
                                <img src="{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $secondBanner->image) }}" alt="{{ $secondBanner->title ?? '' }}" class="img-fluid w-100 mb-3">
                            @endif
                            @if($secondBanner->link)
                                </a>
                            @endif

                            @if($secondBanner->categories->count() > 0)
                                <div class="categories-list">
                                    @foreach($secondBanner->categories as $category)
                                        <div class="mb-2">
                                            <div class="card">
                                                @if($category->image)
                                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="card-img-top" style="max-height: 100px; object-fit: cover;">
                                                @endif
                                                <div class="card-body p-2">
                                                    <h6 class="card-title mb-1">{{ $category->name }}</h6>
                                                    <a href="{{ route('category.show', $category->id) }}" class="btn btn-sm btn-primary btn-block">{{ trans('app.view_category') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif

{{-- Free Categories (not linked to any banner): col-md-4 each --}}
@if(isset($freeCategories) && $freeCategories->count() > 0)
    <section class="free-categories-section mb-4">
        <div class="container">
            <div class="row">
                @foreach($freeCategories as $category)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            @if($category->image)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">{{ trans('app.view_category') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
