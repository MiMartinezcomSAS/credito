
$(function () {
});

$('#buttonMenu').on('click',function(){
    var $headerNav = $('.Header-nav'),
        $el = $(this);
    if($headerNav.hasClass('show--element')){
        $el.removeClass('is-show');
        $headerNav.removeClass('show--element');

    }else{
        $el.addClass('is-show');
        $headerNav.addClass('show--element');
    }
});
$('.u-button').on('click', expand);

function expand(e){
    circle = $("<div class='u-circle'></div>");
    $(this).append(circle);
    x = e.pageX - $(this).offset().left - circle.width() / 2;
    y = e.pageY - $(this).offset().top - circle.height() / 2;
    size = $(this).width();
    circle.css({
        top: y + 'px',
        left: x + 'px',
        width: size + 'px',
        height: size + 'px'
    }).addClass("is-animate");
    setTimeout(function() {
        circle.remove();
    }, 500);

}
$('#loginForm').on('submit',function(e){
    if($(this).hasClass('justMail')){
        e.preventDefault();
        var fields = {'email' : $("input[name='email']").val()};
        $('.u-loader').addClass('show');
        $.post($('#Remember').attr('href'), fields, resetPassword, 'json')
    }

});
$('#Remember').on('click',function(e){
    e.preventDefault();
    var $form = $('#loginForm'),$signUp = $('#signUpButton');
    if($form.hasClass('justMail')){
        $form.removeClass('justMail');
        $signUp.text('Ingresar');
        $(this).text('Olvidaste la contraseña?')
    }else{
        $form.addClass('justMail');
        $signUp.text('Restaurar  contraseña');
        $(this).text('Volver a iniciar sesión')
    }

});
function resetPassword(e){
    var $noty = $('#notify');
    $('#notify').removeClass('success error is-show');
    $('.u-loader').removeClass('is-show');
    if(e.success){
        $noty.addClass('success is-show');
        $noty.find('.text-notify').text('Se envío correctamenta la contraseña al E-mail');

    }else{
        $('#notify').addClass('error is-show');
        $noty.find('.text-notify').text('Email no valido');
    }
}
$('.close-notify').on('click',function(){
    $('#notify').removeClass('success is-show');
})
