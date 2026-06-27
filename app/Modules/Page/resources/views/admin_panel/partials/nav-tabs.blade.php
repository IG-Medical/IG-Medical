<ul class="nav nav-tabs  m-tabs-line" role="tablist">
    @foreach(languages() as $key => $value)
        <li class="nav-item m-tabs__item">
            <a class="nav-link m-tabs__link {{ $key == getAppLocale() ? 'active' : '' }}" data-toggle="tab" href="#m_tabs_{{ $key }}" role="tab">{{ $value }}</a>
        </li>
    @endforeach
</ul>
