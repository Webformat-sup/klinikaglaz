<?
define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
		
<?
$form_id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 1;
if(\Bitrix\Main\Loader::includeModule("aspro.next"))
{
	global $arRegion;
	if(!$arRegion)
		$arRegion = CNextRegionality::getCurrentRegion();
	CNext::GetValidFormIDForSite($form_id);
}
?>
<span class="jqmClose top-close fa fa-close"></span>
<?if($form_id != 7){?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:form",
		"wf_template",
		Array(
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_GROUPS" => "N",
			"CACHE_TIME" => "3600000",
			"CACHE_TYPE" => "A",
			"CHAIN_ITEM_LINK" => "",
			"CHAIN_ITEM_TEXT" => "",
			"EDIT_ADDITIONAL" => "N",
			"EDIT_STATUS" => "Y",
			"HIDDEN_CAPTCHA" => "",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"NOT_SHOW_FILTER" => "",
			"NOT_SHOW_TABLE" => "",
			"SEF_MODE" => "N",
			"SHOW_ADDITIONAL" => "N",
			"SHOW_ANSWER_VALUE" => "N",
			"SHOW_EDIT_PAGE" => "N",
			"SHOW_LICENCE" => "Y",
			"SHOW_LIST_PAGE" => "N",
			"SHOW_STATUS" => "N",
			"SHOW_VIEW_PAGE" => "N",
			"START_PAGE" => "new",
			"SUCCESS_URL" => "",
			"USE_EXTENDED_ERRORS" => "Y",
			"VARIABLE_ALIASES" => Array("action"=>"action"),
			"WEB_FORM_ID" => $form_id
		)
	);?>
<?}else{?>
	<?$APPLICATION->IncludeComponent(
		"aspro:form.scorp", "popup",
		Array(
			"IBLOCK_TYPE" => "aspro_corporation_form",
			"IBLOCK_ID" => 10,
			"USE_CAPTCHA" => N,
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "100000",
			"AJAX_OPTION_ADDITIONAL" => "",
			//"IS_PLACEHOLDER" => "Y",
			"SUCCESS_MESSAGE" => "Спасибо! Ваше сообщение отправлено!",
			"SEND_BUTTON_NAME" => "Отправить",
			"SEND_BUTTON_CLASS" => "btn btn-default",
			"DISPLAY_CLOSE_BUTTON" => "Y",
			"POPUP" => "Y",
			"CLOSE_BUTTON_NAME" => "Закрыть",
			"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-default bottom-close"
		)
	);?>
<?}?>