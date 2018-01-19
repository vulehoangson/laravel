@extends('layout')

@section('title','Tạo bài đăng')

@section('content')
    <style rel="stylesheet">
        .container
        {
            padding: 0 !important;
            margin-left: unset !important;
            width: 100% ;
            background-color: #f4f4f4;
        }
        .topic-detail
        {
            background-color: #fff;
            padding: 15px 0 35px 0;
            margin-right: auto;
            margin-left: auto;

        }


        @media (min-width: 768px)
        {
            .topic-detail {
                width: 750px;
            }
            .carousel-indicators {
                bottom: 0px;
            }
        }
        @media (min-width: 992px)
        {
            .topic-detail {
                width: 970px;
            }
        }
        @media (min-width: 1200px)
        {
            .topic-detail {
                width: 1170px;
            }
        }
        .topic-detail:after
        {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        @media (max-width: 1024px)
        {
            .topic-detail #myCarousel .carousel-inner .item video
            {
                margin-top: 19% !important;
            }
        }
        @media (max-width: 992px)
        {
            .topic-detail #myCarousel .carousel-inner
            {
                height: 350px !important;
            }
            .topic-detail #myCarousel .carousel-inner
            {
                padding: 0 50px !important;
            }
        }

    </style>
    <div class="topic-detail">
        <div id="myCarousel" class="carousel slide col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-18 " data-ride="carousel" style="background-color: #555;">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner col-sm-12" style="width: 100%;height: 500px;padding: 0 100px">
                <div class="item active col-sm-12" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset('storage/files/qVizUtGnhOvSaVieT6XozeA8WeNdlXBYAqDQBUCM.png') }}')">

                </div>
                <div class="item col-sm-12" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset('storage/files/98f7a94f53772dfcd2939d2a8b309eaa.jpg') }}')">

                </div>
                <div class="item col-sm-12" >
                    <video controls="controls" autoplay style=" width:100%; margin-top: 9%;">
                        <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
                        <source src="{{ asset('storage/files/Z8oqd0220DbrFokvFpDi7T5HJyYNgQfCcOQVeop9.mp4') }}" type="video/mp4">
                    </video>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="detail col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-18" style="padding-left: 0; padding-right: 0; word-wrap: break-word; word-break: keep-all">
           <div class="title col-md-12 col-sm-12" style="color: #ce1126; margin-bottom: 5px;padding-left: 0; padding-right: 0; ">
               <h2 style="font-weight: bold">aaaaaaaaaaaaaaaaa</h2>
           </div>
            <div class="contact col-md-12 col-sm-12" style="margin-bottom: 15px;padding-left: 0; padding-right: 0; font-size: 16px;color: darkslategrey;">
                <span class="price">
                    <i class="fa fa-money" aria-hidden="true" style="font-weight: bold;"></i>
                    <span style="margin-left: 10px">250.000</span>
                </span>
                <span class="phone" style="margin-left: 25px;">
                    <i class="fa fa-phone" aria-hidden="true" style="font-weight: bold;"></i>
                    <span style="margin-left: 5px">0933640651</span>
                </span>
            </div>
            <div class="description col-md-12 col-sm-12" style="margin-bottom: 15px;padding-left: 0; padding-right: 0; font-size: 24px;color: darkslategrey;word-wrap: break-word; word-break: keep-all">
asfffffffffffffffffffffffffffffffffffffffffffff
            </div>

            <div class="address col-md-12 col-sm-12" style="margin-bottom: 15px; padding-left: 0; padding-right: 0; font-size: 18px;color: darkslategrey;">
                <i class="fa fa-map-marker" aria-hidden="true" style="font-weight: bold;"></i>
                <span style="margin-left: 10px">1953/3/2 Phạm Thế Hiển P6 Q8 TPHCM</span>
            </div>

            <div class="map col-md-12 col-sm-12" style="height: 400px;" id="vietbando">

            </div>
        </div>
    </div>


<script type="text/javascript" src="https://developers.vietbando.com/V2/Scripts/VietbandoMapsAPI.js?key=a4421f51-dabb-45b5-aa92-d361989037fc"></script>
<script type="text/javascript">
    var lat = parseFloat("{{ $aFrontend['Coordinate'][0] }}");
    var lng = parseFloat("{{ $aFrontend['Coordinate'][1] }}");
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var mapProp = {
            center: new vbd.LatLng(lat, lng),
            zoom: 17,
            /*Nếu layer == null là lấy layer mặc định. Nếu layer là [layer1,layer2,.....] khởi động map với nhiều layer*/
            layer:null
        };

        /*Tạo map*/
        var map = new vbd.Map(document.getElementById("vietbando"), mapProp);
        /*var icon=new vbd.Icon();
        icon.url='/images/marker.png';
        icon.size=new vbd.Size(30,40);*/
        var options=new vbd.MarkerOptions();
        options.position = new vbd.LatLng(lat, lng);
        /*options.icon = icon;*/
        var marker=new vbd.Marker(options);
        marker.setMap(map);
    });
</script>
@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}