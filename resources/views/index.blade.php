@extends('layout')
@section('title',trans('phrases.homepage'))
@section('css')
<link href="{{ asset('css/views/index.css') }}" rel="stylesheet" >
@endsection
@section('content')
<div class="homepage" style="">
    <div class="search col-md-10 col-md-offset-1" style="padding-right: 10px;">
        <input type="hidden" id="detail_url" value="{{ asset('topic/detail') }}">
        <input type="hidden" id="suggestion_url" value="{{ asset('suggestion') }}">
        <h2 style="text-align: center">@lang('phrases.search_product_title')</h2>
        <form id="form_search" method="POST" action="{{ action('Topic\SearchController@process') }}">
            {!! csrf_field() !!}
            <div class="box-search" style="position: relative;">
                <input type="text" class="form-control" id="search" name="search" placeholder="@lang('phrases.search_product_placeholder')" style="height: 50px;display: inline-block;width: 90%">

                <button class="btn btn-success " type="button" id="dropdown"  style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                    <span class="caret"></span>
                </button>
                {{--<button type="submit" id="submit_header" style="display: inline-block;width: 50px;border: none;height: 50px;background-color: #ce1126;position: absolute;font-size: 26px;top: 10px;">
                    <i class="fa fa-search" style="color: #ffffff"></i>
                </button>--}}
                <button class="btn btn-primary" type="submit" id="submit_header" style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                    <i class="fa fa-search" style="color: #ffffff"></i>
                </button>
                <div class="col-md-12 menu" id="menu" style="box-shadow: 1px 1px 4px #ccc;position: absolute; border-radius: 0;background-color: bisque;top: 83%;padding: 20px 90px; display: none;z-index: 1;">
                    <div class="col-md-12 category-selection" style="padding-left: 0; padding-right: 0">
                        <div style="width: 15%;display: inline-block;">
                            <h5 style="font-weight:400;">@lang('phrases.category'): </h5>
                        </div>
                        <div style="width: 84%;display: inline-block;">
                            <select id="cat" name="cat" class="form-control" style="display: inline-block;">
                                <option value="0">@lang('phrases.all')</option>
                                @if(!empty($aFrontend['aCategories']))
                                    @foreach($aFrontend['aCategories'] as $aCategory)
                                        <option value="{{ $aCategory['category_id'] }}">{{ $aCategory['title'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12 time-selection" style="padding-left: 0; padding-right: 0;">
                        <div class="col-md-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                            <div style="width: 30%;display: inline-block;">
                                <h5 style="font-weight:400 ">@lang('phrases.datefrom'): </h5>
                            </div>
                            <div style="width: 65%; display: inline-block">
                                <input type="text" id="datefrom" name="datefrom" value="01-01-{{ (int)date('Y') }}" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                            <div style="width: 33%;display: inline-block;">
                                <h5 style="font-weight:400 ">@lang('phrases.dateto'): </h5>
                            </div>
                            <div style="width: 65%; display: inline-block">
                                <input type="text" id="dateto" name="dateto" value="{{ date('d-m-Y') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="col-md-12" style="margin: 40px 0 35px 0; border-bottom: 1px solid #dddddd"></div>
    <div class="categories col-md-12" style="margin-top: 20px;padding: 0 15px;">
        <h2 style="text-align: center;">@lang('phrases.product_category')</h2>
        <div class="list" >
            @if(!empty($aFrontend['aCategories']))
                @foreach($aFrontend['aCategories'] as $aCategory)
                    <div class="category" style="border: 1px solid #dddddd; margin-bottom: 20px;">
                        <div class="title form-control" style="background-color: #67b168;color: #ffffff;font-size: 20px;height: 50px;margin-top: 0; margin-bottom: 0">
                            {{ $aCategory['title'] }}
                        </div>
                        @if(!empty($aCategory['aTopics']))
                            @foreach($aCategory['aTopics'] as  $aTopic)
                                <div class="col-md-12 item" style="@if((int)$aTopic['stt'] < (int)(count($aCategory['aTopics']) - 1) ) border-bottom: 1px solid #dddddd; @endif padding: 20px 0;cursor: pointer;" data-id="{{ $aTopic['topic_id'] }}">
                                    <div class="col-md-2 col-sm-2 image">
                                        <img src="@if(!empty($aTopic['attachment_path'])) {{ asset($aTopic['attachment_path']) }} @else{{ asset('images/default_product.jpg') }}@endif" style="border: 1px solid #dddddd; height: 110px; width: 110px">
                                    </div>
                                    <div class="content col-md-7 col-sm-7">
                                        <div style="font-size: 19px;margin-bottom: 5px;color: #196c4b"><a href="{{ url('topic/detail/'.$aTopic['topic_id']) }}" style="text-decoration: none;">{{ $aTopic['title'] }}</a> </div>
                                        <div style="font-size: 16px;margin-bottom: 25px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                        <div style="font-size: 16px; margin-bottom: 5px;">@lang('phrases.posted_at') <b>{{ $aTopic['time_stamp'] }}</b></div>
                                    </div>
                                    <div class="user col-md-3 col-sm-3" >
                                        @lang('phrases.by') <a href="{{ asset('profile/'.$aTopic['user_id']) }}" style="text-decoration: none;"><b>{{ $aTopic['full_name'] }}</b></a>
                                        @if((int)$aTopic['user_group'] === 1)
                                            <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>
                                        @elseif((int)$aTopic['user_group'] === 2)
                                            <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                @endforeach
            @endif
        </div>

    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('js/views/index.js') }}"></script>
@endsection
