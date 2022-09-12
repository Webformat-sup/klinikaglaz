<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Акции");
$APPLICATION->SetPageProperty("keywords_inner", "Акции");
$APPLICATION->SetPageProperty("title", "Акции");
$APPLICATION->SetPageProperty("description", "Акции");
$APPLICATION->SetTitle("Акции");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"sale", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "60",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"FILTER_NAME" => "arRegionLink",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/sale/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "j F Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "PERIOD",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "FORM_PRIEM",
			1 => "PHONE",
			2 => "LINK_SERVICES",
			3 => "FORM_TITLE",
			4 => "DATA_FINISH",
			5 => "PERIOD",
			6 => "FORM_QUESTION",
			7 => "FORM_ORDER",
			8 => "SUBTITLE",
			9 => "TEXT",
			10 => "TEXT_BOTTOM",
			11 => "LINK_STUDY",
			12 => "VIDEO",
			13 => "PHOTOS",
			14 => "DOCUMENTS",
			15 => "",
		),
		"IBLOCK_CATALOG_TYPE" => "aspro_next_catalog",
		"DISPLAY_DATE" => "N",
		"SHOW_FAQ_BLOCK" => "N",
		"SHOW_BACK_LINK" => "N",
		"GALLERY_PROPERTY" => "MORE_PHOTO",
		"SHOW_GALLERY" => "N",
		"LINKED_PRODUCTS_PROPERTY" => "LINK",
		"SHOW_LINKED_PRODUCTS" => "Y",
		"PRICE_PROPERTY" => "PRICE",
		"SHOW_PRICE" => "N",
		"PERIOD_PROPERTY" => "PERIOD",
		"SHOW_PERIOD" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"IMAGE_POSITION" => "left",
		"PAGER_TEMPLATE" => "main",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"CATALOG_FILTER_NAME" => "arrProductsFilter",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "sale",
		"SET_LAST_MODIFIED" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"IS_VERTICAL" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"SHOW_SERVICES_BLOCK" => "N",
		"SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_1",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"STRICT_SECTION_CHECK" => "Y",
		"S_ASK_QUESTION" => "",
		"S_ORDER_SERVISE" => "",
		"FORM_ID_ORDER_SERVISE" => "",
		"T_GALLERY" => "",
		"T_DOCS" => "",
		"T_GOODS" => "Товары по акции",
		"T_SERVICES" => "",
		"T_NEXT_LINK" => "",
		"T_PREV_LINK" => "",
		"SHOW_DETAIL_LINK" => "Y",
		"SHOW_FILTER_DATE" => "N",
		"LINE_ELEMENT_COUNT_LIST" => "3",
		"SHOW_NEXT_ELEMENT" => "N",
		"USE_SHARE" => "Y",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"T_STUDY" => "",
		"T_VIDEO" => "",
		"FILE_404" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>