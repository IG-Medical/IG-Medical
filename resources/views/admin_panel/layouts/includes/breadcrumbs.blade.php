@if(meta('breadcrumbs-title') || meta('breadcrumbs'))
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            @if(meta('breadcrumbs-title'))
            <h3 class="m-subheader__title">{{ meta('breadcrumbs-title') }}</h3>
            @endif
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{ route_admin('dashboard.index') }}" class="m-nav__link m-nav__link--icon"><i class="m-nav__link-icon la la-home"></i></a>
                </li>
                @if(meta('breadcrumbs'))
                    @foreach(meta('breadcrumbs') as $route_name => $title)
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <a href="{{ $route_name ? $route_name : '#' }}" class="m-nav__link">
                                <span class="m-nav__link-text">{{ $title }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        @stack('breadcrumbs-right')
    </div>
</div>
<!-- END: Subheader -->
@endif
