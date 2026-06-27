<div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
        <div class="m-portlet__body">
            <div class="m-card-profile">
                <div class="m-card-profile__title m--hide">Your Profile</div>
                <div class="m-card-profile__pic">
                    <div class="m-card-profile__pic-wrapper"><img src="{{ user()->image300 }}" alt="" /></div>
                </div>
                <div class="m-card-profile__details">
                    <span class="m-card-profile__name">{{ user()->full_name }}</span>
                    <a href="mailto:{{ user()->email }}" class="m-card-profile__email m-link">{{ user()->email }}</a>
                </div>
            </div>
            <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                <li class="m-nav__separator m-nav__separator--fit"></li>
                <li class="m-nav__section m--hide"><span class="m-nav__section-text">Section</span></li>
                <li class="m-nav__item">
                    <a href="{{ route_admin('my_profile.index',['page' => 'basic-info']) }}" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-profile-1"></i>
                        <span class="m-nav__link-title">
                            <span class="m-nav__link-wrap">
                                <span class="m-nav__link-text">{{ trans_admin('basic_info') }}</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li class="m-nav__item">
                    <a href="{{ route_admin('my_profile.index',['page' => 'change-password']) }}" class="m-nav__link">
                        <i class="m-nav__link-icon flaticon-lock"></i>
                        <span class="m-nav__link-text">{{ trans_admin('change_password') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
