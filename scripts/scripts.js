let baseurl = document.getElementById('baseurl').value;

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


function sendContact(e,i,o){
    
    e.preventDefault();
    $('input,button').attr('disable',true);

    $.ajax({
        type: "POST",
        data: $('#' + i).serialize(),
        url: baseurl + "action/contact.php",
        dataType: "json"
    }).done(function(data) {
        
        if(data.code == '200'){
            $('#input_argomento').val('');
            $('#input_nome').val('');
            $('#input_email').val('');
            $('#input_messaggio').val('');
            callbackAlert($('#contact-callack'),'success','Contatto inviato con successo!');
        } else if (data.code == '400'){
            callbackAlert($('#contact-callack'),'warning','Compila tutti i campi obbligatori.');
        } else {
            callbackAlert($('#contact-callack'),'warning','Impossibile inviare il contatto, riprova.');
        }

        $('input,button').attr('disable',false);

    }).fail(function(data) {
        callbackAlert($('#contact-callack'),'warning','Impossibile inviare il contatto, riprova.');
        $('input,button').attr('disable',false);
    });
}

function sendSottoscrizione(e,i,o){
    
    e.preventDefault();
    $('input,button').attr('disable',true);

    $.ajax({
        type: "POST",
        data: $('#' + i).serialize(),
        url: baseurl + "action/corsi.php",
        dataType: "json"
    }).done(function(data) {
        
        if(data.code == '200'){
            $('#sottoscrizione_nome').val('');
            $('#sottoscrizione_email').val('');
            $('#sottoscrizione_messaggio').val('');
            callbackAlert($('#sottoscrizione-callack'),'success','Applicazione inviata con successo!');
        } else if (data.code == '400'){
            callbackAlert($('#sottoscrizione-callack'),'warning','Compila tutti i campi obbligatori.');
        } else {
            callbackAlert($('#sottoscrizione-callack'),'warning','Impossibile inviare il contatto, riprova.');
        }

        $('input,button').attr('disable',false);

    }).fail(function(data) {
        callbackAlert($('#sottoscrizione-callack'),'warning','Impossibile inviare il contatto, riprova.');
        $('input,button').attr('disable',false);
    });
}


function callbackAlert(element,type,message){

    // type: primary, success, warning, danger
    // callbackAlert($('#contact-callack'),'danger','Não foi possível concluir operação, tente novamente!');

    let html = '';
    if (type=='primary') {
        html = `<div class="alert alert-primary d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#info-fill" /></svg><div class="line-height-120">${message}</div></div>`;
    } else if (type=='success') {
        html = `<div class="alert alert-success d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#check-circle-fill" /></svg><div class="line-height-120">${message}</div></div>`;
    } else if (type=='warning') {
        html = `<div class="alert alert-warning d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill" /></svg><div class="line-height-120">${message}</div></div>`;
    } else if (type=='danger') {
        html = `<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" width="24" height="24"><use xlink:href="#exclamation-triangle-fill" /></svg><div class="line-height-120">${message}</div></div>`;
    }

    element.attr('style','display:none');
    element.html(html).slideDown(300);
    setTimeout(() => {
        element.slideUp(300);
    }, 6000);
    
}

function IsEmail(email){var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;var check=/@[\w\-]+\./;var checkend=/\.[a-zA-Z]{2,3}$/;if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){return false;}else {return true;}}