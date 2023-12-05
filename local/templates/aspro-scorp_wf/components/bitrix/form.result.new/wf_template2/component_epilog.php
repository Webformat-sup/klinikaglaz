<?global $USER;?>
<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-block".$arParams["WEB_FORM_ID"]);?>
<?if($USER->IsAuthorized()):?>
	<?
	$dbRes = CUser::GetList(($by = "id"), ($order = "asc"), array("ID" => $USER->GetID()), array("FIELDS" => array("ID", "PERSONAL_PHONE")));
	$arUser = $dbRes->Fetch();
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		try{
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=PHONE]').val('<?=$arUser['PERSONAL_PHONE']?>');
			$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid=EMAIL]').val('<?=$USER->GetEmail()?>');

			$('.form.form-wrapp input#CLIENT_NAME').attr('placeholder', 'Имя')
		}
		catch(e){
		}
	});
	</script>
<?endif;?>
<script type="text/javascript">
$(document).ready(function() {
	$('.form.<?=$arResult["arForm"]["SID"]?> input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
});
</script>
<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-block".$arParams["WEB_FORM_ID"], "");?>