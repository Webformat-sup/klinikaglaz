// РћРїСЂРµРґРµР»СЏРµРј РїРµСЂРµРјРµРЅРЅСѓСЋ РґР»СЏ СЌРєРѕРЅРѕРјРёРё РїР°РјСЏС‚Рё.
var doc = $(document),
	menuTimer,
	touchStartPos;

$(document).ready(function () {
    if ($(".form-control-btn").length > 0) {
        $(".form-control-btn,.form-control").addClass("custom_style_bottom_menu");
        $(".form-control-btn,.form-control").find('a').addClass("btn");
    }
    if ($(".tts-tabs-switchers").length > 0) {
        $(".tts-tabs-switchers").addClass("style_mode_list").addClass("custom_mid_menu_style").addClass("custom_menu_position_flex").addClass("nav").addClass("navbar-nav").addClass("bx-components-menu");
        $('.tts-tabs-switchers li').each(function (i, xitem) {
            let item = $(xitem);
            let value = item.text();
            item.text("");
            item.html('<a style="text-decoration:none">' + value + '</a>');
        });
    }
    });

if (window.frameCacheVars !== undefined) {

	BX.addCustomEvent('onFrameDataReceived', mainJsFile);
} else {

	$(mainJsFile);
}

function mainJsFile() {

	var $firstSelect;

	$.tabsToSelect({
		selectCalss: 'styler',
		selectAppendTo: '.tts-tabs-switchers-wrapper',
		onInit: function () {
			
			$firstSelect = $('.tts-tabs-select:first');
		},
		onResized: function () {
		
			if ($firstSelect.is(':visible') && !$firstSelect.hasClass('refreshed')) {
				$('.tts-tabs-select').addClass('refreshed').trigger('refresh');
			}
		},
		beforeTabSwich: function (e) {
		
			var link = $(e.currentTarget).find('.tts-tabs-switcher').eq(e.tab).data('targetSelf');

			if (link) {
				location.href = link;
				return false;
			}
			return true;
		}
	}); 

	

	//popup authors, feedback page
	$('#popup').click(function(e) {
		e.preventDefault();
		$('.alert-success-form').show();
		$('html, body').animate({
	        scrollTop: $(".alert-success-form").offset().top
	    }, 2000);
	});
	$('#close-btn_authors').click(function() {
		$('.alert-success-form').hide();
	});


   $('.form-choise a').on('click', function(e) {
        e.preventDefault();
        $('.form-choise a.active').removeClass('active');
        $(this).addClass('active');
        var tab = $(this).attr('href');
        $('.form-choosen').not(tab).css({'display':'none'});
        $(tab).fadeIn(400);

        $('.form-choise input').val($(this).attr('value'));
    });

	$('.form-more-text').shorten({
		showChars: 180,
		moreText: ' ',
		lessText: ' ',
		onMore: function() {
			$('.morelink').text($('.more-text').attr('value'));
			$('.less').text($('.less-text').attr('value'));
		},
		onLess: function() {
			$('.morelink').text($('.more-text').attr('value'));
			$('.less').text($('.less-text').attr('value'));
		}
	});
	$('.morelink').text($('.more-text').attr('value'));
	$('.less').text($('.less-text').attr('value'));




    
    $('.form-add-author').on('click', function(e) {
        e.preventDefault();
	
	   $('.added-author:hidden').eq(0).show("slow");
	  
	   $('.added-author:hidden').length<1 ? $('.form-add-author').hide() : false;
	   $('.added-author:hidden').length<1 ? $('.btn-add-line').hide() : false;

	  
	   if ($('input[name="author_1_lastname"]').val() == "test"){
            $('.added-author:hidden').show("slow");
        }

	});

    $('.form-del-author').on('click', function(e) {
        e.preventDefault();
		$(this).parent().hide("slow" );
		$(this).parent().find('input').val('');
		$('.form-add-author').show();
		$('.btn-add-line').show();
	});	

	
	$('textarea.disablecopypaste').bind('copy paste', function (e) {
       e.preventDefault();
    });

	
	$('.styler').styler({
		selectSearch: true,
		selectSearchLimit: 20,
		onSelectOpened: function() {
			$(this).find('ul').perfectScrollbar();
		},
		onFormStyled: function () {
			$('.jq-selectbox').addClass('opacity-one');
		}
	});

}

    $(document).on('change', 'input[type="checkbox"]', function() {
	    if(this.checked) {
	       $(this).attr("checked", true);
	    }else {          
           $(this).attr("checked", false);
        }
	});

   	$(document).on('click', '.delete-upload', function() {
		$(this).parent().find('.filename').removeClass('show-upload').text('');
		$(this).parent().find( ".delete-upload" ).removeClass('show-upload');
		    return false;
	});	

	count=0;
	$(document).on('click', "#load", function(){
		count++; 
		$("div.file-block").prepend("<div class='file-line hidden'><span class='filename show-upload span"+count+"'>...</span><input type='file' name='file[]' class='class"+count+"' style='display: none;'><p class='delete-upload del show-upload'></p></div>");

		$(".class"+count+"").trigger('click');		
		$(".class"+count+"").change(function(){
		    var filename = $(this).val().replace(/.*\\/, "");	

		    if (filename != '') {
			   $(this).parent().removeClass('hidden');
			   $("div.file-block .file-line .filename.show-upload.span"+count+"").text(filename);
		    }
	                
        });
    });
