
<div class="header-info" style="height: 40px;background-color: #354c5c;padding: 3px 30px;">
    @if( empty($_COOKIE['login']) )
        <div class="login" style="float: right;color: white">
            <button id="signup" type="button" class="btn btn-warning">Đăng ký</button>
        </div>
        <div class="login" style="float: right;color: white;margin-right: 10px;">
            <button id="login" type="button" class="btn btn-warning">Đăng nhập</button>
        </div>
    @else
        <div class="login" style="float: right;color: white">
            <button id="logout" type="button" class="btn btn-success">Đăng xuất</button>
        </div>
    @endif
</div>
<div class="header-introduction" style="height: 150px;padding: 15px 0;background-color: #B2CFEA">
    <div class="col-md-4 col-md-offset-1" style="float: left">
        <div class="introduction" style="text-align: center;line-height: 8">
            <marquee>Đây là website được thiết kế với mục đích rèn luyện kĩ năng lập trình với HTML/CSS & PHP/Laravel. Học hỏi thêm kiến thức từ những công nghệ mới và PHP Framework mới để có thể tự tạo ra một website.</marquee>


        </div>

    </div>
    <div class="col-md-3 col-md-offset-3"   >
        <div class="logo">
            <img src="{{ asset('images/header_logo.jpg') }}" style="height: 120px;width: 100%">
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#logout').click(function(){
            $.get('logout',function(response){
               console.log(response);
                if(response)
                {
                    window.location.href=response;
                }

            });
        });
        $('#login').click(function(){
            $.get('redirectlogin',function(response){
                    if(response)
                    {
                        window.location.href=response;
                    }
            });
        });
        $('#signup').click(function(){
            $.get('redirectsignup',function(response){
                if(response)
                {
                    window.location.href=response;
                }
            });
        });
    });
</script>