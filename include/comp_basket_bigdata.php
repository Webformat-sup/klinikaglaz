<?global $arRegion;
if($arRegion)
{
	if($arRegion['LIST_PRICES'])
	{
		if(reset($arRegion['LIST_PRICES']) != 'component')
			$arParams['PRICE_CODE'] = array_keys($arRegion['LIST_PRICES']);
	}
	if($arRegion['LIST_STORES'])
	{
		if(reset($arRegion['LIST_STORES']) != 'component')
			$arParams['STORES'] = $arRegion['LIST_STORES'];
	}
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.bigdata.products", 
	"next_new", 
	array(
		"LINE_ELEMENT_COUNT" => "5",
		"TEMPLATE_THEME" => "blue",
		"DETAIL_URL" => "",
		"BASKET_URL" => SITE_DIR."basket/",
		"ACTION_VARIABLE" => "ACTION",
		"PRODUCT_ID_VARIABLE" => "ID",
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"STORES" => $arParams["STORES"],
		"USE_REGION" => ($arRegion ? "Y" : "N"),
		"SHOW_PRICE_COUNT" => "1",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PRICE_VAT_INCLUDE" => isset($arParams["PRICE_VAT_INCLUDE"]) ? $arParams["PRICE_VAT_INCLUDE"] : "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => $arParams["MESS_NOT_AVAILABLE"],
		"STIKERS_PROP" => $arParams["STIKERS_PROP"],
		"SALE_STIKER" => $arParams["SALE_STIKER"],
		"PAGE_ELEMENT_COUNT" => "20",
		"SHOW_FROM_SECTION" => "N",
		"ADD_PICT_PROP" => ($arParams["ADD_PICT_PROP"] ? $arParams["ADD_PICT_PROP"] : 'MORE_PHOTO'),
		"OFFER_ADD_PICT_PROP" => ($arParams["OFFER_ADD_PICT_PROP"] ? $arParams["OFFER_ADD_PICT_PROP"] : 'MORE_PHOTO'),
		"GALLERY_ITEM_SHOW" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["VALUE"],
		"MAX_GALLERY_ITEMS" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["DEPENDENT_PARAMS"]["MAX_GALLERY_ITEMS"]["VALUE"],
		"ADD_DETAIL_TO_GALLERY_IN_LIST" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["DEPENDENT_PARAMS"]["ADD_DETAIL_TO_GALLERY_IN_LIST"]["VALUE"],
		"REVIEWS_VIEW" => $GLOBALS["arTheme"]["REVIEWS_VIEW"]["VALUE"] == 'EXTENDED',
		"IBLOCK_TYPE" => "aspro_next_catalog",
		"IBLOCK_ID" => "46",
		"DEPTH" => "2",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "86400",
		"CACHE_GROUPS" => "N",
		"HIDE_NOT_AVAILABLE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_ELEMENT_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_ELEMENT_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"ID" => "",
		"={\"PROPERTY_CODE_\".\$arParams[\"IBLOCK_ID\"]}" => $arParams["LIST_PROPERTY_CODE"],
		"={\"CART_PROPERTIES_\".\$arParams[\"IBLOCK_ID\"]}" => $arParams["PRODUCT_PROPERTIES"],
		"RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : ''),
		"={\"OFFER_TREE_PROPS_\".\$ElementOfferIblockID}" => $arParams["OFFER_TREE_PROPS"],
		"={\"ADDITIONAL_PICT_PROP_\".\$ElementOfferIblockID}" => $arParams["OFFER_ADD_PICT_PROP"],
		"COMPONENT_TEMPLATE" => "next_new",
		"SHOW_PRODUCTS_46" => "Y",
		"PROPERTY_CODE_46" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_46" => array(
		),
		"ADDITIONAL_PICT_PROP_46" => "MORE_PHOTO",
		"LABEL_PROP_46" => "-",
		"PROPERTY_CODE_49" => array(
			0 => "",
			1 => "",
		),
		"CART_PROPERTIES_49" => array(
			0 => "undefined",
		),
		"ADDITIONAL_PICT_PROP_49" => "MORE_PHOTO",
		"OFFER_TREE_PROPS_49" => array(
		),
		"DISPLAY_COMPARE" => "Y",
		"SHOW_RATING" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false, array('HIDE_ICONS' => 'Y')
);
?>