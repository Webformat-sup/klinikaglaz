<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"aspro:form.scorp", 
	"order", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_form",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_scorp_form"]["aspro_scorp_order_page"][0],
		"USE_CAPTCHA" => "N",
		"IS_PLACEHOLDER" => "N",
		"SEND_BUTTON_NAME" => GetMessage('T_BASKET_BUTTON_ORDER'),
		"SEND_BUTTON_CLASS" => "btn btn-default",
		"DISPLAY_CLOSE_BUTTON" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "order",
	),
	false,
	array('HIDE_ICONS' => 'Y')
);?>