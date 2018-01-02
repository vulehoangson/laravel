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
    </style>
    <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
        <h2>Tạo bài đăng</h2>
    </div>
    @if(!empty($aFrontend['error']))
        <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;display: none">
            {{$aFrontend['error']}}
        </div>
    @endif

    @if(!empty($aFrontend['success']))
        <div class="success" style="padding: 20px;color: white;background-color: #67b168;margin-bottom: 20px;display: none">
            {{$aFrontend['success']}}
        </div>
    @endif
    <div class="upload" style="padding-left: 15px;">
        <form method="POST" action="{{ action('Topic\UploadController@process') }}">
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


            <div class="input-group image-preview" style="width: 25%;margin-bottom: 20px;">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;margin-top: 10px;height: 40px;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;">
                        <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/> <!-- rename it -->
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]-->


            <div>
                <button class="btn btn-danger" id="submit" value="login">Tạo</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        var bError="{{ !empty($aFrontend['error']) ? $aFrontend['error'] : ''}}";
        var bSuccess="{{ !empty($aFrontend['success']) ? $aFrontend['success'] : ''}}";
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            /*if(bError)
            {
                $( "div.error" ).fadeIn( 500 ).delay( 1500 ).fadeOut( 500 );
            }
*/
            if(bSuccess)
            {
                $( "div.success" ).fadeIn( 500 ).delay( 1500 ).fadeOut( 500 );
            }
        });

        $(document).on('click', '#close-preview', function(){
            $('.image-preview').popover('hide');
            // Hover befor close the preview
            $('.image-preview').hover(
                    function () {
                        $('.image-preview').popover('show');
                    },
                    function () {
                        $('.image-preview').popover('hide');
                    }
            );
        });

        $(function() {
            // Create the close button
            var closebtn = $('<button/>', {
                type:"button",
                text: 'x',
                id: 'close-preview',
                style: 'font-size: initial;',
            });
            closebtn.attr("class","close pull-right");
            // Set the popover default content
            $('.image-preview').popover({
                trigger:'manual',
                html:true,
                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                content: "There's no image",
                placement:'bottom'
            });
            // Clear event
            $('.image-preview-clear').click(function(){
                $('.image-preview').attr("data-content","").popover('hide');
                $('.image-preview-filename').val("");
                $('.image-preview-clear').hide();
                $('.image-preview-input input:file').val("");
                $(".image-preview-input-title").text("Browse");
                $('.image-preview').css('width','25%');
            });
            // Create the preview image
            $(".image-preview-input input:file").change(function (){
                $('.image-preview').css('width','30%');
                var img = $('<img/>', {
                    id: 'dynamic',
                    width:250,
                    height:200
                });
                var file = this.files[0];
                var reader = new FileReader();
                // Set preview image into the popover data-content
                reader.onload = function (e) {
                    $(".image-preview-input-title").text("Change");
                    $(".image-preview-clear").show();
                    $(".image-preview-filename").val(file.name);
                    img.attr('src', e.target.result);
                    $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection

{{--https://bootsnipp.com/snippets/featured/input-file-popover-preview-image--}}