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

if(is_array($arResult['SECTION']['PATH'])){
	$arCurSection = end($arResult['SECTION']['PATH']);
}else{
	$arCurSection = $arResult['SECTION'];
}
if(is_array($arCurSection)){
$rsResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" =>$arCurSection["ID"]), false, $arSelect = array("UF_*")); // возвращаем список разделов с нужными нам пользовательскими полями. UF_* - в таком виде выведет все доступные для данного раздела поля.
// $arParams["IBLOCK_ID"] - у вас может быть получением ID инфоблока другим способом
// $arResult["SECTION"]["ID"] - и ID раздела тоже, проверяйте через print_r($arResult);
if($arSection = $rsResult -> GetNext())
    { 
		$arUFIds=[];
		$arUFProps=[];
		foreach ($arSection as $key => $value) {
			switch($key){ 
				case 'UF_COST':
				case 'UF_REVIEWS':
				case 'UF_GALLERY':
					foreach ($value as $id) {
						$arUFIds[]= $id;
					}
					$arResult["SECTION_USER_FIELDS"][$key] = $value;
				break;
	
				case 'UF_SPECIALIST':
				case 'UF_ITEMS':
					$arResult["SECTION_USER_FIELDS"][$key] = $value;
				break;
				// case 'UF_ITEMS':
				// 	$arr = explode ( '\n' , $value );
				// 	array_push($arUFItems, $arr);
				// 	$arResult["SECTION_USER_FIELDS"][$key] = $arr;
				// break;
	
				case 'UF_PRICE_LINK':
				case 'UF_FORM_ID':
				case 'UF_VIDEO_DESCRIPTION':
				case 'UF_VIDEO_LINK':
				case 'UF_VIDEO_NAME':
					$arResult["SECTION_USER_FIELDS"][$key] = $value;
				break;
	
				default:
					continue;
			}

		}
		if($arUFIds){
			$arSelect = ["ID", "IBLOCK_ID", "NAME","PROPERTY_*",'PREVIEW_TEXT'];
			$arFilter = ["ID"=>$arUFIds, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y"];
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();
				$arUFProps[$arFields['ID']] = $arFields;
				$arUFProps[$arFields['ID']]['PROPS'] = $arProps;
			}
			if($arUFProps) $arResult['SECTION_USER_FIELDS_PROPS'] = $arUFProps;
		}
	}
}?>

<?/*
<pre>$arResult[SECTION_USER_FIELDS]:<br><?print_r($arUFProps)?></pre>*/?>
<div class="text_before_items">
	
</div>