<div class="header-info" style="height: 40px;background-color: #354c5c;padding: 3px 30px;">
    <input type="hidden" id="login_url" value="{{ asset('login') }}">
    <input type="hidden" id="signup_url" value="{{ asset('signup') }}">
    <input type="hidden" id="changelanguage_url" value="{{ asset('changelanguage') }}">
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
    @if( empty($bLogin) )
        <div class="signup" style="float: right;color: white">
            <button id="signup" type="button" class="btn btn-warning">@lang('phrases.signup')</button>
        </div>
        <div class="login" style="float: right;color: white;margin-right: 10px;">
            <button id="login" type="button" class="btn btn-warning">@lang('phrases.signin')</button>
        </div>
    @else
        <div class="avatar" style="background-color: white;float: right">
            <a href="{{ (!empty($_SESSION['user_id']) ? url('profile/'.$_SESSION['user_id'] ) : (!empty($_COOKIE['user_id']) ? url('profile/'.$_COOKIE['user_id'] ) : 'javascript:void(0)') )}}">
                <img src="{{ asset('images/header_logo.jpg') }}" style="height: 34px;width: 40px" title="Trang cá nhân">
            </a>

        </div>
        <div class="setting" style="float: right; color: white; padding: 6px 10px;background-color: white;border-radius: 5px;margin-right: 5px;">
            <a href="javascript:void(0)" class="setting-button">
                <i class="fa fa-cog" aria-hidden="true" style="color: #ce1126; font-size: 20px;"></i>
            </a>
            <ul class="setting-option hide" >
                @if((int)$iUserGroup === 1 || (int)$iUserGroup === 2 )
                <li>
                    <a href="{{ asset('admincp') }}">
                        <i class="fa fa-diamond" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 10px"></i>
                        @lang('phrases.admincp')
                    </a>

                </li>
                @endif
                <li>
                    <a href="{{ (!empty($_SESSION['user_id']) ? url('profile/'.$_SESSION['user_id'] ) : (!empty($_COOKIE['user_id']) ? url('profile/'.$_COOKIE['user_id'] ) : 'javascript:void(0)') )}}">
                        <i class="fa fa-user" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 10px"></i>
                        @lang('phrases.gotoprofile')
                    </a>

                </li>
                <li>
                    <a href="{{ asset('upload') }}" >
                        <i class="fa fa-plus" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 10px"></i>
                        @lang('phrases.create_topic')
                    </a>

                </li>
                <li style="border-bottom: none !important;">
                    <a href="{{ asset('logout') }}">
                        <i class="fa fa-sign-out" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 6px"></i>
                        @lang('phrases.signout')
                    </a>

                </li>
            </ul>
        </div>
    @endif
    <div class="language" style="float: right; font-size: 13px;margin-right: 20px;margin-top: 1px;">
        <div style="display: inline-block;margin-left: 5px">
            <img src="{{ asset('images/vietnam.png') }}" title="@lang('phrases.vietnamese')">
            <a class="change-language" data-language="vi" style="text-decoration: none;color: #fff;cursor: pointer;">@lang('phrases.vietnamese')</a>
        </div>
        <div style="display: inline-block; margin-left: 5px">
            <img src="{{ asset('images/england.png') }}" title="@lang('phrases.english')">
            <a class="change-language" data-language="en" style="text-decoration: none;color: #fff;cursor: pointer;">@lang('phrases.english')</a>
        </div>
    </div>
</div>
<div class="header-introduction" style="height: 110px;padding: 15px 0;background-color: #B2CFEA">
    <div class="col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-0" style="float: left;">
        <div class="introduction" style="text-align: center;line-height: 4;">
            <marquee>@lang('phrases.website_title')</marquee>
        </div>

    </div>
    <div class="col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-2"   >
        <div class="logo">
            <a href="{{ asset('') }}">
                <img src="{{ asset('images/logo.gif') }}" style="height: 80px;width: 100%">
            </a>

        </div>
    </div>
</div>
