(function (window) {

	$(document).on('click', '.tab-block .tab:not(.disable)', function(){
			var code = $(this).data('code');
			$('.tab-block .tab').removeClass('active');
			$(this).addClass('active');
			$('.tabs-container > div').attr('data-select', 'close')
			$('.tabs-container > div[data-code="'+code+'"]').attr('data-select', 'open')
	});

})(window);