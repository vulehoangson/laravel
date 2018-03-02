@extends('layout')
@section('css')
<link href="{{ asset('css/views/signup.css') }}" rel="stylesheet" >
@endsection
@section('content')
@section('title',trans('phrases.signup'))
<div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
    <h2>@lang('phrases.signup')</h2>
</div>
@if(!empty($aError))
    @foreach($aError as $value)
        <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;">
            {{$value['content']}}
        </div>
    @endforeach
@endif
<div class="content" style="padding-left: 15px;">
    <form method="POST" action="{{ action('User\SignupController@validateSignup') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div style="margin-bottom: 15px;">
            <b>@lang('phrases.username')</b>:
            <input type="text" name="val[username]" id="username" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>
        <div>
            <b>@lang('phrases.password')</b>:
            <input type="password" name="val[password]" id="password" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>
        <div>
            <b>@lang('phrases.full_name')</b>:
            <input type="text" name="val[full_name]" id="full_name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>
        <div>
            <b>@lang('phrases.address')</b>:
            <input type="text" name="val[address]" id="address" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>
        <div>
            <b>@lang('phrases.phone')</b>:
            <input type="text" name="val[phone]" id="phone" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>
        <div class="avatar">
            <b>@lang('phrases.avatar')</b>:
            <div class="input-group image-preview" style="margin-bottom: 15px;position: relative; width: 35%;">
                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-button" style="display:none;margin-top: 10px;height: 40px;border-radius: 0">
                        <span class="glyphicon glyphicon-eye-open" style="top: 2px;"></span> Preview
                    </button>
                    <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;border-radius: 0">
                        <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/*" name="file" style="height: 40px" />
                    </div>
                </span>
            </div>
        </div>
        <div class="cover-photo">
            <b>@lang('phrases.cover_background')</b>:
            <div class="input-group image-preview-cover" style="margin-bottom: 15px;position: relative; width: 35%;">
                <input type="text" class="form-control image-preview-filename-cover" disabled="disabled">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-button-cover" style="display:none;margin-top: 10px;height: 40px;border-radius: 0">
                        <span class="glyphicon glyphicon-eye-open" style="top: 2px;"></span> Preview
                    </button>
                    <div class="btn btn-default image-preview-input-cover" style="margin-top: 10px;height: 40px;border-radius: 0">
                        <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                        <span class="image-preview-input-title-cover">Browse</span>
                        <input type="file" accept="image/*" name="coverphoto" style="height: 40px" />
                    </div>
                </span>
            </div>
        </div>
        <div>
            <button class="btn btn-danger" id="submit" value="login">@lang('phrases.signup')</button>
        </div>
    </form>
</div>
@endsection
@section('js')
<script src="{{ asset('js/views/signup.js') }}"></script>
@endsection

