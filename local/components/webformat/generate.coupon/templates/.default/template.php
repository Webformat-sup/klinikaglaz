<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

//webformatdebug::log($arParams,'arParams');
//webformatdebug::log($arResult,'arResult');
//webformatdebug::log($_SESSION,'_SESSION');

?>
<div class="webformat-generate-coupon-default"><?
	if($arParams['PRINT_TEMPLATE_CONDITION']){
		?><div class="coupon-value couponValue4js"><?=$arResult['COUPON']?></div><?
	} else {
		?><div class="coupon-value display-none couponValue4js"><?=$arResult['COUPON']?></div><?
		?><a href="#" class="btn btn-default getCoupon4js">Получить купон</a><?
	}
?></div><?

