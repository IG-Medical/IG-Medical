<!DOCTYPE html>
<html>
<head>
    <title>@stack('page-title')</title>
    @stack('css')
</head>
<body>
<img src="{{ isset($logo) ? $logo : getLogo() }}" style="width: 10em;">

<div style="border: 1px solid #ccc!important;
    padding: 1em;
    margin-top: 1em;
    width: 100%;
    border-radius: 15px;">

    <h2 style="color: #3E91D7">@stack('page-title')</h2>
    <p>@lang('app.hello'):
        @php
        if(isset($user)) {
            if(isset($user->full_name))
                echo $user->full_name;
            elseif(isset($data['user']->full_name))
              echo  $data['user']->full_name;
            else
              echo  $user;
        }
        @endphp
    </p>
    @yield('content')
    <p>@lang('app.if_you_have_questions_about_your_account')
        <a href="{{ url('/')}}">{{ app_name() }}</a>
        @lang('app.and')
        <a href="{{ route('contact.index') }}">@lang('app.contact_us')</a>.
    </p>

    <p>@lang('app.kind_regard'),</p>
    <p>@lang('app.app_team')</p>
</div>
<p>@lang('app.please_dont_reply_to_this_email')</p>
</body>
</html>
