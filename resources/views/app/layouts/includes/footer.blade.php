<footer id="footer">
    <div class="container">
        <div class="row mt-5 justify-content-between">
            <div class="col-md-3 col-12 mb-4 mb-md-0 text-sm-center">
                <img class="footer-logo" src="{{ $data['footer_logo'] }}" alt="">
                <img class="footer-logo-two mx-sm-auto-custom" src="{{ asset('uploads/footer_logo_new.png') }}"
                    alt="">
            </div>
            <div class="col-md-2 col-12 mb-4 mb-md-0 text-sm-center">
                <h5>{{ trans('app.surgical_lights') }}</h5>
                <div class="row useful-links">
                    <ul class="col-12">
                        @foreach ($data['categoryFooter'] as $category)
                            <li><a href="{{ route('product.category', ['category' => $category->slug]) }}"
                                    class="text-9fa5a8-hover">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-12 mb-4 mb-md-0 text-sm-center">
                <h5>{{ trans_app('contact_us') }}</h5>
                <div class="row useful-links">
                    <ul class="col-12">
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-envelope fs-18"></i>
                            </div>
                            <a href="mailto:{{ $data['email'] }}" class="text-9fa5a8-hover">{{ $data['email'] }}</a>
                        </li>
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-map-marker fs-18"></i>
                            </div>
                            <a href="javascript:;" class="text-9fa5a8-hover">
                                {{ $data['address'] }}
                            </a>
                        </li>
                        <li class="data_link">
                            <div class="data_link_icon">
                                <i class="fa fa-phone fs-18"></i>
                            </div>
                            <a href="tel:{{ $data['phone'] }}" style="color: #fff" class="text-9fa5a8-hover">
                                {{ $data['phone'] }}
                            </a>
                        </li>
                        {{-- <table>
                                <tr>
                                    <td class="pr-2"><i class="fa fa-envelope fs-18"></i></td>
                                    <td class="pb-2"></td>
                                </tr>
                                <tr>
                                    <td class="pr-2"><i class="fa fa-map-marker fs-18"></i></td>
                                    <td class="pb-2" >
                                        <a href="javascript:;" class="text-9fa5a8-hover">
                                            {{ $data['address'] }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-2"><i class="fa fa-phone"></i></td>
                                    <td class="pb-2">
                                        <a href="tel:{{ $data['phone'] }}" style="color: #fff" class="text-9fa5a8-hover">
                                        {{ $data['phone'] }}
                                        </a>
                                    </td>
                                </tr>
                            </table> --}}
                        {{-- </li> --}}

                        <li>
                            <div class="social-links mx-auto mt-2">
                                @if ($data['facebook'])
                                    <a target="_blank" href="{{ $data['facebook'] }}" class="facebook mr-2 "><i
                                            class="fa fa-facebook text-white text-9fa5a8-hover fs-22"></i></a>
                                @endif
                                @if ($data['linkedin'])
                                    <a target="_blank" href="{{ $data['linkedin'] }}" class="linkedin mr-2"><i
                                            class="fa fa-linkedin text-white text-9fa5a8-hover fs-22"></i></a>
                                @endif
                                @if ($data['youtube'])
                                    <a target="_blank" href="{{ $data['youtube'] }}" class="linkedin mr-2"><i
                                            class="fa fa-youtube text-white text-9fa5a8-hover fs-22"></i></a>
                                @endif
                                {{--                                @if ($data['twitter']) --}}
                                {{--                                    <a target="_blank" href="{{ $data['twitter'] }}" class="twitter mr-2"><i class="fa fa-twitter text-white text-9fa5a8-hover fs-22"></i></a> --}}
                                {{--                                @endif --}}
                                @if ($data['instagram'])
                                    <a target="_blank" href="{{ $data['instagram'] }}" class="instagram mr-2"><i
                                            class="fa fa-instagram text-white text-9fa5a8-hover fs-22"></i></a>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <subscribe-email-component></subscribe-email-component>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="credits">{{ date('Y') }} &copy; {{ trans('app.ig_medical_all_rights_reserved') }}
            <a href="{{ route('page.index', ['page' => 'data-protection']) }}" style="color: #fff;"
                class="text-9fa5a8-hover">{{ trans('app.data_protection') }}</a>
            |
            <a href="{{ route('contact.index') }}" style="color: #fff;"
                class="text-9fa5a8-hover">{{ trans('app.contact') }}</a>
            |
            <a href="{{ route('page.index', ['page' => 'imprint']) }}" class="text-9fa5a8-hover"
                style="color: #fff;">{{ trans('app.imprint') }}</a>
            |
            <a href="{{ route('page.index', ['page' => 'conditions']) }}" class="text-9fa5a8-hover"
                style="color: #fff;">{{ trans('app.conditions') }}</a>
        </div>
    </div>
</footer>
