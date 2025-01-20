$(function(){
    $('#main_content p, #main_content li').attr('tabindex', '0');
    $('#main_content li').has($('a')).attr('tabindex', '-1');
	$('#main_content .bx-components-menu li').attr('tabindex', '-1');
	$('#main_content .bx-components-menu li:first').attr('tabindex', '0');
    $('img').attr('tabindex', '0');
    $('#main_content h2, #main_content blockquote, #main_content td, #main_content th').attr('tabindex', '0');
    $('#main_content h3').attr('tabindex', '0');
	$('#main_content h1').attr('tabindex', '0');
    $('#complementary_content h2').attr('tabindex', '0');
    $('#complementary_content h3').attr('tabindex', '0');
    $('#main_content table').addClass('table');
    $('.wrapper-form-control input[type=text], .wrapper-form-control textarea, .wrapper-form-control select, .wrapper-form-control input[type=file]').addClass('form-control');
    var $img = $('img');

    var isIndexPage = false;
    if (location.pathname == '/' || location.pathname == '/index.html' || location.pathname == '/index.php') isIndexPage = true;
    var forms = document.querySelectorAll('form')
    
    for(i=0;i<$img.length;i++){
        if(!$img.eq(i).attr('alt')){
            $img.eq(i).attr('alt', 'Изображение №'+(i+1));
        }
    }    
    var $a = $('a');
    for(i=0;i<$a.length;i++){
        if(!$a.eq(i).attr('title')){
            $a.eq(i).attr('title', $a.eq(i).text());
        }
    }        
    if($('.alert-danger').is('div')){
		$.scrollTo($('.alert-danger'), 300, function(){
			$('.alert-danger').focus();
		});
	}
	if($('.alert-success').is('div')){
		$.scrollTo($('.alert-success'), 300, function(){
			$('.alert-success').focus();
		});
	}
    if (sessionStorage && !isIndexPage) {
        if(element = JSON.parse(sessionStorage.getItem(sessionStorage.length-1))) {
            let elementSelector = $(element.class + "[href='" + element.href + "']").selector;
            if(element.url == location.href && elementSelector) {
                $(elementSelector).focus();
                sessionStorage.removeItem(sessionStorage.length-1);
            } else if ($('h1.page-header')) {
                $('h1.page-header').focus()
            }
        } else if ($('h1.page-header' && !isIndexPage)) {
            $('only h1.page-header').focus()
        }
    } else if (isIndexPage) {
        sessionStorage.clear();
    }

    if (forms) {
        let form;
        for (let i = 0; i < forms.length; i++) {
            if (forms[i].id == "") {
                form = forms[i];
            }
        }

        if (form) {
            form.fields = form.querySelectorAll('.form-control[required]');
            for (let i = 0; i < form.fields.length; i++) {
                form.fields[i].removeAttribute('required');
            }
        }
    }
});

$(document)
    .on('click', '.go-top', function(){
        $.scrollTo('.panel-access', '100', function(){
            $('.panel-access button:first').focus();
        });               
    })        
    .on('submit', '#panel_auth_form .btn-resume', function () {
        $('#panel_auth_form').trigger('submit');
    })
    .on('submit', '#panel_auth_form', function () {
        $(this).ajaxSubmit({
            cache: false,
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function (data) {
                $('.help-block').attr('tabindex', '-1');
                if(data.status == 'success'){
                    $('.panel-auth').removeClass('error');
                    $('.panel-auth').addClass('success');
                    $('.help-block-success').text(data.message).attr('tabindex', '0');
                    //$('#panel_auth_form').css('display', 'none');
                }
                if(data.status == 'error'){
                    $('.panel-auth').removeClass('success');
                    $('.panel-auth').addClass('error');
                    $('.help-block-error').text(data.message).attr('tabindex', '0');
                }
            }
        });
        return false;
    })
    .on('click', '.btn-help-form:not(.active)', function(){
        $(this).parent().find('.alert-info').slideDown({
                duration: 'fast',
                complete: function(){     
                    $(this).trigger('focus');
                    // .attr('tabindex', '0');
                    $(this).parent().find('.btn-help-form:not(.active)').addClass('active');
                },
                start: function(){

                }
        });               
    })
    .on('click', '.btn-help-form.active', function(){
        $(this).parent().find('.alert-info').slideUp({
                duration: 'fast',
                complete: function(){  
                    // $(this).attr('tabindex', '-1');
                    $(this).parent().find('.btn-help-form.active').removeClass('active').trigger('focus');
                },
                start: function(){

                }
        });               
    })
    .on('keydown click', 'a', function(ev){
        let keycode = (ev.keyCode ? ev.keyCode : ev.which);
        if (keycode == 13 && ev.type == 'click' || keycode == 32 && ev.type == 'click' || ev.type == 'click') {
            let cls = makeClass(ev);
            let link = $(this).attr('href');
            let urlPath = location.href;
            let el = {'class' : cls,
                'href' : link,
                'url': urlPath};
            sessionStorage.setItem(sessionStorage.length, JSON.stringify(el));
        }
    });

function makeClass(el) {
    let elem = $(el)[0].target;
    let arCls = new Array;
    while (elem.tagName != "BODY") {
        arCls.push(makeSelector(elem));
        if (arCls[arCls.length - 1][0] == "#") break;
        elem = elem.parentElement;
    }
    let res = ''
    let i = arCls.length - 1;
    while (i > 0) {
        res += " " + arCls[i];
        i--;
    }
    res += ' A';
    return res;
}

function makeSelector(elem) {
    let selector = elem.id;
    if (!selector) {
        selector = elem.className;
        let arClass = selector.split(" ");
        arClass.forEach(function(value, index) {
            if (['open', 'active', 'hide', 'hidden', 'hover', 'menu-hover', 'menu-focus'].includes(value))
                arClass.splice(index);
        })
        if (arClass[0]) selector = '.' + arClass[0];
        else selector = elem.tagName;
    } else selector = '#' + selector;
    return selector;
}