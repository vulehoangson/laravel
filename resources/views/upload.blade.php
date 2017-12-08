@extends('layout')

@section('title','Tạo bài đăng')

@section('content')

    <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
        <h2>Tạo bài đăng</h2>
    </div>
    @if(!empty($error))
        <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;">
            {{$error}}
        </div>
    @endif
    <div class="upload" style="padding-left: 15px;">
        <form method="POST" action="{{ action('User\LoginController@validateLogin') }}">
            {!! csrf_field() !!}
            <div style="margin-bottom: 15px;">
                <div><b>Tiêu đề </b>:</div>
                <input type="text" name="name" id="name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;"  placeholder="Bạn đang bán gì ?">
            </div>

            <div>
                <div><b>Chọn tiền tệ</b> :</div>
                <select id="currency" class="form-control">
                    <option value="vnd">VNĐ</option>
                    <option value="dollar">Dollar</option>
                </select>
            </div>

            <div>
                <div><b>Giá tiền </b>:</div>
                <input type="text" name="price" id="price" class="form-control"  placeholder="Giá tiền">
            </div>

            <div>
                <div><b>Mô tả sản phẩm </b>:</div>
                <input type="text" name="description" id="description" class="form-control"  placeholder="Mô tả sản phẩm">
            </div>

            <div>
                <div><b>Địa chỉ </b>:</div>
                <input type="text" name="address" id="address" class="form-control"  placeholder="Địa chỉ">
            </div>

            <div>
                <div><b>Số điện thọai </b>:</div>
                <input type="text" name="phone" id="phone" class="form-control"  placeholder="Số điện thoại">
            </div>



            <div>
                <button class="btn btn-danger" id="submit" value="login">Tạo</button>
            </div>
        </form>
    </div>

@endsection