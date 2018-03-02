@extends('layout')
@section('title','AdminCP')
@section('css')
<link href="{{ asset('css/views/admincp/index.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="admincp-index">
        <input type="hidden" id="approve_url" value="{{ asset('topic/approve') }}">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
        <div class="option col-md-2 col-sm-3" style="background: #0c0c0c;text-align: left;">
            <div class="back-home" style="border-bottom: 1px solid #dddddd; padding: 20px 10px">
                <i class="fa fa-home" aria-hidden="true" style="color: greenyellow;margin-right: 5px;"></i>
                <a href="{{ asset('') }}" style="text-decoration: none; color: white">
                    Quay lại Trang chủ
                </a>
            </div>
            <ul>
                <li data-tab="tab-1" class="selected">
                    <i class="fa fa-tachometer" aria-hidden="true" ></i>
                    <h5>DashBoard</h5>
                </li>
                <li data-tab="tab-2">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <h5>Danh Sách Chờ Duyệt</h5>
                </li>
                <li data-tab="tab-3">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <h5>Quản lý Danh mục</h5>
                </li>
            </ul>
        </div>
        <div class="content col-md-10 col-sm-9">
            <div id="tab-1" style="width: 100%" class="tab-content"></div>
            <div id="tab-2" style="width: 100%;" class="tab-content hide">
                <h1 style="text-align: center">Danh sách Topic chờ duyệt</h1>
                <div class="list col-md-12" style="padding: 0  30px">
                    @if(!empty($aFrontend['aTopics']))
                        @foreach($aFrontend['aTopics'] as $aTopic)
                        <div class="col-md-12 item" style="padding: 0px 0 20px 5px !important;  border: 1px solid #e5e5e5;margin-right: 20px;margin-bottom: 20px;">
                            <div class="title" style="height: auto; color: #808080; margin-bottom: 10px; padding: 0 10px;">
                                <a href=""><h2>{{ $aTopic['title'] }}</h2></a>
                            </div>
                            <div class="description" style="padding: 0 10px;margin-bottom: 15px;">
                                <h4>{{ $aTopic['description'] }}</h4>
                            </div>
                            <div class="approve-remove" style="padding: 0 10px;">
                                <button class="btn btn-success approve" style="margin-right: 20px;" data-id="{{ $aTopic['topic_id'] }}">Chấp nhận</button>
                                <button class="btn btn-danger remove" data-id="{{ $aTopic['topic_id'] }}">Xóa</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-content hide" id="tab-3">
                <h1 style="text-align: center">Danh mục</h1>
                <div class="list col-md-12 col-sm-12" style="padding: 0  30px">
                    @if(!empty($aFrontend['aCategories']))
                        @foreach($aFrontend['aCategories'] as $aCategory)
                            <div class="col-md-6 col-sm-12 item" style="padding: 0px 0 20px 5px !important;  border: 1px solid #e5e5e5; width: 45%;margin-right: 20px;margin-bottom: 20px;">
                                <div class="title" style="height: auto; color: #808080; margin-bottom: 25px; padding: 0 30px;">
                                    <a href=""><h3>{{ $aCategory['title'] }}</h3></a>
                                </div>
                                <div class="optional-button" style="padding: 0 30px;">
                                    <button class="btn btn-success see" style="margin-right: 20px;width: auto;" data-id="{{ $aCategory['category_id'] }}">Xem</button>
                                    <button class="btn btn-warning update" data-id="{{ $aCategory['category_id'] }}" style="margin-right: 20px;width: auto;">Cập nhật</button>
                                    <button class="btn btn-danger delete" data-id="{{ $aCategory['category_id'] }}" style="margin-right: 20px;width: auto;">Xóa</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('js/views/admincp/index.js') }}"></script>
@endsection