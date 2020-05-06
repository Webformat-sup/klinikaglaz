/* Add here all your JS customizations */

$(document).mouseleave(function(e){
function getWindowClose(){
	if (!$.cookie('smartCookies')) { 
		 if (e.clientY < 10) {	
			$('#dialog').jqm();	
		    $('#dialog').jqmShow();
		     $.cookie('smartCookies', true, {
				        expires: 1, 
				        path: '/'
				      });
		 }
	}
}
 setTimeout (getWindowClose, 1000);
})	
$(document).ready(function() {
	/*------цели яндекс------*/
	    //     “Задать вопрос” в шапке основного сайта
        $('header .questionTitle').on('click', function(){
            ym(30339732, 'reachGoal', 'ask-question');
        });

        // “Заказать обратный звонок”  шапке основного сайта
        $('header .callbackTitle').on('click', function(){
            ym(30339732, 'reachGoal', 'request-call-back');
        });
    /*------цели яндекс------*/

	function getWindow(){
		if (!$.cookie('smartCookies')) { 
		$('#dialog').jqm();	
		$('#dialog').jqmShow();

	    $.cookie('smartCookies', true, {
	        expires: 1, 
	        path: '/'
	      });
		}
	};
	 
	setTimeout (getWindow, 20000);
	$('.imgchat').click(function(){
		$('.b24-widget-button-openline_livechat span').trigger("click");	

	})




	$('a.section').click(function(e){
		var id = $(this).attr("href");
		console.log(id);
		destination = $('a'+id+'').offset().top-100;
		$('body').animate({
		scrollTop: destination}, 200);
	})

	var anchor = window.location.hash;
	destination = $('a'+anchor+'').offset().top-100;
	$('body').animate({
	scrollTop: destination}, 200);
	
	/*$(".item.review .text").each(function() {
		  console.log($(this).height());
		});*/
	


})

$(window).load(function(){
	/* $('.item.review .text').readmore({
		 collapsedHeight:207,
		 heightMargin:16,
	 });*/
	
	$(".item.review .text").each(function(index, element) {
	  //console.log($(element).outerHeight());		
		$(element).readmore({
				 collapsedHeight:207,
				 heightMargin:16,
				 moreLink: '<a href="#">Читать далее</a>', //ссылка "Читать далее", можно переименовать
				 lessLink: '<a href="#">Скрыть</a>' //ссылка "Скрыть", можно переименовать
		})
	});
	
	
})
