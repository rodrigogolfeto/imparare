$(function(){

    var SPMaskBehavior = function (val) { return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009'; }, spOptions = { onKeyPress: function(val, e, field, options) { field.mask(SPMaskBehavior.apply({}, arguments), options); }};
    $('.telefone').mask(SPMaskBehavior, spOptions);

    $('.btn-menu').on('click', function(){
        const controle = $('.topo').hasClass('aberto');
        if (controle) {
            $('.topo').removeClass('aberto');
        } else {
            $('.topo').addClass('aberto');
        }
    });
    
    $('.btn-menu, .menu').click(function(event) { 
        event.stopPropagation(); 
    }); 
    $('body').click(function() { 
        $('.topo').removeClass('aberto');         
    });

});

function goTo(classe) {
    $('html, body').animate({ scrollTop: $('.'+classe).offset().top }, 200);
}

function IsEmail(email){var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;var check=/@[\w\-]+\./;var checkend=/\.[a-zA-Z]{2,3}$/;if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}else {return true;}}