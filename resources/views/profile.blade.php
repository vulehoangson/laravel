@extends('layout')

@section('title','Vũ Lê Hoàng Sơn')

@section('content')
<div class="profile col-md-12">
    <div class="cover-photo" style="position: relative;height: 450px;overflow: hidden;text-decoration: none;">
        <img src="{{asset('images/cover.jpeg')}}" style="min-height: 100%;min-width: 100%;position: absolute;left: 0;top: -50px;width: 100%;image-rendering: auto;">
    </div>

    <div class="avatar" style="position: absolute; width: 160px; height: 160px;border: 2px #e6e6e6 solid;background: #ffffff;z-index: 4;bottom: -50px;left: 50px;">
        <img src="{{asset('images/family_resize.jpg')}}" style="width:100%;height:100%;">
    </div>

    <div class="user-info" style="position: absolute;z-index: 4;left: 240px;bottom: 40px;">
        <h1 style="font-size: 32px;font-weight: 200;letter-spacing: 1px;padding: 0;">
            <a href="{{ (!empty($_SESSION['user_id']) ? url('profile/'.$_SESSION['user_id'] ) : (!empty($_COOKIE['user_id']) ? url('profile/'.$_COOKIE['user_id'] ) : '') )}}" style="max-width: 100%;display: block;white-space: normal;overflow: hidden;padding: 0;font-size: 24px;text-overflow: ellipsis;line-height: 32px;height: 32px;color: whitesmoke;">
                Vũ Lê Hoàng Sơn
            </a>
        </h1>
    </div>
</div>
@endsection