<!-- ======= Last gallery Section ======= -->
<section id="gallery" class="lastNews gallery bg-2dafe6">
    <div class="container">

        <div class="section-title">
            @isset($home_page_product_section['title'][getAppLocale()])
                <p>{{ $home_page_product_section['title'][getAppLocale()] }}</p>
            @endisset

            @isset($home_page_product_section['sub_title'][getAppLocale()])
                <h2>{{ $home_page_product_section['sub_title'][getAppLocale()] }}</h2>
            @endisset
        </div>

        @if (isset($banners) && $banners->count() > 0)
            @php
                $firstBanner = $banners->first();
                $remainingBanners = $banners->skip(1);

                $allCategories = collect();

                foreach ($remainingBanners as $banner) {
                    if ($banner->categories && $banner->categories->count() > 0) {
                        $allCategories = $allCategories->merge($banner->categories);
                    }
                }

                if (isset($freeCategories) && $freeCategories->count() > 0) {
                    $allCategories = $allCategories->merge($freeCategories);
                }

                $allCategories = $allCategories->sortBy('created_at')->values();

                $bannerCol = $allCategories->count() === 1 ? 'col-md-8' : 'col-md-4';
            @endphp

            {{-- First Banner Full Width --}}
            @if ($firstBanner)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="banner-block banner-category-list position-relative"
                            style="background-image: url('{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $firstBanner->image) }}');">

                            <a href="{{ route('product.showOperatingRoomPage') }}"
                                class="banner-bg-link"
                                aria-label="Operating Room"
                                style="position:absolute; inset:0; z-index:1;"></a>

                            <div class="position-relative mx-sm-auto-custom banner-content"
                                style="z-index: 2; width: fit-content; height: fit-content;">

                                @if ($firstBanner->categories && $firstBanner->categories->count() > 0)
                                    <div class="categories-list-grid">
                                        @foreach ($firstBanner->categories as $category)
                                            <div class="member grid_cat category-item">
                                                <div class="member-info">
                                                    <h4 class="mb-0" style="font-size: 16px; line-height: 1.4;">
                                                        {{ $category->name }}
                                                    </h4>
                                                </div>

                                                <div class="gallery-details text-white text-center"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index:3;">
                                                    <div class="my-auto">
                                                        <a href="{{ route('product.category', ['category' => $category->slug]) }}"
                                                            class="category-link">
                                                            <h3 class="fs-16">{{ $category->name }}</h3>
                                                            <p class="fs-12 cat_desc">
                                                                {{ $category->short_description }}
                                                            </p>
                                                        </a>
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
            @endif

            {{-- Remaining Banners + Categories Cards --}}
            @if ($remainingBanners->count() > 0 || $allCategories->count() > 0)
                <div class="row mb-4">

                    @foreach ($remainingBanners as $banner)
                        <div class="{{ $bannerCol }} mb-3 d-flex align-items-stretch">
                            <div class="banner-block banner-category-list position-relative"
                                style="
                                    background-image: url('{{ assetUpload(\App\Models\Banner::DIR_UPLOADS . '/' . $banner->image) }}');
                                    width: 100%;
                                    height: 100%;
                                    min-height: 350px;
                                    background-size: cover;
                                    background-position: center;
                                    overflow: hidden;
                                ">

                                <a href="{{ route('product.showOperatingRoomPage') }}"
                                    class="banner-bg-link"
                                    aria-label="Banner"
                                    style="position:absolute; inset:0; z-index:1;"></a>

                                <div class="position-relative mx-sm-auto-custom banner-content"
                                    style="z-index: 2; width: fit-content; height: fit-content;">

                                    @if ($banner->categories && $banner->categories->count() > 0)
                                        <div class="categories-list-grid">
                                            @foreach ($banner->categories as $category)
                                                <div class="member grid_cat category-item">
                                                    <div class="member-info">
                                                        <h4 class="mb-0" style="font-size: 16px; line-height: 1.4;">
                                                            {{ $category->name }}
                                                        </h4>
                                                    </div>

                                                    <div class="gallery-details text-white text-center"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index:3;">
                                                        <div class="my-auto">
                                                            <a href="{{ route('product.category', ['category' => $category->slug]) }}"
                                                                class="category-link">
                                                                <h3 class="fs-16">{{ $category->name }}</h3>
                                                                <p class="fs-12 cat_desc">
                                                                    {{ $category->short_description }}
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($allCategories as $category)
                        @php $isBanner = $category->slug === 'surgical-instruments'; @endphp
                        <div class="{{ $isBanner ? 'col-md-8' : 'col-md-4' }} mb-3 d-flex align-items-stretch">
                            <div class="member"
                                style="min-height: 350px; width: 100%; position: relative; overflow: hidden;">
                                <div class="member-img" style="padding: unset; height: {{ $isBanner ? '400px' : '260px' }}; overflow: hidden;">
                                    @if ($category->image)
                                        <img src="{{ $category->image_url }}" class="img-fluid"
                                            alt="{{ $category->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>

                                <div class="member-info" style="min-height: 90px; padding: 20px;">
                                    <h4 class="font-size-product mb-0" style="font-size: 16px; line-height: 1.4;">
                                        {{ $category->name }}
                                    </h4>
                                </div>

                                <div class="gallery-details text-white text-center"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                    <div class="my-auto">
                                        <a href="{{ route('product.category', ['category' => $category->slug]) }}">
                                            <h3 class="fs-16 pb-3">{{ $category->name }}</h3>
                                            <p class="fs-14">{{ $category->short_description }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

        @elseif(isset($freeCategories) && $freeCategories->count() > 0)
            <div class="row mb-4">
                @foreach ($freeCategories as $category)
                    @php $isBanner = $category->slug === 'surgical-instruments'; @endphp
                    <div class="{{ $isBanner ? 'col-md-8' : 'col-md-4' }} mb-3 d-flex align-items-stretch">
                        <div class="member"
                            style="min-height: 350px; width: 100%; position: relative; overflow: hidden;">
                            <div class="member-img" style="padding: unset; height: {{ $isBanner ? '400px' : '260px' }}; overflow: hidden;">
                                @if ($category->image)
                                    <img src="{{ $category->image_url }}" class="img-fluid"
                                        alt="{{ $category->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>

                            <div class="member-info" style="min-height: 90px; padding: 20px;">
                                <h4 class="font-size-product mb-0" style="font-size: 16px; line-height: 1.4;">
                                    {{ $category->name }}
                                </h4>
                            </div>

                            <div class="gallery-details text-white text-center"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <div class="my-auto">
                                    <a href="{{ route('product.category', ['category' => $category->slug]) }}">
                                        <h3 class="fs-16 pb-3">{{ $category->name }}</h3>
                                        <p class="fs-14">{{ $category->short_description }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
<!-- End gallery Section -->