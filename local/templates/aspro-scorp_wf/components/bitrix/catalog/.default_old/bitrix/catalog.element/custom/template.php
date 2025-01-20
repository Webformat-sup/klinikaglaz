<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\ModuleManager;
$CScorp = new CScorp;
$CCache = new CCache;

$strMainID = $this->GetEditAreaId($arResult['ID']);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;
$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);

$arProps = [];
foreach($arParams['PROPERTY_CODE'] as $key => $prop)
	$arProps[$arResult['PROPERTIES'][$prop]['SORT']] = $arResult['PROPERTIES'][$prop];
ksort($arProps);
?>
<div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $strMainID; ?>">


<div class="first-block">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">

		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="title-wrapp">
				<h1><?= $arResult['NAME'] ?></h1>
			</div>
			<div class="props-wrapp">
				<? foreach ($arProps as $key => $prop): ?>
					<? if(!empty($prop['VALUE'])): ?>
						<div class="prop-wrapp">
							<div class="prop-name">
								<span><?=$prop['NAME']?></span>
							</div>
							<div class="prop-value">
								<?if(is_array($prop["VALUE"]) && count($prop["VALUE"]) > 1):?>
									<span><?=implode(', ', $prop["VALUE"]);?></span>
								<?else:?>
									<span><?=$prop["VALUE"];?></span>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
				<? endforeach; ?>
			</div>
			<div class="price-wrapp">
				<span class="price">20 000 ₽</span> <span class="price-info">/ без стоимости услуги операции</span>
			</div>
			<div class="buttom-wrapp">
				<div class="btn-custom-sign" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="Монофокальная асферическая линза AcrySof IQ SN6OWF">Записаться на индивидуальный расчет</div>
			</div>
		</div>
	</div>
</div>

<?
$arReviewIds = [];
$arStaffIds = [];
$arCertificates = [];
$arPreparation = [];
$arMemo = [];

if($arResult['PROPERTIES']['LINK_STAFF']['VALUE']) 
		$arStaffIds = $arResult['PROPERTIES']['LINK_STAFF']['VALUE'];

if($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE']) 
		$arReviewIds = $arResult['PROPERTIES']['LINK_REVIEWS']['VALUE'];
?>
<div class="tab-block">
	<div class="row tabs-wrapp">
		<div class="col tab active" data-code="DETAIL_TEXT">Описание</div>
		<div class="col tab <?= (!$arReviewIds) ? 'disable' : '' ?>" data-code="LINK_REVIEWS">Отзывы <?= ($arReviewIds) ? '('.count($arReviewIds).')' : '';?></div>
		<div class="col tab <?= (!$arCertificates) ? 'disable' : '' ?>" data-code="">Сертификаты</div>
		<div class="col tab <?= (!$arStaffIds) ? 'disable' : '' ?>" data-code="LINK_STAFF">Врачи</div>
		<div class="col tab <?= (!$arPreparation) ? 'disable' : '' ?>" data-code="">Подготовка к операции</div>
		<div class="col tab <?= (!$arMemo) ? 'disable' : '' ?>" data-code="">Памятка пациенту</div>
	</div>
</div>

<div class="tabs-container">

	<div class="tab-detail" data-code="DETAIL_TEXT" data-select="open">
		<?if('html' == $arResult['DETAIL_TEXT_TYPE']):?>
			<?=$arResult['DETAIL_TEXT'];?>
		<?else:?>
			<p><?= $arResult['DETAIL_TEXT']; ?></p>
		<?endif?>
	</div>

	<div class="tab-review" data-code="LINK_REVIEWS" data-select="close">
		<?if($arReviewIds):?>
			<?
				$arRevies = $CCache->CIBlockElement_GetList(
					array(
						'CACHE' => array(
							'TAG' => $CCache->GetIBlockCacheTag($CCache::$arIBlocks[SITE_ID]['aspro_scorp_content']['aspro_scorp_reviews'][0]), 
							'MULTI' => 'Y'
						)
					), 
					array(
						'ID' => $arReviewIds, 
						'ACTIVE' => 'Y', 
						'GLOBAL_ACTIVE' => 'Y', 
						'ACTIVE_DATE' => 'Y'
					), 
					false, 
					false, 
					array('ID', 'NAME', 'IBLOCK_ID', 'PROPERTY_POST', 'PROPERTY_DOCUMENTS', 'PREVIEW_TEXT')
				);
			?>
			<div class="wraps nomargin">
				<div class="item-views image_left reviews">
					<div class="row items">
						<?$count = count($arRevies);?>
						<?foreach($arRevies as $arItem):?>
							<?
							// edit/add/delete buttons for edit mode
							$arItemButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], $arItem['ID'], 0, array('SESSID' => false, 'CATALOG' => true));
							$this->AddEditAction($arItem['ID'], $arItemButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItemButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="col-md-12 col-sm-12">
								<div class="item review" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<div class="it">
										<div class="text" id="text_<?=$arItem['ID']?>"><?=$arItem['PREVIEW_TEXT']?></div>
										<?if($arItem['PROPERTY_DOCUMENTS_VALUE']):?>
											<div class="row docs">
												<?foreach((array)$arItem['PROPERTY_DOCUMENTS_VALUE'] as $docID):?>
													<?$arFile = $CScorp->get_file_info($docID);?>
													<div class="col-md-6 <?=$arFile['TYPE']?>">
														<?
														$fileName = substr($arFile['ORIGINAL_NAME'], 0, strrpos($arFile['ORIGINAL_NAME'], '.'));
														$fileTitle = (strlen($arFile['DESCRIPTION']) ? $arFile['DESCRIPTION'] : $fileName);
														?>
														<a href="<?=$arFile['SRC']?>" target="_blank" title="<?=$fileTitle?>"><?=$fileTitle?></a>
														<?=GetMessage('CT_NAME_SIZE')?>:
														<?=$CScorp->filesize_format($arFile['FILE_SIZE']);?>
													</div>
												<?endforeach;?>
											</div>
										<?endif;?>
										<div class="border"></div>
									</div>
									<div class="info">
										<div class="title"><?=$arItem['NAME']?></div>
										<?if($arItem['PROPERTY_POST_VALUE']):?>
											<div class="post"><?=$arItem['PROPERTY_POST_VALUE']?></div>
										<?endif;?>
									</div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
			</div>
		<?endif;?>
	</div>

	<div class="tab-staff" data-code="LINK_STAFF" data-select="close">
		<?if($arStaffIds):?>
			<div class="wraps nomargin">
				<?global $arrrFilter; $arrrFilter = array('ID' => $arStaffIds);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"staff-linked", 
					array(
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
						"PAGER_TITLE" => "",
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
			</div>
		<?endif;?>
	</div>

</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.bigdata.products", 
	"custom", 
	array(
		"LINE_ELEMENT_COUNT" => 3,
		"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action")."_cbdp",
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
		"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
		"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
		"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
		"MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
		"PAGE_ELEMENT_COUNT" => 5,
		"SHOW_FROM_SECTION" => "N",
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"DEPTH" => "2",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SHOW_PRODUCTS_".$arParams["IBLOCK_ID"] => "Y",
		"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
		"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_ELEMENT_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_ELEMENT_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"ID" => $ElementID,
		"LABEL_PROP_".$arParams["IBLOCK_ID"] => $arParams['LABEL_PROP'],
		"PROPERTY_CODE_".$arParams["IBLOCK_ID"] => $arParams["LIST_PROPERTY_CODE"],
		"PROPERTY_CODE_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"CART_PROPERTIES_".$arParams["IBLOCK_ID"] => $arParams["PRODUCT_PROPERTIES"],
		"CART_PROPERTIES_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFERS_CART_PROPERTIES"],
		"ADDITIONAL_PICT_PROP_".$arParams["IBLOCK_ID"] => $arParams['ADD_PICT_PROP'],
		"ADDITIONAL_PICT_PROP_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams['OFFER_ADD_PICT_PROP'],
		"OFFER_TREE_PROPS_".$arRecomData['OFFER_IBLOCK_ID'] => $arParams["OFFER_TREE_PROPS"],
		"RCM_TYPE" => (isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '')
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?>