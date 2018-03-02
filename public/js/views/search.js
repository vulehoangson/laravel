$(document).ready(function(){
    var bLoadMore = false;
    var detail_url = $('#detail_url').val();
    var suggestion_url = $('#suggestion_url').val();
    var ajax_loader_image = $('#ajax_loader_image').val();
    var load_more_url = $('#load_more_url').val();
    var aParams = $('#json_param').val();
    $(window).scroll(function() {
        var scrollTop = parseInt($(window).scrollTop()) + parseInt($(window).height());
        var list = parseInt($('.search-result .result .list').height()) + parseInt($('.search-result .result .list').offset().top);
        if( (scrollTop  > list + 100) && !bLoadMore)
        {
            bLoadMore = true;
            var oImg = $('<img/>').attr('src',ajax_loader_image).attr('style','width: 30px; height: 30px; margin-left: 50%');
            $('.search-result .result .list').append(oImg);

            $.ajax({
                type: "GET",
                url: load_more_url,
                data: {
                    paging: parseInt($('.search-result .result .list').data('paging')) + 1,
                    params: aParams
                },
                success: function(response){
                    var oOutput = $.parseJSON(response);
                    if(oOutput.status)
                    {
                        $('.search-result .result .list').append(oOutput.data);
                        $('.search-result .result .list').data('paging',parseInt($('.search-result .result .list').data('paging')) + 1)
                        bLoadMore = false;
                    }

                    oImg.remove();
                }
            });
        }
    });
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
        dateFormat: "dd-mm-yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    };
    $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
    /*$('#datefrom').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});
     $('#dateto').datepicker({format: 'dd/mm/yyyy',showButtonPanel: true});*/
    $('#datefrom').datepicker();
    $('#dateto').datepicker();

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
                url: suggestion_url,
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
/*
$(document).click(function(e){
    if(e.target.id !='menu' && !$('#menu').find(e.target).length && e.target.id !='dropdown' )
    {
        $('#menu').hide();
    }
});*/
