<header id="contactUsHeader" class="d-flex align-items-center ">
    <div class="container d-md-flex d-block align-items-center justify-content-between">
        <div class="d-md-block d-none justify-content-between">
            <p class="mb-0">{{ $data['welcome_text'] }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ $data['global_website'] }}" style="color: #fff;" target="_blank"><p class="mb-0 pr-3 d-md-block d-none text-9fa5a8-hover">{{ trans('app.global_website') }}</p></a>
            <div class="pr-3 d-md-block d-none">
                <a href="tel:{{ $data['phone'] }}" class="text-9fa5a8-hover" style="color: #fff">
                    <i class="fa fa-phone"></i> <span class="d-rtl fs-14">{{ $data['phone'] }}</span>
                </a>
            </div>
            <div class="pr-3 d-md-block d-none">
                <a href="mailto:{{ $data['email'] }}" class="text-9fa5a8-hover" style="color: #fff">
                <i class="fa fa-envelope"></i> <span class="fs-14">{{ $data['email'] }}</span>
                </a>
            </div>
            <div class="social-links mx-auto">
                @if($data['facebook'])
                    <a target="_blank" href="{{ $data['facebook'] }}" class="facebook pr-3"><i class="fa fa-facebook text-white text-9fa5a8-hover"></i></a>
                @endif
                @if($data['linkedin'])
                    <a target="_blank" href="{{$data['linkedin']}}" class="linkedin pr-3"><i class="fa fa-linkedin text-white text-9fa5a8-hover"></i></a>
                @endif
{{--                @if($data['twitter'])--}}
{{--                    <a target="_blank" href="{{$data['twitter']}}" class="twitter pr-3"><i class="fa fa-twitter text-white text-9fa5a8-hover"></i></a>--}}
{{--                @endif--}}
                @if($data['youtube'])
                    <a target="_blank" href="{{$data['youtube']}}" class="instagram pr-3"><i class="fa fa-youtube text-white text-9fa5a8-hover"></i></a>
                @endif
                    @if($data['instagram'])
                    <a target="_blank" href="{{$data['instagram']}}" class="instagram pr-3"><i class="fa fa-instagram text-white text-9fa5a8-hover"></i></a>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center  header-transparent ">
    <ul class="container d-flex align-items-center">

        <div class="logo">
            <h1 class="text-light">
                <a href="{{ url('/') }}">
                    <img class="d-md-inline " src="{{ $data['header_logo'] }}" alt="">
                </a>
            </h1>
        </div>

        <nav class="nav-menu d-none d-lg-block ">
            <ul>
                <li class="{{ request()->path() === getAppLocale() || request()->path() === getAppLocale() . '/' ? 'active' : '' }}">
                    <a href="{{ url_lang('/') }}">{{ trans('app.home') }}</a>
                </li>

                {{-- Operating Room --}}
                @if(isset($data['categoryHeader2']) && $data['categoryHeader2']->count() > 0)
                    <li class="{{ isset($breadcrumbsOperatingRoom) ? 'active' : '' }} dropdown dropdown-with-hover">
                        <a href="{{ route('product.showOperatingRoomPage') }}" class="dropdown-toggle" id="dropdownMenuButtonOR" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('app.operating_room') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonOR">
                            @foreach($data['categoryHeader2'] as $cat)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="{{ route('product.category', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                                    @if($cat->products && $cat->products->count() > 0)
                                        <ul class="dropdown-menu">
                                            @foreach($cat->products as $p)
                                                <li><a class="dropdown-item" href="{{ route('product.details', ['slug' => $p->slug]) }}">{{ $p->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                {{-- Products --}}
                @if(isset($data['categoryHeader1']) && $data['categoryHeader1']->count() > 0)
                    <li class="{{ isset($breadcrumbsProducts) ? 'active' : '' }} dropdown dropdown-with-hover">
                        <a href="{{ route('product.showProductsPage') }}" class="dropdown-toggle" id="dropdownMenuButtonProd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('app.products') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonProd">
                            @foreach($data['categoryHeader1'] as $cat)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="{{ route('product.category', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                                    @if($cat->products && $cat->products->count() > 0)
                                        <ul class="dropdown-menu">
                                            @foreach($cat->products as $p)
                                                <li><a class="dropdown-item" href="{{ route('product.details', ['slug' => $p->slug]) }}">{{ $p->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                {{-- Company --}}
                <li class="{{ in_array(get_last_segments(), ['about-us', 'distributors', 'jobs', 'r-and-d', 'qm', 'certifications']) ? 'active' : '' }} dropdown dropdown-with-hover">
                    <a href="{{ route_app('home.about_us') }}" class="dropdown-toggle" id="dropdownMenuButtonCompany" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('app.company') }}</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonCompany">
                        <li><a class="dropdown-item" href="{{ route_app('home.about_us') }}">{{ trans('app.about_us') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('distributor.index') }}">{{ trans('app.ig_world_wide') }}</a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="{{ route_app('home.certification') }}">{{ trans('app.quality') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('page.index', ['page' => 'r-and-d']) }}">{{ trans('app.r_and_d') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('page.index', ['page' => 'qm']) }}">{{ trans('app.qm') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route_app('home.certification') }}">{{ trans('app.certifications') }}</a></li>
                            </ul>
                        </li>
                        <li><a class="dropdown-item" href="{{ route_app('job.index') }}">{{ trans('app.careers') }}</a></li>
                    </ul>
                </li>

                {{-- News --}}
                <li class="{{ get_last_segments() === 'news' ? 'active' : '' }}"><a href="{{ route('news.index') }}">{{ trans('app.news') }}</a></li>

                {{-- Contact --}}
                <li class="{{ in_array(get_last_segments(), ['sales', 'technical', 'contact-us']) ? 'active' : '' }} dropdown dropdown-with-hover">
                    <a href="javascript:;" class="dropdown-toggle" id="dropdownMenuButtonContact" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('app.contact') }}</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonContact">
                        <li><a class="dropdown-item" href="{{ route('page.index', ['page' => 'sales']) }}">{{ trans('app.sales') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('page.index', ['page' => 'technical']) }}">{{ trans('app.technical_service') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('contact.index') }}">{{ trans('app.contact_us') }}</a></li>
                    </ul>
                </li>
                
                {{-- Language Switcher (always at the end) --}}
                <li class="dropdown ">
                    <a href="javascript:;" class="dropdown-toggle" id="dropdownMenuButtonLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset_app('img/'.getAppLocale().'.png') }}" class="d-inline" alt=""></a>
                    <ul class="dropdown-menu" style="min-width: 9rem;" aria-labelledby="dropdownMenuButtonLang">
                        @foreach(languages() as $key => $value)
                            <a class="dropdown-item {{$key===getAppLocale() ? 'selected' : ''}}" href="{{ route('change.language',['locale' => $key]) }}" style="margin-left:0!important;">{{$value}}</a>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
    </ul>
</header>

