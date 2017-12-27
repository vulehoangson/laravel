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

    </style>
    <div class="search-result">
        <div class="search">
            <h2>Tìm kiếm sản phẩm</h2>
            <form id="form_search" method="POST" action="{{ action('Topic\SearchController@process') }}">
                {!! csrf_field() !!}
                <div class="box-search" style="position: relative;">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm sản phẩm..." style="height: 60px;display: inline-block;width: 95%">
                    <button type="submit" id="submit_header" style="display: inline-block;width: 60px;border: none;height: 60px;background-color: #ce1126;position: absolute;font-size: 26px;top: 10px;">
                        <i class="fa fa-search" style="color: #ffffff"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="result">
            <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
                <h3>Có <b>20</b> sản phẩm thỏa điều kiện tìm kiếm</h3>
            </div>


            <div class="list" >
                @if(!empty($aFrontend['aTopics']))
                    @foreach($aFrontend['aTopics'] as $iKey => $aTopic)

                        <div class="col-md-12 item" style="padding: 20px 0;">
                            <div class="col-md-2 image">
                                <img src="{{ asset('images/forever.jpg') }}" style="height: 110px; width: 110px">
                            </div>
                            <div class="content col-md-7">
                                <div style="font-size: 20px;margin-bottom: 5px;color: #196c4b"><a href="javascript:void(0)" style="text-decoration: none;">{{ $aTopic['topic_title'] }}</a> </div>
                                <div style="font-size: 17px;margin-bottom: 25px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                <div style="font-size: 17px; margin-bottom: 5px;">Đăng lúc <b>{{ $aTopic['time_stamp'] }}</b></div>
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
            $('#search').autocomplete({
                minLength: 0,
                source: function(request,response){
                    var key=$('#search').val();
                    $.ajax({
                        type: "GET",
                        url: '/suggestion',
                        data: {
                            key : key,
                        },
                        success: function(e) {
                            var oOutput = $.parseJSON(e);
                            if(oOutput.status)
                            {
                                response(oOutput.data);
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