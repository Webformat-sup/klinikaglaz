<?
// кодировка cp-1251
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach($arResult['SECTIONS'] as $skey=>$arSection){
	$arSelect = Array("*","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>$arSection['ID']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
	while($ob = $res->GetNextElement()){ 
		$arFields = $ob->GetFields();  
		$arProps = $ob->GetProperties();
		$arResult['SECTIONS'][$skey]['ITEMS'][$arFields['ID']] = $arFields;
		$arResult['SECTIONS'][$skey]['ITEMS'][$arFields['ID']]['PROPERTIES'] = $arProps;
	}	
}

$op = \Bitrix\Main\Config\Option::getForModule("ist.istwidget");
$arResult['OPTIONS'] = $op;