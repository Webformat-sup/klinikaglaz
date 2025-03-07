<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc,
	\Bitrix\Main\Web\Json;?>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
	<?if($arParams["AJAX_REQUEST"]=="N"){?>
		<div class="display_list <?=($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props");?>">
	<?}?>
		<?
		$currencyList = '';
		if (!empty($arResult['CURRENCIES'])){
			$templateLibrary[] = 'currency';
			$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
		}
		$templateData = array(
			'TEMPLATE_LIBRARY' => $templateLibrary,
			'CURRENCIES' => $currencyList
		);
		unset($currencyList, $templateLibrary);

		$arParams["BASKET_ITEMS"] = ($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

		$arOfferProps = implode(';', (array)$arParams['OFFERS_CART_PROPERTIES']);
		?>
		<?foreach($arResult["ITEMS"] as $arItem){?>

			<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
			$bUseSkuProps = ($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP']) && !$bBigBlock);
			?>

			<div class="list_item_wrapp item_wrap item js-notice-block">
				<div class="basket_props_block" id="bx_basket_div_<?=$arItem["ID"];?>" style="display: none;">
					<?if (!empty($arItem['PRODUCT_PROPERTIES_FILL'])){
						foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
							<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
							<?if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
								unset($arItem['PRODUCT_PROPERTIES'][$propID]);
						}
					}
					$arItem["EMPTY_PROPS_JS"]="Y";
					$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
					if (!$emptyProductProperties){
						$arItem["EMPTY_PROPS_JS"]="N";?>
						<div class="wrapper">
							<table>
								<?foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
									<tr>
										<td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
										<td>
											<?if('L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']	&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']){
												foreach($propInfo['VALUES'] as $valueID => $value){?>
													<label>
														<input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
													</label>
												<?}
											}else{?>
												<select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
													foreach($propInfo['VALUES'] as $valueID => $value){?>
														<option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
													<?}?>
												</select>
											<?}?>
										</td>
									</tr>
								<?}?>
							</table>
						</div>
						<?
					}?>
				</div>

				<?
				$arItem["strMainID"] = $this->GetEditAreaId($arItem['ID']);
				$arItemIDs=CNext::GetItemsIDs($arItem);

				$item_id = $arItem["ID"];
				$strMeasure = '';
				$arAddToBasketData = array();

				$arCurrentSKU = array();

				$totalCount = CNext::GetTotalCount($arItem, $arParams);
				$arQuantityData = CNext::GetQuantityArray($totalCount, array('ID' => $item_id), "N", $arItem["PRODUCT"]["TYPE"], (($arItem["OFFERS"] || $arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || !$arResult['STORES_COUNT']) ? false : true));

				$elementName = ((isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem['NAME']);

				if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'){
					if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
						$arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
						$strMeasure = $arMeasure["SYMBOL_RUS"];
					}
					$arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
				}
				elseif($arItem["OFFERS"]){
					$strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
					if($arParams['TYPE_SKU'] == 'TYPE_1' && $arItem['OFFERS_PROP'])
					{
						$currentSKUIBlock = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["IBLOCK_ID"];
						$currentSKUID = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["ID"];

						$totalCount = CNext::GetTotalCount($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], $arParams);
						//$arQuantityData = CNext::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"], "N", $arItem["PRODUCT"]["TYPE"]);
						$arQuantityData = CNext::GetQuantityArray($totalCount, array('ID' => $currentSKUID), "N", $arItem["PRODUCT"]["TYPE"], (($arItem['CATALOG_TYPE'] == CCatalogProduct::TYPE_SET || !$arResult['STORES_COUNT']) ? false : true));

						
						$arItem["DETAIL_PAGE_URL"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DETAIL_PAGE_URL"];
						if($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
							$arItem["PREVIEW_PICTURE"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"];
						if($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
							$arItem["DETAIL_PICTURE"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DETAIL_PICTURE"];

						if($arParams["SET_SKU_TITLE"] === "Y"){
							$skuName = ((isset($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['NAME']);
							$arItem["NAME"] = $elementName = $skuName;
						}

						$item_id = $currentSKUID;

						// ARTICLE
						if($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"])
						{
							$arItem["ARTICLE"]["NAME"] = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["NAME"];
							$arItem["ARTICLE"]["VALUE"] = (is_array($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) ? reset($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) : $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]);
						}

						$arCurrentSKU = $arItem["JS_OFFERS"][$arItem["OFFERS_SELECTED"]];
						$strMeasure = $arCurrentSKU["MEASURE"];

						$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IS_OFFER'] = 'Y';
						$offerIblockID = $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IBLOCK_ID'];
						$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IBLOCK_ID'] = $arParams['IBLOCK_ID'];//fix add props to basket
						$arAddToBasketData = CNext::GetAddToBasketArray($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
						$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IBLOCK_ID'] = $offerIblockID;
					}
				}
				
				// stickers
				$arParams["STIKERS_PROP"] = $arParams["STIKERS_PROP"] ?: 'HIT';
				$bShowHitStickers = $arParams["STIKERS_PROP"] && isset($arItem['DISPLAY_PROPERTIES'][$arParams["STIKERS_PROP"]]) && $arItem["DISPLAY_PROPERTIES"][$arParams["STIKERS_PROP"]]["VALUE"];
				$bShowSaleStickers = $arParams["SALE_STIKER"] && isset($arItem['DISPLAY_PROPERTIES'][$arParams["SALE_STIKER"]]) && $arItem['DISPLAY_PROPERTIES'][$arParams["SALE_STIKER"]]["VALUE"];
				?>

				<table class="list_item" id="<?=$arItemIDs["strMainID"];?>">
					<tr class="adaptive_name">
						<td colspan="3">
							<div class="desc_name"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$elementName;?></span></a></div>
						</td>
					</tr>
					<tr>
					<td class="image_block<?=($arParams['GALLERY_ITEM_SHOW'] == 'Y' ? ' with-gallery' : '');?>">
						<div class="image_wrapper_block js-notice-block__image">
							<? if ($bShowHitStickers || $bShowSaleStickers): ?>
								<div class="stickers">
									<? if($bShowHitStickers): ?>
										<? foreach(CNext::GetItemStickers($arItem["DISPLAY_PROPERTIES"][$arParams["STIKERS_PROP"]]) as $arSticker): ?>
											<div><div class="<?=$arSticker['CLASS']?>"><?=$arSticker['VALUE']?></div></div>
										<? endforeach; ?>
									<? endif; ?>
									<? if($bShowSaleStickers): ?>
										<div><div class="sticker_sale_text"><?= $arItem["DISPLAY_PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]; ?></div></div>
									<? endif; ?>
								</div>
							<? endif; ?>
							<?$arParams['EVENT_TYPE'] = 'section_list_view'?>
							<?if($arParams['GALLERY_ITEM_SHOW'] == 'Y'):?>
								<?if($bUseSkuProps && $arItem["OFFERS"]):?>
									<?//print_r($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]);?>
									<?\Aspro\Functions\CAsproNext::showSectionGallery( array('ITEM' => $arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], 'RESIZE' => $arResult['CUSTOM_RESIZE_OPTIONS']) );?>
								<?else:?>
									<?\Aspro\Functions\CAsproNext::showSectionGallery( array('ITEM' => $arItem, 'RESIZE' => $arResult['CUSTOM_RESIZE_OPTIONS']) );?>
								<?endif;?>
							<?else:?>
								<?\Aspro\Functions\CAsproNext::showImg($arParams, $arItem, false);?>
							<?endif;?>
						</div>
						<?if($fast_view_text_tmp = CNext::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
							$fast_view_text = $fast_view_text_tmp;
						else
							$fast_view_text = GetMessage('FAST_VIEW');?>
						<div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?=$arParams["IBLOCK_ID"];?>" data-param-id="<?=$arItem["ID"];?>" data-param-fid="<?=$arItemIDs["strMainID"];?>" data-param-item_href="<?=urlencode($arItem["DETAIL_PAGE_URL"]);?>" data-name="fast_view"><?=$fast_view_text;?></div>
					</td>

					<td class="description_wrapp item_info">
						<div class="description">
							<div class="item-title">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="dark_link js-notice-block__title"><span><?=$elementName;?></span></a>
							</div>
							<div class="wrapp_stockers sa_block <?=($arParams["SHOW_RATING"] == "Y" ? 'with-rating' : '');?>" data-stores='<?=Json::encode($arParams["STORES"])?>' >
								<?if($arParams["SHOW_RATING"] == "Y"):?>
									<div class="rating">
										<?//$frame = $this->createFrame('dv_'.$arItem["ID"])->begin('');?>
										<?if ($arParams['REVIEWS_VIEW']):?>
											<?\Aspro\Functions\CAsproNext::showBlockHtml([
												'FILE' => 'catalog/detail_rating_extended.php',
												'PARAMS' => [
													'MESSAGE' => $arItem['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE'] ? GetMessage('VOTES_RESULT', array('#VALUE#' => $arItem['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'])) : GetMessage('VOTES_RESULT_NONE'),
													'RATING_VALUE' => $arItem['PROPERTIES']['EXTENDED_REVIEWS_RAITING']['VALUE'] ?? 0,
													'REVIEW_COUNT' => isset($arItem['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']) ? intval($arItem['PROPERTIES']['EXTENDED_REVIEWS_COUNT']['VALUE']) : 0,
												]
											]);?>
										<?else:?>
											<?$APPLICATION->IncludeComponent(
											   "bitrix:iblock.vote",
											   "element_rating_front",
											   Array(
												  "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
												  "IBLOCK_ID" => $arItem["IBLOCK_ID"],
												  "ELEMENT_ID" =>$arItem["ID"],
												  "MAX_VOTE" => 5,
												  "VOTE_NAMES" => array(),
												  "CACHE_TYPE" => $arParams["CACHE_TYPE"],
												  "CACHE_TIME" => $arParams["CACHE_TIME"],
												  "DISPLAY_AS_RATING" => 'vote_avg'
											   ),
											   $component, array("HIDE_ICONS" =>"Y")
											);?>
										<?endif;?>
										<?//$frame->end();?>
									</div>
								<?endif;?>
								<?=$arQuantityData["HTML"];?>
								<div class="article_block" <?if(isset($arItem['ARTICLE']) && $arItem['ARTICLE']['VALUE']):?>data-name="<?=$arItem['ARTICLE']['NAME'];?>" data-value="<?=$arItem['ARTICLE']['VALUE'];?>"<?endif;?>>
									<?if(isset($arItem['ARTICLE']) && $arItem['ARTICLE']['VALUE']){?>
										<?=$arItem['ARTICLE']['NAME'];?>: <?=$arItem['ARTICLE']['VALUE'];?>
									<?}?>
								</div>
							</div>
							<?if ($arItem["PREVIEW_TEXT"]):?> <div class="preview_text"><?=$arItem["PREVIEW_TEXT"]?></div> <?endif;?>
							<?$boolShowOfferProps = ($arItem['OFFERS_PROPS_DISPLAY']);
							$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));?>
							<?if($boolShowProductProps || $boolShowOfferProps):?>
								<div class="props_list_wrapp">
									<table class="props_list prod">
										<?if ($boolShowProductProps){
											foreach( $arItem["DISPLAY_PROPERTIES"] as $arProp ){?>
												<?if( !empty( $arProp["VALUE"] ) ){?>
													<tr>
														<td><span><?=$arProp["NAME"]?></span></td>
														<td>
															<span>
															<?
															if(count((array)$arProp["DISPLAY_VALUE"])>1) { foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }}
															else { echo $arProp["DISPLAY_VALUE"]; }
															?>
															</span>
														</td>
													</tr>
												<?}?>
											<?}
										}?>
									</table>
									<?if ($boolShowOfferProps){?>
										<table class="props_list offers" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>">
											<?if($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['DISPLAY_PROPERTIES']):?>
												<?foreach($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['DISPLAY_PROPERTIES'] as $arProp):?>
													<tr>
														<td><span><?=$arProp['NAME']?></span></td>
														<td>
															<span><?
															if(is_array($arProp["DISPLAY_VALUE"])) { foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }}
															else { echo $arProp["DISPLAY_VALUE"]; }
															?>
															</span>
														</td>
													</tr>
												<?endforeach;?>
											<?endif;?>
										</table>
									<?}?>
								</div>
								<div class="show_props dark_link">
									<span class="icons_fa char_title"><span><?=GetMessage('PROPERTIES')?></span></span>
								</div>
							<?endif;?>
						</div>
						<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
							<div class="like_icons">
								<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
									<?if(!$arItem["OFFERS"]):?>
										<div class="wish_item_button" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?>>
											<span class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i><span><?=GetMessage('CATALOG_WISH')?></span></span>
											<span class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i><span><?=GetMessage('CATALOG_WISH_OUT')?></span></span>
										</div>
									<?elseif($arItem["OFFERS"] && !empty($arItem['OFFERS_PROP'])):?>
										<?$canBuy = ($arParams['USE_REGION'] == 'Y' ? $arAddToBasketData['CAN_BUY'] : $arCurrentSKU['CAN_BUY']);?>
										<?//=($arCurrentSKU && $canBuy != 'Y' ? 'style="display:none;"' : '')?>
										<div class="wish_item_button" <?=(!$arAddToBasketData["CAN_BUY"] ? 'style="display:none;"' : '');?>>
											<span class="wish_item to <?=$arParams["TYPE_SKU"];?>" data-item="<?=$currentSKUID;?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i><span><?=GetMessage('CATALOG_WISH')?></span></span>
											<span class="wish_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="<?=$currentSKUID;?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i><span><?=GetMessage('CATALOG_WISH_OUT')?></span></span>
										</div>
									<?endif;?>
								<?endif;?>
								<?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
									<?if(!$arItem["OFFERS"] || ($arParams["TYPE_SKU"] !== 'TYPE_1' || ($arParams["TYPE_SKU"] == 'TYPE_1' && !$arItem["OFFERS_PROP"]))):?>
										<div class="compare_item_button">
											<span class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i><span><?=GetMessage('CATALOG_COMPARE')?></span></span>
											<span class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i><span><?=GetMessage('CATALOG_COMPARE_OUT')?></span></span>
										</div>
									<?elseif($arItem["OFFERS"]):?>
										<div class="compare_item_button">
											<span class="compare_item to <?=$arParams["TYPE_SKU"];?>" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$currentSKUID;?>" ><i></i><span><?=GetMessage('CATALOG_COMPARE')?></span></span>
											<span class="compare_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$currentSKUID;?>"><i></i><span><?=GetMessage('CATALOG_COMPARE_OUT')?></span></span>
										</div>
									<?endif;?>
								<?endif;?>
							</div>
						<?endif;?>
					</td>
					<td class="information_wrapp main_item_wrapper">
						<div class="information <?=($arItem["OFFERS"] && $arItem['OFFERS_PROP'] ? 'has_offer_prop' : '');?>  inner_content js_offers__<?=$arItem['ID'];?>">
							<div class="cost prices clearfix">
								<?if( count( $arItem["OFFERS"] ) > 0 ){?>
									<div class="with_matrix" style="display:none;">
										<div class="price price_value_block"><span class="values_wrapper"></span></div>
										<?if($arParams["SHOW_OLD_PRICE"]=="Y"):?>
											<div class="price discount"></div>
										<?endif;?>
										<?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
											<div class="sale_block matrix" style="display:none;">
												<div class="sale_wrapper">
													<?if($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] != "Y"):?>
														<div class="text">
															<span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
															<span class="values_wrapper"></span>
														</div>
													<?else:?>
														<div class="value">-<span></span>%</div>
														<div class="text">
															<span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
															<span class="values_wrapper"></span>
														</div>
													<?endif;?>
													<div class="clearfix"></div>
												</div>
											</div>
										<?}?>
									</div>
									<div class="js_price_wrapper price">
										<?if($arCurrentSKU):?>
											<?
											$item_id = $arCurrentSKU["ID"];
											$arCurrentSKU['PRICE_MATRIX'] = $arCurrentSKU['PRICE_MATRIX_RAW'];
											$arCurrentSKU['CATALOG_MEASURE_NAME'] = $arCurrentSKU['MEASURE'];
											if(isset($arCurrentSKU['PRICE_MATRIX']) && $arCurrentSKU['PRICE_MATRIX']) // USE_PRICE_COUNT
											{?>
												<?if($arCurrentSKU['ITEM_PRICE_MODE'] == 'Q' && count((array)$arCurrentSKU['PRICE_MATRIX']['ROWS']) > 1):?>
													<?=CNext::showPriceRangeTop($arCurrentSKU, $arParams, GetMessage("CATALOG_ECONOMY"));?>
												<?endif;?>
												<?=CNext::showPriceMatrix($arCurrentSKU, $arParams, $strMeasure, $arAddToBasketData);?>
												<?$arMatrixKey = array_keys($arCurrentSKU['PRICE_MATRIX']['MATRIX']);
												$min_price_id=current($arMatrixKey);?>
											<?
											}
											else
											{
												$arCountPricesCanAccess = 0;
												$min_price_id=0;?>
												<?\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arCurrentSKU["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
											<?}?>
										<?else:?>
											<?\Aspro\Functions\CAsproSku::showItemPrices($arParams, $arItem, $item_id, $min_price_id, $arItemIDs, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
										<?endif;?>
									</div>
								<?}else{?>
									<?
									$item_id = $arItem["ID"];
									if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
									{?>
										<?if($arItem['ITEM_PRICE_MODE'] == 'Q' && count((array)$arItem['PRICE_MATRIX']['ROWS']) > 1):?>
											<?=CNext::showPriceRangeTop($arItem, $arParams, GetMessage("CATALOG_ECONOMY"));?>
										<?endif;?>
										<?=CNext::showPriceMatrix($arItem, $arParams, $strMeasure, $arAddToBasketData);?>
										<?$arMatrixKey = array_keys($arItem['PRICE_MATRIX']['MATRIX']);
										$min_price_id=current($arMatrixKey);?>
									<?
									}
									else
									{
										$arCountPricesCanAccess = 0;
										$min_price_id=0;?>
										<?\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arItem["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
									<?}?>
								<?}?>
							</div>
							<?if($arParams["SHOW_DISCOUNT_TIME"]=="Y" && $arParams['SHOW_COUNTER_LIST'] != 'N'){?>
								<?$arUserGroups = $USER->GetUserGroupArray();?>
								<?if($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] != 'Y' || ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] == 'Y' && !$arItem['OFFERS'])):?>
									<?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $arUserGroups, "N", $min_price_id, SITE_ID);
									$arDiscount=array();
									if($arDiscounts)
										$arDiscount=current($arDiscounts);
									if($arDiscount["ACTIVE_TO"]){?>
										<div class="view_sale_block <?=($arQuantityData["HTML"] ? '' : 'wq');?>">
											<div class="count_d_block">
												<span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
												<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
												<span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
											</div>
											<?if($arQuantityData["HTML"]):?>
												<div class="quantity_block">
													<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
													<div class="values">
														<span class="item">
															<span class="value" ><?=$totalCount;?></span>
															<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
														</span>
													</div>
												</div>
											<?endif;?>
										</div>
									<?}?>
								<?else:?>
									<?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $arUserGroups, "N", array(), SITE_ID);
									$arDiscount=array();
									if($arDiscounts)
										$arDiscount=current($arDiscounts);
									?>
									<div class="view_sale_block <?=($arQuantityData["HTML"] ? '' : 'wq');?>" <?=($arDiscount["ACTIVE_TO"] ? '' : 'style="display:none;"');?> >
										<div class="count_d_block">
											<span class="active_to hidden"><?=($arDiscount["ACTIVE_TO"] ? $arDiscount["ACTIVE_TO"] : "");?></span>
											<div class="title"><?=GetMessage("UNTIL_AKC");?></div>
											<span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
										</div>
										<?if($arQuantityData["HTML"]):?>
											<div class="quantity_block">
												<div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
												<div class="values">
													<span class="item">
														<span class="value"><?=$totalCount;?></span>
														<span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
													</span>
												</div>
											</div>
										<?endif;?>
									</div>
								<?endif;?>
							<?}?>
							<?if($arItem["OFFERS"]){?>
								<?if(!empty($arItem['OFFERS_PROP'])){?>
									<div class="sku_props">
										<div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>" data-site_id="<?=SITE_ID;?>" data-id="<?=$arItem["ID"];?>" data-offer_id="<?=$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["ID"];?>" data-propertyid="<?=$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["PROPERTIES"]["CML2_LINK"]["ID"];?>" data-offer_iblockid="<?=$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["IBLOCK_ID"];?>">
											<?$arSkuTemplate = array();?>
											<?$arSkuTemplate=CNext::GetSKUPropsArray($arItem['OFFERS_PROPS_JS'], $arResult["SKU_IBLOCK_ID"], $arParams["DISPLAY_TYPE"], $arParams["OFFER_HIDE_NAME_PROPS"], "N", $arItem, $arParams['OFFER_SHOW_PREVIEW_PICTURE_PROPS']);?>
											<?foreach ($arSkuTemplate as $code => $strTemplate){
												if (!isset($arItem['OFFERS_PROP'][$code]))
													continue;
												echo '<div class="item_wrapper">', str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate), '</div>';
											}?>
										</div>
										<?$arItemJSParams=CNext::GetSKUJSParams($arResult, $arParams, $arItem);?>
									</div>
								<?}?>
							<?}?>
							<?if(!$arItem["OFFERS"] /*|| $arParams['TYPE_SKU'] !== 'TYPE_1'*/):?>
								<div class="counter_wrapp <?=($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '')?>">
									<?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") && $arAddToBasketData["CAN_BUY"]):?>
										<div class="counter_block" data-offers="<?=($arItem["OFFERS"] ? "Y" : "N");?>" data-item="<?=$arItem["ID"];?>">
											<span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>" <?=isset($arAddToBasketData["SET_MIN_QUANTITY_BUY"]) && $arAddToBasketData["SET_MIN_QUANTITY_BUY"] ? "data-min='".$arAddToBasketData["MIN_QUANTITY_BUY"]."'" : "";?>>-</span>
											<input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=$arAddToBasketData["MIN_QUANTITY_BUY"]?>" />
											<span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?=($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='".$arAddToBasketData["MAX_QUANTITY_BUY"]."'" : "")?>>+</span>
										</div>
									<?endif;?>
									<div id="<?=$arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER"/*&& !$arItem["CAN_BUY"]*/) || !$arAddToBasketData["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : "");?>">
										<!--noindex-->
											<?=$arAddToBasketData["HTML"]?>
										<!--/noindex-->
									</div>
								</div>
								<?
								if(isset($arItem['PRICE_MATRIX']) && $arItem['PRICE_MATRIX']) // USE_PRICE_COUNT
								{?>
									<?if($arItem['ITEM_PRICE_MODE'] == 'Q' && count($arItem['PRICE_MATRIX']['ROWS']) > 1):?>
										<?$arOnlyItemJSParams = array(
											"ITEM_PRICES" => $arItem["ITEM_PRICES"],
											"ITEM_PRICE_MODE" => $arItem["ITEM_PRICE_MODE"],
											"ITEM_QUANTITY_RANGES" => $arItem["ITEM_QUANTITY_RANGES"],
											"MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
											"SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
											"ID" => $arItemIDs["strMainID"],
										)?>
										<script type="text/javascript">
											var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogSectionOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
										</script>
									<?endif;?>
								<?}?>
							<?elseif($arItem["OFFERS"]):?>
								<?if(empty($arItem['OFFERS_PROP'])){?>
									<div class="offer_buy_block buys_wrapp woffers">
										<div class="counter_wrapp <?=($arAddToBasketData["ACTION"] === "MORE" ? " more" : "")?>">
										<?
										$arItem["OFFERS_MORE"] = "Y";
										$arAddToBasketData = CNext::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small read_more1', $arParams);?>
										<!--noindex-->
											<?=$arAddToBasketData["HTML"]?>
										<!--/noindex-->
										</div>
									</div>
								<?}else{?>
									<div class="offer_buy_block">
										<?
										$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IS_OFFER'] = 'Y';
										$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
										//$arAddToBasketData = CNext::GetAddToBasketArray($arItem["OFFERS"][$arItem["OFFERS_SELECTED"]], $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'small', $arParams);
										?>
										<div class="counter_wrapp">
											<?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") && $arAddToBasketData["CAN_BUY"]):?>
												<div class="counter_block" data-item="<?=$arItem["OFFERS"][$arItem["OFFERS_SELECTED"]]["ID"];?>">
													<span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>" <?=isset($arAddToBasketData["SET_MIN_QUANTITY_BUY"]) && $arAddToBasketData["SET_MIN_QUANTITY_BUY"] ? "data-min='".$arAddToBasketData["MIN_QUANTITY_BUY"]."'" : "";?>>-</span>
													<input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=$arAddToBasketData["MIN_QUANTITY_BUY"]?>" />
													<span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?=($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='".$arAddToBasketData["MAX_QUANTITY_BUY"]."'" : "")?>>+</span>
												</div>
											<?endif;?>
											<div id="<?=$arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER"/*&& !$arItem["CAN_BUY"]*/)  || !$arAddToBasketData["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : "");?>">
												<!--noindex-->
													<?=$arAddToBasketData["HTML"]?>
												<!--/noindex-->
											</div>
										</div>
									</div>
									<?
									if(isset($arCurrentSKU['PRICE_MATRIX']) && $arCurrentSKU['PRICE_MATRIX']) // USE_PRICE_COUNT
									{?>
										<?if($arCurrentSKU['ITEM_PRICE_MODE'] == 'Q' && count($arCurrentSKU['PRICE_MATRIX']['ROWS']) > 1):?>
											<?$arOnlyItemJSParams = array(
												"ITEM_PRICES" => $arCurrentSKU["ITEM_PRICES"],
												"ITEM_PRICE_MODE" => $arCurrentSKU["ITEM_PRICE_MODE"],
												"ITEM_QUANTITY_RANGES" => $arCurrentSKU["ITEM_QUANTITY_RANGES"],
												"MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
												"SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
												"ID" => $arItemIDs["strMainID"],
												"NOT_SHOW" => "Y",
											)?>
											<script type="text/javascript">
												var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogSectionOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
											</script>
										<?endif;?>
									<?}?>
								<?}?>
							<?endif;?>
						</div>
					</td></tr>
				</table>
			</div>
		<?}?>
	<?if($arParams["AJAX_REQUEST"]=="N"){?>
		</div>
	<?}?>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		<div class="wrap_nav">
	<?}?>
	<div class="bottom_nav <?=$arParams["DISPLAY_TYPE"];?>" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
		<?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
	</div>
	<?if($arParams["AJAX_REQUEST"]=="Y"){?>
		</div>
	<?}?>
<?}else{?>
	<script>
		// $(document).ready(function(){
			$('.sort_header').animate({'opacity':'1'}, 500);
		// })
	</script>
	<div class="no_goods">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?if($_REQUEST["set_filter"]){?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}else{?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}?>
			</div>
		</div>
		<?if($_REQUEST["set_filter"]){?>
			<span class="button wide btn btn-default"><?=GetMessage('RESET_FILTERS');?></span>
		<?}?>
	</div>
<?}?>
<script>
	function realWidth(obj){
		var clone = obj.clone();
		clone.css("visibility","hidden");
		$('body').append(clone);
		var width = clone.width()+0;
		clone.remove();
		return width;
	}
	function setPropWidth(){
		if($('table.props_list.offers').length){
			$('table.props_list.offers').each(function(){
				$(this).width(realWidth($(this).closest('.props_list_wrapp').find("table.props_list.prod")));
			});
		}
	}
	setPropWidth();
	BX.message({
		QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.next", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
		QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.next", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
		ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
		ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
	})
</script>
