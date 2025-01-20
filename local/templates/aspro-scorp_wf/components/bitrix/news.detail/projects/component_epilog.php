<?php
$iblockId = $arResult['IBLOCK_ID'];
$elementId = $arResult['ID'];

if($iblockId && $elementId)
{
		$ipropElementValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($iblockId,$elementId);
		$seoPropValue = $ipropElementValues->getValues();

		$detailPathElement = $_SERVER['SERVER_NAME'] . $arResult['DETAIL_PAGE_URL'];
		$nameElement = $seoPropValue['ELEMENT_META_TITLE'];
		$descElement = $seoPropValue['ELEMENT_META_DESCRIPTION'];
		$imgPathElement = (!empty($arResult['PROPERTIES']['LINK_IMG_MICRO_JSON']['VALUE'])) ? $arResult['PROPERTIES']['LINK_IMG_MICRO_JSON']['VALUE'] : '';

		$mictoFormatJson = stringMicromarkingJsonProjects($detailPathElement, $nameElement, $descElement, $imgPathElement);
		$APPLICATION->AddHeadString("<script type=\"application/ld+json\">" . $mictoFormatJson . "</script>");
}
?>