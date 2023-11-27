(function (window) {

	var widthShowTabsMenu = 768;

	if($(window).width() <= widthShowTabsMenu) $('.tab.active').css('display', 'none');

	function changeTab(obj)
	{
			var code = obj.data('code'),
					title = obj.text();
			$('.tab-block .tab').removeClass('active');
			obj.addClass('active');
			$('.tabs-container > div').attr('data-select', 'close');
			$('.tabs-container > div[data-code="'+code+'"]').attr('data-select', 'open');
	}

	function closeTabMenu(obj)
	{
			var code = obj.data('code'),
					title = obj.text();

			$('#tabmobile-title').text(title).data('select', 'close');
			$('.tab-block .tabs-wrapp').css('display', 'none')

			$('.tab-block .tabs-wrapp .tab').css('display', 'flex')
			obj.css('display', 'none')
	}

	function openTabMenu()
	{
			$('.tab-block .tabs-wrapp').css('display', 'flex')
			$('#tabmobile-title').data('select', 'open');
	}

	// click tab
	$(document).on('click', '.tab-block .tab:not(.disable)', function(){
			var $this = $(this);
			changeTab($this);
			if($(window).width() <= widthShowTabsMenu) closeTabMenu($this)
	});

	// click select menu
	$(document).on('click', '.tab-block .tabs-mobile', function(){
			openTabMenu();
	});

	var oneClick = 1;
	$(document).on('click', '.tab[data-code="LINK_REVIEWS"]', function(){
			if(oneClick) {
				$('.it .text').readmore();
				oneClick = 0;
			}
	});

})(window); 