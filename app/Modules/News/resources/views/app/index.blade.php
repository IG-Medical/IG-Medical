@extends('app.layouts.app')

@push('page-title',$pageTitle)


@section('content')
    <main id="main">

        @include('app.layouts.includes.breadcrumbs',['breadcrumb_image'=> $breadcrumb])
        <news-index v-cloak inline-template>
            <section class="lastNews gallery mt-5">
                <div class="container">
                    <div class="section-title d-flex flex-column">
                        <p class="special-border-bottom mx-w-500 mx-auto">{{ trans_module_news('app.news') }}</p>
                        <h2 class="fs-14 text-MontserratMedium fs-14 ">
{{--                           {{ trans_module_news('app.lorm_news') }}--}}
                        </h2>
                    </div>

                    <div class="row">
                        <div v-for="(n,index) in news" class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="member aos-init aos-animate" data-aos="fade-up">
                                <div class="member-img p-0 max-h-245">
                                    <a :href="`{{route('news.index')}}/${n.slug}`">
                                    <img :src="n.image_url" class="img-fluid max-h-unset" alt="">
                                    </a>
                                </div>
                                <div class="member-info border-0">
                                    <a :href="`{{route('news.index')}}/${n.slug}`">
                                        <h4 class="font-size-20 line-1-ellipsis">@{{ n.title }}</h4>
                                    </a>
                                    <p class="text-muted">@{{ n.date }}</p>
                                    <span class="details line-4-ellipsis">
                                        <template v-if="n.short_content.length>165">
                                            <div v-html="n.short_content.substring(0,165)"></div>
                                        </template>
                                         <template v-else>
                                            <div v-html="n.short_content"></div>
                                        </template>
                                </span>
                                    <p class="d-flex justify-content-between mb-0 pt-3">
                                        <a class="text-1492E6" :href="`{{route('news.index')}}/${n.slug}`">{{ trans_module_news('app.read_more') }}</a>
                                        <a class="text-1492E6"  :href="`{{route('news.index')}}/${n.slug}`"><i class="ri-arrow-right-line"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5 pb-5 justify-content-center">
                        <nav aria-label="Page navigation example">
                            <paginate ref="paginateTable"
                                      v-if="page.totalPages>1"
                                      :prev-text="'«'"
                                      :next-text="'»'"
                                      :page-count="page.totalPages"
                                      :click-handler="nextPage"
                                      :container-class="'pagination justify-content-end'"
                                      :page-class="'page-item'"
                                      :page-link-class="'page-link'"
                                      :prev-class="'page-item'"
                                      :next-class="'page-item'"
                                      :prev-link-class="'page-link'"
                                      :next-link-class="'page-link'">
                            </paginate>
                        </nav>
                    </div>
                </div>
            </section>
        </news-index>
    </main><!-- End #main -->
@endsection

@php $is_module = true; @endphp
@push('js_module')
    <script src="{{ asset('js/app/news.js') }}"></script>
@endpush
