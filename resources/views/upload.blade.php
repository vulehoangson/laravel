@extends('layout')

@section('title','Tạo bài đăng')

@section('content')
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
        video::-internal-media-controls-download-button {
            display:none;
        }
    </style>
    <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
        <h2>Tạo bài đăng</h2>
    </div>
    @if(!empty($aError))
        @foreach($aError as $value)
            <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;display: none">
                {{$value['content']}}
            </div>
        @endforeach

    @endif

    @if(!empty($sSuccess))
        <div class="success" style="padding: 20px;color: white;background-color: #67b168;margin-bottom: 20px;display: none">
            {{$sSuccess}}
        </div>
    @endif
    <div class="upload" style="padding-left: 15px;">
        <form method="POST" action="{{ action('Topic\UploadController@process') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div style="margin-bottom: 15px;">
                <div><b>Tiêu đề </b>:</div>
                <input type="text" name="name" id="name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;"  placeholder="Bạn đang bán gì ?">
            </div>

            <div>
                <div><b>Chọn Danh mục</b> :</div>
                <select id="category" class="form-control" name="category">
                    @if(!empty($aFrontend['aCategories']))
                        @foreach($aFrontend['aCategories'] as $aCategory)
                            <option value="{{ $aCategory['category_id'] }}">{{ $aCategory['title'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <div><b>Chọn tiền tệ</b> :</div>
                <select id="currency" class="form-control" name="currency">
                    @if(!empty($aFrontend['aCurrencies']))
                        @foreach($aFrontend['aCurrencies'] as $aCurrency)
                        <option value="{{ $aCurrency['currency_id'] }}">{{ $aCurrency['title'] }}</option>
                        @endforeach
                    @endif
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

            <div class="attachments">
                <div><b>Đính kèm file (tối đa 4 files)</b>:</div>
                <div class="attachment-list">
                    <div class="input-group image-preview" style="width: 35%;margin-bottom: 15px;position: relative;" data-id="1">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                        <span class="input-group-btn">
                            <!-- image-preview-clear button -->
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;margin-top: 10px;height: 40px;border-radius: 0">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <!-- image-preview-input -->
                            <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;border-radius: 0">
                                <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input type="file" accept="image/*, video/mp4" name="file[]" style="height: 40px"/> <!-- rename it -->
                            </div>

                        </span>
                        <div class="remove-attachment" style="position: absolute;top: 20px;left: 425px;display: none;cursor: pointer;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 22px"></i></div>
                    </div>
                </div>
            </div>
            <div class="add-attachment-button" style="cursor: pointer;margin-bottom: 15px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 18px;"></i></div>


            <div>
                <button class="btn btn-danger" id="submit" value="login">Tạo</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        var bError="{{ !empty($aError) ? true : false }}";
        var bSuccess="{{ !empty($sSuccess) ? true : false}}";
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            if(bError)
            {
                $( "div.error" ).fadeIn( 500 );
            }
            if(bSuccess)
            {
                $( "div.success" ).fadeIn( 500 ).delay( 1500 ).fadeOut( 500 );
            }

            $('.add-attachment-button').click(function(){
                if($('.attachments .attachment-list .image-preview').length + 1  <= 4)
                {
                    var oAttachment = $('.attachments .attachment-list .image-preview:first').clone();
                    oAttachment.find('.remove-attachment').css('display','block');
                    oAttachment.attr('data-id',$('.attachments .attachment-list .image-preview').length + 1);


                    oAttachment.attr("data-content","");
                    oAttachment.children('.image-preview-filename').val("");
                    oAttachment.children('.input-group-btn').children('.image-preview-clear').css('display','none');
                    oAttachment.children('.input-group-btn').children('.image-preview-input input:file').val("");
                    oAttachment.children('.input-group-btn').children().children(".image-preview-input-title").text("Browse");

                    $('.attachments .attachment-list').append(oAttachment);
                }

            });

            $('.attachments').on('click','.remove-attachment',function(){
               $(this).parent().remove();
            });

        });

        $(document).on('click', '#close-preview', function(){
            console.log($(this).data('id'));
            var oAttachmentFile = $('.image-preview:nth-child('+$(this).data('id')+')');
            oAttachmentFile.popover('hide');
            // Hover befor close the preview
            /*oAttachmentFile.hover(
                    function () {
                        oAttachmentFile.popover('show');
                    },
                    function () {
                        oAttachmentFile.popover('hide');
                    }
            );*/
        });

        $(function() {
            // Create the close button

            // Clear event
            $('.attachments .attachment-list ').on('click','.image-preview-clear',function(){
                $(this).parent().parent().attr("data-content","").popover('hide');
                $(this).parent().parent().children('.image-preview-filename').val("");
                $(this).hide();
                $(this).siblings('.image-preview-input').children('.image-preview-input input:file').val("");
                $(this).siblings('.image-preview-input').children(".image-preview-input-title").text("Browse");
            });
            // Create the preview image
            $(".attachments .attachment-list ").on('change','.image-preview-input input:file',function (){


                var closebtn = $('<button/>', {
                    type:"button",
                    text: 'x',
                    id: 'close-preview',
                    style: 'font-size: initial;'

                });
                closebtn.attr("class","close pull-right");
                closebtn.attr("data-id",$(this).parent().parent().parent().attr('data-id'));
                // Set the popover default content
                $(this).parent().parent().parent().popover({
                    trigger:'manual',
                    html:true,
                    title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                    content: "There's no image/video",
                    placement:'bottom'
                });




                var file = this.files[0];
                var file_type = file.type;
                var attachment = '';
                if(file_type.indexOf('video/mp4') != -1)
                {
                    attachment = $('<video/>', {
                        id: 'dynamic-attachment',
                        width: 250,
                        height: 200,
                        controls: true,
                        controlsList: "nodownload"
                    });
                }
                else if(file_type.indexOf('image/') != -1)
                {
                    attachment = $('<img/>', {
                        id: 'dynamic-attachment',
                        width: 250,
                        height: 200
                    });
                }
                if(attachment)
                {

                    var reader = new FileReader();
                    var oObject = $(this);
                    // Set preview image into the popover data-content
                    reader.onload = function (e) {
                        oObject.parent().children('.image-preview-input-title').text("Change");
                        oObject.parent().parent().children(".image-preview-clear").show();
                        oObject.parent().parent().parent().children(".image-preview-filename").val(file.name);
                        attachment.attr('src', e.target.result);
                        oObject.parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");
                    }
                    reader.readAsDataURL(file);
                }

            });
        });


    </script>
@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}