<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
global $arTheme;
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
//$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
//$bOrderViewBasket = $arParams['ORDER_VIEW'];
//$basketURL = (strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['URL_BASKET_SECTION']['VALUE']) : '');
?>
<?

 ?>
<div>
<?if($arResult['ITEMS']):?>
	<?
	$qntyItems = count($arResult['ITEMS']);
	$countmd = 5;
	$countsm = 4;
	$countxs = 3;
	$colmd = 3;
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
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 160, 'height' => 160), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_product.png');
						$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
					}
					// use order button?
					$bOrderButton = $arItem["DISPLAY_PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"] == "YES";
					$dataItem = ($bOrderViewBasket ? CScorp::getDataItem($arItem) : false);
					?>
					<li class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
						<div class="item<?=($bShowImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?> itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product">
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

									<?// element section name?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
										<div class="section_name"><?=$arItem['DISPLAY_PROPERTIES']['POST']['VALUE']?></div>
									<?endif;?>

								</div>

							</div>
						</div>
					</li>
				<?endforeach;?>
			</ul>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			setBasketItemsClasses();
			$('.catalog.item-views.table .item .image').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false, lineheight: -3});
			$('.catalog.item-views.table .item .title').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
			$('.catalog.item-views.table .item .cont').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
			$('.catalog.item-views.table .item .slice_price').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
			$('.catalog.item-views.table .item').sliceHeight({slice: <?=$qntyItems?>, autoslicecount: false});
		});
		</script>
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
		}
		else{
			$('.catalog.item-views.sections.front').remove();
			$('#front_catalog_separator').remove();
		}
		if(arScorpOptions.THEME.CATALOG_FAVORITES_INDEX == 'Y'){
			$('.catalog.item-views.table.front').show();
			if(arScorpOptions.THEME.TEASERS_INDEX == 'NONE' && arScorpOptions.THEME.CATALOG_INDEX == 'N'){
				$('.catalog.item-views.table.front').css('margin-top', '47px');
			}
			InitFlexSlider();
			$('.catalog.item-views.table.front .blink img').blink();
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
