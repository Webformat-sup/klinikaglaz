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
<?$GLOBALS['arrProductsFilter']['INCLUDE_SUBSECTIONS'] = 'Y';?>
<?$propertyCodeList = CNext::GetFrontParametrValue("CATALOG_LINKED_PROP", SITE_ID);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"products_slider", 
	array(
		"COMPATIBLE_MODE" => "Y",
		"IBLOCK_TYPE" => "aspro_next_catalog",
		"IBLOCK_ID" => "46",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD" => ($arParams["LINKED_ELEMENT_TAB_SORT_FIELD"] ? $arParams["LINKED_ELEMENT_TAB_SORT_FIELD"] : "SORT"),
		"ELEMENT_SORT_ORDER" => ($arParams["LINKED_ELEMENT_TAB_SORT_ORDER"] ? $arParams["LINKED_ELEMENT_TAB_SORT_ORDER"] : "ASC"),
		"ELEMENT_SORT_FIELD2" => ($arParams["LINKED_ELEMENT_TAB_SORT_FIELD2"] ? $arParams["LINKED_ELEMENT_TAB_SORT_FIELD2"] : "ID"),
		"ELEMENT_SORT_ORDER2" => ($arParams["LINKED_ELEMENT_TAB_SORT_ORDER2"] ? $arParams["LINKED_ELEMENT_TAB_SORT_ORDER2"] : "DESC"),
		"ELEMENT_COUNT" => "20",
		"LINE_ELEMENT_COUNT" => "",
		"PROPERTY_CODE" => (strlen(trim($propertyCodeList)) ? explode(',', $propertyCodeList) : []),
		"OFFERS_LIMIT" => "10",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"BASKET_URL" => SITE_DIR."basket/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_GROUPS" => "N",
		"CACHE_FILTER" => "Y",
		"DISPLAY_COMPARE" => "Y",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"STORES" => $arParams["STORES"],
		"USE_REGION" => ($arRegion ? "Y" : "N"),
		"USE_PRICE_COUNT" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"CONVERT_CURRENCY" => "N",
		"FILTER_NAME" => "arrProductsFilter",
		"SHOW_BUY_BUTTONS" => $arParams["SHOW_BUY_BUTTONS"],
		"USE_PRODUCT_QUANTITY" => "N",
		"INIT_SLIDER" => "Y",
		"COMPONENT_TEMPLATE" => "products_slider",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"HIDE_NOT_AVAILABLE" => "N",
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "NAME",
			2 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"SEF_MODE" => "N",
		"ADD_PICT_PROP" => ($arParams["ADD_PICT_PROP"] ? $arParams["ADD_PICT_PROP"] : 'MORE_PHOTO'),
		"OFFER_ADD_PICT_PROP" => ($arParams["OFFER_ADD_PICT_PROP"] ? $arParams["OFFER_ADD_PICT_PROP"] : 'MORE_PHOTO'),
		"GALLERY_ITEM_SHOW" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["VALUE"],
		"MAX_GALLERY_ITEMS" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["DEPENDENT_PARAMS"]["MAX_GALLERY_ITEMS"]["VALUE"],
		"ADD_DETAIL_TO_GALLERY_IN_LIST" => $GLOBALS["arTheme"]["GALLERY_ITEM_SHOW"]["DEPENDENT_PARAMS"]["ADD_DETAIL_TO_GALLERY_IN_LIST"]["VALUE"],
		"REVIEWS_VIEW" => $GLOBALS["arTheme"]["REVIEWS_VIEW"]["VALUE"] == 'EXTENDED',
		"CACHE_FILTER" => "Y",
		"SHOW_MEASURE" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"OFFERS_CART_PROPERTIES" => array(
		),
		"COMPARE_PATH" => "",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_RATING" => $arParams["SHOW_RATING"],
		"STIKERS_PROP" => $arParams["STIKERS_PROP"],
		"SALE_STIKER" => $arParams["SALE_STIKER"],
		"TITLE" => $arParams["TITLE"],
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false, array("HIDE_ICONS" => "Y")
);?>