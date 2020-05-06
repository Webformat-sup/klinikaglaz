<??><pre style="display: none;"><?print_r($arResult['META_TAGS'])?></pre><?
CScorp::getFieldImageData($arResult, array('DETAIL_PICTURE'));

if($arResult['DISPLAY_ACTIVE_FROM'] && strpos($arResult['META_TAGS']['BROWSER_TITLE'],'#DATE#')!==false){
	$arResult['META_TAGS']['BROWSER_TITLE'] = str_replace('#DATE#',' - '.$arResult['DISPLAY_ACTIVE_FROM'], $arResult['META_TAGS']['BROWSER_TITLE']);
	$arResult['META_TAGS']['DESCRIPTION'] = str_replace('#DATE#',' - '.$arResult['DISPLAY_ACTIVE_FROM'], $arResult['META_TAGS']['DESCRIPTION']);
}elseif(strpos($arResult['META_TAGS']['BROWSER_TITLE'],'#DATE#')!==false){
	$arResult['META_TAGS']['BROWSER_TITLE'] = str_replace('#DATE#','', $arResult['META_TAGS']['BROWSER_TITLE']);
	$arResult['META_TAGS']['DESCRIPTION'] = str_replace('#DATE#','', $arResult['META_TAGS']['DESCRIPTION']);
}

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
?>