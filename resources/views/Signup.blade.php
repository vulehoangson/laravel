@extends('layout')


@section('content')
@section('title','Đăng ký')
<style rel="stylesheet">
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title {
        margin-left:2px;
    }

/*---------------------------------------------*/
    .image-preview-input-cover {
        position: relative;
        overflow: hidden;
        margin: 0px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .image-preview-input-cover input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .image-preview-input-title-cover {
        margin-left:2px;
    }



    .popover.bottom
    {
        margin-top: 0 !important;
    }
    .popover
    {
        left: 200px !important;

    }
</style>
<div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
    <h2>Đăng ký</h2>
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
            <b>Username</b>:
            <input type="text" name="val[username]" id="username" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>

        <div>
            <b>Password</b>:
            <input type="password" name="val[password]" id="password" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>

        <div>
            <b>Họ tên</b>:
            <input type="text" name="val[full_name]" id="full_name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>

        <div>
            <b>Địa chỉ</b>:
            <input type="text" name="val[address]" id="address" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>

        <div>
            <b>Số điện thoại</b>:
            <input type="text" name="val[phone]" id="phone" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;" >
        </div>

        <div class="avatar">
            <b>Ảnh đại diện</b>:
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
            <b>Ảnh Cover</b>:
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
            <button class="btn btn-danger" id="submit" value="login">Đăng ký</button>
        </div>
    </form>
</div>
<script type="text/javascript">

    //------ avatar --------------------
    $(document).ready(function () {
        $('.content').on('click','.image-preview-button',function(){
            $(this).parent().parent().parent().popover('show');
        });
    });
    $(document).on('click', '#close-preview', function(){
        var oAttachmentFile = $('.avatar');
        oAttachmentFile.popover('hide');
    });
    $(document).on('change','input[name="file"]',function (){
        $(this).parents('.avatar').children('.preview-file').hide();
        $(this).parents('.image-preview').children('#attachment').val('');
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;'

        });
        closebtn.attr("class","close pull-right");
        $(this).parent().parent().children('.image-preview-button').show();
        $(this).parent().parent().parent().parent().popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image/video",
            placement:'bottom'
        });


        var url = (URL || webkit).createObjectURL(this.files[0]);
        var file = this.files[0];
        var file_type = file.type;
        var attachment = '';
        attachment = $('<img/>', {
            id: 'dynamic-attachment',
            height: '100%',
            width: '100%'
        });

        if(attachment)
        {
            var oObject = $(this);
            oObject.parent().children('.image-preview-input-title').text("Change");
            oObject.parent().parent().parent().children(".image-preview-filename").val(file.name);
            attachment.attr('src', url);
            oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");

        }

    });

    //---- cover photo ---------------------

    $(document).ready(function () {
        $('.content').on('click','.image-preview-button-cover',function(){
            $(this).parent().parent().parent().popover('show');
        });
    });
    $(document).on('click', '#close-preview-cover', function(){
        var oAttachmentFile = $('.cover-photo');
        oAttachmentFile.popover('hide');
    });
    $(document).on('change','input[name="coverphoto"]',function (){
        $(this).parents('.cover-photo').children('.preview-file').hide();
        $(this).parents('.image-preview').children('#attachment').val('');
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview-cover',
            style: 'font-size: initial;'

        });
        closebtn.attr("class","close pull-right");
        $(this).parent().parent().children('.image-preview-button-cover').show();
        $(this).parent().parent().parent().parent().popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image/video",
            placement:'bottom'
        });


        var url = (URL || webkit).createObjectURL(this.files[0]);
        var file = this.files[0];
        var file_type = file.type;
        var attachment = '';

        attachment = $('<img/>', {
            id: 'dynamic-attachment-cover',
            height: '100%',
            width: '100%'
        });
        if(attachment)
        {
            var oObject = $(this);
            oObject.parent().children('.image-preview-input-title-cover').text("Change");
            oObject.parent().parent().parent().children(".image-preview-filename-cover").val(file.name);
            attachment.attr('src', url);
            oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");

        }

    });
</script>

@endsection

