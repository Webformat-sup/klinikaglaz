<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
$CScorp = new CScorp;
$CCache = new CCache;
// get section items count and subsections
$arItemFilter = $CScorp->GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = $CScorp->GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = $CCache->CIblockElement_GetList(array("CACHE" => array("TAG" => $CCache->GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = $CCache->CIblockSection_GetList(array("CACHE" => array("TAG" => $CCache->GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE' ,'DETAIL_TEXT', 'UF_DOCTORS','UF_SP_VIEW'), true);
$CScorp->AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = $CScorp->GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
$arSubSections = $CCache->CIblockSection_GetList(array("CACHE" => array("TAG" => $CCache->GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID"));


$this->SetViewTarget('under_sidebar_pay_btn');
$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/under_sidebar_pay_btn.php",
		"EDIT_TEMPLATE" => ""
	)
);
$this->EndViewTarget();

?>
<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?$CScorp->goto404Page();?>
<?else:?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		$CScorp->ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}?>
	<?if($arSubSections):?>
		<?// sections list?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"sections",
			Array(
				"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
				"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
				"SORT_BY1"	=>	$arParams["SORT_BY1"],
				"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
				"SORT_BY2"	=>	$arParams["SORT_BY2"],
				"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
				"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
				"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
				"SET_TITLE"	=>	"N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
				"ADD_SECTIONS_CHAIN"	=>	"N",
				"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
				"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
				"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
				"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
				"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
				"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			),
			$component
		);?>
	<?endif;?>
	<?// section elements?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"services",
		Array(
			"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
			"S_ORDER_SERVICE" => $arParams["S_ORDER_SERVICE"],
			"T_GALLERY" => $arParams["T_GALLERY"],
			"T_DOCS" => $arParams["T_DOCS"],
			"T_GOODS" => $arParams["T_GOODS"],
			"T_SERVICES" => $arParams["T_SERVICES"],
			"T_PROJECTS" => $arParams["T_PROJECTS"],
			"T_REVIEWS" => $arParams["T_REVIEWS"],
			"T_STAFF" => $arParams["T_STAFF"],
			"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
			"SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
			"VIEW_TYPE" => $arParams["VIEW_TYPE"],
			"SHOW_TABS" => $arParams["SHOW_TABS"],
			"SHOW_NAME" => $arParams["SHOW_NAME"],
			"SHOW_DETAIL" => $arParams["SHOW_DETAIL"],
			"SHOW_IMAGE" => $arParams["SHOW_IMAGE"],
			"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
			"SORT_BY1"	=>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	=>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
			"SET_TITLE"	=>	$arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
			"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
			"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"INCLUDE_SUBSECTIONS" => "N",
			"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
		),
		$component
	);?>
<?endif;?>
<?// staff links?>




<?
$arSpecSecIds = is_array($arSection['UF_DOCTORS'])?$arSection['UF_DOCTORS']:array();
$modeSpec = 'ADD';
if($arSection && $arSection['UF_SP_VIEW']!= false)
{
	$modeSpec = 'CHANGE';
}
 $arSpecIds = [];
if($modeSpec == 'ADD')
{
	$dbServicesGroupedBySpecialities = \CIblockElement::getList(['PROPERTY_LINK_STAFF_VALUE' => 'ASC'], ['SECTION_ID' => $arSection['ID'], 'INCLUDE_SUBSECTIONS' => true], ['PROPERTY_LINK_STAFF']);
  while($res = $dbServicesGroupedBySpecialities->Fetch()) {
    $arSpecIds[$res['PROPERTY_LINK_STAFF_VALUE']] = $res['PROPERTY_LINK_STAFF_VALUE'];
  }
}
$arSpecIds = array_unique(array_merge($arSpecSecIds, $arSpecIds));
  if(!empty($arSpecIds)) {
  ?><div class="wraps nomargin wf-specialists">
    <hr />
    <h4 class="underline"><?=GetMessage('T_STAFFS') // GetMessage('T_STAFF')?></h4>
    <?global $arrrFilter; $arrrFilter = array('ID' => $arSpecIds);?>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "staff-linked", array(
      "IBLOCK_TYPE" => "aspro_scorp_content",
      "IBLOCK_ID" => $CCache::$arIBlocks[SITE_ID]["aspro_scorp_content"]["aspro_scorp_staff"][0],
      "NEWS_COUNT" => "30",
      "SORT_BY1" => "SORT",
      "SORT_ORDER1" => "DESC",
      "SORT_BY2" => "",
      "SORT_ORDER2" => "ASC",
      "FILTER_NAME" => "arrrFilter",
      "FIELD_CODE" => array(
        0 => "NAME",
        1 => "PREVIEW_TEXT",
        2 => "PREVIEW_PICTURE",
        3 => "",
      ),
      "PROPERTY_CODE" => array(
        0 => "EMAIL",
        1 => "POST",
        2 => "PHONE",
        3 => "",
      ),
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "CACHE_TYPE" => "A",
      "CACHE_TIME" => "360000",
      "CACHE_FILTER" => "Y",
      "CACHE_GROUPS" => "N",
      "PREVIEW_TRUNCATE_LEN" => "",
      "ACTIVE_DATE_FORMAT" => "d.m.Y",
      "SET_TITLE" => "N",
      "SET_STATUS_404" => "N",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "Y",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "INCLUDE_SUBSECTIONS" => "Y",
      "PAGER_TEMPLATE" => "",
      "DISPLAY_TOP_PAGER" => "N",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "PAGER_TITLE" => "Новости",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "VIEW_TYPE" => "table",
      "SHOW_TABS" => "N",
      "SHOW_SECTION_PREVIEW_DESCRIPTION" => "N",
      "IMAGE_POSITION" => "left",
      "COUNT_IN_LINE" => "3",
      "AJAX_OPTION_ADDITIONAL" => ""
      ),
      false, array("HIDE_ICONS" => "Y")
    );?>
  </div><?
  }
?>
<?php // микроразметка Json LD
$iblockId = $arParams['IBLOCK_ID'];
if($arResult['VARIABLES']['SECTION_CODE']){
		$iblockSectionId = CIBlockSection::GetList(
			[], ['IBLOCK_ID' => $iblockId, 'CODE' => $arResult['VARIABLES']['SECTION_CODE']]
		)->Fetch()['ID'];
}

$stringValue = '';
if($iblockId && $iblockSectionId)
{
		$codeCustomProp = 'UF_MICRORAZMETKA';
		$entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($iblockId);

		$customPropValue = $entity::getList([
			'select' => [$codeCustomProp], 
			'filter' => ['ID' => $iblockSectionId], 
			'cache' => ['ttl' => 36000],
		])->fetch()[$codeCustomProp];

		if($customPropValue && !empty($customPropValue)){
			$stringValue = $customPropValue;
		}else{
			$ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($iblockId, $iblockSectionId);
			$seoPropValue = $ipropSectionValues->getValues()['SECTION_META_DESCRIPTION'];
			$stringValue = (!empty($seoPropValue)) ? $seoPropValue : '';
		}
}

$url = $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'];
$mictoFormatJson = stringMicromarkingJson($url, $stringValue);
$APPLICATION->AddHeadString("<script type=\"application/ld+json\">" . $mictoFormatJson . "</script>");
?>