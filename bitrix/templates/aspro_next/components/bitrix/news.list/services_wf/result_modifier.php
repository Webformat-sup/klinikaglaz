<?
foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	CScorp::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}

$sectionResult = CIBlockSection::GetList(array('SORT' => 'ASC'), array('IBLOCK_ID' => 13, 'ID' => $arSectionsIDs), false, $arSelect = array('UF_*'));
while ($sectionProp = $sectionResult -> GetNext())
{
print_r($sectionProp['UF_INFOTEXT']);
}


?>
<div class="text_before_items">
	
</div>