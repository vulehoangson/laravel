@extends('layout')
@section('title','Tìm kiếm Topic')

@section('content')
    <style rel="stylesheet">
        .container
        {
            padding: 0 !important;
            margin-left: unset !important;
            width: 100% ;
            background-color: #f4f4f4;
        }
        .search-result
        {
            background-color: #fff;
            padding: 15px 20px 35px 20px;
            margin-right: auto;
            margin-left: auto;

        }
        .search-result .result .list:after
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
            .search-result {
                width: 750px;
            }
        }
        @media (min-width: 992px)
        {
            .search-result {
                width: 970px;
            }
        }
        @media (min-width: 1200px)
        {
            .search-result {
                width: 1170px;
            }
        }
        .search-result:after
        {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
    </style>
    <div class="search-result">
        <div class="search col-md-10 col-md-offset-1">
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
                    <div class=" col-md-12 menu" style="box-shadow: 1px 1px 4px #ccc;position: absolute; border-radius: 0;background-color: bisque;top: 83%;padding: 20px 90px; display: none;z-index: 1;">
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
                                    <input type="text" id="datefrom" name="datefrom" value="01-01-{{ (int)date('Y') }}" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-6" style="display: inline-block;padding-left: 0;padding-right: 0">
                                <div style="width: 33%;display: inline-block;">
                                    <h5 style="font-weight:400 ">Đến ngày: </h5>
                                </div>
                                <div style="width: 65%; display: inline-block">
                                    <input type="text" id="dateto" name="dateto" value="{{ date('d-m-Y') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class="result col-md-12">
            <div style="border-bottom: 1px solid #dddddd;margin: 40px 0 40px 0;"></div>

            <h3 style="margin-bottom: 35px;">Có <b>20</b> sản phẩm thỏa điều kiện tìm kiếm</h3>

            <div class="list" >
                @if(!empty($aFrontend['aTopics']))
                    @foreach($aFrontend['aTopics'] as $iKey => $aTopic)

                        <div class="col-md-12 item" style="padding: 20px 0;">
                            <div class="col-md-2 image">
                                <img src="{{ asset('images/forever.jpg') }}" style="height: 110px; width: 110px">
                            </div>
                            <div class="content col-md-7">
                                <div style="font-size: 18px;margin-bottom: 15px;color: #196c4b"><a href="javascript:void(0)" style="text-decoration: none;">{{ $aTopic['topic_title'] }}</a> </div>
                                <div style="font-size: 15px;margin-bottom: 5px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                <div style="font-size: 15px;margin-bottom: 5px">Danh mục: <b>{{ $aTopic['category_title'] }}</b></div>
                                <div style="font-size: 15px; margin-bottom: 5px;">Đăng lúc <b>{{ $aTopic['time_stamp'] }}</b></div>
                            </div>
                            <div class="user col-md-3" >
                                Đăng bởi <b>{{ $aTopic['username'] }}</b>
                            </div>
                            <div class="col-md-12" style="padding: 0 120px 0 15px;;margin-top: 20px;">
                                <div class="col-md-12" style="@if((int)$iKey < (int)(count($aFrontend['aTopics']) - 1) )border-bottom: 1px solid #dddddd;@endif">
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>

    </div>
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
            $('#datefrom').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});
            $('#dateto').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});
            $('#dropdown').click(function () {
                $('.menu').toggle();
            });
            $('#search').autocomplete({
                minLength: 0,
                source: function(request,response){
                    var key=$('#search').val();
                    var cat = $('#cat').val();
                    var datefrom = $('#datefrom').val();
                    var dateto = $('#dateto').val();
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
                    /* $( "#project" ).val( ui.item.label );
                     return false;*/
                },
                select: function(event, ui) {}
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li class='ui-menu-item'></li>" )
                        .data( "item.autocomplete", item )
                        .append('<div class="ui-menu-item-wrapper">'+item.label+'</div>')
                        .appendTo( ul );
            };
        });
    </script>

@endsection