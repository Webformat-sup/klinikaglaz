<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arProducts = [];
foreach ($arResult['ITEMS'] as $k => $product) 
{
		$arProducts[$k] = [
			'ID' => $product['ID'],
			'IBLOCK_ID' => $product['IBLOCK_ID'],
			'NAME' => $product['NAME'],
			'IBLOCK_SECTION_ID' => $product['IBLOCK_SECTION_ID'],
			'SORT' => $product['SORT'],
			'DETAIL_PAGE_URL' => $product['DETAIL_PAGE_URL']
		];

		if($product['PREVIEW_PICTURE']['ID'] && true)
		{
				// $arFileTmp = CFile::ResizeImageGet(
				// 	$product['PREVIEW_PICTURE']['ID'],
				// 	["width" => 125, "height" => 225],
				// 	BX_RESIZE_IMAGE_PROPORTIONAL,
				// 	true,
				// 	[]
				// );

				// $arProducts[$k]['PREVIEW_PICTURE'] = [
				// 	'ID' => 1,
				// 	"SRC" => $arFileTmp['src']
				// ];
	
				$arProducts[$k]['PREVIEW_PICTURE'] = $product['PREVIEW_PICTURE'];
		}

		$arProducts[$k]['LOGOTIP'] = 
				$product['PROPERTIES']['LOGOTIP']['VALUE'] 
					? CFile::GetByID($product['PROPERTIES']['LOGOTIP']['VALUE'])->fetch() 
					: false;

		$arProducts[$k]['COUNTRY'] = $product['PROPERTIES']['SIZE']['VALUE'];

		$arProducts[$k]['SHOW'] = 
				($product['PROPERTIES']['SHOW_ON_INDEX_PAGE']['VALUE_ENUM_ID'] == '17') ? 'Y' : 'N';

}

$result = CIBlockSection::GetList(
	[],
	['IBLOCK_ID' => $arResult['IBLOCK_ID'],'ID' => $arResult['ID']],
	false,
	['UF_*']
);

$arSection = [];
if($section = $result->GetNext())
{ 
	$arSection['VIDEO'] = $section['UF_GZ_VIDEOS'];
	$arSection['STAFF'] = $section['UF_STAFF'];
	$arSection['VIEWTYPE'] = $section['UF_VIEWTYPE'];

	if($section['UF_GZ_QESTION_ANSWER'])
	{
			$rs = CIBlockElement::GetList(
				['SORT'=>'ASC'],['IBLOCK_ID' => 17, 'ID' => $section['UF_GZ_QESTION_ANSWER']],false,false,['ID','NAME','DETAIL_TEXT','PROPERTY_SUB_ELEMENTS']
			);
			
			$u = 1;
			while($ar = $rs->fetch()) 
			{
					if(!$arSection['QESTION_ANSWER'][$ar['ID']])
					{
							$arSection['QESTION_ANSWER'][$ar['ID']] = [
								'ID' => $ar['ID'],
								'NAME' => $ar['NAME'],
								'DETAIL_TEXT' => $ar['DETAIL_TEXT']
							];
					}

					if($ar['PROPERTY_SUB_ELEMENTS_VALUE'])
					{
						$rs_2 = CIBlockElement::GetList(
							['SORT'=>'ASC'],['IBLOCK_ID' => 17, 'ID' => $ar['PROPERTY_SUB_ELEMENTS_VALUE']],false,false,['ID','NAME','DETAIL_TEXT']
						)->fetch();
						$arSection['QESTION_ANSWER'][$ar['ID']]['SUB_ITEMS'][$u] = [
							'ID' => $rs_2['ID'],
							'NAME' => $rs_2['NAME'],
							'DETAIL_TEXT' => $rs_2['DETAIL_TEXT']
						];
						$u++;
					}
			}
	}

	if($section['UF_GZ_PRICE'])
	{
			$rs = CIBlockElement::GetList(
				['SORT'=>'ASC'],['IBLOCK_ID' => 27, 'ID' => $section['UF_GZ_PRICE']],false,false,['NAME','PROPERTY_PRICE']
			);
			while($ar = $rs->GetNext()) $arSection['PRICE'][] = $ar;
	}

	if($section['UF_GZ_REVIEWS'])
	{
			$rs = CIBlockElement::GetList(
				['SORT'=>'ASC'],['IBLOCK_ID' => 10, 'ID' => $section['UF_GZ_REVIEWS']],false,false,['NAME','PROPERTY_MESSAGE','PROPERTY_NAME','DATE_CREATE','PREVIEW_TEXT']
			);
			while($ar = $rs->GetNext()) $arSection['REVIEWS'][] = $ar;
	}

	if($section['UF_GZ_SERTIFS'])
	{

			foreach ($section['UF_GZ_SERTIFS'] as $k => $id) 
			{
					$arFileTmp = CFile::ResizeImageGet(
						$id,
						["width" => 250, "height" => 350],
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true,
						[]
					);

					$arSection['SERTIFS'][] = $arFileTmp['src'];
			}
	}
}

$arResult['SECTION_USER_FIELDS'] = $arSection;
$arResult['PRODUCTS'] = $arProducts;