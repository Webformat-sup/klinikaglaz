<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
global $USER;
$userID = CUser::GetID();
$userID = ($userID > 0 ? $userID : 0);
global $arTheme;
$arParams["COUNT_IN_LINE"] = intval($arParams["COUNT_IN_LINE"]);
$arParams["COUNT_IN_LINE"] = (($arParams["COUNT_IN_LINE"] > 0 && $arParams["COUNT_IN_LINE"] < 12) ? $arParams["COUNT_IN_LINE"] : 3);
$colmd = floor(12 / $arParams['COUNT_IN_LINE']);
$colsm = floor(12 / round($arParams['COUNT_IN_LINE'] / 2));
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['URL_BASKET_SECTION']['VALUE']) : '');
?>
<div class="catalog item-views table">
	<?if($arResult["ITEMS"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>

		<div class="row items">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				// preview image
				if($bShowImage){
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 160, 'height' => 160), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
					$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_product.png');
					$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				}
				// use order button?
				$bOrderButton = ($arItem["DISPLAY_PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"] == "YES");
				$dataItem = ($bOrderViewBasket ? CScorp::getDataItem($arItem) : false);
				?>
				<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colsm?>">
					<div class="item<?=($bShowImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
						<?if($bShowImage):?>
							<div class="image">
								<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink">
								<?elseif($imageDetailSrc):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox">
								<?endif;?>
									<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
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
										<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
											<?=$arItem['NAME']?>
										<?if($bDetailLink):?></a><?endif;?>
									</div>
								<?endif;?>

								<?/*
								<?// element section name?>
								<?if(strlen($arItem['SECTION_NAME'])):?>
									<div class="section_name"><?=$arItem['SECTION_NAME']?></div>
								<?endif;?>
								*/?>

								<?// element status?>
								<?if(strlen($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
									<span class="label label-<?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
								<?endif;?>

								<?// element article?>
								<?if(strlen($arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
									<span class="article"><?=GetMessage('S_ARTICLE')?>:&nbsp;<span><?=$arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span></span>
								<?endif;?>

								<?/*
								<?// element preview text?>
								<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
									<div class="description">
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
								<div class="<?=(!$bOrderButton || $bOrderViewBasket ? 'col-md-12 col-sm-12 col-xs-12 clearfix slice_price' : 'col-md-6 col-sm-7 col-xs-12 pull-left slice_price')?>">
									<?// element price?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
										<div class="price pull-left<?=($bOrderViewBasket ? '  inline' : '')?>">
											<div class="price_new">
												<span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']?></span>
											</div>
											<?if($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']):?>
												<div class="price_old">
													<span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span>
												</div>
											<?endif;?>
										</div>
									<?endif;?>
								</div>

								<div class="<?=(!$bOrderViewBasket ? 'col-md-6 col-sm-5 col-xs-12 pull-right' : 'col-md-12 col-sm-12 col-xs-12')?>">
									<?// element order button?>
									<?if($bOrderButton && !$bOrderViewBasket):?>
										<span class="btn btn-default btn-sm pull-right" <?=(strlen(($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) && strlen($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE'])) ? 'style="margin-top:16px;"' : '')?> data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]["aspro_scorp_form"]["aspro_scorp_order_product"][0]?>" data-product="<?=$arItem["NAME"]?>" data-name="order_product"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
									<?endif;?>
									<?// element buy block?>
									<?if($bOrderViewBasket && $bOrderButton):?>
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
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>

			<?// slice elements height?>
			<script type="text/javascript">
			var templateName = '<?=$templateName?>';
			$(document).ready(function(){
				setBasketItemsClasses();
				$('.catalog.item-views.table .item .image').sliceHeight({lineheight: -3});
				$('.catalog.item-views.table .item .title').sliceHeight();
				$('.catalog.item-views.table .item .cont').sliceHeight();
				$('.catalog.item-views.table .item .slice_price').sliceHeight();
				$('.catalog.item-views.table .item').sliceHeight();
			});
			</script>
		</div>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	<?endif;?>

	<?// section description?>
	<?if(is_array($arResult["SECTION"]["PATH"])):?>
		<?$arCurSectionPath = end($arResult["SECTION"]["PATH"]);?>
		<?if(strlen($arCurSectionPath["DESCRIPTION"]) && strpos($_SERVER["REQUEST_URI"], "PAGEN") === false):?>
			<div class="cat-desc"><hr style="<?=(strlen($arResult['NAV_STRING']) && $arParams['DISPLAY_BOTTOM_PAGER'] ? 'margin-top:20px;' : 'border-color:transparent;margin-top:0;margin-bottom:10px;')?>" /><?=$arCurSectionPath["DESCRIPTION"]?></div>
		<?endif;?>
	<?endif;?>
</div>
<?$frame->end();?>