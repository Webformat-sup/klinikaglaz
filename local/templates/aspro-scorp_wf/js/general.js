getRandomInt = function(min, max){
	return Math.floor(Math.random() * (max - min)) + min;
}
CheckTopMenuDotted = function(){
	var menu = $('nav.mega-menu');
	var menuMoreItem = menu.find('td.js-dropdown');
	if(menu.parents('.collapse').css('display') == 'none'){
		return false;
	}

	var block_w = menu.closest('div').actual('width');
	var	menu_w = menu.find('table').actual('outerWidth');
	var afterHide = false;

	while(menu_w > block_w) {
		menuItemOldSave = menu.find('td').not('.nosave').last();
		if(menuItemOldSave.length){
			menuMoreItem.show();
			menuItemNewSave = '<li class="' + (menuItemOldSave.hasClass('dropdown') ? 'dropdown-submenu ' : '') + (menuItemOldSave.hasClass('active') ? 'active ' : '') + '" data-hidewidth="' + menu_w + '">' + menuItemOldSave.find('.wrap').html() + '</li>';
			menuItemOldSave.remove();
			menuMoreItem.find('> .wrap > .dropdown-menu').prepend(menuItemNewSave);
			menu_w = menu.find('table').actual('outerWidth');
			afterHide = true;
		}
		else{
			break;
		}
	}

	if(!afterHide) {
		do {
			var menuItemOldSaveCnt = menuMoreItem.find('.dropdown-menu').find('li').length;
			menuItemOldSave = menuMoreItem.find('.dropdown-menu').find('li').first();
			if(!menuItemOldSave.length) {
				menuMoreItem.hide();
				break;
			}
			else {
				var hideWidth = menuItemOldSave.attr('data-hidewidth');
				if(hideWidth > block_w) {
					break
				}
				else {
					menuItemNewSave = '<td class="' + (menuItemOldSave.hasClass('dropdown-submenu') ? 'dropdown ' : '') + (menuItemOldSave.hasClass('active') ? 'active ' : '') + '" data-hidewidth="' + block_w + '"><div class="wrap">' + menuItemOldSave.html() + '</div></td>';
					menuItemOldSave.remove();
					$(menuItemNewSave).insertBefore(menu.find('td.js-dropdown'));
					if(!menuItemOldSaveCnt) {
						menuMoreItem.hide();
						break;
					}
				}
			}
			menu_w = menu.find('table').actual('outerWidth');
		}
		while(menu_w <= block_w);
	}

	menu.find('td').css('visibility', 'visible');

	return false;
}

CheckTopVisibleMenu = function(that) {
	var dropdownMenu = $('.dropdown-menu:visible').last();
	if(dropdownMenu.length){
		dropdownMenu.find('a').css('white-space', '');
		dropdownMenu.css('left', '');
		dropdownMenu.css('right', '');
		dropdownMenu.removeClass('toright');

		var dropdownMenu_left = dropdownMenu.offset().left;
		if(typeof(dropdownMenu_left) != 'undefined'){
			var menu = dropdownMenu.parents('.mega-menu');
			var menu_width = menu.outerWidth();
			var menu_left = menu.offset().left;
			var menu_right = menu_left + menu_width;
			var isToRight = dropdownMenu.parents('.toright').length > 0;
			var parentsDropdownMenus = dropdownMenu.parents('.dropdown-menu');
			var isHasParentDropdownMenu = parentsDropdownMenus.length > 0;
			if(isHasParentDropdownMenu){
				var parentDropdownMenu_width = parentsDropdownMenus.first().outerWidth();
				var parentDropdownMenu_left = parentsDropdownMenus.first().offset().left;
				var parentDropdownMenu_right = parentDropdownMenu_width + parentDropdownMenu_left;
			}

			if(parentDropdownMenu_right + dropdownMenu.outerWidth() > menu_right){
				dropdownMenu.find('a').css('white-space', 'normal');
			}

			var dropdownMenu_width = dropdownMenu.outerWidth();
			var dropdownMenu_right = dropdownMenu_left + dropdownMenu_width;

			if(dropdownMenu_right > menu_right || isToRight){
				var addleft = 0;
				addleft = menu_right - dropdownMenu_right;
				if(isHasParentDropdownMenu || isToRight){
					dropdownMenu.css('left', 'auto');
					dropdownMenu.css('right', '100%');
					dropdownMenu.addClass('toright');
				}
				else{
					var dropdownMenu_curLeft = parseInt(dropdownMenu.css('left'));
					dropdownMenu.css('left', (dropdownMenu_curLeft + addleft) + 'px');
				}
			}
		}
	}
}

CheckPopupTop = function(){
	var popup = $('.jqmWindow.show');
	if(popup.length){
		var documentScollTop = $(document).scrollTop();
		var windowHeight = $(window).height();
		var popupTop = parseInt(popup.css('top'));
		var popupHeight = popup.height();

		if(windowHeight >= popupHeight){
			// center
			popupTop = (windowHeight - popupHeight) / 2;
		}
		else{
			if(documentScollTop > documentScrollTopLast){
				// up
				popupTop -= documentScollTop - documentScrollTopLast;
			}
			else if(documentScollTop < documentScrollTopLast){
				// down
				popupTop += documentScrollTopLast - documentScollTop;
			}

			if(popupTop + popupHeight < windowHeight){
				// bottom
				popupTop = windowHeight - popupHeight;
			}
			else if(popupTop > 0){
				// top
				popupTop = 0;
			}
		}
		popup.css('top', popupTop + 'px');
	}
}

CheckMainBannerSliderVText = function(slider){
	if(slider.parents('.banners-big').length){
		var sh = slider.height();
		slider.find('.item').each(function() {
			var curSlideTextInner = $(this).find('.text .inner');
			if(curSlideTextInner.length){
				var ith = curSlideTextInner.actual('height');
				var p = (ith >= sh ? 0 : Math.floor((sh - ith) / 2));
				curSlideTextInner.css('padding-top', p + 'px');
			}
		});
	}
}

CheckStickyFooter = function() {
	$(window).resize(function() { //  BX.addCustomEvent('onWindowResize', function(eventdata) {
		try{
			var footerHeight = $('footer').outerHeight();
			ignoreResize.push(true);
			$('footer').css('margin-top', '-' + footerHeight + 'px');
			$('.body').css('margin-bottom', '-' + footerHeight + 'px');
			$('.main').css('padding-bottom', footerHeight + 25 + 'px');
			ignoreResize.pop();
		}
		catch(e){}
	});
}

getGridSize = function(counts) {
	var z = parseInt($('.body_media').css('top'));
	return (z == 2 ? counts[0] : z == 1 ? counts[1] : counts[2]);
}

CheckFlexSlider = function(){
	$('.flexslider:not(.thmb)').each(function(){
		var slider = $(this);
		slider.resize();
		var counts = slider.data('flexslider').vars.counts;
		if(typeof(counts) != 'undefined'){
			var cnt = getGridSize(counts);
			var to0 = (cnt != slider.data('flexslider').vars.minItems || cnt != slider.data('flexslider').vars.maxItems || cnt != slider.data('flexslider').vars.move);
			if(to0){
				slider.data('flexslider').vars.minItems = cnt;
				slider.data('flexslider').vars.maxItems = cnt;
				slider.data('flexslider').vars.move = cnt;
				slider.flexslider(0);
				slider.resize();
				slider.resize(); // twise!
			}
		}
	});
}

CheckHeaderFixed = function(){
	var header = $('header.canfixed');
	if(header.length){
		var headerLogoAndMenuRow = header.find('.logo_and_menu-row');
		if(headerLogoAndMenuRow.length){
			var isHeaderFixed = false;
			var headerCanFix = true;
			var headerFixedHeight = 53;
			var headerNormalHeight = headerLogoAndMenuRow.actual('outerHeight');
			var headerDiffHeight = headerNormalHeight - headerFixedHeight;
			var mobileBtnMenu = $('.btn.btn-responsive-nav');
			$(window).scroll(function(){
				var headerTop = $('#panel:visible').outerHeight();
				var scrollTop = $(window).scrollTop();
				if(!isHeaderFixed){
					headerNormalHeight = headerLogoAndMenuRow.actual('outerHeight');
					headerDiffHeight = headerNormalHeight - headerFixedHeight;
				}

				headerCanFix = !mobileBtnMenu.is(':visible') && !$('.dropdown-menu:visible').length;

				if(!isHeaderFixed){
					if((scrollTop > headerNormalHeight + headerTop) && headerCanFix){
						isHeaderFixed = true;
						var headerNext = header.next();
						if(headerNext.length){
							var mt = parseInt(headerNext.css('margin-top'));
						}
						header.css('top', '-' + headerNormalHeight + 'px');
						header.addClass('fixed');
						if(headerNext.length){
							headerNext.css('margin-top', headerNormalHeight + mt + 'px');
						}
						header.delay(0).animate({top: '0'}, 300);
					}
				}
				else if(isHeaderFixed || !headerCanFix){
					if((scrollTop <= headerDiffHeight + headerTop) || !headerCanFix){
						isHeaderFixed = false;
						header.removeClass('fixed');
						var headerNext = header.next();
						if(headerNext.length){
							headerNext.css('margin-top', '');
						}
						CheckTopMenuDotted();
					}
				}
			});
		}
	}
}

CheckObjectsSizes = function() {
	$('.container iframe,.container object,.container video').each(function() {
		var height_attr = $(this).attr('height');
		var width_attr = $(this).attr('width');
		if (height_attr && width_attr) {
			$(this).css('height', $(this).outerWidth() * height_attr / width_attr);
		}
	});
}

scrollToTop = function(){
	if(arScorpOptions['THEME']['SCROLLTOTOP_TYPE'] !== 'NONE'){
		var _isScrolling = false;
		// Append Button
		$('body').append($('<a />').addClass('scroll-to-top ' + arScorpOptions['THEME']['SCROLLTOTOP_TYPE'] + ' ' + arScorpOptions['THEME']['SCROLLTOTOP_POSITION']).attr({'href': '#', 'id': 'scrollToTop'}));
		$('#scrollToTop').click(function(e){
			e.preventDefault();
			$('body, html').animate({scrollTop : 0}, 500);
			return false;
		});
		// Show/Hide Button on Window Scroll event.
		$(window).scroll(function(){
			if(!_isScrolling) {
				_isScrolling = true;
				var bottom = 23,
					scrollVal = $(window).scrollTop(),
					windowHeight = $(window).height(),
					footerOffset = $('footer').offset().top;
				if(scrollVal > 150){
					$('#scrollToTop').stop(true, true).addClass('visible');
					_isScrolling = false;
				}
				else{
					$('#scrollToTop').stop(true, true).removeClass('visible');
					_isScrolling = false;
				}
				CheckScrollToTop();
			}
		});
	}
}

CheckScrollToTop = function(){
	var bottom = 23,
		scrollVal = $(window).scrollTop(),
		windowHeight = $(window).height(),
		footerOffset = $('footer').offset().top;

	if(scrollVal + windowHeight > footerOffset){
		$('#scrollToTop').css('bottom', bottom + scrollVal + windowHeight - footerOffset);
	}
	else if(parseInt($('#scrollToTop').css('bottom')) > bottom){
		$('#scrollToTop').css('bottom', bottom);
	}
}

var isMobile = jQuery.browser.mobile;
var players = {};

if(isMobile){
	document.documentElement.className += ' mobile';
}

function startMainBannerSlideVideo($slide){
	if(typeof(CoverPlayer) === 'undefined'){
		CoverPlayer = function(){
			var $videoCover = $('.video.cover');
			if($videoCover.length){
				var bannersHeight = $('.banners-big').height()
				var bannersWidth = $('.banners-big').width()
				var windowWidth = $(window).width()
				var height = windowWidth * 9 / 16

				$videoCover.each(function(i, node){
					node.style.height = height + 'px'
					node.style.marginTop = ((bannersHeight - height) / 2) + 'px'
				})
			}
		}
		$(window).resize(function() {
			if($('.video.cover').length){
				CoverPlayer();
			}
		});
	}

	var slideActiveIndex = $slide.attr('data-slide_index')
	var $slides = $slide.closest('.items').find('.item[data-slide_index="'+ slideActiveIndex +'"]')
	var videoSource = $slide.attr('data-video_source')

	if(videoSource){
		var videoPlayerSrc = $slide.attr('data-video_src')
		var videoSoundDisabled = $slide.attr('data-video_disable_sound')
		var bVideoSoundDisabled = videoSoundDisabled == 1
		var videoLoop = $slide.attr('data-video_loop')
		var bVideoLoop = videoLoop == 1
		var videoCover = $slide.attr('data-video_cover')
		var bVideoCover = videoCover == 1 && !isMobile
		var videoUnderText = $slide.attr('data-video_under_text')
		var bVideoUnderText = videoUnderText == 1
		if(videoSource === 'LINK'){
			var videoPlayer = $slide.attr('data-video_player')
			var bVideoPlayerYoutube = videoPlayer === 'YOUTUBE'
			var bVideoPlayerVimeo = videoPlayer === 'VIMEO'

			if(videoPlayerSrc && !$slide.find('iframe.video').length){
				$slides.each(function(i, node){
					var $_slide = $(node);
					var videoID = getRandomInt(100, 1000);
					if(bVideoPlayerVimeo){
						videoPlayerSrc += '&player_id=vimeoplayer';
					}
					$_slide.prepend('<iframe id="player_' + videoID + '" class="video' + (bVideoCover == true ? ' cover' : '') + '" src="'+ videoPlayerSrc +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
					if(typeof(players) !== 'undefined' && players){
						players[videoID] = {id: 'player_' + videoID, mute: (bVideoSoundDisabled ? '1' : '0'), loop: (bVideoLoop ? '1' : '0'), cover: (bVideoCover ? '1' : '0')};
						if(bVideoPlayerYoutube){
							window[players[videoID].id] = new YT.Player(
								players[videoID].id, {
									events: {
										'onReady': onYoutubePlayerReady
									}
								}
							);
							if(bVideoSoundDisabled){
								window[players[videoID].id].addEventListener('onReady', muteYoutubePlayer);
							}
							if(bVideoLoop){
								window[players[videoID].id].addEventListener('onStateChange', loopYoutubePlayer);
							}
						}
						else if(bVideoPlayerVimeo){
							var iframe = $('#'+players[videoID].id)
							if(iframe.length){
								setTimeout(function(){
									iframe.closest('.item').addClass('started')
	    							pauseMainBanner()
								},150)
								var player = iframe[0].childNodes
								// console.log(iframe, player)
								/*player.addEvent('play', function() {
									console.log('play')
								});*/
							}
						}
					}
				});
			}
		}
		if(videoPlayerSrc && !$slide.find('.video').length){
			$slides.each(function(i, node){
				var $_slide = $(node);
				var videoID = getRandomInt(100, 1000);
				$_slide.prepend('<video id="player_' + videoID + '" class="video' + (bVideoCover == true ? ' cover' : '') + '"' + (bVideoLoop == true ? ' loop ' : '') + (bVideoSoundDisabled == true ? ' muted ' : '') + ' autoplay><source src="'+ videoPlayerSrc +'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' /><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p></iframe>');
				if(typeof(players) !== 'undefined' && players){
					players[videoID] = {id: 'player_' + videoID, mute: (bVideoSoundDisabled ? '1' : '0'), loop: (bVideoLoop ? '1' : '0'), cover: (bVideoCover ? '1' : '0')};
					// if(bVideoCover){
						document.getElementById(players[videoID].id).addEventListener('play', onHtml5PlayerPlay);
					// }
				}
			});
		}


	}
}

function muteYoutubePlayer(e) {
	e.target.mute()
}

function loopYoutubePlayer(e) {
	if(e.data === YT.PlayerState.ENDED){
		e.target.playVideo()
	}
}

function onYoutubePlayerReady(e) {
    e.target.playVideo()
    var videoID = e.target.a.id.replace('player_', '')
    if(videoID){
    	var $slide = $('#player_' + videoID).closest('.item')
    	$slide.addClass('started')
    	pauseMainBanner()
    	// setMainBannerSlideVerticalCenter($slide)
		var cover = players[videoID].cover
		if(cover){
	    	CoverPlayer()
	    }
    }
}

function onHtml5PlayerPlay(e){
    var videoID = e.target.id.replace('player_', '')
    if(videoID){
    	var $slide = $('#player_' + videoID).closest('.item')
    	$slide.addClass('started')
    	pauseMainBanner()
    	// setMainBannerSlideVerticalCenter($slide)
		var cover = players[videoID].cover
		if(cover){
	    	CoverPlayer()
	    }
    }
}

function pauseMainBanner(){
	$('.banners-big .flexslider').flexslider('pause');
}

$.fn.equalizeHeights = function( outer ){
	var maxHeight = this.map( function( i, e ){
		$(e).css('height', '');
		if( outer == true ){
			return $(e).actual('outerHeight');
		}else{
			return $(e).actual('height');
		}
	}).get();

	for(var i = 0, c = maxHeight.length; i < c; ++i){
		if(maxHeight[i] % 2){
			--maxHeight[i];
		}
	}

	return this.height( Math.max.apply( this, maxHeight ) );
}

$.fn.sliceHeight = function( options ){
	function _slice(el){
		el.each(function() {
			$(this).css('line-height', '');
			$(this).css('height', '');
		});
		if(typeof(options.autoslicecount) == 'undefined' || options.autoslicecount !== false){
			var elw = (el.first().hasClass('item') ? el.first().outerWidth() : el.first().parents('.item').outerWidth());
			var elsw = el.first().parents('.items').outerWidth();
			if(!elsw){
				elsw = el.first().parents('.row').outerWidth();
			}
			if(elsw && elw){
				options.slice = Math.floor(elsw / elw);
			}
		}
		if(options.slice){
			for(var i = 0; i < el.length; i += options.slice){
				$(el.slice(i, i + options.slice)).equalizeHeights(options.outer);
			}
		}
		if(options.lineheight){
			var lineheightAdd = parseInt(options.lineheight);
			if(isNaN(lineheightAdd)){
				lineheightAdd = 0;
			}
			el.each(function() {
				$(this).css('line-height', ($(this).actual('height') + lineheightAdd) + 'px');
			});
		}
	}

	var options = $.extend({
		slice: null,
		outer: false,
		lineheight: false,
		autoslicecount: true
	}, options);

	var el = $(this);
	_slice(el);

	BX.addCustomEvent('onWindowResize', function(eventdata) {
		ignoreResize.push(true);
		_slice(el);
		ignoreResize.pop();
	});
}

waitingExists = function(selector, delay, callback){
	if(typeof(callback) !== 'undefined' && selector.length && delay > 0){
		delay = parseInt(delay);
		delay = (delay < 0 ? 0 : delay);

		if(!$(selector).length){
			setTimeout(function(){
				waitingExists(selector, delay, callback);
			}, delay);
		}
		else{
			callback();
		}
	}
}

waitingNotExists = function(selectorExists, selectorNotExists, delay, callback){
	if(typeof(callback) !== 'undefined' && selectorExists.length && selectorNotExists.length && delay > 0){
		delay = parseInt(delay);
		delay = (delay < 0 ? 0 : delay);

		setTimeout(function(){
			if(selectorExists.length && !$(selectorNotExists).length){
				callback();
			}
		}, delay);
	}
}

function onLoadjqm(hash){
	var name = $(hash.t).data('name'),
		top = (($(window).height() > hash.w.height()) ? Math.floor(($(window).height() - hash.w.height()) / 2) : 0) + 'px';
	$.each($(hash.t).get(0).attributes, function(index, attr){
		if(/^data\-autoload\-(.+)$/.test(attr.nodeName)){
			var key = attr.nodeName.match(/^data\-autoload\-(.+)$/)[1];
			var el = $('input[name="'+key.toUpperCase()+'"]');
			el.val( $(hash.t).data('autoload-'+key) ).attr('readonly', 'readonly');
			el.attr('title', el.val());
		}
	});
	if($(hash.t).data('autohide')){
		$(hash.w).data('autohide', $(hash.t).data('autohide'));
	}
	if(name == 'order_product'){
		if($(hash.t).data('product')) {
			$('input[name="PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="PRODUCT"]').val());
		}
	}
	if(name == 'question'){
		if($(hash.t).data('product')) {
			$('input[name="NEED_PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="NEED_PRODUCT"]').val());
		}
	}
	hash.w.addClass('show').css({'margin-left': '-' + Math.floor(hash.w.width() / 2) + 'px', 'top': top, 'opacity': 1});
}

function onHide(hash){
	if($(hash.w).data('autohide')){
		eval($(hash.w).data('autohide'));
	}
	hash.w.css('opacity', 0).hide();
	hash.w.empty();
	hash.o.remove();
	hash.w.removeClass('show');
}

$.fn.jqmEx = function(){
	$(this).each(function(){
		var _this = $(this);
		var name = _this.data('name');

		if(name.length){
			var script = arScorpOptions['SITE_DIR'] + 'ajax/form.php';
			var paramsStr = ''; var trigger = ''; var arTriggerAttrs = {};
			$.each(_this.get(0).attributes, function(index, attr){
				var attrName = attr.nodeName;
				var attrValue = _this.attr(attrName);
				trigger += '[' + attrName + '=\"' + attrValue + '\"]';
				arTriggerAttrs[attrName] = attrValue;
				if(/^data\-param\-(.+)$/.test(attrName)){
					var key = attrName.match(/^data\-param\-(.+)$/)[1];
					paramsStr += key + '=' + attrValue + '&';
				}
			});

			var triggerAttrs = JSON.stringify(arTriggerAttrs);
			var encTriggerAttrs = encodeURIComponent(triggerAttrs);
			script += '?' + paramsStr + 'data-trigger=' + encTriggerAttrs;

			if(!$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').length){
				if(_this.attr('disabled') != 'disabled'){
					$('body').find('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').remove();
					$('body').append('<div class="' + name + '_frame jqmWindow" style="width:500px" data-trigger="' + encTriggerAttrs + '"></div>');
					$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').jqm({trigger: trigger, onLoad: function(hash){onLoadjqm(hash);}, onHide: function(hash){onHide(hash);}, ajax:script});
				}
			}
		}
	});
}

InitFlexSlider = function() {
	$('.flexslider:not(.thmb):not(.flexslider-init)').each(function(){
		var slider = $(this);
		var options;
		var defaults = {
			animationLoop: false,
			controlNav: false,
			directionNav: true,
			animation: "slide"
		}
		var config = $.extend({}, defaults, options, slider.data('plugin-options'));
		if(typeof(config.counts) != 'undefined' && config.direction !== 'vertical'){
			config.maxItems =  getGridSize(config.counts);
			config.minItems = getGridSize(config.counts);
			config.move = getGridSize(config.counts);
			config.itemWidth = 200;
		}

		config.after = config.start = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlide', [eventdata]);
		}

		config.end = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlideEnd', [eventdata]);
		}

		slider.flexslider(config).addClass('flexslider-init');
		if(config.controlNav)
			slider.addClass('flexslider-control-nav');
		if(config.directionNav)
			slider.addClass('flexslider-direction-nav');
	});
}

$(document).ready(function(){
	scrollToTop();
	CheckStickyFooter();
	CheckHeaderFixed();
	CheckTopMenuDotted();
	setTimeout(function() {$(window).resize();}, 350); // need to check resize flexslider & menu
	$(window).scroll();

	$('.blink img').blink();

	waitingNotExists('#bx-composite-banner .bx-composite-btn', '#footer .col-sm-3.hidden-md.hidden-lg #bx-composite-banner .bx-composite-btn', 500, function() {
		$('#footer .col-sm-3.hidden-md.hidden-lg #bx-composite-banner').html($('#bx-composite-banner .bx-composite-btn').parent().html());
	});

	$.extend( $.validator.messages, {
		required: BX.message('JS_REQUIRED'),
		email: BX.message('JS_FORMAT'),
		equalTo: BX.message('JS_PASSWORD_COPY'),
		minlength: BX.message('JS_PASSWORD_LENGTH'),
		remote: BX.message('JS_ERROR')
	});

	$.validator.addMethod(
		'regexp', function( value, element, regexp ){
			var re = new RegExp( regexp );
			return this.optional( element ) || re.test( value );
		},
		BX.message('JS_FORMAT')
	);

	$.validator.addMethod(
		'filesize', function( value, element, param ){
			return this.optional( element ) || ( element.files[0].size <= param )
		},
		BX.message('JS_FILE_SIZE')
	);

	$.validator.addMethod(
		'date', function( value, element, param ) {
			var status = false;
			if(!value || value.length <= 0){
				status = false;
			}
			else{
				var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4})$');
				var matches = re.exec(value);
				if(matches){
					var composedDate = new Date(matches[5], (matches[3] - 1), matches[1]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]));
				}
			}
			return status;
		}, BX.message('JS_DATE')
	);

	$.validator.addMethod(
		'datetime', function( value, element, param ) {
			var status = false;
			if(!value || value.length <= 0){
				status = false;
			}
			else{
				var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4}) ([0-9]{1,2}):([0-9]{1,2})$');
				var matches = re.exec(value);
				if(matches){
					var composedDate = new Date(matches[5], (matches[3] - 1), matches[1], matches[6], matches[7]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]) && (composedDate.getHours() == matches[6]) && (composedDate.getMinutes() == matches[7]));
				}
			}
			return status;
		}, BX.message('JS_DATETIME')
	);

	$.validator.addMethod(
		'extension', function(value, element, param){
			param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g|gif';
			return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
		}, BX.message('JS_FILE_EXT')
	);

	$.validator.addMethod(
		'captcha', function( value, element, params ){
			return $.validator.methods.remote.call(this, value, element,{
				url: arScorpOptions['SITE_DIR'] + 'ajax/check-captcha.php',
				type: 'post',
				data:{
					captcha_word: value,
					captcha_sid: function(){
						return $(element).closest('form').find('input[name="captcha_sid"]').val();
					}
				}
			});
		},
		BX.message('JS_ERROR')
    );

	/*reload captcha*/
	$('body').on( 'click', '.refresh', function(e){
		e.preventDefault();
		$.ajax({
			url: arScorpOptions['SITE_DIR'] + 'ajax/captcha.php'
		}).done(function(text){
			$('.captcha_sid').val(text);
			$('.captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + text);
		});
	});

	$.validator.addClassRules({
		'phone':{
			regexp: arScorpOptions['THEME']['VALIDATE_PHONE_MASK']
		},
		'confirm_password':{
			equalTo: 'input[name="REGISTER\[PASSWORD\]"]',
			minlength: 6
		},
		'password':{
			minlength: 6
		},
		'inputfile':{
			extension: arScorpOptions['THEME']['VALIDATE_FILE_EXT'],
			filesize: 5000000
		},
		'datetime':{
			datetime: ''
		},
		'captcha':{
			captcha: ''
		}
	});

	InitFlexSlider();

	// for check flexslider bug in composite mode
	waitingNotExists('.detail .galery #slider', '.detail .galery #slider .flex-viewport', 1000, function() {
		InitFlexSlider();
		setTimeout(function() {
			$(window).resize();
		}, 350);
	});

	/*check mobile device*/
	if(jQuery.browser.mobile){
		$('.style-switcher').addClass('hidden');
		$('.hint span').remove();

		$('*[data-event="jqm"]').live('click', function(e){
			e.preventDefault();
			var _this = $(this);
			var name = _this.data('name');

			if(name.length){
				var script = arScorpOptions['SITE_DIR'] + 'form/';
				var paramsStr = ''; var arTriggerAttrs = {};
				$.each(_this.get(0).attributes, function(index, attr){
					var attrName = attr.nodeName;
					var attrValue = _this.attr(attrName);
					arTriggerAttrs[attrName] = attrValue;
					if(/^data\-param\-(.+)$/.test(attrName)){
						var key = attrName.match(/^data\-param\-(.+)$/)[1];
						paramsStr += key + '=' + attrValue + '&';
					}
				});

				var triggerAttrs = JSON.stringify(arTriggerAttrs);
				var encTriggerAttrs = encodeURIComponent(triggerAttrs);
				script += '?name=' + name + '&' + paramsStr + 'data-trigger=' + encTriggerAttrs;
				location.href = script;
			}
		});

		$('.fancybox').removeClass('fancybox');
	}
	else{
		$('*[data-event="jqm"]').live('click', function(e){
			e.preventDefault();
			$(this).jqmEx();
			$(this).trigger('click');
		});
	}

	$('a.fancybox:has(img)').fancybox();

	// Responsive Menu Events
	var addActiveClass = false;
	$('#mainMenu li.dropdown > a > i, #mainMenu li.dropdown-submenu > a > i').on('click', function(e){
		e.preventDefault();
		if($(window).width() > 979) return;
		addActiveClass = $(this).closest('li').hasClass('resp-active');
		// $('#mainMenu').find('.resp-active').removeClass('resp-active');
		if(!addActiveClass){
			$(this).closest("li").addClass("resp-active");
		}else{
			$(this).closest("li").removeClass("resp-active");
		}
	});

	if($('.styled-block .row > div.col-md-3').length){
		BX.addCustomEvent('onWindowResize', function(eventdata) {
			try{
				ignoreResize.push(true);
				$('.styled-block .row > div.col-md-3').each(function() {
					$(this).css({'height': '', 'line-height': ''});
					var z = parseInt($('.body_media').css('top'));
					if(z > 0){
						var rowHeight = $(this).parents('.row').first().actual('outerHeight');
						$(this).css({'height': rowHeight + 'px', 'line-height' : rowHeight + 'px'});
					}
				});
			}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});
	}

	if($('.order-block').length){
		BX.addCustomEvent('onWindowResize', function(eventdata) {
			try{
				ignoreResize.push(true);
				$('.order-block').each(function() {
					var cols = $(this).find('.row > div');
					if(cols.length){
						var colFirst = cols.first();
						var colLast = cols.last();
						var colText = colLast.find('.text');
						var bText = colText.length;
						var bOnlyText = cols.length === 1 && bText;
						var bPrice = colFirst.find('.price').length;
						var z = parseInt($('.body_media').css('top'));

						cols.css({'height': '', 'padding-top': '', 'padding-bottom': ''});
						colText.css({'height': '', 'padding-top': '', 'padding-bottom': ''});
						if((!bPrice && z > 0) || (bPrice && z > 1)){
							var minHeight = 83;

							if(!bOnlyText){
								var colFirst_height = colFirst.outerHeight();
								colFirst_height = colFirst_height >= minHeight ? colFirst_height : minHeight;
							}

							if(bText){
								var colLast_height = colLast.outerHeight();
								colLast_height = colLast_height >= minHeight ? colLast_height : minHeight;
							}

							var colMax_height = (bText ? (!bOnlyText ? (colLast_height >= colFirst_height ? colLast_height : colFirst_height) : colLast_height) : colFirst_height);

							if(!bOnlyText){
								var textPadding = 22 + (colMax_height - colFirst.outerHeight()) / 2;
								colFirst.css({'padding-top': textPadding + 'px', 'padding-bottom': textPadding + 'px', 'height': colMax_height + 'px'});
							}
							if(bText){
								colLast.css({'height': colMax_height + 'px'});
								var textPadding = 22 + (colMax_height - colText.outerHeight()) / 2;
								colText.css({'padding-top': textPadding + 'px', 'padding-bottom': textPadding + 'px', 'height': colMax_height + 'px'});
							}
						}
					}
				});
			}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});
	}

	$(document).on('click', '.mega-menu .dropdown-menu', function(e){
		e.stopPropagation()
	});

	$(document).on('click', '.mega-menu .dropdown-toggle.more-items', function(e){
		e.preventDefault();
	});

	$('.table-menu .dropdown,.table-menu .dropdown-submenu,.table-menu .dropdown-toggle').live('mouseenter', function() {
		CheckTopVisibleMenu();
	});

	$('.mega-menu .search-item .search-icon, .menu-row #title-search .fa-close').live('click', function(e) {
		e.preventDefault();
		$('.menu-row #title-search').toggleClass('hide');
	});

	$('.mega-menu ul.nav .search input').live('keyup', function(e) {
		var inputValue = $(this).val();
		$('.menu-row > .search input').val(inputValue);
		if(e.keyCode == 13){
			$('.menu-row > .search form').submit();
		}
	});

	$('.menu-row > .search input').live('keyup', function(e) {
		var inputValue = $(this).val();
		$('.mega-menu ul.nav .search input').val(inputValue);
		if(e.keyCode == 13){
			$('.menu-row > .search form').submit();
		}
	});

	$('.mega-menu ul.nav .search button').live('click', function(e) {
		e.preventDefault();
		var inputValue = $(this).parents('.search').find('input').val();
		$('.menu-and-search .search input').val(inputValue);
		$('.menu-row > .search form').submit();
	});

	$('.filter .calendar').live('click', function() {
		var button = $(this).next();
		if(button.hasClass('calendar-icon')){
			button.trigger('click');
		}
	});

	/* toggle */
	var $this = this,
		previewParClosedHeight = 25;

	$('section.toggle > label').prepend($('<i />').addClass('fa fa-plus'));
	$('section.toggle > label').prepend($('<i />').addClass('fa fa-minus'));
	$('section.toggle.active > p').addClass('preview-active');
	$('section.toggle.active > div.toggle-content').slideDown(350, function() {});

	$('section.toggle > label').click(function(e){
		var parentSection = $(this).parent(),
			parentWrapper = $(this).parents('div.toogle'),
			previewPar = false,
			isAccordion = parentWrapper.hasClass('toogle-accordion');

		if(isAccordion && typeof(e.originalEvent) != 'undefined') {
			parentWrapper.find('section.toggle.active > label').trigger('click');
		}

		parentSection.toggleClass('active');

		// Preview Paragraph
		if( parentSection.find('> p').get(0) ){
			previewPar = parentSection.find('> p');
			var previewParCurrentHeight = previewPar.css('height');
			previewPar.css('height', 'auto');
			var previewParAnimateHeight = previewPar.css('height');
			previewPar.css('height', previewParCurrentHeight);
		}

		// Content
		var toggleContent = parentSection.find('> div.toggle-content');

		if( parentSection.hasClass('active') ){
			$(previewPar).animate({
				height: previewParAnimateHeight
			}, 350, function() {
				$(this).addClass('preview-active');
			});
			toggleContent.slideDown(350, function() {});
		}
		else{
			$(previewPar).animate({
				height: previewParClosedHeight
			}, 350, function() {
				$(this).removeClass('preview-active');
			});
			toggleContent.slideUp(350, function() {});
		}
	});

	/* accordion */
	$('.accordion-head').on('click', function(e){
		e.preventDefault();
		if(!$(this).next().hasClass('collapsing')){
			$(this).toggleClass('accordion-open');
			$(this).toggleClass('accordion-close');
		}
	});

	/* progress bar */
	$('[data-appear-progress-animation]').each(function(){
		var $this = $(this);
		$this.appear(function(){
			var delay = ($this.attr('data-appear-animation-delay') ? $this.attr('data-appear-animation-delay') : 1);
			if( delay > 1 )
				$this.css('animation-delay', delay + 'ms');
			$this.addClass($this.attr('data-appear-animation'));

			setTimeout(function(){
				$this.animate({
					width: $this.attr('data-appear-progress-animation')
				}, 1500, 'easeOutQuad', function() {
					$this.find('.progress-bar-tooltip').animate({
						opacity: 1
					}, 500, 'easeOutQuad');
				});
			}, delay);
		}, {accX: 0, accY: -50});
	});

	$('a[rel=tooltip]').tooltip();
	$('span[data-toggle=tooltip]').tooltip();

	$('select.sort').live('change', function(){
		location.href = $(this).val();
	});

	setTimeout(function(th){
		$('.catalog.group.list .item').each(function(){
			var th = $(this);
			if((tmp = th.find('.image').outerHeight() - th.find('.text_info').outerHeight()) > 0){
				th.find('.text_info .titles').height(th.find('.text_info .titles').outerHeight() + tmp);
			}

		})
	}, 50);

	/*item galery*/
	$('.thumbs .item a').live('click', function(e){
		e.preventDefault();
		$('.thumbs .item').removeClass('current');
		$(this).closest('.item').toggleClass('current');
		$('.slides li' + $(this).attr('href')).addClass('current').siblings().removeClass('current');
	});

	$('header.fixed .btn-responsive-nav').live('click', function() {
		$('html, body').animate({scrollTop: 0}, 400);
	});

	$('body').on('click', '.form .refresh-page', function(){
		location.href = location.href;
	});

	// SCORP BASKET
	// - basket fly close
	$(document).on('click', function(){
		if($('.basket.fly').length && $('.ajax_basket').hasClass('opened')){
			$('.ajax_basket').removeClass('opened');
		}
	});

	$(document).on('click', '.basket.fly', function(e){
		e.stopPropagation();
	});

	// - COUNTER
	var timerBasketCounter = false;

	// -- keyup input
	$(document).on('keydown', '.count', function(e){
		// Allow: backspace, delete, tab, escape, enter and .
		if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			 // Allow: Ctrl+A, Command+A
			(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
			 // Allow: home, end, left, right, down, up
			(e.keyCode >= 35 && e.keyCode <= 40)) {
				 // let it happen, don't do anything
				 return;
		}
		// Ensure that it is a number and stop the keypress
		if((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
			e.preventDefault();
		}
	});
	$(document).on('keyup', '.count', function(e){
		var $this = $(this),
			counterInputValueNew = $this.val(),
			price = $this.closest('.item').find('input[name=PRICE]').val();

		Summ($this, counterInputValueNew, price);
	});
	// -- blur input
	$(document).on('blur', '.count', function(){
		BasketCounter($(this));
	});

	// -- click minus, plus button
	$(document).on('click', '.minus, .plus', function(e){
		e.stopPropagation();
		BasketCounter($(this));
	});

	// - Add2Basket
	$(document).on('click', '.to_cart', function(e){
		e.stopPropagation();
		var item = $(this).closest('[data-item]'),
			itemData = item.data('item'),
			buyBlock = item.find('.buy_block'),
			counter = buyBlock.find('.counter'),
			buttonToCart = buyBlock.find('.to_cart'),
			itemQuantity = parseFloat(buttonToCart.data('quantity')),
			countItem = ($('.basket').length ? parseInt($('.basket .count').text()) : parseInt($('.basket_top:visible .count').text()));

		$('.basket_top .count').text(countItem + 1).removeClass('empted');
		$('.basket .count').text(countItem + 1).removeClass('empted');

		if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length){
			var bBasketFly = true;
		}

		if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length){
			var bBasketTop = true;
		}

		if(isNaN(itemQuantity) || itemQuantity <= 0){
			itemQuantity = 1;
		}

		if(!isNaN(itemData.ID) && parseInt(itemData.ID) > 0){
			buyBlock.addClass('in');
			$.ajax({
				url: arScorpOptions['SITE_DIR'] + 'ajax/basket_items.php',
				type: 'POST',
				data: {itemData: itemData, quantity: itemQuantity},
			}).success(function(html){
				if(bBasketTop){
					$('.ajax_basket').html(html);
					//$('.basket_top').css('opacity', 1);
					//$('.basket_top').prepend($(html).find('.ajax_basket_items'));
					if(!$('.basket_top .dropdown').hasClass('expanded')){
						setTimeout(function(){
							$('.basket_top .dropdown').addClass('expanded');
						}, 100);
					}

					setTimeout(function(){
						$('.basket_top .dropdown').removeClass('expanded');
					}, 1000);
				}

				if(bBasketFly){
					if($('.basket.fly').length){
						$('.ajax_basket').html(html);
						//$('.basket.fly>.wrap').css({'opacity': 1});
						setTimeout(function(){
							if(!$('.ajax_basket').hasClass('opened')){
								$('.ajax_basket').addClass('opened');
							}
						}, 50);
					}
				}
			});
		}
		else{
			return;
		}
	});

	// - Remove9Basket
	$(document).on('click', '.remove', function(){
		var item = $(this).closest('[data-item]'),
			itemData = item.data('item'),
			bRemove = 'Y',
			bRemoveAll = ($.trim($(this).closest('[data-remove_all]').data('remove_all')) === 'Y' ? 'Y' : false);
			getCurUri = $.trim($('input[name=getPageUri]').val()),
			countItem = ($('.basket').length ? parseInt($('.basket .item').length) : parseInt($('.basket_top:visible .item').length)),
			bOneItem = (countItem - 1 <= 0),
			scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

		var _ajax = function(){
			$.ajax({
				url: arScorpOptions['SITE_DIR'] + 'ajax/basket_items.php',
				data: {itemData: itemData, remove: bRemove, removeAll: bRemoveAll},
			}).success(function(html){
				/*if(typeof(data) === 'object'){
					arBasketItems = data;
				}*/

				if(bBasketTop){
					$('.ajax_basket').html(html);
					//$('.basket_top').css('opacity', 1);
					$('.basket_top .items').scrollTop(scrollTop);
				}

				if(getCurUri){
					$.ajax({
						url: getCurUri,
						type: 'POST',
					}).success(function(html){
						if($('.basket.default').length){
							$('.basket.default').html(html);
						}
					});
				}

				if(bBasketFly){
					$('.ajax_basket').html(html);
					//$('.basket.fly>.wrap').css({'opacity': 1});
					$('.ajax_basket').addClass('opened');
					$('.basket.fly .items_wrap').scrollTop(scrollTop);
				}
			});
		}

		if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length){
			var bBasketFly = true;
		}

		if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length){
			var bBasketTop = true;
		}

		if(typeof(itemData) !== 'undefined' && (!isNaN(itemData.ID) && itemData.ID > 0) || bRemoveAll){
			if(bRemoveAll){
				$('.buy_block').removeClass('in');
				$('.basket .count').text(0).addClass('empted');
				$('.basket_top .count').text(0).addClass('empted');
			}
			else{
				$('[data-item]').each(function(){
					if($(this).data('item').ID == itemData.ID){
						$(this).find('.buy_block').removeClass('in');
					}
				});
				if($('.basket').length){
					$('.basket .count').text(parseFloat($('.basket .count').text()) - 1);
					$('.basket_top .count').text(parseFloat($('.basket .count').text()) - 1);
				}
				else{
					$('.basket_top .count').text(parseFloat($('.basket_top:visible .count').text()) - 1);
				}
			}

			if(bOneItem && !bRemoveAll){
				if(item.closest('.basket_top').length){
					item.closest('.dropdown').animate({opacity: 0}, 200, function(){
						_ajax();
					});
				}
				else{
					item.closest('.basket').find('.count').addClass('empted');
					item.closest('.basket_wrap').fadeOut(200, function(){
						item.closest('.basket').find('.basket_empty').fadeIn(200, function(){
							_ajax();
						});
					});
				}
			}
			else if(bRemoveAll){
				$('.basket_wrap').fadeOut(200, function(){
					$('.basket').find('.basket_empty').fadeIn(200, function(){
						_ajax();
					});
				});
			}
			else if(!bOneItem){
				item.animate({opacity: 0}, 200).slideUp(200, function(){
					_ajax();
				});
			}
		}
		else{
			return;
		}
	});
	$(document).on('click', '.print', function(){
		window.print();
	});
});

// START VIDEO BUTTON
$(document).on('click', '.banners-big .item .btn-video', function(){
	$(this).addClass('loading');
	$(this).closest('.item').addClass('loading');
	startMainBannerSlideVideo($(this).closest('.item'));
});

//SCORP BASKET
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function(n, prec){
		var k = Math.pow(10, prec);
		return '' + (Math.round(n*k)/k).toFixed(prec);
	};

	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}

	if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}

	return s.join(dec);
}


setBasketItemsClasses = function(){
	if(typeof(arBasketItems) !== 'undefined' && Object.keys(arBasketItems).length){
		for(var key in arBasketItems){
			$('[data-item]').each(function(){
				if($(this).data('item').ID == key){
					$(this).find('.buy_block').addClass('in');
				}
			});
		}
	}
}

function Summ(el, counterInputValueNew, price){
	if(counterInputValueNew <= 0){
		counterInputValueNew = 1;
	}

	var summ = number_format(counterInputValueNew*price, 0, '.', ' '),
		allSumm = 0;

	el.closest('.items').find('.item').each(function(){
		var $this = $(this),
			price = parseFloat($this.find('input[name=PRICE]').val()),
			count =  parseFloat($this.find('input.count').val());

		if(count <= 0){
			count = 1;
		}

		if(!isNaN(price) && !isNaN(count)){
			allSumm += count*price;
		}
	});

	allSumm = number_format(parseFloat(allSumm), 0, '.', ' ');

	el.closest('.item').find('.summ .price_val').text(summ);
	el.closest('.basket').find('.foot .total>span').text(allSumm);
}

var timerBasketUpdate = false;
// - COUNTER
BasketCounter = function(el){
	var elClass = $.trim(el.attr('class')),
		bClassMinus = (elClass.indexOf('minus') > -1),
		bClassPlus = (elClass.indexOf('plus') > -1),
		bClassCount = (elClass.indexOf('count') > -1),
		getCurUri = $.trim($('input[name=getPageUri]').val()),
		buyBlock = el.closest('.buy_block'),
		buttonToCart = buyBlock.find('.to_cart'),
		counterInput = el.closest('.counter').find('input.count'),
		counterInputValue = parseFloat($.trim(counterInput.val())),
		price = parseFloat(buyBlock.find('input[name=PRICE]').val()),
		counterInputMaxCount = Math.pow(10, parseInt(counterInput.attr('maxlength'))) - 1;

	// class minus button
	if(bClassMinus){
		var counterInputValueNew = counterInputValue - 1;

		if(counterInputValueNew <= 0){
			counterInputValueNew = 1;
		}

		counterInput.val(counterInputValueNew);

		Summ(el, counterInputValueNew, price);

		if(timerBasketUpdate){
			clearTimeout(timerBasketUpdate);
			timerBasketUpdate = false;
		}

		timerBasketUpdate = setTimeout(function(){
			BasketUpdate(el, counterInputValueNew);
			timerBasketUpdate = false;
		}, 700);
	}
	// class plus button
	else if(bClassPlus){
		var counterInputValueNew = counterInputValue + 1;

		if(counterInputValueNew > counterInputMaxCount){
			counterInputValueNew = counterInputMaxCount;
		}

		counterInput.val(counterInputValueNew);
		Summ(el, counterInputValueNew, price);

		if(timerBasketUpdate){
			clearTimeout(timerBasketUpdate);
			timerBasketUpdate = false;
		}

		timerBasketUpdate = setTimeout(function(){
			BasketUpdate(el, counterInputValueNew);
			timerBasketUpdate = false;
		}, 700);
	}
	// class input
	else if(bClassCount){
		var counterInputValueNew = counterInputValue;

		if(counterInputValueNew <= 0 || isNaN(counterInputValueNew)){
			counterInputValueNew = 1;
		}
		el.val(counterInputValueNew);
		BasketUpdate(el, counterInputValueNew);
	}

	if(!getCurUri && !el.closest('.basket.fly').length){
		buttonToCart.data('quantity', counterInputValueNew);
	}
}

BasketUpdate = function(el, counterInputValueNew){
	var	itemData = el.closest('[data-item]').data('item'),
		itemData = (typeof(arBasketItems) === 'object' && typeof(arBasketItems[itemData.ID]) === 'object' ? arBasketItems[itemData.ID] : itemData),
		buyBlock = el.closest('.buy_block'),
		buttonToCart = buyBlock.find('.to_cart'),
		getCurUri = $.trim($('input[name=getPageUri]').val())
		scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

	if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length){
		var bBasketFly = true;
	}

	if(typeof(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arScorpOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length){
		var bBasketTop = true;
	}

	else{
		if(typeof(itemData) != 'undefined' && !isNaN(itemData.ID) && itemData.ID > 0){
			$.ajax({
				url: arScorpOptions['SITE_DIR'] + 'ajax/basket_items.php',
				data: {itemData: itemData, quantity: counterInputValueNew},
			}).success(function(data){
				if(typeof(data) === 'object'){
					arBasketItems = data;
				}
				if(bBasketTop){
					$.ajax({
						url: arScorpOptions['SITE_DIR'] + 'ajax/basket_items.php',
						type: 'POST',
					}).success(function(html){
						buyBlock.removeClass('in');
						$('.ajax_basket').html(html);

						if(!getCurUri){
							setTimeout(function(){
								$('.basket_top .dropdown').addClass('expanded');
							}, 100);

							setTimeout(function(){
								$('.basket_top .dropdown').removeClass('expanded');
							}, 1000);
						}
					});
				}

				if(bBasketFly){
					$.ajax({
						url: arScorpOptions['SITE_DIR'] + 'ajax/basket_items.php',
						type: 'POST',
					}).success(function(html){
						if($('.basket.fly').length){
							$('.ajax_basket').html(html);
							$('.basket.fly .items_wrap').scrollTop(scrollTop);
						}
					});
				}

				if(getCurUri){
					$.ajax({
						url: getCurUri,
						type: 'POST',
					}).success(function(html){
						if($('.basket.default').length){
							$('.basket.default').html(html);
						}
					});
				}
			});
		}
		else{
			return;
		}
	}
}

// Events
var timerScroll = false, ignoreScroll = [], documentScrollTopLast = $(document).scrollTop();
$(window).scroll(function(){
	CheckPopupTop();
	if(!ignoreScroll.length){
		if(timerScroll){
			clearTimeout(timerScroll);
			timerScroll = false;
		}
		timerScroll = setTimeout(function(){
			BX.onCustomEvent('onWindowScroll', false);
		}, 100);
	}
	documentScrollTopLast = $(document).scrollTop();
});

var timerResize = false, ignoreResize = [];

$(window).resize(function(){
	CheckPopupTop();
	CheckScrollToTop();
	if(!ignoreResize.length){
		if(timerResize){
			clearTimeout(timerResize);
			timerResize = false;
		}
		timerResize = setTimeout(function(){
			BX.onCustomEvent('onWindowResize', false);
		}, 100);
	}
	documentScrollTopLast = $(document).scrollTop();
});

BX.addCustomEvent('onWindowScroll', function(eventdata) {
	try{
		ignoreScroll.push(true);
	}
	catch(e){}
	finally{
		ignoreScroll.pop();
	}
});

BX.addCustomEvent('onWindowResize', function(eventdata) {
	try{
		ignoreResize.push(true);
		CheckTopMenuDotted();
		CheckTopVisibleMenu();
		CheckFlexSlider();
		CheckMainBannerSliderVText($('.banners-big .flexslider'));
		CheckObjectsSizes();
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});

BX.addCustomEvent('onSlide', function(eventdata) {
	try{
		ignoreResize.push(true);
		if(eventdata){
			var slider = eventdata.slider;
			if(slider){
				// add classes .curent & .shown to slide
				slider.find('.item').removeClass('current');
				var curSlide = slider.find('.item.flex-active-slide');
				var curSlideId = curSlide.attr('id');
				curSlide.addClass('current');

				if(curSlide.hasClass('shown')){
					slider.find('.item.clone[id=' + curSlideId + '_clone]').addClass('shown');
				}

				curSlide.addClass('shown');
				slider.resize();

				// set main banners text vertical center
				CheckMainBannerSliderVText(slider);

				//video
				var videoAutoPlay = curSlide.attr('data-video_autoplay')
				var bVideoAutoPlay = videoAutoPlay == 1
				if(bVideoAutoPlay){
					startMainBannerSlideVideo(curSlide)
				}
			}
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});

BX.addCustomEvent('onSlideEnd', function(eventdata) {
	try{
		ignoreResize.push(true);
		if(eventdata){
			var slider = eventdata.slider;
			if(slider){

			}
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});


	var jqmEd = function (name, form_id, open_trigger, requestData, selector, requestTitle, isButton, thButton){
		if(typeof(requestData) == "undefined"){
			requestData = '';
		}
		if(typeof(selector) == "undefined"){
			selector = false;
		}
		$('body').find('.'+name+'_frame').remove();
		$('body').append('<div class="'+name+'_frame jqmWindow popup"></div>');
		if(typeof open_trigger == "undefined" ){
			$('.'+name+'_frame').jqm({trigger: '.'+name+'_frame.popup',onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( name , hash , requestData, selector); }, ajax: arNextOptions["SITE_DIR"]+'ajax/form.php?form_id='+form_id+(requestData.length ? '&' + requestData : '')});
		}else{
			if(name == 'enter'){
				$('.'+name+'_frame').jqm({trigger: open_trigger,onHide: function(hash) { onHidejqm(name,hash); },  onLoad: function( hash ){ onLoadjqm( name , hash , requestData, selector); }, ajax: arNextOptions["SITE_DIR"]+'ajax/auth.php'});
			}else{
				$('.'+name+'_frame').jqm({trigger: open_trigger, onHide: function(hash) { onHidejqm(name,hash); }, onLoad: function( hash ){ onLoadjqm( name , hash , requestData, selector); }, ajax: arNextOptions["SITE_DIR"]+'ajax/form?form_id='+form_id+(requestData.length ? '&' + requestData : '')});
			}
			$(open_trigger).dblclick(function(){return false;})
		}
		return true;
	}

	
BX.addCustomEvent('onSubmitForm', function(eventdata){
	try{
		if(!window.renderRecaptchaById || !window.asproRecaptcha || !window.asproRecaptcha.key)
		{
			eventdata.form.submit();
			$(eventdata.form).closest('.form').addClass('sending');
			return true;
		}

		if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && $(eventdata.form).find('.g-recaptcha').length)
		{
			if($(eventdata.form).find('.g-recaptcha-response').val())
			{
				eventdata.form.submit();
				$(eventdata.form).closest('.form').addClass('sending');
				return true;
			}
			else
			{
				if(typeof grecaptcha != 'undefined'){
					grecaptcha.execute($(eventdata.form).find('.g-recaptcha').data('widgetid'));
				}
				else{
					return false;
				}
			}
		}
		else
		{
			eventdata.form.submit();
			$(eventdata.form).closest('.form').addClass('sending');
			return true;
		}
	}
	catch (e){
		console.error(e);
		return true;
	}
})