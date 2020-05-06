<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<div class="confirmation-block">
	<div class="title"><?echo GetMessage("subscr_title_confirm")?></div>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="form">
		<label for="CONFIRM_CODE"><?echo GetMessage("subscr_conf_code")?><span class="required-star">*</span></label>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6  col-sm-6">
					<div class="input">
						<input class="form-control" type="text" id="CONFIRM_CODE" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
					</div>
				</div>
				<div class="col-md-6  col-sm-6">
					<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
				</div>
			</div>			
		</div>
		<div class="text-info-block gray">
			<p><?echo GetMessage("subscr_conf_date")?></p>
			<p><?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></p>
		</div>

		<input type="submit" class="btn btn-default btn-md btn-confirm" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" />

		<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
		<?echo bitrix_sessid_post();?>
	</form>
</div>
