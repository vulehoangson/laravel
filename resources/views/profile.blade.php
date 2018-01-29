@extends('layout')

@section('title','Vũ Lê Hoàng Sơn')

@section('content')
<style rel="stylesheet">
    .profile a
    {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .profile i
    {
        color: coral;
        margin-right: 10px;

    }
</style>
<div class="profile col-md-12" style="margin-bottom: 60px;">

    <div class="cover-photo" style="position: relative;height: 450px;overflow: hidden;text-decoration: none; @if(empty($aFrontend['aUser']['cover_photo'])) background-color: #1d2129; @endif ">
        @if(!empty($aFrontend['aUser']['cover_photo']))
            <img src="{{asset($aFrontend['aUser']['cover_photo'])}}" style="min-height: 100%;min-width: 100%;position: absolute;left: 0;top: 0;width: 100%;image-rendering: auto;">
        @endif
    </div>

    <div class="avatar" style="position: absolute; width: 160px; height: 160px;background: #ffffff;z-index: 4;top: 290px;;left: 50px;">
        <img src="@if(!empty($aFrontend['aUser']['avatar'])){{asset($aFrontend['aUser']['avatar'])}} @else{{ asset('images/default_avatar.jpg') }} @endif" style="width:100%;height:100%;">
    </div>


    <div class="user-info col-md-12 col-sm-12" style="padding-left: 0; padding-right: 0;margin-top: 15px;">
        @if(!empty($aFrontend['aUser']['full_name']))
        <div class="full-name" style="font-size: 25px;margin-top: 15px;">
            <i class="fa fa-user" aria-hidden="true" ></i>
            <span style="font-weight: 400;letter-spacing: 1px;padding: 0;">
                {{ $aFrontend['aUser']['full_name'] }}
                </a>
            </span>
        </div>
        @endif
        @if(!empty($aFrontend['aUser']['full_name']))
            <div class="phone" style="font-size: 25px;margin-top: 15px;">
                <i class="fa fa-mobile" aria-hidden="true"></i>
            <span style="font-weight: 400;letter-spacing: 1px;padding: 0;">
                {{ $aFrontend['aUser']['phone'] }}
                </a>
            </span>
            </div>
        @endif
        @if(!empty($aFrontend['aUser']['full_name']))
            <div class="address" style="font-size: 25px;margin-top: 15px;">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span style="font-weight: 400;letter-spacing: 1px;padding: 0;">
                    {{ $aFrontend['aUser']['address'] }}
                    </a>
                </span>
            </div>
        @endif
        <div class="map col-md-12 col-sm-12" style="height: 400px;" id="vietbando-profile">

        </div>
    </div>

</div>
<script type="text/javascript" src="https://developers.vietbando.com/V2/Scripts/VietbandoMapsAPI.js?key=a4421f51-dabb-45b5-aa92-d361989037fc"></script>
<script type="text/javascript">
    var lat = parseFloat("{{ $aFrontend['aCoordinate'][0] }}");
    var lng = parseFloat("{{ $aFrontend['aCoordinate'][1] }}");
    var find_address = "{{ $aFrontend['aUser']['address'] }}";
    var find_phone = "{{ $aFrontend['aUser']['phone'] }}";
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var mapProp = {
            center: new vbd.LatLng(lat, lng),
            zoom: 15,
            /*Nếu layer == null là lấy layer mặc định. Nếu layer là [layer1,layer2,.....] khởi động map với nhiều layer*/
            layer:null
        };

        /*Tạo map*/
        var map = new vbd.Map(document.getElementById("vietbando-profile"), mapProp);
        /*var icon=new vbd.Icon();
         icon.url='/images/marker.png';
         icon.size=new vbd.Size(30,40);*/
        var options=new vbd.MarkerOptions();
        options.position = new vbd.LatLng(lat, lng);
        /*options.icon = icon;*/
        var marker=new vbd.Marker(options);
        marker.setMap(map);
        var content = '<div class="MiniPopup"><p class="Content"> <span class="address"><i class="fa fa-home" style="font-size:14px;margin-right: 5px;"></i>' + find_address + '</span> <span class="phone"><i class="fa fa-phone" style="font-size:13px;margin-right: 7px;"></i>' + find_phone + '</span></p> </div>'
        var infowindow = new vbd.InfoWindow();
        infowindow.setContent(content);
        infowindow.open(map, marker);
        vbd.event.addListener(marker, 'click', function (param) {
            infowindow.open(map, marker);
        });

        // stop video playing when click next or pre slide
        $('#myCarousel').on('slide.bs.carousel', function () {
            document.getElementById('video').pause();
        });
    });
</script>
@endsection