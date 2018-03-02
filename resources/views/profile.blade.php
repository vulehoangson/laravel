@extends('layout')
@section('title',$aFrontend['aUser']['full_name'])
@section('css')
<link href="{{ asset('css/views/pr.css') }}" rel="stylesheet" >
@endsection
@section('content')
<div class="profile" style="margin-bottom: 60px;">
    <input type="hidden" id="lat" value="{{ $aFrontend['aCoordinate'][0] }}">
    <input type="hidden" id="lng" value="{{ $aFrontend['aCoordinate'][1] }}">
    <input type="hidden" id="find_address" value="{{ $aFrontend['aUser']['address'] }}">
    <input type="hidden" id="find_phone" value="{{ $aFrontend['aUser']['phone'] }}">
    <div class="title">
        <h2>@lang('phrases.profile')</h2>
    </div>
    <div class="detail col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-18">
        <div class="cover-photo" style="position: relative;height: 450px;overflow: hidden;text-decoration: none; @if(empty($aFrontend['aUser']['cover_photo'])) background-color: #1d2129; @endif ">
            @if(!empty($aFrontend['aUser']['cover_photo']))
                <img src="{{asset($aFrontend['aUser']['cover_photo'])}}" style="min-height: 100%;min-width: 100%;position: absolute;left: 0;top: 0;width: 100%;image-rendering: optimizequality;">
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
</div>
@endsection
@section('js')
<script type="text/javascript" src="https://developers.vietbando.com/V2/Scripts/VietbandoMapsAPI.js?key=a4421f51-dabb-45b5-aa92-d361989037fc"></script>
<script src="{{ asset('js/views/profile.js') }}"></script>
@endsection