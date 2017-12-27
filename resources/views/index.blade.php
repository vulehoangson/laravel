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


</style>
<div class="homepage" style="">
    <div class="search " style="padding: 0 15px;">

        <h2>Tìm kiếm sản phẩm</h2>
        <form id="form_search" method="POST" action="{{ action('Topic\SearchController@process') }}">
            {!! csrf_field() !!}
            <div class="box-search" style="position: relative;">
                <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm sản phẩm..." style="height: 60px;display: inline-block;width: 93%">
                <button type="submit" id="submit_header" style="display: inline-block;width: 60px;border: none;height: 60px;background-color: #ce1126;position: absolute;font-size: 26px;top: 10px;">
                    <i class="fa fa-search" style="color: #ffffff"></i>
                </button>
            </div>
        </form>


    </div>
    <div style="margin: 40px 0 35px 0; border-bottom: 1px solid #dddddd"></div>
    <div class="categories" style="margin-top: 20px;padding: 0 15px;">
        <h2>Danh mục sản phẩm</h2>
        <div class="list" >
            @if(!empty($aFrontend['aCategories']))
                @foreach($aFrontend['aCategories'] as $aCategory)
                    <div class="category" style="border: 1px solid #dddddd; margin-bottom: 20px;">
                        <div class="title form-control" style="background-color: #67b168;color: #ffffff;font-size: 20px;height: 50px;margin-top: 0; margin-bottom: 0">
                            {{ $aCategory['title'] }}
                        </div>
                        @if(!empty($aCategory['aTopics']))
                            @foreach($aCategory['aTopics'] as $aTopic)
                                <div class="col-md-12 item" style="border-bottom: 1px solid #dddddd;padding: 20px 0;">
                                    <div class="col-md-2 image">
                                        <img src="images/forever.jpg" style="height: 110px; width: 110px">
                                    </div>
                                    <div class="content col-md-7">
                                        <div style="font-size: 20px;margin-bottom: 5px;color: #196c4b"><a href="javascript:void(0)" style="text-decoration: none;">{{ $aTopic['title'] }}</a> </div>
                                        <div style="font-size: 17px;margin-bottom: 25px"><b>{{ $aTopic['price'] }}</b> {{ $aTopic['currency_title'] }}</div>
                                        <div style="font-size: 17px; margin-bottom: 5px;">Đăng lúc <b>{{ $aTopic['time_stamp'] }}</b></div>
                                    </div>
                                    <div class="user col-md-3" >
                                        Đăng bởi <b>{{ $aTopic['username'] }}</b>
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
