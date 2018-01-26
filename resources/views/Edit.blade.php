@extends('layout')

@section('title','Chỉnh sửa bài đăng')

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
        {{-- using route(route_name,params) when method post with params  --}}
        <form id="frm_edit" method="POST" action="{{ route('edit.route',$aFrontend['aTopic']['topic_id']) }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div style="margin-bottom: 15px;">
                <div><b>Tiêu đề </b>:</div>
                <input type="text" name="val[name]" id="name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;"  placeholder="Bạn đang bán gì ?" value="{{ $aFrontend['aTopic']['title'] }}" class="check-special-characters">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    * Nội dung chứa ký tự không được phép. Vui lòng thay đổi !!!
                </div>
            </div>

            <div>
                <div><b>Chọn Danh mục</b> :</div>
                <select id="category" class="form-control" name="val[category]">
                    @if(!empty($aFrontend['aCategories']))
                        @foreach($aFrontend['aCategories'] as $aCategory)
                            @if((int)$aCategory['category_id'] === $aFrontend['aTopic']['category_id'])
                                <option value="{{ $aCategory['category_id'] }}" selected>{{ $aCategory['title'] }}</option>
                            @else
                                <option value="{{ $aCategory['category_id'] }}">{{ $aCategory['title'] }}</option>
                            @endif

                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <div><b>Chọn tiền tệ</b> :</div>
                <select id="currency" class="form-control" name="val[currency]">
                    @if(!empty($aFrontend['aCurrencies']))
                        @foreach($aFrontend['aCurrencies'] as $aCurrency)
                            @if((int)$aCurrency['currency_id'] === $aFrontend['aTopic']['currency'])
                                <option value="{{ $aCurrency['currency_id'] }}" selected>{{ $aCurrency['title'] }}</option>
                            @else
                                <option value="{{ $aCurrency['currency_id'] }}">{{ $aCurrency['title'] }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

            <div>
                <div><b>Giá tiền </b>:</div>
                <input type="text" name="val[price]" id="price" class="form-control check-special-characters"  placeholder="Giá tiền" value="{{ $aFrontend['aTopic']['price'] }}">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    * Nội dung chứa ký tự không được phép. Vui lòng thay đổi !!!
                </div>
            </div>

            <div>
                <div><b>Mô tả sản phẩm </b>:</div>
                <input type="text" name="val[description]" id="description" class="form-control check-special-characters"  placeholder="Mô tả sản phẩm" value="{{ $aFrontend['aTopic']['description'] }}">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    * Nội dung chứa ký tự không được phép. Vui lòng thay đổi !!!
                </div>
            </div>

            <div>
                <div><b>Địa chỉ </b>:</div>
                <input type="text" name="val[address]" id="address" class="form-control check-special-characters"  placeholder="Địa chỉ" value="{{ $aFrontend['aTopic']['address'] }}">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    * Nội dung chứa ký tự không được phép. Vui lòng thay đổi !!!
                </div>
            </div>

            <div>
                <div><b>Số điện thọai </b>:</div>
                <input type="text" name="val[phone]" id="phone" class="form-control check-special-characters"  placeholder="Số điện thoại" value="{{ $aFrontend['aTopic']['phone'] }}">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    * Nội dung chứa ký tự không được phép. Vui lòng thay đổi !!!
                </div>
            </div>

            <div class="attachments">
                <div><b>Đính kèm file (tối đa 4 files - mỗi file tối đa 5MB)</b>:</div>
                <div class="attachment-list col-md-12 col-sm-12" style="padding-left: 0; padding-right: 0;">
                    @foreach($aFrontend['aTopic']['attachment'] as $iKey => $aAttachment)
                        <div class="item col-md-12" data-id="{{ (int)$iKey + 1 }}" style="padding-left: 0; padding-right: 0; margin-bottom: 15px;" id="item_{{ (int)$iKey + 1 }}">
                            <div class="input-group image-preview" style="margin-bottom: 15px;position: relative; width: 35%;">
                                <input type="hidden" value="{{ $aAttachment['attachment_id'] }}" name="val[attachment][]" id="attachment">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled" value="{{ $aAttachment['name'] }}.{{ $aAttachment['type'] }}">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default image-preview-button" style="display:none;margin-top: 10px;height: 40px;border-radius: 0">
                                        <span class="glyphicon glyphicon-eye-open" style="top: 2px;"></span> Preview
                                    </button>
                                    <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;border-radius: 0">
                                        <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                                        <span class="image-preview-input-title">Browse</span>
                                        <input type="file" accept="image/*, video/mp4" name="file[]" style="height: 40px" /> <!-- rename it -->
                                    </div>

                                </span>
                                <div class="remove-attachment" style="position: absolute;top: 20px;left: 425px;@if((int)$iKey === 0)display: none; @endif cursor: pointer;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 22px"></i></div>

                            </div>
                            <div class="col-md-4 col-sm-4 preview-file" style="padding-left: 0;height: auto;width: 100%;padding-top: 10px;padding-right: 0;">
                                @if($aAttachment['type'] === 'mp4')
                                    <video id="video" controls="controls" style="width: 35%;">
                                        <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
                                        <source src="{{ asset($aAttachment['path']) }}" type="video/mp4" >
                                    </video>
                                @else
                                    <img src="{{ asset($aAttachment['path']) }}" style="width: 400px">
                                @endif
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
            <div class="add-attachment-button col-md-12" style="padding-left: 0;cursor: pointer;margin-bottom: 15px;margin-top: 15px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 18px;"></i></div>


            <div class="col-md-12" style="padding-left: 0;">
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
                if($('.attachments .attachment-list .item').length + 1  <= 4)
                {
                    /* var oAttachment = $('.attachments .attachment-list .item:first').clone(true,true);
                     oAttachment.children().find('.remove-attachment').css('display','block');
                     oAttachment.attr('data-id',$('.attachments .attachment-list .item').length + 1);


                     oAttachment.children().children('.image-preview-filename').val("");
                     oAttachment.attr('data-content','');
                     oAttachment.children().children('.input-group-btn').children('.image-preview-input input:file').val("");
                     oAttachment.children('.image-preview').children('.input-group-btn').children('.image-preview-button').css('display','none');
                     oAttachment.children().children('.input-group-btn').children().children(".image-preview-input-title").text("Browse");*/

                    var oClone = '<div class="item col-md-12" data-id="'+($(".attachments .attachment-list .item").length + 1)+'" style="padding-left: 0; padding-right: 0; margin-bottom: 15px;" id="item_1"> <div class="input-group image-preview" style="margin-bottom: 15px;position: relative; width: 35%;"> <input type="text" class="form-control image-preview-filename" disabled="disabled"> <span class="input-group-btn"> <button type="button" class="btn btn-default image-preview-button" style="display:none;margin-top: 10px;height: 40px;border-radius: 0"> <span class="glyphicon glyphicon-eye-open" style="top: 2px;"></span> Preview </button> <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;border-radius: 0"> <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span> <span class="image-preview-input-title">Browse</span> <input type="file" accept="image/*, video/mp4" name="file[]" style="height: 40px"/> </div> </span> <div class="remove-attachment" style="position: absolute;top: 20px;left: 425px;cursor: pointer;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 22px"></i></div> </div> <div class="col-md-4 preview-file" style="padding-left: 0;height: auto;width: 35%;display: none;padding-top: 10px;padding-right: 0;"> </div> </div>';
                    $('.attachments .attachment-list').append(oClone);
                }

            });
            $('.attachments').on('click','.image-preview-button',function(){
                $(this).parent().parent().parent().popover('show');
            });
            $('.attachments').on('click','.remove-attachment',function(){

                $(this).parent().parent().remove();
            });

            //*************************** preview with div ******************************

            /* $(".attachments .attachment-list .item .image-preview ").on('change','input:file',function (){
             var url = (URL || webkit).createObjectURL(this.files[0]);
             var file = this.files[0];
             var file_type = file.type;
             var attachment = '';
             if(file_type.indexOf('video/mp4') != -1)
             {
             attachment = $('<video/>', {
             id: 'dynamic-attachment',
             height: '100%',
             width: '100%',
             controls: true,
             controlsList: "nodownload"
             });
             }
             else if(file_type.indexOf('image/') != -1)
             {
             attachment = $('<img/>', {
             id: 'dynamic-attachment',
             height: 300,
             width: '100%'
             });
             }
             if(attachment)
             {
             var oObject = $(this);
             oObject.parent().children('.image-preview-input-title').text("Change");
             oObject.parent().parent().parent().children(".image-preview-filename").val(file.name);
             attachment.attr('src', url);

             oObject.parents('.item').children('.preview-file').html($(attachment)[0].outerHTML);
             oObject.parents('.item').children('.preview-file').fadeIn(2000);
             }

             });*/

            //***********************************************************

            $('.check-special-characters').each(function() {
                $mainElement = $(this);
                // return a function that executes instead of type code directly to function (can't work)
                $mainElement.on('input',function($mainElement) {
                    return function() {
                        var checkSpecialCharacter = /[~`!#$%\^&*+=\\[\]\\';.,{}|?_@":<>]/g.test($mainElement.val());
                        if(checkSpecialCharacter)
                        {

                            $mainElement.parent().children('.warning').show();
                        }
                        else
                        {
                            $mainElement.parent().children('.warning').hide();
                        }

                    }
                }($mainElement));
            });


            /*$('form').one('submit',function (e) {
                e.preventDefault();
                var count = 0 ;
                $('.check-special-characters').each(function() {
                    $mainElement = $(this);
                    var checkSpecialCharacter = /[~`!#$%\^&*+=\\[\]\\';.,{}|?_":<>]/g.test($mainElement.val());
                    if(checkSpecialCharacter)
                    {
                        console.log($(this));
                        count++;
                    }
                });
                console.log(count);
                if(count === 0)
                {
                    console.log('yes');
                    $(this).submit();
                }
            });*/




        });


        //*************************** preview with popup ******************************

        $(document).on('click', '#close-preview', function(){
            var oAttachmentFile = $('.item:nth-child('+$(this).data('id')+')');
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


        // Create the close button


        // Create the preview image
        $(document).on('change','input:file',function (){
            $(this).parents('.item').children('.preview-file').hide();
            $(this).parents('.image-preview').children('#attachment').val('');
            var closebtn = $('<button/>', {
                type:"button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;'

            });
            closebtn.attr("class","close pull-right");
            closebtn.attr("data-id",$(this).parent().parent().parent().parent().attr('data-id'));
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
            if(file_type.indexOf('video/mp4') != -1)
            {
                attachment = $('<video/>', {
                    id: 'dynamic-attachment',
                    height: '100%',
                    width: '100%',
                    controls: true,
                    controlsList: "nodownload"
                });
            }
            else if(file_type.indexOf('image/') != -1)
            {
                attachment = $('<img/>', {
                    id: 'dynamic-attachment',
                    height: '100%',
                    width: '100%'
                });
            }
            if(attachment)
            {
                var oObject = $(this);
                oObject.parent().children('.image-preview-input-title').text("Change");
                oObject.parent().parent().parent().children(".image-preview-filename").val(file.name);
                attachment.attr('src', url);

                /*oObject.parents('.item').children('.preview-file').html($(attachment)[0].outerHTML);
                 oObject.parents('.item').children('.preview-file').fadeIn(2000);*/
                console.log(oObject.parent().parent().parent().parent().data('id'));
                oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");

            }

        });



    </script>
@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}