<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arParams['PRINT_TEMPLATE_CONDITION']) {
	$APPLICATION->SetAdditionalCss(rtrim($templateFolder,'/').'/print.css');
}
