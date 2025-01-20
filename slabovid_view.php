<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetPageProperty("robots", "noindex, nofollow");
?>

<?$APPLICATION->IncludeComponent(
	"mibok:special_representation", 
	".default", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"ELEMENT_ID" => $_REQUEST["ID"],
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>