<section class="padding-y pb-4">
    <div class="container">

        <div class="d-md-flex d-block justify-content-between nav-pills-border position-relative mb-5">
            <ul class="nav nav-pills mb-3 d-block d-md-flex" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active position-relative text-center" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">{{ trans_module_product('app.like_products') }}</a>
                </li>
            </ul>
            <div class="d-md-block d-flex justify-content-between">
                <a href="javascript:;" id="prev-slide" class="btn btn-link text-A4A7AB"><i class="fal fa-chevron-left"></i> {{ trans_module_product('app.previous') }}</a>
                <a href="javascript:;" id="next-slide" class="btn btn-link text-A4A7AB">{{ trans_module_product('app.next') }} <i class="fal fa-chevron-right"></i></a>
            </div>
        </div>


        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                <div class="row row-sm owl-carousel slider-owl-carousel">
                    @foreach($productsRelated as $product)
                        <div class="item">
                            <div class="row m-0">
                                <div class="col-12">
                                    <div class="card card-sm card-product-grid">
                                        @if($product->discount_percentage>0)
                                            <span class="flag-discount"><i class="far fa-chart-line mr-2 transform-90deg "></i> %{{ $product->discount_percentage }}</span>
                                        @endif
                                        <a href="{{ route('product.details',['slug' => $product->slug]) }}" class="img-wrap"> <img src="{{$product->main_image_url}}"> </a>
                                        <figcaption class="info-wrap">
                                            <a href="{{ route('product.details',['slug' => $product->slug]) }}" class="title fw-semi-bold">{{$product->name}}</a>
                                            <div class="d-flex justify-content-between">
                                                @if($product->discount_percentage>0)
                                                    <div class="price mt-1 text-site color-red"><s>{{$product->show_price}}</s></div> <!-- price-wrap.// -->
                                                @endif
                                                <div class="price mt-1 text-site">{{$product->show_price_after_discount}}</div> <!-- price-wrap.// -->
                                            </div>
                                        </figcaption>
                                    </div>
                                </div> <!-- col.// -->
                            </div>
                        </div>
                    @endforeach
                </div> <!-- row.// -->
            </div>
        </div>
    </div>
</section>
