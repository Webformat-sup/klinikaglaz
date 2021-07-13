<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arSectionsNames = array();
if (!empty($arResult["IBLOCK_SECTION_ID"])) {
  $arSection = GetIBlockSection($arResult["IBLOCK_SECTION_ID"]);
  $arResult["SECTION_NAME"] = $arSection["NAME"];
}
else {
  $arResult["SECTION_NAME"] = "";
}

if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"]))
{
    $arResult['RESIZE'] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array('width'=>1140, 'height'=>1140));
}
