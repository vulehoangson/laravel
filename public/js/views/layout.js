$(document).ready(function(){
    //------------header.blade.php----------------------
    var login = $('#login_url').val();
    var signup= $('#signup_url').val();
    var change_language_url = $('#changelanguage_url').val();
    var token_check = $('#csrf_token').val();
    $('#login').click(function(){
        window.location.href=login;
    });
    $('#signup').click(function(){
        window.location.href=signup;
    });
    $('.setting-button').click(function(){
        $('.setting-option').toggleClass('hide');
    });
    $('.change-language').click(function () {
        var sLanguage = $(this).data('language');
        console.log(sLanguage);
        $.ajax({
            type: "POST",
            url: change_language_url,
            data: {
                language: sLanguage,
                _token : token_check
            },
            success: function(){
                window.location.reload();
            }
        });
    });
    //----------------end header.blade.php------------------------


});