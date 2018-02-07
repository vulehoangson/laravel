@extends('layout')

@section('title',$aFrontend['aTopic']['title'])

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
            margin-bottom: 30px;

        }
        .related-topic
        {
            background-color: #fff;
            padding: 15px 0 35px 0;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 30px;
        }

        @media (min-width: 768px)
        {
            .topic-detail,
            .related-topic
            {
                width: 750px;
            }
            .carousel-indicators {
                bottom: 0px;
            }
        }
        @media (min-width: 992px)
        {
            .topic-detail,
            .related-topic
            {
                width: 970px;
            }
        }
        @media (min-width: 1200px)
        {
            .topic-detail,
            .related-topic
            {
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
        .related-topic:after
        {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
        .topic-detail #myCarousel .carousel-inner .item video
        {
            width:100%;
            margin-top: 9%;
        }

        @media (max-width: 1024px)
        {
            .topic-detail #myCarousel .carousel-inner .item video
            {
                margin-top: 19%;
            }
        }
        @media (max-width: 992px)
        {
            .topic-detail #myCarousel .carousel-inner
            {
                height: 350px !important;
                padding: 0 50px !important;
            }
            .topic-detail #myCarousel .carousel-inner .item video
            {
                margin-top: 9%;
            }
        }
        .MiniPopup
        {
            color: #333333;
            float: left;
            line-height: 18px;
            width: 300px;
        }
        .MiniPopup .Title {
            float: left;
            font-size: 15px;
            font-weight: bold;
            margin-left: 18px;
        }
        .MiniPopup p {
            float: left;
            font-size: 13px;
            line-height: 15px;
            margin: 7px 0 0;
            padding: 0 0 5px;
        }
        .MiniPopup .Content .address {
            display: block;
            margin-bottom: 8px;
            padding-left: 18px;
        }
        .MiniPopup .Content .phone {
            display: inline-block;
            margin-bottom: 10px;
            padding-left: 18px;
        }
        .MiniPopup a:hover
        {
            color: #297fc7 !important;

        }
        .topic-detail .title
        {
            padding-bottom: 5px;
            border-bottom: 1px solid #dddddd;
            margin-bottom: 30px;
            padding-left: 15px;
        }
        .topic-detail .title h2
        {
            margin-top: 0;
        }

        .related-topic .title
        {
            padding-bottom: 5px;
            border-bottom: 1px solid #dddddd;
            margin-bottom: 30px;
            padding-left: 15px;
        }
        .related-topic .title h2
        {
            margin-top: 0;
        }
        .carousel-control
        {
            width: 10%;
        }
        .topic-detail .detail .time .edit-button
        {
            width: 45px;
            height: 40px;
            background: #e6e6e6;
            cursor: pointer;
        }
        .topic-detail .detail .time .edit-button:before
        {
            transform: translate(0, 0);
            text-indent: 0 !important;
            content: '\f044';
            font-size: 20px;
            color: #626262;
            position: absolute;
            padding: 0;
            line-height: 40px;
            text-align: center;
            font-family: "FontAwesome";
            font-style: normal;
            font-weight: normal;
            text-rendering: auto;
        }
    </style>

    <div class="topic-detail">
        <div class="title">
            <h2>Chi Tiết Sản Phẩm</h2>
        </div>
        @if( !empty($aFrontend['aTopic']['attachment']))
        <div id="myCarousel" class="carousel slide col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-18 " data-interval="false" data-ride="carousel" style="background-color: #555;">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner col-sm-12" style="width: 100%;height: 500px;padding: 0 100px">
                @foreach($aFrontend['aTopic']['attachment'] as $iKey => $value)
                    @if(file_exists(public_path().'/'.$value['path']))
                        @if($value['type'] != 'mp4')
                            <div class="item @if( (int)$iKey == 0 ) active @endif col-sm-12 col-sm-12" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset($value['path']) }}')">

                            </div>
                        @else

                                <div class="item @if( (int)$iKey == 0 ) active @endif col-sm-12 col-sm-12" >
                                    <video id="video" controls="controls" autoplay >
                                        <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
                                        <source src="{{ asset($value['path']) }}" type="video/mp4">
                                    </video>
                                </div>

                        @endif
                    @endif
                @endforeach
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
        @endif
        <div class="detail col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-18" style="padding-left: 0; padding-right: 0; word-wrap: break-word; word-break: keep-all">
           <div class="title-detail col-md-12 col-sm-12" style="color: #ce1126; padding-left: 0; padding-right: 0; ">
               <h2 style="font-weight: bold">{{ $aFrontend['aTopic']['title'] }}</h2>
           </div>
            <div class="time col-md-12 col-sm-12" style="font-size: 14px;padding-left: 0; padding-right: 0;margin-bottom: 15px;">
                <div class="col-md-10 col-sm-10">
                    Đăng lúc <b>{{ $aFrontend['aTopic']['time_stamp'] }}</b> - bởi <a href="{{ asset('profile/'.$aFrontend['aTopic']['user_id']) }}" style="text-decoration: none;"><b>{{ $aFrontend['aTopic']['full_name'] }}</b></a>
                    @if((int)$aFrontend['aTopic']['user_group'] === 1)
                        <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>
                    @elseif((int)$aFrontend['aTopic']['user_group'] === 2)
                        <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>
                    @endif
                </div>
                @if( $bLogin && (int)$iCurrentUserId === (int)$aFrontend['aTopic']['user_id'])
                    <a class="col-md-2 col-sm-2 edit-button" href="{{ url('topic/edit/'.$aFrontend['aTopic']['topic_id']) }}">

                    </a>
                @endif
            </div>
            <div class="contact col-md-12 col-sm-12" style="margin-bottom: 15px;padding-left: 0; padding-right: 0; font-size: 16px;color: darkslategrey;">
                <span class="price">
                    <i class="fa fa-money" aria-hidden="true" style="font-weight: bold;"></i>
                    <span style="margin-left: 10px">{{ $aFrontend['aTopic']['price'] }} {{ $aFrontend['aTopic']['currency_title'] }}</span>
                </span>
                <span class="phone" style="margin-left: 25px;">
                    <i class="fa fa-phone" aria-hidden="true" style="font-weight: bold;"></i>
                    <span style="margin-left: 5px">{{ $aFrontend['aTopic']['phone'] }}</span>
                </span>
            </div>
            <div class="description col-md-12 col-sm-12" style="margin-bottom: 15px;padding-left: 0; padding-right: 0; font-size: 24px;color: darkslategrey;word-wrap: break-word; word-break: keep-all">
                {{ $aFrontend['aTopic']['description'] }}
            </div>

            <div class="address col-md-12 col-sm-12" style="margin-bottom: 15px; padding-left: 0; padding-right: 0; font-size: 18px;color: darkslategrey;">
                <i class="fa fa-map-marker" aria-hidden="true" style="font-weight: bold;"></i>
                <span style="margin-left: 10px">{{ $aFrontend['aTopic']['address'] }}</span>
            </div>

            <div class="map col-md-12 col-sm-12" style="height: 400px;" id="vietbando">

            </div>
        </div>
    </div>
    @if(!empty($aFrontend['aRelatedTopics']))
        <div class="related-topic">
            <div class="title">
                <h2>Bài Viết Liên Quan</h2>
            </div>
            <div class="result col-md-12">
                <div class="list" >
                    @foreach($aFrontend['aRelatedTopics'] as $iKey => $aRelatedTopic)
                        <div class="col-md-12 col-sm-12 item" style="cursor: pointer; @if((int)$aRelatedTopic['stt'] < (int)(count($aFrontend['aRelatedTopics']) - 1) ) border-bottom: 1px solid #dddddd; @endif padding: 20px 0;" data-id="{{ $aRelatedTopic['topic_id'] }}">
                            <div class="col-md-2 col-sm-2 image">
                                <img src="@if(!empty($aRelatedTopic['attachment_path'])) {{ asset($aRelatedTopic['attachment_path']) }} @else{{ asset('images/default_product.jpg') }}@endif" style="border: 1px solid #dddddd; height: 110px; width: 110px">
                            </div>
                            <div class="content col-md-7 col-sm-7">
                                <div style="font-size: 18px;margin-bottom: 15px;color: #196c4b"><a href="{{ url('topic/detail/'.$aRelatedTopic['topic_id']) }}" style="text-decoration: none;">{{ $aRelatedTopic['title'] }}</a> </div>
                                <div style="font-size: 15px;margin-bottom: 5px"><b>{{ $aRelatedTopic['price'] }}</b> {{ $aRelatedTopic['currency_title'] }}</div>
                                <div style="font-size: 15px;margin-bottom: 5px">Danh mục: <b>{{ $aRelatedTopic['category_title'] }}</b></div>
                                <div style="font-size: 15px; margin-bottom: 5px;">Đăng lúc <b>{{ $aRelatedTopic['time_stamp'] }}</b></div>
                            </div>
                            <div class="user col-md-3 col-sm-3" >
                                Đăng bởi <a href="{{ asset('profile/'.$aRelatedTopic['user_id']) }}" style="text-decoration: none;"><b>{{ $aRelatedTopic['full_name'] }}</b></a>
                                @if((int)$aRelatedTopic['user_group'] === 1)
                                    <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>
                                @elseif((int)$aRelatedTopic['user_group'] === 2)
                                    <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>
                                @endif
                            </div>
                            <div class="col-md-12 col-sm-2" style="padding: 0 120px 0 15px;;margin-top: 20px;">
                                <div class="col-md-12 col-sm-2" style="@if((int)$iKey < (int)(count($aFrontend['aRelatedTopics']) - 1) ) border-bottom: 1px solid #dddddd; @endif">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
<script type="text/javascript" src="https://developers.vietbando.com/V2/Scripts/VietbandoMapsAPI.js?key=a4421f51-dabb-45b5-aa92-d361989037fc"></script>
<script type="text/javascript">
    var lat = parseFloat("{{ $aFrontend['Coordinate'][0] }}");
    var lng = parseFloat("{{ $aFrontend['Coordinate'][1] }}");
    var find_address = "{{ $aFrontend['aTopic']['address'] }}";
    var find_phone = "{{ $aFrontend['aTopic']['phone'] }}";
    var detail_url = "{{ asset('topic/detail') }}";
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
        var map = new vbd.Map(document.getElementById("vietbando"), mapProp);
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
            if(document.getElementById('video'))
            {
                document.getElementById('video').pause();
            }

        });
        $('.related-topic .item').click(function () {
            var id = $(this).data('id');
            window.location.href = detail_url+'/'+id;
        });
    });
</script>
@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}