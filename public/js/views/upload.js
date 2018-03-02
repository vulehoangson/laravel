$(document).ready(function () {
    var bError=parseInt($('#error').val());
    var bSuccess=parseInt($('#success').val());

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
    $('.check-special-characters').each(function() {
        $mainElement = $(this);
        // return a function that executes instead of type code directly to function (can't work)
        $mainElement.on('input',function($mainElement) {
            return function() {
                var checkSpecialCharacter = /[~`!#$%\^&*+=\\[\]\\';{}|?_@":<>]/g.test($mainElement.val());
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
});

//*************************** preview with popup ******************************
$(document).on('click', '#close-preview', function(){
    var oAttachmentFile = $('.item:nth-child('+$(this).data('id')+')');
    oAttachmentFile.popover('hide');
});
// Create the preview image
$(document).on('change','input:file',function (){
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
        oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");
    }
});