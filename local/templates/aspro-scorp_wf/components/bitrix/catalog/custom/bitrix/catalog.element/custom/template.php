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

$mainImg = ($arResult['DETAIL_PICTURE']['SRC']) ?: $arResult['PREVIEW_PICTURE']['SRC'];

$arrayTabMenu = [];
$arrayTabProperty = [];
$arrayTabMenu[] = ['DETAIL_TEXT'=>'Описание'];
$arrayTabProperty[] = [
	'VALUE' => ($arResult['DETAIL_TEXT_TYPE'] == 'html') 
			? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>',
];

$arReviewIds = [];
$arStaffIds = [];
$arCertificates = [];
$arPreparation = (isset($arResult['PROPERTIES']['PREPARING_SURGERY']) && $arResult['PROPERTIES']['PREPARING_SURGERY']['VALUE']) ? true : false;
$arMemo = (isset($arResult['PROPERTIES']['PATIENT_REMINDER']) && $arResult['PROPERTIES']['PATIENT_REMINDER']['VALUE']) ? true : false;

if($arResult['PROPERTIES']['PHOTOS']['VALUE']) {
	foreach ($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $key => $id) {
		$arCertificates[] = CFile::ResizeImageGet($id, array('width' => 250, 'height' => 400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}
}

$price = ($arResult['PROPERTIES']['PRICE']['VALUE']) ?: '';
?>
<div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $strMainID; ?>">
<div class="first-block">
	<div class="row">
		<div class="img-block" href="<?= $mainImg ?>">
			<? if($mainImg): ?>
				<img src="<?= $mainImg ?>" alt="<?= $arResult['NAME'] ?>" />
			<? endif ?>
		</div>
		<div class="content-block">
			<div>
				<div class="title-wrapp"><h1><?= $arResult['NAME'] ?></h1></div>
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
				<? if($price){ ?>
					<div class="price-wrapp">
						<span class="price"><?= $price ?></span> <span class="price-info">/ без стоимости услуги операции</span>
					</div>
				<? } ?>
				<? if(isset($arResult['PROPERTIES']['LINK_PRICE']) && $arResult['PROPERTIES']['LINK_PRICE']['VALUE']){ ?>
					<a class="price-link" href="<?= $arResult['PROPERTIES']['LINK_PRICE']['VALUE'] ?>">
						<div class="price-link-img"><img src="/local/templates/aspro-scorp_wf/images/docs/xls.png" alt="прайс-лист" /></div>
						<div class="text">Ссылка на прайс лист</div>
					</a>
				<? } ?>
			</div>
			<div class="buttom-wrapp">
				<div class="btn-custom-sign" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?= $arResult['NAME'] ?>">Записаться на индивидуальный расчет</div>
			</div>
		</div>
	</div>
</div>
<?
if($arResult['PROPERTIES']['LINK_STAFF']['VALUE']) 
		$arStaffIds = $arResult['PROPERTIES']['LINK_STAFF']['VALUE'];

if($arResult['PROPERTIES']['LINK_REVIEWS']['VALUE']) 
		$arReviewIds = $arResult['PROPERTIES']['LINK_REVIEWS']['VALUE'];
?>
<div class="tab-block">
	<div class="row tabs-mobile">
		<div class="col">
			<span id="tabmobile-title" data-select="close">Описание</span>
			<img src="/upload/polygon _1.png" alt="polygon" />
		</div>
	</div>
	<div class="row tabs-wrapp">
		<div class="col tab active" data-code="DETAIL_TEXT">Описание</div>
		<div class="col tab  <?= (!$arReviewIds) ? 'disable' : '' ?>" data-code="LINK_REVIEWS">Отзывы <?= ($arReviewIds) ? '('.count($arReviewIds).')' : '';?></div>
		<div class="col tab <?= (!$arCertificates) ? 'disable' : '' ?>" data-code="LINK_CERTIF">Сертификаты</div>
		<div class="col tab <?= (!$arStaffIds) ? 'disable' : '' ?>" data-code="LINK_STAFF">Врачи</div>
		<div class="col tab <?= (!$arPreparation) ? 'disable' : '' ?>" data-code="LINK_PREPARING">Подготовка к операции</div>
		<div class="col tab <?= (!$arMemo) ? 'disable' : '' ?>" data-code="LINK_PATIENT">Памятка пациенту</div>
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
			<?$arRevies = $CCache->CIBlockElement_GetList(array('CACHE' => array('TAG' => $CCache->GetIBlockCacheTag($CCache::$arIBlocks[SITE_ID]['aspro_scorp_content']['aspro_scorp_reviews'][0]), 'MULTI' => 'Y')), array('ID' => $arReviewIds,'ACTIVE' => 'Y','GLOBAL_ACTIVE' => 'Y','ACTIVE_DATE' => 'Y'), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'PROPERTY_POST', 'PROPERTY_DOCUMENTS', 'PREVIEW_TEXT'));?>
			<div class="row items">
				<?foreach($arRevies as $arItem):?>
					<div class="col-md-12 col-sm-12">
						<div class="item review" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
							<div class="it">
								<div class="text" id="text_<?=$arItem['ID']?>">
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
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
						"COUNT_IN_LINE" => "4",
						"AJAX_OPTION_ADDITIONAL" => ""
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			</div>
		<?endif;?>
	</div>
	<div class="tab-certif" data-code="LINK_CERTIF" data-select="close">
		<? if($arCertificates): ?>
			<div class="certif swiper">
				<div class="certif-wrapp swiper-wrapper">
					<? foreach($arCertificates as $key => $item){ ?>
							<div class="item swiper-slide" data-fancybox="gallery-1" href="<?= $item['src'] ?>">
								<img class="pic" src="<?= $item['src'] ?>" alt="<?= $item['NAME'] ?>" data-image="<?= $item['src'] ?>" />
							</div>
					<? } ?>
				</div>
			</div>
			<script>
				var perView = 4;
				if($(window).width() <= 768) perView = 2;
				var selector;
				selector = '.tab-certif';
				var swiper_main = new Swiper(selector + " .swiper", {
						navigation: { 
							nextEl: selector + ' .nav-right', 
							prevEl: selector + ' .nav-left' 
						},
						slidesPerView: perView,
						spaceBetween: 20,
				});
				$(selector + ' .swiper-slide').fancybox();
			</script>
		<? endif; ?>
	</div>
	<div class="tab-preparing" data-code="LINK_PREPARING" data-select="close">
		<? if(isset($arResult['PROPERTIES']['PREPARING_SURGERY']) && $arResult['PROPERTIES']['PREPARING_SURGERY']['VALUE']): ?>
			<?if('HTML' == $arResult['PROPERTIES']['PREPARING_SURGERY']['VALUE']['TYPE']):?>
					<?=$arResult['PROPERTIES']['PREPARING_SURGERY']['VALUE']['TEXT'];?>
			<?else:?>
					<p><?=$arResult['PROPERTIES']['PREPARING_SURGERY']['VALUE']['TEXT'];?></p>
			<?endif?>
		<?endif?>
	</div>
	<div class="tab-patient" data-code="LINK_PATIENT" data-select="close">
		<? if(isset($arResult['PROPERTIES']['PATIENT_REMINDER']) && $arResult['PROPERTIES']['PATIENT_REMINDER']['VALUE']): ?>
			<?if('HTML' == $arResult['PROPERTIES']['PATIENT_REMINDER']['VALUE']['TYPE']):?>
					<?=$arResult['PROPERTIES']['PATIENT_REMINDER']['VALUE']['TEXT'];?>
			<?else:?>
					<p><?=$arResult['PROPERTIES']['PATIENT_REMINDER']['VALUE']['TEXT'];?></p>
			<?endif?>
		<?endif?>
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

<? 
if($arResult['PROPERTIES']['LINK_PRICE_OPERATION']['VALUE'])
{
	$arFilter = ["IBLOCK_ID" => 27, "=ID" => $arResult['PROPERTIES']['LINK_PRICE_OPERATION']['VALUE'], "ACTIVE"=>"Y"];
	$res = CIblockElement::GetList([], $arFilter, false, false, []);
	$u = 0;
	$elements = [];
	while($ob = $res->GetNextElement()){
			$elements[$u] = $ob->GetFields();
			$elements[$u]['PROPERTIES'] = $ob->GetProperties();
			$u++;
	}
?>
	<?if($elements){?>
		<div class="wraps price_operation">
			<hr />
			<h2>Стоимость операции</h2>
			<div class="row chars">
				<div class="col-md-12">
					<div class="char-wrapp">
						<table class="props_table">
						<?foreach($elements as $elem){?>
							<tr class="char">
								<td class="char_name">
									<span><?=$elem['NAME']?>
									<?if($elem['PREVIEW_TEXT']){?>
										<i class="fa fa-question question" data-trigger="click" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$elem['PREVIEW_TEXT']?>"></i>
										<?}?></span>
								</td>
								<td class="char_value">
									<?if(!empty($elem['PROPERTIES']['PRICE']['VALUE'])){?>
										<span>
											<?=$elem['PROPERTIES']['PRICE']['VALUE']?><br />
											(взрослые)
										</span>
										
									<?}?>	
									<?if(!empty($elem['PROPERTIES']['PRICE_KIDS']['VALUE'])){?>
										<span>
											<?=$elem['PROPERTIES']['PRICE_KIDS']['VALUE']?><br />
											(дети)
										</span>								
									<?}?>													
								</td>
							</tr>
						<?}?>
					</table>
					</div>
				</div>
			</div>			
		</div>
		<script>
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
	<?}?>
<? } ?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"wf_template2", 
	array(
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
		"EDIT_URL" => "",	// Страница редактирования результата
		"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
		"LIST_URL" => "",	// Страница со списком результатов
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SUCCESS_URL" => "/thanks/",	// Страница с сообщением об успешной отправке
		"USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
		"WEB_FORM_ID" => "22",	// ID веб-формы
		"COMPONENT_TEMPLATE" => "wf_template",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "",
			"RESULT_ID" => "",
		)
	),
	false
);?>

<?if(isset($arResult["PROPERTIES"]['LINK_VIDEO']) && $arResult["PROPERTIES"]['LINK_VIDEO']['VALUE']):?>
	<div class="video-container">
		<?$videoId = str_replace('https://youtu.be/','',$arResult["PROPERTIES"]['LINK_VIDEO']['VALUE']);?>
		<iframe width="480" height="360" title='video' src="https://www.youtube.com/embed/<?=$videoId?>?feature=oembed" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
	</div>
<?endif;?>


<?// projects links?>
<?if($arResult['PROPERTIES']['LINK_PROJECTS']['VALUE']):?>
	<?$arProjects = $CCache->CIBlockElement_GetList(array('CACHE' => array('TAG' => $CCache->GetIBlockCacheTag($CCache::$arIBlocks[SITE_ID]['aspro_scorp_content']['aspro_scorp_projects'][0]), 'MULTI' => 'Y')), array('ID' => $arResult['PROPERTIES']['LINK_PROJECTS']['VALUE'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));?>
	<div class="wraps nomargin projects-container">
		<hr />
		<h4 class="underline"><?=(strlen($arParams['T_PROJECTS']) ? $arParams['T_PROJECTS'] : GetMessage('T_PROJECTS'))?></h4>
		<div class="projects item-views table">
			<div class="row items">
				<?
				$itemsCount = count($arProjects);
				$arParams['COLUMN_COUNT'] = 3;
				//$arParams['COLUMN_COUNT'] = ($arParams['COLUMN_COUNT'] > 0 && $arParams['COLUMN_COUNT'] < 6) ? ($arParams['COLUMN_COUNT'] > $itemsCount ? $itemsCount : $arParams['COLUMN_COUNT']) : 3;
				$countmd = $arParams['COLUMN_COUNT'];
				$countsm = (($tmp = ceil($arParams['COLUMN_COUNT'] / 2)) > 2 ? $tmp : (!$tmp ? 1 : $tmp));
				$colmd = floor(12 / $countmd);
				$colsm = floor(12 / $countsm);
				?>
				<?foreach($arProjects as $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$arItemButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], $arItem['ID'], 0, array('SESSID' => false, 'CATALOG' => true));
					$this->AddEditAction($arItem['ID'], $arItemButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItemButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$thumb = CFile::GetPath($arItem['PREVIEW_PICTURE'] ? $arItem['PREVIEW_PICTURE'] : $arItem['DETAIL_PICTURE']);
					?>
					<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?>">
						<div class="item noborder" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink">
								<?// preview picture?>
								<div class="image">
									<?if($thumb):?>
										<img src="<?=$thumb?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" class="img-responsive" />
									<?else:?>
										<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/images/noimage.png" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" />
									<?endif;?>
								</div>
								<div class="info">
									<?// element name?>
									<div class="title">
										<span><?=$arItem['NAME']?></span>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?endforeach;?>
				<script type="text/javascript">
				$(document).ready(function(){
					$('.projects.item-views .item .image').sliceHeight({lineheight: -3});
					$('.projects.item-views .item .info').sliceHeight();
				});
				</script>
			</div>
		</div>
	</div>
<?endif;?>

<script>
	$('.first-block .img-block').fancybox();
</script>