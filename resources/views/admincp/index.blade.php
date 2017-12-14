@extends('layout')

@section('title','AdminCP')

@section('content')
    <style rel="stylesheet">
        .option
        {
            height: 1000px;
        }
        .admincp-index .option ul
        {
            padding: 15px 5px;
            list-style: none;
        }

        .admincp-index .option ul li
        {
            margin-bottom: 5px;
            padding: 10px 0;
        }
        .admincp-index .option ul li a
        {
            color: #dddddd;
            text-decoration: none;
        }
        .container
        {
            padding: 0 !important;
            margin-left: unset !important;
            width: 100% ;
            min-height: 1000px;
        }
        .active
        {
            display: block;
        }
        .hide
        {
            display: none;
        }
        .tab-content
        {
            background-color: #fafafa;
            padding: 15px 15px 15px 100px;
            height: 1000px;
            overflow: auto;
        }
        .content
        {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .item a
        {
            text-decoration: none;
            word-break: keep-all;
            word-wrap: break-word;
        }
        .white-popup {
            position: relative;
            background: #FFF;
            padding: 20px;
            width:auto;
            max-width: 500px;
            margin: 20px auto;
        }
    </style>
    <div class="admincp-index">
        <div class="option col-md-2" style="background: #0c0c0c;text-align: left;">
            <ul>
                <li>
                    <a href="javascript:void(0)" data-tab="tab-1">DashBoard</a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-tab="tab-2">Danh Sách Chờ Duyệt</a>
                </li>
            </ul>
        </div>
        <div class="content col-md-10">
            <div id="tab-1" style="width: 100%" class="tab-content">

            </div>
            <div id="tab-2" style="width: 100%;" class="tab-content hide">
                <h1 style="text-align: center">Danh sách Topic chờ duyệt</h1>
                <div class="list col-md-12" style="padding: 0  30px">

                    @foreach($aFrontend['aTopics'] as $aTopic)
                    <div class="col-md-6 item" style="padding: 0px 0 20px 5px !important;  border: 1px solid #e5e5e5; width: 45%;margin-right: 20px;margin-bottom: 20px;">
                        <div class="title" style="height: auto; color: #808080; margin-bottom: 10px; padding: 0 10px;">
                            <a href=""><h2>{{ $aTopic['title'] }}</h2></a>
                        </div>
                        <div class="description" style="padding: 0 10px;margin-bottom: 15px;">
                            <h4>{{ $aTopic['description'] }}</h4>
                        </div>
                        <div class="approve-remove" style="padding: 0 10px;">
                            <button class="btn btn-success approve" style="margin-right: 20px;" data-id="{{ $aTopic['topic_id'] }}">Chấp nhận</button>
                            <button class="btn btn-danger remove" data-id="{{ $aTopic['topic_id'] }}">Xóa</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var approve_url= "{{ asset('topic/approve') }}";
        var token_check = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.option ul li a').click(function(){
                var tab=$(this).data('tab');
                $('.tab-content').addClass('hide');
                $('#'+ tab).removeClass('hide');
            });

            $('.admincp-index').on('click','.approve',function(){
                var iId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '/topic/approve',
                    data: {
                        id : iId,
                        _token : token_check
                    },
                    success: function(e) {
                        var oOutput = $.parseJSON(e);
                        if(oOutput.status)
                        {
                            $.magnificPopup.open({
                                items: {
                                    src: '<div class="white-popup">Topic đã được duyệt</div>',
                                    type: 'inline'
                                },
                                closeBtnInside: true
                            });

                            $('.admincp-index .content #tab-2 .list').html(oOutput.sHtml);

                            setTimeout(function () {
                                $.magnificPopup.close();

                            },1000);
                        }
                    }
                });
            });

            $('.admincp-index').on('click','.remove',function(){
                var iId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: '/topic/remove',
                    data: {
                        id : iId,
                        _token : token_check
                    },
                    success: function(e) {
                        var oOutput = $.parseJSON(e);
                        if(oOutput.status)
                        {
                            $.magnificPopup.open({
                                items: {
                                    src: '<div class="white-popup">Topic đã được bỏ qua</div>',
                                    type: 'inline'
                                },
                                closeBtnInside: true
                            });

                            if(oOutput.sHtml)
                            {
                                $('.content #tab-2 .list').html(oOutput.sHtml);
                            }

                            setTimeout(function () {
                                $.magnificPopup.close();
                            },1000);
                        }
                    }
                });
            });
        });
    </script>


@endsection