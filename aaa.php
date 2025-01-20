<? die() ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>



<? 



/*
set_time_limit(0);
define("NOT_CHECK_PERMISSIONS",true);
// $_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/ext_www/klinikaglaz.ru/";

// require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use \Bitrix\Main\Entity;
\Bitrix\Main\Loader::IncludeModule('iblock');

$fileSave = $_SERVER["DOCUMENT_ROOT"] . "/upload/yml_catalog_vrach.xml";
$arSets = [];
$arElement = [];
$domen = 'https://klinikaglaz.ru';

$u = 0;
$IBLOCK_ID = 8;
$arSelect = [];
$arFilter = ["IBLOCK_ID"=>$IBLOCK_ID,'ACTIVE'=>'Y'];
$res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
while($arFields = $res->GetNextElement())
{
	
		$fields = $arFields->GetFields();
		// if($fields['ID'] != 125) continue;
		$arProps = $arFields->GetProperties();

		if($arProps['DOCTOR_SPECIALT']['VALUE']){
			foreach ($arProps['DOCTOR_SPECIALT']['VALUE'] as $value) 
					$strSpecialt = trim($value);
					$arElement[$u]['DOCTOR_SPECIALT'][] = $arSets[] = str_replace("&quot;", '', $strSpecialt);
		}

		$arElement[$u]['ID'] = $fields['ID'];
		$arElement[$u]['NAME'] = $fields['NAME'];
		if($fields['PREVIEW_PICTURE']){ // 100 × 100 пикселей (квадрат).
			$arElement[$u]['PREVIEW_PICTURE'] = $domen . CFile::GetPath($fields['PREVIEW_PICTURE']);
		}
		$arElement[$u]['DETAIL_PAGE_URL'] = $domen . $fields['DETAIL_PAGE_URL'];

		$arElement[$u]['EXPERIENCE'] = $arProps['EXPERIENCE']['VALUE'];
		if($arProps['DEC_FID']['VALUE']){
			$strDescription = str_replace(array("&quot;"), '', $arProps['DEC_FID']['VALUE']);
			// $strDescription = str_replace(array("\r", "\n", "&quot;"), '', $arProps['DEC_FID']['VALUE']);
			$arElement[$u]['DEC_FID'] = strip_tags($strDescription);
		}

		if($arProps['POST']['VALUE']){
			$arElement[$u]['POST'] = str_replace('&quot;', '', $arProps['POST']['VALUE']);
		}

		$u++;
}

$arSets = array_unique($arSets);
$arParams = array( "replace_space" => "_", "replace_other" => "_"); 
foreach ($arSets as $key => $value) 
{
		$code = CUtil::translit($value, "ru", $arParams);
		$arSets[$value] = $code;
		unset($arSets[$key]);
}


$xmlWriter = new \XMLWriter();
$xmlWriter->openMemory();
$xmlWriter->startDocument('1.0', 'UTF-8');
$xmlWriter->setIndent(true);
file_put_contents($fileSave, $xmlWriter->flush(true));
// file_put_contents($fileSave, $headerFile . PHP_EOL, FILE_APPEND);
$xmlWriter->startElement('yml_catalog');
$xmlWriter->writeAttribute("date", date('Y-m-d H:i:s'));
$xmlWriter->startElement('shop');

	$xmlWriter->writeElement('name', 'Клиника микрохирургии ГЛАЗ');
	$xmlWriter->writeElement('company', 'ООО Клиника микрохирургии ГЛАЗ им. академика С.Н. Фёдорова');
	$xmlWriter->writeElement('url', $domen);
	$xmlWriter->writeElement('email', 'reception@klinikaglaz.ru');
	$xmlWriter->writeElement('picture', 'https://klinikaglaz.ru/upload/logotip_klinikaglaz.png');
	$xmlWriter->writeElement('description', 'Каталог врачей');

	$xmlWriter->startElement('currencies');
		$xmlWriter->startElement('currency');
			$xmlWriter->writeAttribute("id", 'RUB');
			$xmlWriter->writeAttribute("rate", 1);
		$xmlWriter->endElement();
	$xmlWriter->endElement();

	$xmlWriter->startElement('categories');
		$xmlWriter->startElement('category');
			$xmlWriter->writeAttribute('id', '1');
			$xmlWriter->text('Врач');
		$xmlWriter->endElement();
	$xmlWriter->endElement();


	$xmlWriter->startElement('sets');
	foreach($arSets as $k => $set)
	{
			$xmlWriter->startElement('set');
				$xmlWriter->writeAttribute('id', $set);
				$xmlWriter->writeElement('name', $k);
				// $xmlWriter->writeElement('url', $domen.'/'.$set);
				$xmlWriter->writeElement('url', $domen); // ???
			$xmlWriter->endElement();
	}
	$xmlWriter->endElement();


	// group_id - уникальный идентификтаор врача. нужен при наличии разных URL у одного человека. Целое число, не более 9 знаков
	$xmlWriter->startElement('offers');
	foreach($arElement as $element)
	{  
				// не у всех врачей заполнен Опыт работы (обязательное поле)
				if(!$element['EXPERIENCE']) continue;

				$strSpec = '';
				if($element['DOCTOR_SPECIALT']){
					foreach ($element['DOCTOR_SPECIALT'] as $specialt) {
						if(!strlen($strSpec)) $strSpec = $arSets[$specialt];
						else $strSpec .= ','.$arSets[$specialt];
					}
				}

				$xmlWriter->startElement('offer');

					$xmlWriter->writeAttribute('id', 'vrach'.$element['ID']);
					$xmlWriter->writeAttribute('group_id', $element['ID']);
					$xmlWriter->writeElement('name', $element['NAME']);
					$xmlWriter->writeElement('url', $element['DETAIL_PAGE_URL']);

					$xmlWriter->startElement('price');
						$xmlWriter->writeAttribute('from', 'true');
						$xmlWriter->text('0');
					$xmlWriter->endElement();

					$xmlWriter->writeElement('currencyId', 'RUR');

					$xmlWriter->writeElement('sales_notes', 'Цена неизвестна');

					if($strSpec){
						$xmlWriter->writeElement('set-ids', $strSpec);
					}
					if($element['PREVIEW_PICTURE']){
						$xmlWriter->writeElement('picture', $element['PREVIEW_PICTURE']);
					}


					if($element['DEC_FID']){
						$xmlWriter->writeElement('description', $element['DEC_FID']);
					}
					$xmlWriter->writeElement('categoryId', '1');
					
					$xmlWriter->startElement('param');
						$xmlWriter->writeAttribute('name', 'Годы опыта');
						$xmlWriter->text(preg_replace('/[^0-9]/', '', $element['EXPERIENCE']));
					$xmlWriter->endElement();
					
					$xmlWriter->startElement('param');
						$xmlWriter->writeAttribute('name', 'Город');
						$xmlWriter->text('Екатеринбург');
					$xmlWriter->endElement();

					$xmlWriter->startElement('param');
						$xmlWriter->writeAttribute('name', 'Адрес клиники');
						$xmlWriter->text('Екатеринбург, Н. Никонова 18');
					$xmlWriter->endElement();

					$xmlWriter->startElement('param');
						$xmlWriter->writeAttribute('name', 'Название клиники');
						$xmlWriter->text('Клиника микрохирургии «ГЛАЗ» им. академика Святослава Фёдорова');
					$xmlWriter->endElement();

					$xmlWriter->startElement('param');
						$xmlWriter->writeAttribute('name', 'Телефон для записи');
						$xmlWriter->text('+7(343)38-48-654');
					$xmlWriter->endElement();



				$xmlWriter->endElement();
	}
	$xmlWriter->endElement();
	
/////
$xmlWriter->endElement(); // shop
$xmlWriter->endElement(); // yml_catalog
$xmlWriter->endElement();
file_put_contents($fileSave, $xmlWriter->flush(true), FILE_APPEND);
*/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>