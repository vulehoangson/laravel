@extends('layout')


@section('content')
    @section('title','Đăng nhập')
    <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
        <h2>Đăng nhập</h2>
    </div>
    @if(!empty($error))
    <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;">
        {{$error}}
    </div>
    @endif
    <div class="content" style="padding-left: 15px;">
        <form method="POST" action="{{ action('User\LoginController@validateLogin') }}">
            {!! csrf_field() !!}
            <div style="margin-bottom: 15px;">
                <b>Username</b>:
                <input type="text" name="username" id="username" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
            </div>
            <div>
                <b>Password</b>:
                <input type="password" name="password" id="password" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
            </div>

            <div>
                <button class="btn btn-danger" id="submit" value="login">Đăng nhập</button>
            </div>
        </form>
    </div>

@endsection

