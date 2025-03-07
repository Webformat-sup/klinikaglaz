<?
CScorp::getFieldImageData($arResult, array('DETAIL_PICTURE'));
if($arResult['DISPLAY_PROPERTIES']){
	$arResult['GALLERY'] = array();
	$arResult['VIDEO'] = array();

	if($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] && is_array($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'])){
		foreach($arResult['DISPLAY_PROPERTIES']['PHOTOS']['VALUE'] as $img){
			$arResult['GALLERY'][] = array(
				'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
				'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 600, 'height' => 400), BX_RESIZE_IMAGE_EXACT, true),
				'THUMB' => CFile::ResizeImageGet($img, array('width' => 75, 'height' => 75), BX_RESIZE_IMAGE_EXACT, true),
				'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE']  :(strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
				'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT']  : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
			);
		}
	}

	foreach($arResult['DISPLAY_PROPERTIES'] as $i => $arProp){
		if($arProp["VALUE"] || strlen($arProp["VALUE"])){
			if($arProp['USER_TYPE'] == 'video'){
				if (count($arProp['PROPERTY_VALUE_ID']) > 1) {
					foreach($arProp['VALUE'] as $val){
						if($val['path']){
							$arResult['VIDEO'][] = $val;
						}
					}
				}
				elseif($arProp['VALUE']['path']){
					$arResult['VIDEO'][] = $arProp['VALUE'];
				}
				unset($arResult['DISPLAY_PROPERTIES'][$i]);
			}
		}
	}
}
$link = '<div><a href="?print=Y" class="btn btn-default white link-on-print-template" target="_blank">Распечатать</a></div>';

$arResult['DETAIL_TEXT'] = str_replace("[loyalitycode]", $link, $arResult['DETAIL_TEXT']);
$arResult['FIELDS']['DETAIL_TEXT'] = str_replace("[loyalitycode]", $link, $arResult['DETAIL_TEXT']);


if(is_array($arResult['PROPERTIES']['LINK_SERVICES']['VALUE']))
{
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>13, "ID"=>$arResult['PROPERTIES']['LINK_SERVICES']['VALUE']);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext()) {
		
		$arResult['SERVICES'][$arFields['ID']] =$arFields['NAME'];

	}
}

$arResult["DATA_FINISH"] = $arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE'];
$arResult["PHONE"] = $arResult['PROPERTIES']['PHONE']['VALUE'];
$arResult["TITLE"] = $arResult['PROPERTIES']['FORM_TITLE']['VALUE']; 
//P($arResult["PHONE"]);
$cp = $this->__component; // объект компонента

if (is_object($cp))
{
	
   	$cp->SetResultCacheKeys(array('DATA_FINISH', 'PHONE', 'TITLE', 'SERVICES'));
}
?>