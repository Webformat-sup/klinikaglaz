<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
unset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']);
?>
<div class="confirm">
	<div class="description">
		<h4><?=GetMessage('T_CONFIRM_ORDER_TITLE');?></h4>
		<p><?=GetMessage('T_CONFIRM_ORDER_DESCRIPTION');?></p>
		<div class="buttons">
			<a class="btn btn-default" href="<?=$arParams['PATH_TO_CATALOG'];?>"><?=GetMessage('T_HEAD_LINK_CATALOG');?></a>
			<a class="btn btn-default white" href="<?=SITE_DIR;?>"><?=GetMessage('T_HEAD_LINK_MAIN');?></a>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$.ajax({
		url: arScorpOptions['SITE_DIR'] + 'ajax/basket_top.php',
		type: 'POST',
	}).success(function(html){
		if($('.basket_top').length){
			$('.basket_top').html(html);
		}
	});

});
</script>
