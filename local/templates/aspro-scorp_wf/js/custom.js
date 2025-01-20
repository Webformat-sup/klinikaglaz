/* Add here all your JS customizations */
var funcDefined = function(func){
	try
	{
		if(typeof func == 'function')
			return true;
		else
			return typeof window[func] === "function";
	}
	catch (e)
	{
		return false;
	}
}



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
	$('body').bind("contextmenu", function(e) {
		e.preventDefault();
	});
	/*------открыть формы------*/
	var hash = window.location.hash;
	if(hash != ''){
		switch(hash){
			case '#callback':
				setTimeout(() =>$('callbackTitle span').trigger('click'), 3000);
				break;
			case '#question':
				setTimeout(() =>$('questionTitle span').trigger('click'), 3000);
				break;
			case '#appointment':
				setTimeout(() => $('div.questiondockTitle span').trigger('click'), 3000);
				break;
		}
	}

    $('a[href*="#appointment"]').on('click', function(){
        console.log('appointment ref clicked');
        $('div.questiondockTitle span').trigger('click')
        return false;
    });
	/*------открыть формы------*/

	/*------цели яндекс------*/
	    //     “Задать вопрос” в шапке основного сайта
        $('header .questionTitle').on('click', function(){

			try {
				ym(30339732, 'reachGoal', 'ask-question');
			} catch(e) {
				console.log('Ошибка ' + e.name + ":" + e.message + "\n" + e.stack);
			}
        });

        // “Заказать обратный звонок”  шапке основного сайта
        $('header .callbackTitle').on('click', function(){
			try {
				ym(30339732, 'reachGoal', 'request-call-back');
			} catch(e) {
				console.log('Ошибка ' + e.name + ":" + e.message + "\n" + e.stack);
			}
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
		console.log('id',id);
		destination = $('a'+id+'').offset().top-100;
		$('body').animate({
		scrollTop: destination}, 200);
	})

	var anchor = window.location.hash;
	if($('a'+anchor+'').length > 0){
		destination = $('a'+anchor+'').offset().top-100;
		$('body').animate({
		scrollTop: destination}, 200);
	}


	/*$(".item.review .text").each(function() {
		  console.log($(this).height());
		});*/



})

$(document).ready(function(){
	setTimeout(function() {
		$(".item.review .text").each(function(index, element) {
	  	  $(element).readmore({
	  			   collapsedHeight:207,
	  			   heightMargin:18,
	  			   moreLink: '<a href="#">Читать далее</a>', //ссылка "Читать далее", можно переименовать
	  			   lessLink: '<a href="#">Скрыть</a>' //ссылка "Скрыть", можно переименовать
	  	  })
	    });
	}, 500);


	/*$(".item.review .it .text").each(function(index, element) {
		$(element).readmore({
				 collapsedHeight:207,
				 heightMargin:18,
				 moreLink: '<a href="#">Читать далее</a>', //ссылка "Читать далее", можно переименовать
				 lessLink: '<a href="#">Скрыть</a>' //ссылка "Скрыть", можно переименовать
		})
	});	*/


})


//таймер с обратным отсчетом
/*countdown start*/
if(!funcDefined('initCountdown')){
	var initCountdown = function initCountdown(){
		if( $('.view_sale_block').size() ){
			$('.view_sale_block').each(function(){
				var activeTo=$(this).find('.active_to').text(),
					dateTo= new Date(activeTo.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
				$(this).find('.countdown').countdown({until: dateTo, format: 'dHM', padZeroes: true, layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span>'}, $.countdown.regionalOptions['ru']);
			})
		}
	}
}

if(!funcDefined('initCountdownSecond')){
	var initCountdownSecond = function initCountdownSecond(){
		if( $('.view_sale_block').size() ){
			$('.view_sale_block').each(function(){
				var activeTo=$(this).find('.active_to').text(),
					dateTo= new Date(activeTo.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
				$(this).find('.countdown').countdown({until: dateTo, format: 'dHMS', padZeroes: true, layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span> <span class="sec item">{snn}<div class="text">{sl}</div></span>'}, $.countdown.regionalOptions['ru']);
			})
		}
	}
}

if(!funcDefined('initCountdownTime')){
	var initCountdownTime = function initCountdownTime(block, time){
		if(time)
		{
			var dateTo= new Date(time.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
			block.find('.countdown').countdown('destroy');
			block.find('.countdown').countdown({until: dateTo, format: 'dHMS', padZeroes: true, layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span> <span class="sec item">{snn}<div class="text">{sl}</div></span>'}, $.countdown.regionalOptions['ru']);
			block.find('.view_sale_block').show();
		}
		else
		{
			block.find('.view_sale_block').hide();
		}
	}
}

/*countdown end*/
