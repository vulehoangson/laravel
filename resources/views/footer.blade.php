<style rel="stylesheet">

        @media (max-width: 992px)
        {

            .footer-info .contact-us .address .info
            {
                padding-top: 0 !important;
            }
            .footer-info  .about-us div:first-child
            {
                margin-bottom: 5px !important;
            }
        }


</style>

<div class="footer-info" style="height: 220px;background-color: #354c5c;padding: 30px 0;">
    {{--<div class="logo col-md-3 col-sm-3">
        <img src="{{ asset('images/footer_logo.jpg') }}" style="height: 120px;width: 100%">
    </div>--}}
    <div class="contact-us col-md-6 col-sm-6">
        <div class="address col-md-12 col-sm-12" style="margin-bottom: 20px">
            <div class="icon col-md-2 col-sm-2" style="background-color: #757575; width: 40px;height: 40px;border-radius: 50%;padding-left: 14px;padding-top: 9px;">
                <i class="fa fa-map-marker" aria-hidden="true" style="color: white;font-size: 22px"></i>
            </div>
            <div class="info col-md-10 col-sm-10" style="color: white;padding-top: 9px;font-size: 16px;word-break: keep-all">
                @lang('phrases.admin_address')
            </div>
        </div>

        <div class="phone col-md-12 col-sm-12" style="margin-bottom: 20px">
            <div class="icon col-md-2 col-sm-2" style="background-color: #757575; width: 40px;height: 40px;border-radius: 50%;padding-left: 14px;padding-top: 10px;">
                <i class="fa fa-phone" aria-hidden="true" style="color: white;font-size: 21px"></i>
            </div>
            <div class="info col-md-10 col-sm-10" style="color: white;padding-top: 9px;font-size: 16px;word-break: keep-all">
                @lang('phrases.admin_phone')
            </div>
        </div>

        <div class="email col-md-12 col-sm-12" >
            <div class="icon col-md-2 col-sm-2" style="background-color: #757575; width: 40px;height: 40px;border-radius: 50%;padding-left: 13px;padding-top: 10px;">
                <i class="fa fa-envelope" aria-hidden="true" style="color: white;font-size: 17px"></i>
            </div>
            <div class="info col-md-10 col-sm-10" style="color: white;padding-top: 9px;font-size: 16px;color: #2ab27b; font-weight: bold;word-break: keep-all">
                @lang('phrases.admin_email')
            </div>
        </div>
    </div>

    <div class="about-us col-md-6 col-sm-6">
        <div style="font-size: 16px;font-weight: bold;color: white;margin-bottom: 20px">
            @lang('phrases.about_me_title')
        </div>
        <div class="content" style="word-break: keep-all;color: #dddddd">
            @lang('phrases.about_me_content')
        </div>
    </div>
</div>

