@extends('layout')

@section('title','Trang chủ')

@section('content')
<style rel="stylesheet">
    .container
    {
        padding: 0 !important;
        margin-left: unset !important;
        width: 100% ;
        background-color: #f4f4f4;
    }
    .homepage
    {
        background-color: #fff;
        padding: 15px 0 35px 0;
        margin-right: auto;
        margin-left: auto;

    }
    .homepage .categories .list .category:after
    {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }



    @media (min-width: 768px)
    {
        .homepage {
            width: 750px;
        }
    }
    @media (min-width: 992px)
    {
        .homepage {
            width: 970px;
        }
    }
    @media (min-width: 1200px)
    {
        .homepage {
            width: 1170px;
        }
    }
    .homepage:after
    {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }

</style>
<div class="homepage" style="">
    <div class="search col-md-10 col-md-offset-1" style="padding-right: 10px;">

        <h2 style="text-align: center">Tìm kiếm sản phẩm</h2>
        <form id="form_search" method="POST" action="{{ action('Topic\SearchController@process') }}">
            {!! csrf_field() !!}
            <div class="box-search" style="position: relative;">
                <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm sản phẩm..." style="height: 50px;display: inline-block;width: 90%">

                <button class="btn btn-success " type="button" id="dropdown"  style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                    <span class="caret"></span>
                </button>
                {{--<button type="submit" id="submit_header" style="display: inline-block;width: 50px;border: none;height: 50px;background-color: #ce1126;position: absolute;font-size: 26px;top: 10px;">
                    <i class="fa fa-search" style="color: #ffffff"></i>
                </button>--}}
                <button class="btn btn-primary" type="submit" id="submit_header" style="display: inline-block;width: 5%;height: 50px;border-radius: 0;margin-top: -2px;margin-left: -4px;">
                    <i class="fa fa-search" style="color: #ffffff"></i>
                </button>
                <div class="col-md-12 menu" id="menu" style="box-shadow: 1px 1px 4px #ccc;position: absolute; border-radius: 0;background-color: bisque;top: 83%;padding: 20px 90px; display: none;z-index: 1;">
                    <div class="col-md-12 category-selection" style="padding-left: 0; padding-right: 0">
                        <div style="width: 15%;display: inline-block;">
                            <h5 style="font-weight:400;">Danh mục: </h5>
                        </div>
                        <div style="width: 84%;display: inline-block;">
                            <select id="cat" name="cat" class="form-control" style="display: inline-block;">
                                <option value="0">Tất cả</option>
                                @if(!empty($aFrontend['aCategories']))
                                    @foreach($aFrontend['aCategories'] as $aCategory)
                                        <option value="{{ $aCategory['category_id'] }}">{{ $aCategory['title'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                    <div class="col-md-12 time-selection" style="padding-left: 0; padding-right: 0;">
                        <div class="col-md-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                            <div style="width: 30%;display: inline-block;">
                                <h5 style="font-weight:400 ">Từ ngày: </h5>
                            </div>
                            <div style="width: 65%; display: inline-block">
                                <input type="text" id="datefrom" name="datefrom" value="01/01/{{ (int)date('Y') }}" class="form-control">
                            </div>

                        </div>
                        <div class="col-md-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                            <div style="width: 33%;display: inline-block;">
                                <h5 style="font-weight:400 ">Đến ngày: </h5>
                            </div>
                            <div style="width: 65%; display: inline-block">
                                <input type="text" id="dateto" name="dateto" value="{{ date('m/d/Y') }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
    <div class="col-md-12" style="margin: 40px 0 35px 0; border-bottom: 1px solid #dddddd"></div>
    <div class="categories col-md-12" style="margin-top: 20px;padding: 0 15px;">
        <h2 style="text-align: center;">Danh mục sản phẩm</h2>
        <div class="list" >
            @if(!empty($aFrontend['aCategories']))
                @foreach($aFrontend['aCategories'] as $aCategory)
                    <div class="category" style="border: 1px solid #dddddd; margin-bottom: 20px;">
                        <div class="title form-control" style="background-color: #67b168;color: #ffffff;font-size: 20px;height: 50px;margin-top: 0; margin-bottom: 0">
                            {{ $aCategory['title'] }}
                        </div>
                        @if(!empty($aCategory['aTopics']))
                            @foreach($aCategory['aTopics'] as  $aTopic)
                                <div class="col-md-12 item" style="@if((int)$aTopic['stt'] < (int)(count($aCategory['aTopics']) - 1) ) border-bottom: 1px solid #dddddd; @endif padding: 20px 0;cursor: pointer;" data-id="{{ $aTopic['topic_id'] }}">
                                    <div class="col-md-2 col-sm-2 image">
                                        <img src="@if(!empty($aTopic['attachment_path'])) {{ asset($aTopic['attachment_path']) }} @else{{ asset('images/default_product.jpg') }}@endif" style="border: 1px solid #dddddd; height: 110px; width: 110px">
                                    </div>
                                    <div class="content col-md-7 col-sm-7">
                                        <div style="font-size: 19px;margin-bottom: 5px;color: #196c4b"><a href="{{ url('topic/detail/'.$aTopic['topic_id']) }}" style="text-decoration: none;">{{ $aTopic['title'] }}</a> </div>
                                        <div style="font-size: 16px;margin-bottom: 25px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                        <div style="font-size: 16px; margin-bottom: 5px;">Đăng lúc <b>{{ $aTopic['time_stamp'] }}</b></div>
                                    </div>
                                    <div class="user col-md-3 col-sm-3" >
                                        Đăng bởi <a href="{{ asset('profile/'.$aTopic['user_id']) }}" style="text-decoration: none;"><b>{{ $aTopic['full_name'] }}</b></a>
                                        @if((int)$aTopic['user_group'] === 1)
                                            <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 0;height: 12px;width: 17px;display: inline-block;"></div>
                                        @elseif((int)$aTopic['user_group'] === 2)
                                            <div style="background-image: url('{{ asset('images/superadmin.png') }}'); background-position: 0 -17px;height: 12px;width: 12px;display: inline-block;"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                @endforeach
            @endif
        </div>

    </div>
</div>
<script type="text/javascript">
    var detail_url = "{{ asset('topic/detail') }}";
</script>
<script type="text/javascript">

    $(document).ready(function(){
        $.datepicker.regional["vi-VN"] =
        {
            closeText: "Đóng",
            prevText: "Trước",
            nextText: "Sau",
            currentText: "Hôm nay",
            monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
            dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
            dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
            dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            weekHeader: "Tuần",
            dateFormat: "dd/mm/yy",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
        /*$('#datefrom').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});
        $('#dateto').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});*/
        $('#datefrom').datepicker({format: 'dd/mm/yyyy'});
        $('#dateto').datepicker({format: 'dd/mm/yyyy'});
        $('#dropdown').on('touchstart click',function (e) {
            e.preventDefault();
            $('#menu').toggle();
        });

        $('#search').on('input',function()
        {
            if($(this).val() !='')
            {
                $(this).css('border','1px solid #dddddd');
            }

        });
        $('#submit_header').click(function(event){
            var sString=$('#search').val();
            var checkSpecialCharacter = /[~`!#$%\^&*+=\-\[\]\\';.,/{}|?_":<>]/g.test(sString);
            if(sString=='') {
                event.preventDefault();
                $('#search').css("border", "5px solid orange");
            } else if(checkSpecialCharacter === true ) {
                event.preventDefault();
                $('#search').css("border", "5px solid orange");
            }
        });
        $('#search').keypress(function(e)
        {
            var sString=$(this).val();
            var checkSpecialCharacter = /[~`!#$%\^&*+=\-\[\]\\';.,/{}|?_":<>]/g.test(sString);
            if(e.which == 13) {
                if(sString=='') {
                    e.preventDefault();
                    $(this).css("border", "5px solid orange");
                } else if(checkSpecialCharacter === true) {
                    e.preventDefault();
                    $(this).css("border", "5px solid orange");
                }
            }
        });

        $('#search').autocomplete({
            minLength: 0,
            source: function(request,response){
                var key=$('#search').val();
                var cat = $('#cat').val();
                var datefrom = $('#datefrom').val();
                var dateto = $('#dateto').val();
                var checkSpecialCharacter = /[~`!#$%\^&*+=\-\[\]\\';.,/{}|?_":<>]/g.test(key);
                if(checkSpecialCharacter === true)
                {
                    response(null)
                    return false;
                }
                $.ajax({
                    type: "GET",
                    url: '/suggestion',
                    data: {
                        search : key,
                        cat : cat,
                        datefrom : datefrom,
                        dateto : dateto
                    },
                    success: function(e) {
                        var oOutput = $.parseJSON(e);
                        if(oOutput.status)
                        {
                            response(oOutput.data);
                        }
                        else
                        {
                            response(null);
                        }

                    }
                });
            },
            open: function() {},
            close: function() {},
            focus: function(event,ui) {
            },
            select: function(event, ui) {
                window.location.href = ui.item.url;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li class='ui-menu-item'></li>" )
                    .data( "item.autocomplete", item )
                    .append('<div class="ui-menu-item-wrapper">'+item.label+'</div>')
                    .appendTo( ul );
        };

        $('.item').click(function () {
           var id = $(this).data('id');
            window.location.href = detail_url+'/'+id;
        });
    });
    // hide menu when clicking outsite the menu. except the dropdown button
    /*$(document).click(function(e){
        if(e.target.id !='menu' && !$('#menu').find(e.target).length && e.target.id !='dropdown' )
        {
            $('#menu').hide();
        }
    });*/


</script>
@endsection
