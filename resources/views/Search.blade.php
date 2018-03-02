@extends('layout')
@section('title',trans('phrases.search_product_title'))
@section('css')
<link href="{{ asset('css/views/search.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="search-result">
        <input type="hidden" id="detail_url" value="{{ asset('topic/detail') }}">
        <input type="hidden" id="suggestion_url" value="{{ asset('suggestion') }}">
        <input type="hidden" id="ajax_loader_image" value="{{ asset('images/load-more.gif') }}">
        <input type="hidden" id="load_more_url" value="{{ asset('paging') }}">
        <input type="hidden" id="json_param" value="{{ json_encode($aFrontend['QueryDatas']) }}">
        <div class="search col-md-10 col-md-offset-1">
            <h2 style="text-align: center">@lang('phrases.search_product_title')</h2>
            <form id="form_search" method="POST" action="{{ action('Topic\SearchController@process') }}">
                {!! csrf_field() !!}
                <div class="box-search" style="position: relative;">
                    <input type="text" class="form-control" id="search" name="search" placeholder="@lang('phrases.search_product_placeholder')" style="height: 50px;display: inline-block;width: 90%" value="@if(!empty($aFrontend['QueryDatas']['search'])){{ $aFrontend['QueryDatas']['search'] }}@endif">
                    <button class="btn btn-success " type="button" id="dropdown"  style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                        <span class="caret"></span>
                    </button>
                    <button class="btn btn-primary" type="submit" id="submit_header" style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                        <i class="fa fa-search" style="color: #ffffff"></i>
                    </button>
                    <div class=" col-md-12 menu" style="box-shadow: 1px 1px 4px #ccc;position: absolute; border-radius: 0;background-color: bisque;top: 83%;padding: 20px 90px; display: none;z-index: 1;" id="menu">
                        <div class="col-md-12 category-selection" style="padding-left: 0; padding-right: 0">
                            <div style="width: 15%;display: inline-block;">
                                <h5 style="font-weight:400;">@lang('phrases.category'): </h5>
                            </div>
                            <div style="width: 84%;display: inline-block;">
                                <select id="cat" name="cat" class="form-control" style="display: inline-block;">
                                    <option value="0">@lang('phrases.all')</option>
                                    @if(!empty($aFrontend['aCategories']))
                                        @foreach($aFrontend['aCategories'] as $aCategory)
                                            <option value="{{ $aCategory['category_id'] }}" @if(!empty($aFrontend['QueryDatas']['cat']) && (int)$aCategory['category_id'] == (int)$aFrontend['QueryDatas']['cat']) selected @endif>{{ $aCategory['title'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 time-selection" style="padding-left: 0; padding-right: 0;">
                            <div class="col-md-6 col-sm-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                                <div style="width: 30%;display: inline-block;">
                                    <h5 style="font-weight:400 ">@lang('phrases.datefrom'): </h5>
                                </div>
                                <div style="width: 65%; display: inline-block">
                                    <input type="text" id="datefrom" name="datefrom" value="@if(!empty($aFrontend['QueryDatas']['date']['datefrom'])) {{ $aFrontend['QueryDatas']['date']['datefrom'] }} @else 01-01-{{ (int)date('Y') }} @endif" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                                <div style="width: 33%;display: inline-block;">
                                    <h5 style="font-weight:400 ">@lang('phrases.dateto'): </h5>
                                </div>
                                <div style="width: 65%; display: inline-block">
                                    <input type="text" id="dateto" name="dateto" value="@if(!empty($aFrontend['QueryDatas']['date']['dateto'])) {{ $aFrontend['QueryDatas']['date']['dateto'] }} @else {{ date('d-m-Y') }} @endif" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="result col-md-12">
            <div style="border-bottom: 1px solid #dddddd;margin: 40px 0 40px 0;"></div>
            <div class="list" data-paging="0" >
                @if(!empty($aFrontend['aTopics']))
                    @foreach($aFrontend['aTopics'] as $iKey => $aTopic)
                        <div class="col-md-12 col-sm-12 item" style="padding: 20px 0;cursor: pointer" data-id="{{ $aTopic['topic_id'] }}">
                            <div class="col-md-2 col-sm-2 image">
                                <img src="@if(!empty($aTopic['attachment_path'])) {{ asset($aTopic['attachment_path']) }} @else{{ asset('images/default_product.jpg') }}@endif" style="border: 1px solid #dddddd; height: 110px; width: 110px">
                            </div>
                            <div class="content col-md-7 col-sm-7">
                                <div style="font-size: 18px;margin-bottom: 15px;color: #196c4b"><a href="{{ url('topic/detail/'.$aTopic['topic_id']) }}" style="text-decoration: none;">{{ $aTopic['title'] }}</a> </div>
                                <div style="font-size: 15px;margin-bottom: 5px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                <div style="font-size: 15px;margin-bottom: 5px">@lang('phrases.category'): <b>{{ $aTopic['category_title'] }}</b></div>
                                <div style="font-size: 15px; margin-bottom: 5px;">@lang('phrases.posted_at') <b>{{ $aTopic['time_stamp'] }}</b></div>
                            </div>
                            <div class="user col-md-3 col-sm-3" >
                                @lang('phrases.by') <a style="text-decoration: none;" href="{{ asset('profile/'.$aTopic['user_id']) }}"><b>{{ $aTopic['full_name'] }}</b></a>
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
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('js/views/search.js') }}"></script>
@endsection