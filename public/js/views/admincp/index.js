$(document).ready(function(){
    var approve_url= $('#approve_url').val();
    var token_check = $('#csrf_token').val();

    $('.header-introduction').hide();
    $('.option ul li').click(function(){
        var tab=$(this).data('tab');
        $('.tab-content').addClass('hide');
        $('.option ul li').removeClass('selected');
        $('#'+ tab).removeClass('hide');
        $(this).addClass('selected');
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