<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?define('STOP_STATISTICS', true);
//define('PUBLIC_AJAX_MODE', true);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$APPLICATION->IncludeComponent("bitrix:form.result.new", "wf_page_akciya", array(
    "SEF_MODE" => "",
    "WEB_FORM_ID" => 20,
    "LIST_URL" => "",
    "EDIT_URL" => "",
    "SUCCESS_URL" => "",
    "AJAX_MODE" => "Y", // режим AJAX
    "AJAX_OPTION_SHADOW" => "N", // затемнять область
    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
    "AJAX_OPTION_STYLE" => "N", // подключать стили
    "AJAX_OPTION_HISTORY" => "N",
    "CHAIN_ITEM_TEXT" => "",
    "CHAIN_ITEM_LINK" => "",
    "IGNORE_CUSTOM_TEMPLATE" => "Y",
    "USE_EXTENDED_ERRORS" => "Y",
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "3600",
    "SEF_FOLDER" => "",
    "VARIABLE_ALIASES" => array()
    )
);?>