BX.ready(function(e){
	$('.webformat-generate-coupon-default .getCoupon4js').on('click',function(e){
		e.preventDefault();
		var parentContainer = $(e.target).closest('.webformat-generate-coupon-default');
		parentContainer.find('.getCoupon4js').hide();
		parentContainer.find('.couponValue4js').show();
	});
});
