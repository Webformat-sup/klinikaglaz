<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;
$CScorp = new CScorp;
$CCache = new CCache;
$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$sectionViewType = 'LIST';
if($arResult['SECTION_USER_FIELDS']['VIEWTYPE'] == '1') $sectionViewType = 'TABLE';
?>
<div class="maxwidth-theme">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"custom",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult['ORIGINAL_PARAMETERS']["SECTION_ID"],
		"SECTION_CODE" => $arResult['ORIGINAL_PARAMETERS']["SECTION_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult['ORIGINAL_PARAMETERS']["SECTION_URL"],
		"VIEW_MODE" => $sectionViewType,
		"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
		"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
		"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
	),
	$component,
	array("HIDE_ICONS" => "Y")
);?>
</div>
<div id="section-wrapp">
	<div id="<?= $this->GetEditAreaId($arResult['ID']) ?>" class="maxwidth-theme">

		<? if($arResult['PRODUCTS']){ ?>
			<div class="products-container swiper">
				<? if(count($arResult['PRODUCTS']) > 5){ ?>
					<!-- <div class="products-more"><?=Loc::getMessage('CT_PRODUCT_MORE');?></div> -->
				<?}?> 
				<div class="products-wrapp swiper-wrapper">
					<? foreach($arResult['PRODUCTS'] as $k => $product){ ?>
						<? if($product['SHOW'] == 'Y') { ?>
							<div class="product swiper-slide">
								<div class="manufacturer-block">
									<? if($product['LOGOTIP']){ ?>
										<div class="manufacturer">
											<img src="<?=$product['LOGOTIP']['SRC']?>" alt="<?=$product['NAME']?>" />
										</div>
									<?}?>
									<?if($product['COUNTRY']){?>
										<div class="country">(<?=$product['COUNTRY']?>)</div>
									<?}?>
								</div>
								<div class="product-name"><?=$product['NAME']?></div>
								<a href="<?=$product['DETAIL_PAGE_URL']?>" class="product-more">
									<span><?=Loc::getMessage('CT_LEARN_MORE');?></span>
								</a>
							</div>
						<?}?>
					<?}?>
				</div>
			</div>
			<script>
				var swiper_main = new Swiper(".products-container.swiper", {
						spaceBetween: 20,
						slidesPerView: 5,
						breakpoints: {
							320: { slidesPerView: 2, spaceBetween: 20 },
							768: { slidesPerView: 4, spaceBetween: 20 },
							992: { slidesPerView: 5, spaceBetween: 20 }
						}
				});
			</script>
		<?}?>

		<? if(!empty($arResult['DESCRIPTION'])){ ?>
			<div class="info-container info-1">
				<p><?= $arResult['DESCRIPTION'] ?></p>
			</div>
			<div style="clear:both"></div>
		<? } ?>
		<? if($arResult['SECTION_USER_FIELDS']['QESTION_ANSWER']){ ?>
			<div class="collapse-container">
				<div class="title"><?=Loc::getMessage('CT_COLLAPSE_TITLE');?></div>
					<? foreach ($arResult['SECTION_USER_FIELDS']['QESTION_ANSWER'] as $k => $item) { ?>
						<div class="collapse-item" data-id="<?=$k?>" data-status="<?=($k == 0)?'open':'close'?>">
							<div class="header">
								<div class="header-title"><?=$item['NAME']?></div>
								<div class="header-icon">
									<img data-id="<?=$k?>" data-code="open" class="i-open" src="/upload/icon-open.png" alt="open" />
									<img data-id="<?=$k?>" data-code="close" class="i-close" src="/upload/icon-close.png" alt="close" />
								</div>
							</div>
							<div class="content">
								<?if($item['DETAIL_TEXT']){?>
									<p><?=$item['DETAIL_TEXT']?></p>
								<?}?>
								<? if($item['SUB_ITEMS']){?>
									<div class="info-container">
										<? foreach ($item['SUB_ITEMS'] as $k2 => $subitem) { ?>
											<div class="info-item">
												<div class="info-title"><?=$subitem['NAME']?></div>
												<div class="info-content">
													<?=$subitem['DETAIL_TEXT']?>
												</div>
											</div>
										<?}?>
									</div>
								<?}?>
							</div>
						</div>
					<?}?>
			</div>
		<?}?>

		<div class="info-container info-2">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
				"AREA_FILE_SHOW" => "sec",
				"AREA_FILE_SUFFIX" => "info_container_".$arResult['CODE'],
				"EDIT_TEMPLATE" => "standard.php"
				),
				false
			);?>&nbsp;
		</div>

		<div class="order-block form-container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 valign">
					<span class="btn-custom-sign" data-event="jqm" data-param-id="5"  data-name="order_services" data-autoload-service="<?=$arResult["NAME"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/sign.svg" height="54"/></span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 valign">
					<div class="text"><?=Loc::getMessage('CT_FORM_TEXT');?></div>
				</div>
			</div>
		</div>
	</div>

	<? if($arResult['SECTION_USER_FIELDS']['PRICE']){ ?>
		<div class="pricelist-container">
			<div class="maxwidth-theme">
				<div class="pricelist-wrapp">
					<h2><?=Loc::getMessage('CT_PRICE_TITLE');?></h2>
					<div class="pricelist-text user-edit"><?=Loc::getMessage('CT_PRICE_TEXT_1');?></div>
					<div class="pricelist-list">
						<? foreach($arResult['SECTION_USER_FIELDS']['PRICE'] as $k => $item){ ?>
							<div class="item">
								<div class="text"><?=$item['NAME']?></div>
								<div class="price"><?=$item['PROPERTY_PRICE_VALUE']?> ₽</div>
							</div>
						<?}?>
					</div>
					<div class="pricelist-footer">
						<div class="text"><?=Loc::getMessage('CT_PRICE_TEXT_2');?></div>
					</div>
				</div>
			</div>
		</div>
	<?}?>

	<div class="maxwidth-theme">

		<div class="info-container info-2">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
				"AREA_FILE_SHOW" => "sec",
				"AREA_FILE_SUFFIX" => "info2_container_".$arResult['CODE'],
				"EDIT_TEMPLATE" => "standard.php"
				),
				false
			);?>&nbsp;
		</div>

		<? $arStaffIds = $arResult['SECTION_USER_FIELDS']['STAFF']; ?>
		<?if($arStaffIds):?>
			<div class="staff-container">
				<div class="info-title"><?=Loc::getMessage('CT_STAFF');?></div>
				<?global $arrrFilter; $arrrFilter = array('ID' => $arStaffIds);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list", 
					"staff-linked", 
					array(
						"FORM_ID" => 2,
						"VIEW_TYPE" => "block",
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

		<? if($arResult['SECTION_USER_FIELDS']['SERTIFS']){?>
		<div class="sertif-container">
			<div class="sertif-background"></div>
			<div class="content">
				<?$APPLICATION->IncludeComponent(
					'bitrix:main.include',
					'',
					array(
						'AREA_FILE_SHOW' => 'file',
						'PATH' => SITE_DIR.'include/they_trust_us.php',
						'EDIT_TEMPLATE' => ''
					)
				);?>
			</div>
			<div class="sertifs-block swiper">
				<div class="sertifs swiper-wrapper">
				<? foreach ($arResult['SECTION_USER_FIELDS']['SERTIFS'] as $key => $path) {?>
					<div class="sertif swiper-slide" data-fancybox="gallery-1" href="<?=$path?>">
						<img src="<?=$path?>" />
					</div>
				<?}?>
				</div>
			</div>

			<script>
				var swiper_main = new Swiper(".sertifs-block.swiper", {
						spaceBetween: 10,
						slidesPerView: 2
				});
				$('.sertifs-block.swiper .swiper-slide').fancybox();
			</script>
		</div>
		<?}?>

		<? if($arResult['SECTION_USER_FIELDS']['REVIEWS']){?>
			<div class="reviews-container swiper">
				<div class="reviews-title"><?=Loc::getMessage('CT_REVIEW_TITLE');?></div>
				<div class="reviews-header">
					<div class="reviews-header-text">
						<span><?=Loc::getMessage('CT_REVIEW_DESC');?></span>
					</div>
					<div class="reviews-header-nav">
						<div class="nav nav-back">
							<img src="/upload/arrow-forward.png" alt="back" />
						</div>
						<div class="delimiter"></div>

						<div class="nav nav-next nav-right">
							<img src="/upload/arrow-forward.png" alt="next" />
						</div>
					</div>
				</div>
				<div class="item-wrapp swiper-wrapper">
					<? foreach($arResult['SECTION_USER_FIELDS']['REVIEWS'] as $k => $reviews){ ?>
						<? if($reviews['PROPERTY_MESSAGE_VALUE']['TEXT']){?>
							<div class="item swiper-slide">
									<div class="item-text">
										<? if(strlen($reviews['PROPERTY_MESSAGE_VALUE']['TEXT']) > 730){ ?>
											<?= mb_substr(trim($reviews['PROPERTY_MESSAGE_VALUE']['TEXT']),0,465, 'UTF-8') . ' ...' ?>
										<?} else {?>
											<?= $reviews['PROPERTY_MESSAGE_VALUE']['TEXT'] ?>
										<?}?>
									</div>
									<div class="item-info">
										<div class="item-info-name"><?= $reviews['PROPERTY_NAME_VALUE'] ?></div>
										<div class="item-info-date"><?= $reviews['DATE_CREATE'] ?></div>
									</div>
							</div>
						<?}?>
					<?}?>
				</div>
			</div>
			<script>
				var swiper_main = new Swiper(".reviews-container.swiper", {
						navigation: { 
							nextEl: '.reviews-header-nav .nav-next', 
							prevEl: '.reviews-header-nav .nav-back' 
						},
						spaceBetween: 20,
						slidesPerView: 5,
						breakpoints: {
							320: {slidesPerView: 1,spaceBetween: 20},
							768: {slidesPerView: 1,spaceBetween: 20},
							992: {slidesPerView: 2,spaceBetween: 20}
						}
				});
			</script>
		<?}?>

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
				"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
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

		<?if($arResult['SECTION_USER_FIELDS']['VIDEO']):?>
			<div class="video-container">
				<?$videoId = str_replace('https://youtu.be/','',$arResult["PROPERTIES"]['LINK_VIDEO']['VALUE']);?>
				<iframe width="480" height="360" title='video' src="https://www.youtube.com/embed/<?=$videoId?>?feature=oembed" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
			</div>
		<?endif;?>
	</div>
</div>