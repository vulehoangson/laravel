//------ avatar --------------------
$(document).ready(function () {
    $('.content').on('click','.image-preview-button',function(){
        $(this).parent().parent().parent().popover('show');
    });
});
$(document).on('click', '#close-preview', function(){
    var oAttachmentFile = $('.avatar');
    oAttachmentFile.popover('hide');
});
$(document).on('change','input[name="file"]',function (){
    $(this).parents('.avatar').children('.preview-file').hide();
    $(this).parents('.image-preview').children('#attachment').val('');
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;'
    });
    closebtn.attr("class","close pull-right");
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
    attachment = $('<img/>', {
        id: 'dynamic-attachment',
        height: '100%',
        width: '100%'
    });

    if(attachment)
    {
        var oObject = $(this);
        oObject.parent().children('.image-preview-input-title').text("Change");
        oObject.parent().parent().parent().children(".image-preview-filename").val(file.name);
        attachment.attr('src', url);
        oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");
    }

});

//---- cover photo ---------------------

$(document).ready(function () {
    $('.content').on('click','.image-preview-button-cover',function(){
        $(this).parent().parent().parent().popover('show');
    });
});
$(document).on('click', '#close-preview-cover', function(){
    var oAttachmentFile = $('.cover-photo');
    oAttachmentFile.popover('hide');
});
$(document).on('change','input[name="coverphoto"]',function (){
    $(this).parents('.cover-photo').children('.preview-file').hide();
    $(this).parents('.image-preview').children('#attachment').val('');
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview-cover',
        style: 'font-size: initial;'
    });
    closebtn.attr("class","close pull-right");
    $(this).parent().parent().children('.image-preview-button-cover').show();
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

    attachment = $('<img/>', {
        id: 'dynamic-attachment-cover',
        height: '100%',
        width: '100%'
    });
    if(attachment)
    {
        var oObject = $(this);
        oObject.parent().children('.image-preview-input-title-cover').text("Change");
        oObject.parent().parent().parent().children(".image-preview-filename-cover").val(file.name);
        attachment.attr('src', url);
        oObject.parent().parent().parent().parent().attr("data-content",$(attachment)[0].outerHTML).popover("show");
    }
});