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
    </style>
    <div class="topic-detail">
        <div id="myCarousel" class="carousel slide col-md-8 col-md-offset-3" data-ride="carousel" style="background-color: #555;;margin-left: 16%;">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="width: 100%;height: 400px;padding: 0 100px">
                <div class="item active" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset('storage/files/qVizUtGnhOvSaVieT6XozeA8WeNdlXBYAqDQBUCM.png') }}')">

                </div>
                <div class="item" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset('storage/files/98f7a94f53772dfcd2939d2a8b309eaa.jpg') }}')">

                </div>
                <div class="item" style="height: 93%;width:100%;">
                    <video controls="controls" autoplay style=" width:100%;height: 100%;">
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
    </div>




@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}