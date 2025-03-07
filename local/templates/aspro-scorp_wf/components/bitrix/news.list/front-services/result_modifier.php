<?
$CScorp = new CScorp();
$CCache = new CCache();
if($arParams['SHOW_SECTIONS'] !== 'N'){
	// get all subsections of PARENT_SECTION or root sections
	$cntSections = (isset($arParams['SECTIONS_COUNT']) && strlen($arParams['SECTIONS_COUNT'])) ? intval($arParams['SECTIONS_COUNT']) : 999;
	$arSectionsFilter = array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'ACTIVE' => 'Y',
		'GLOBAL_ACTIVE' => 'Y',
		'ACTIVE_DATE' => 'Y',
	);
	if($arParams['PARENT_SECTION']){
		$arSectionsFilter = array_merge($arSectionsFilter, array(
			'SECTION_ID' => $arParams['PARENT_SECTION'],
			'>DEPTH_LEVEL' => '1',
		));
	}
	else{
		$arSectionsFilter['DEPTH_LEVEL'] = 1;
	}
	if($arResult['SECTIONS'] = $CCache->CIBLockSection_GetList(
		array(
			'SORT' => 'ASC',
			'NAME' => 'ASC',
			'CACHE' => array(
				'TAG' => $CCache->GetIBlockCacheTag($arParams['IBLOCK_ID']),
				'GROUP' => array('ID'),
				'MULTI' => 'N'
			)
		),
		$arSectionsFilter,
		false,
		array(
			'ID',
			'NAME',
			'IBLOCK_ID',
			'DEPTH_LEVEL',
			'SECTION_PAGE_URL',
			'PICTURE',
			'DETAIL_PICTURE',
			'UF_INFOTEXT',
			'DESCRIPTION'
		),
		array('nTopCount' => $cntSections)
	)){
		foreach($arResult['SECTIONS'] as $key => $arSection){
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection['IBLOCK_ID'], $arSection['ID']);
			$arResult['SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();
			$CScorp->getFieldImageData($arResult['SECTIONS'][$key], array('PICTURE'), 'SECTION');
		}
	}
}

if($arParams['SHOW_GOODS'] !== 'N'){
	// get goods with property SHOW_ON_INDEX_PAGE == Y
	if($arResult['ITEMS']){
		foreach($arResult['ITEMS'] as $i => $arItem){
			$CScorp->getFieldImageData($arResult['ITEMS'][$i], array('PREVIEW_PICTURE'));
			if($arItem['PROPERTIES']['SHOW_ON_INDEX_PAGE']['VALUE_XML_ID'] !== 'YES'){
				unset($arResult['ITEMS'][$i]);
				unset($arResult['ELEMENTS'][$i]);
			}
			else{
				$arGoodsSectionsIDs[] = $arItem['IBLOCK_SECTION_ID'];
			}
		}

		// get good`s section name
		if($arGoodsSectionsIDs){
			$arGoodsSectionsIDs = array_unique($arGoodsSectionsIDs);
			if($arGoodsSections = $CCache->CIBLockSection_GetList(
				array(
					'CACHE' => array(
						'TAG' => $CCache->GetIBlockCacheTag($arParams['IBLOCK_ID']),
						'GROUP' => array('ID'),
						'MULTI' => 'N',
						'RESULT' => array('NAME')
					)
				),
				array(
					'ID' => $arGoodSectionsIDs
				),
				false,
				array(
					'ID',
					'NAME',
				),
				array('nTopCount' => $arParams['SECTIONS_COUNT'])
			)){
				foreach($arResult['ITEMS'] as $i => $arItem){
					$arResult['ITEMS'][$i]['SECTION_NAME'] = $arGoodsSections[$arItem['IBLOCK_SECTION_ID']];
				}
			}
		}
	}
}
?>