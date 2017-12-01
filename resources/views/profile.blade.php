@extends('layout')

@section('title','')

@section('content')
<div class="profile col-md-12">
    <div class="cover-photo" style="position: relative;height: 450px;overflow: hidden;text-decoration: none;">
        <img src="{{asset('images/family.jpg')}}" style="min-height: 100%;min-width: 100%;position: absolute;left: 0;top: -50px;width: 100%;">
    </div>
</div>
@endsection