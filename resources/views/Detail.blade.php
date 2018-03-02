@extends('layout')
@section('title',$aFrontend['aTopic']['title'])
@section('css')
<link href="{{ asset('css/views/detail.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="topic-detail">
        <input type="hidden" id="lat" value="{{ $aFrontend['Coordinate'][0] }}">
        <input type="hidden" id="lng" value="{{ $aFrontend['Coordinate'][1] }}">
        <input type="hidden" id="address" value="{{ $aFrontend['aTopic']['address'] }}">
        <input type="hidden" id="phone" value="{{ $aFrontend['aTopic']['phone'] }}">
        <input type="hidden" id="detail_url" value="{{ asset('topic/detail') }}">
        <div class="title">
            <h2>@lang('phrases.product_detail')</h2>
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
                            <div class="item @if( (int)$iKey == 0 ) active @endif col-sm-12 col-sm-12" style="height: 100%;background-position: center center;background-repeat: no-repeat;padding: 5px 0;background-image: url('{{ asset($value['path']) }}')"></div>
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
                    @lang('phrases.posted_at') <b>{{ $aFrontend['aTopic']['time_stamp'] }}</b> - @lang('phrases.by') <a href="{{ asset('profile/'.$aFrontend['aTopic']['user_id']) }}" style="text-decoration: none;"><b>{{ $aFrontend['aTopic']['full_name'] }}</b></a>
                    @if((int)$aFrontend['aTopic']['user_group'] === 1)
                        <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>
                    @elseif((int)$aFrontend['aTopic']['user_group'] === 2)
                        <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>
                    @endif
                </div>
                @if( $bLogin && (int)$iCurrentUserId === (int)$aFrontend['aTopic']['user_id'])
                    <a class="col-md-2 col-sm-2 edit-button" href="{{ url('topic/edit/'.$aFrontend['aTopic']['topic_id']) }}"></a>
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
            @if(!empty($aFrontend['Coordinate'][0]) && !empty($aFrontend['Coordinate'][1]))
            <div class="map col-md-12 col-sm-12" style="height: 400px;" id="vietbando">
            @endif
            </div>
        </div>
    </div>
    @if(!empty($aFrontend['aRelatedTopics']))
        <div class="related-topic">
            <div class="title">
                <h2>@lang('phrases.related_topic')</h2>
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
                                <div style="font-size: 15px;margin-bottom: 5px">@lang('phrases.category'): <b>{{ $aRelatedTopic['category_title'] }}</b></div>
                                <div style="font-size: 15px; margin-bottom: 5px;">@lang('phrases.posted_at') <b>{{ $aRelatedTopic['time_stamp'] }}</b></div>
                            </div>
                            <div class="user col-md-3 col-sm-3" >
                                @lang('phrases.by') <a href="{{ asset('profile/'.$aRelatedTopic['user_id']) }}" style="text-decoration: none;"><b>{{ $aRelatedTopic['full_name'] }}</b></a>
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
@endsection
@section('js')
<script type="text/javascript" src="https://developers.vietbando.com/V2/Scripts/VietbandoMapsAPI.js?key=a4421f51-dabb-45b5-aa92-d361989037fc"></script>
<script src="{{ asset('js/views/detail.js') }}"></script>
@endsection