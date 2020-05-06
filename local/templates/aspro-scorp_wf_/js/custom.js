/* Add here all your JS customizations */


$(document).ready(function() {

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

	
})