<style rel="stylesheet">
    .hide
    {
        display: none;
    }
    .show
    {
        display: block;
    }
    .header-info .setting ul.setting-option
    {
        background-color: white;
        color: #ce1126;
        list-style: none;
        padding: 10px 30px 10px 10px;
        right: 30px;
        top: 38px;
        position: absolute;
        z-index: 1;
        border-radius: 5px;
        border: 1px solid #dddddd;
    }
    .header-info .setting ul.setting-option li
    {
        border-bottom: 1px solid #dddddd;
        font-size: 17px;
        padding: 10px 30px 10px 5px;
        cursor: pointer;

    }
</style>
<div class="header-info" style="height: 40px;background-color: #354c5c;padding: 3px 30px;">
    @if( empty($bLogin) )
        <div class="signup" style="float: right;color: white">
            <button id="signup" type="button" class="btn btn-warning">Đăng ký</button>
        </div>
        <div class="login" style="float: right;color: white;margin-right: 10px;">
            <button id="login" type="button" class="btn btn-warning">Đăng nhập</button>
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
                <li>
                    <i class="fa fa-diamond" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 10px"></i>
                    AdminCP
                </li>
                <li>
                    <i class="fa fa-user" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 10px"></i>
                    Vào trang cá nhân
                </li>
                <li id="logout" style="border-bottom: none !important;">
                    <i class="fa fa-sign-out" aria-hidden="true" style="color: yellowgreen; font-size: 20px;margin-right: 6px"></i>
                    Đăng xuất
                </li>
            </ul>
        </div>
    @endif
</div>
<div class="header-introduction" style="height: 150px;padding: 15px 0;background-color: #B2CFEA">
    <div class="col-md-4 col-md-offset-1" style="float: left">
        <div class="introduction" style="text-align: center;line-height: 8">
            <marquee></marquee>


        </div>

    </div>
    <div class="col-md-3 col-md-offset-3"   >
        <div class="logo">
            {{--<img src="{{ asset('images/header_logo.jpg') }}" style="height: 120px;width: 100%">--}}
        </div>
    </div>
</div>
<script type="text/javascript">
   var login = "{{ asset('login') }}";
    var logout = "{{ asset('logout') }}";
    var signup= "{{ asset('signup') }}";
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#logout').click(function(){
            console.log(logout);

            window.location.href=logout;
        });
        $('#login').click(function(){

            window.location.href=login;
        });
        $('#signup').click(function(){

            window.location.href=signup;

        });
        $('.setting-button').click(function(){
            $('.setting-option').toggleClass('hide');
        });
    });
</script>