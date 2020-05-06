<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>
<div class="subtitle"><?echo GetMessage("subscr_title_settings")?></div>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="form">
	<?echo bitrix_sessid_post();?>
	<label for="EMAIL"><?echo GetMessage("subscr_email")?><span class="required-star">*</span></label>
	<div class="form-group">
		<div class="row">
			<div class="col-md-6  col-sm-6">
				<div class="input">
					<input class="form-control" type="text" id="EMAIL" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" />
					<i class="fa fa-envelope"></i>
				</div>
			</div>		
			<div class="col-md-6  col-sm-6">
				<?echo GetMessage("subscr_settings_note1")?> <?echo GetMessage("subscr_settings_note2")?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="subsection-title"><?echo GetMessage("subscr_rub")?><span class="required-star">*</span></div>
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<input type="checkbox" name="RUB_ID[]" id="rub_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
			<label for="rub_<?=$itemValue["ID"]?>"><?=$itemValue["NAME"]?></label>
		<?endforeach;?>
	</div>
	<div class="form-group">
		<div class="subsection-title"><?echo GetMessage("subscr_fmt")?></div>
		<input type="radio" id="text" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> />
		<label for="text"><?echo GetMessage("subscr_text")?></label>
		&nbsp;/&nbsp;
		<input type="radio" name="FORMAT" id="html" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> />
		<label for="html">HTML</label>
	</div>	

	<input type="submit" class="btn btn-default btn-md" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
	<input type="reset" class="btn btn-default white btn-md" value="<?echo GetMessage("subscr_reset")?>" name="reset" />

<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
