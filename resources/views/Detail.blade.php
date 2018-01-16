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
    </style>
    <div class="topic-detail">
        <div id="myCarousel" class="carousel slide col-md-8 col-md-offset-3" data-ride="carousel" style="width: 650px;padding: 0 100px;background-color: black;margin-left: 20%;">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="">
                <div class="item active" style="padding: 5px 0;">
                    <img src="{{ asset('storage/files/31400f7fce3e20d5992511db7dcd4685.png') }}" alt="Los Angeles" style="width:100%;">
                </div>

                <div class="item" style="padding-top: 5px">

                    <video src="{{ asset('storage/files/EjkHfVjUi7CLhGQbzyMQrRE1OonLZVfwHVJhuR4q.mp4') }}" alt="New york" style="width:100%;" controls="controls"></video>
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
    </div>




@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}