<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Опрос");
?><?$APPLICATION->IncludeComponent(
	"ist.istwidget:ist.widget",
	"",
	Array(
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "79",
		"IBLOCK_TYPE" => "ist_service_widget_type",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("UF_*",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "LINE"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>