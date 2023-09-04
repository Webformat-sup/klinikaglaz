<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$CScorp = new CScorp();
$CCache = new CCache();
global $arTheme;
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
$bShowBasket = $arTheme['ORDER_VIEW']['VALUE'] === 'Y';
$basketURL = (strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['URL_BASKET_SECTION']['VALUE']) : '');

$cntItems = count($arResult['ITEMS']);
?>
<div>&nbsp;
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
?>
<?if($arResult['ITEMS'] && $arParams['SHOW_GOODS'] !== 'N'):?>
	<?
	$countmd = 3;
	$countsm = 3;
	$countxs = 2;
	$colmd = 4;
	$colsm = 4;
	$colxs = 6;
	$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
	?>
	<div class="catalog item-views table front" style="display:none;">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/front-catalog-favorites.php",
				"EDIT_TEMPLATE" => "standard.php"
			)
		);?>
		<div class="flexslider unstyled row" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, "counts": [<?=$countmd?>, <?=$countsm?>, <?=$countxs?>]}'>
			<ul class="slides" itemscope itemtype="http://schema.org/ItemList">
				<?foreach($arResult["ITEMS"] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// preview image
					if($bShowImage){
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 350, 'height' => 350), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_product.png');
						$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
					}
					// use order button?
					$bOrderButton = !$bShowBasket && ($arItem["DISPLAY_PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"] == "YES");
					// use buy button?
					if($bBuyButton = $bShowBasket && ($arItem["DISPLAY_PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"] == "YES")){
						$dataItem = $CScorp->getDataItem($arItem);
					}
					?>
					<li class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
						<div class="item<?=($bShowImage ? '' : ' wti')?> custom" id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bBuyButton ? ' data-item="'.$dataItem.'"' : '')?> itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product">
							<?if($bShowImage):?>
								<div class="image">
									<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink" itemprop="url">
									<?elseif($imageDetailSrc):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox" itemprop="url">
									<?endif;?>
										<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" itemprop="image" />
									<?if($bDetailLink):?></a>
									<?elseif($imageDetailSrc):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
									<?endif;?>
								</div>
							<?endif;?>

							<div class="text">
								<div class="cont">
									<?// element name?>
									<?if(strlen($arItem['FIELDS']['NAME'])):?>
										<div class="title">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url"><?endif;?>
												<span itemprop="name"><?=$arItem['NAME']?></span>
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									<?endif;?>
									<div class="prevorder">
										<span class="btn btn-default btn-sm btn-custom" data-autoload-need_product="<?=$arItem["NAME"]?>" data-name="question"  data-event="jqm" data-param-id="17<?/*=WEBFORM?'5':$CCache::$arIBlocks[SITE_ID]['aspro_scorp_form']['aspro_scorp_order_services'][0]?>" data-name="order_services" data-autoload-service="<?=$arItem['NAME']*/?>"><span><?=(strlen($arParams['S_ORDER_SERVICE']) ? $arParams['S_ORDER_SERVICE'] : GetMessage('S_ORDER_SERVICE'))?></span></span>
									</div>
									<?// element status?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
										<span class="label label-<?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="description"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
									<?endif;?>

									<?// element article?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
										<span class="article" itemprop="description"><?=GetMessage('S_ARTICLE')?>:&nbsp;<span><?=$arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span></span>
									<?endif;?>

									<?/*
									<?// element preview text?>
									<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
										<div class="description" itemprop="description">
											<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
												<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
											<?else:?>
												<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
											<?endif;?>
										</div>
									<?endif;?>
									*/?>
								</div>

								<div class="row foot">
									<div class="<?=(!$bOrderButton ? 'col-md-12 col-sm-12 col-xs-12 slice_price' : 'col-md-6 col-sm-12 col-xs-12 slice_price pull-left')?>">
										<?// element price?>
										<?if(is_string($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
											<div class="price clearfix<?=($bBuyButton ? '  inline' : '')?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												<div class="price_new">
													<span class="price_val"><?=$CScorp->FormatPriceShema($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?></span>
												</div>
												<?if($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']):?>
													<div class="price_old">
														<span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span>
													</div>
												<?endif;?>
											</div>
										<?endif;?>
									</div>

									<?if($bOrderButton || $bBuyButton):?>
										<div class="<?=($bOrderButton ? 'col-md-6 col-sm-5 col-xs-12 pull-right' : 'col-md-12 col-sm-12 col-xs-12')?>">
											<?// element order button?>
											<?if($bOrderButton):?>
												<span class="btn btn-default btn-sm pull-right" <?=(strlen(($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) && strlen($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE'])) ? 'style="margin-top:16px;"' : '')?> data-event="jqm" data-param-id="<?=$CCache::$arIBlocks[SITE_ID]["aspro_scorp_form"]["aspro_scorp_order_product"][0]?>" data-product="<?=$arItem["NAME"]?>" data-name="order_product"><?=GetMessage("TO_ORDER")?></span>
											<?// element buy block?>
											<?else:?>
												<div class="buy_block clearfix">
													<div class="counter pull-left">
														<div class="wrap">
															<span class="minus ctrl bgtransition"></span>
															<div class="input"><input type="text" value="1" class="count" maxlength="20" /></div>
															<span class="plus ctrl bgtransition"></span>
														</div>
													</div>
													<div class="buttons pull-right">
														<span class="btn btn-default btn-sm to_cart" data-quantity="1"><span><?=GetMessage('BUTTON_TO_CART')?></span></span>
														<a href="<?=$basketURL;?>" class="btn btn-default btn-sm in_cart"><span><?=GetMessage('BUTTON_IN_CART')?></span></a>
													</div>
												</div>
											<?endif;?>
										</div>
									<?endif;?>
								</div>
							</div>
						</div>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
<?endif;?>
<script type="text/javascript">
$(document).ready(function() {
	try{
		if(arScorpOptions.THEME.CATALOG_INDEX == 'Y'){
			$('.catalog.item-views.sections.front').show();
			if(arScorpOptions.THEME.TEASERS_INDEX == 'NONE'){
				$('.catalog.item-views.sections.front').css('margin-top', '47px');
			}

			$('.catalog.item-views.sections .item .title').sliceHeight();
			$('.catalog.item-views.sections .item').sliceHeight();
		}
		else{
			$('.catalog.item-views.sections.front').remove();
			$('#front_catalog_separator').remove();
		}

		if(arScorpOptions.THEME.CATALOG_FAVORITES_INDEX == 'Y'){
			setBasketItemsClasses();
			$('.catalog.item-views.table.front .blink img').blink();

			$('.catalog.item-views.table.front').show();
			if(arScorpOptions.THEME.TEASERS_INDEX == 'NONE' && arScorpOptions.THEME.CATALOG_INDEX == 'N'){
				$('.catalog.item-views.table.front').css('margin-top', '47px');
			}

			InitFlexSlider();

			var interval = setInterval(function(){
				if($('.catalog.item-views.table.front .flexslider-init').length && typeof($('.catalog.item-views.table.front .flexslider-init').data('flexslider')) === 'object'){
					clearInterval(interval);
					$('.catalog.item-views.table .item .image').sliceHeight({slice: <?=$cntItems?>, autoslicecount: false, lineheight: -3, native: true});
					$('.catalog.item-views.table .item .title').sliceHeight({slice: <?=$cntItems?>, autoslicecount: false, native: true});
					$('.catalog.item-views.table .item .cont').sliceHeight({slice: <?=$cntItems?>, autoslicecount: false, native: true});
					$('.catalog.item-views.table .item .slice_price').sliceHeight({slice: <?=$cntItems?>, autoslicecount: false, native: true});
					$('.catalog.item-views.table .item').sliceHeight({slice: <?=$cntItems?>, autoslicecount: false, native: true});
				}
			}, 100);
		}
		else{
			$('.catalog.item-views.table.front').remove();
			$('#front_catalog_separator').remove();
		}
	}
	catch(e){}
});
</script>
<?$frame->end();?>
</div>
