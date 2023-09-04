<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$CCache = new CCache;
?>
<?$this->setFrameMode(true);?>
<div class="item-views list <?=($arParams['IMAGE_POSITION'] ? 'image_'.$arParams['IMAGE_POSITION'] : '')?> <?=($templateName = $component->{'__parent'}->{'__template'}->{'__name'})?>">

	<?// top pagination?>
	<?if($arParams['DISPLAY_TOP_PAGER']):?>
		<?=$arResult['NAV_STRING']?>
	<?endif;?>
	
	<?if($arResult['ITEMS']):?>
		<div class="items row flex" style="display: flex;flex-wrap: wrap;">
			<?// show section items?>
			<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
				$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] :  SITE_TEMPLATE_PATH.'/images/noimage_sections.png');
				$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				// show active date period
				$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
				?>

				<?ob_start();?>
					<?// element name?>
					<?if(strlen($arItem['FIELDS']['NAME'])):?>
						<div class="title">
							<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
								<?=$arItem['NAME']?>
							<?if($bDetailLink):?></a><?endif;?>
						</div>
					<?endif;?>

					<?// date active period?>
					<?if($bActiveDate):?>
						<div class="period">
							<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
								<span class="label label-info"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
							<?else:?>
								<span class="label"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
							<?endif;?>
						</div>
					<?endif;?>

					<?// element preview text?>
					<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
						<div class="previewtext">
							<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
								<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
							<?else:?>
								<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
							<?endif;?>
						</div>
					<?endif;?>

					<?// element display properties?>
					<?if($arItem['DISPLAY_PROPERTIES']):?>
						<div class="properties">
							<?foreach($arItem['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
								<?if(in_array($PCODE, array('PERIOD', 'TITLE_BUTTON', 'LINK_BUTTON'))) continue;?>
								<div class="property">
									<?if($arProperty['XML_ID']):?>
										<i class="fa <?=$arProperty['XML_ID']?>"></i>&nbsp;
									<?else:?>
										<?=$arProperty['NAME']?>:&nbsp;
									<?endif;?>
									<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
										<?$val = implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']);?>
									<?else:?>
										<?$val = $arProperty['DISPLAY_VALUE'];?>
									<?endif;?>
									<?if($PCODE == 'SITE'):?>
										<!--noindex-->
										<?=str_replace("href=", "rel='nofollow' target='_blank' href=", $val);?>
										<!--/noindex-->
									<?elseif($PCODE == 'EMAIL'):?>
										<a href="mailto:<?=$val?>"><?=$val?></a>
									<?else:?>
										<?=$val?>
									<?endif;?>
								</div>
							<?endforeach;?>
						</div>
					<?endif;?>
					<div class="prevorder">
						<span class="btn btn-default btn-sm" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?=$arItem['NAME']?>"><span><?=(strlen($arParams['S_ORDER_SERVICE']) ? $arParams['S_ORDER_SERVICE'] : GetMessage('S_ORDER_SERVICE'))?></span></span>
					</div>
				<?$textPart = ob_get_clean();?>

				<?ob_start();?>
					<?if($bImage):?>
						<div class="image">
							<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="blink">
							<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox">
							<?endif;?>
								<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
							<?if($bDetailLink):?></a>
							<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
							<?endif;?>
						</div>						
						
					<?endif;?>
				<?$imagePart = ob_get_clean();?>
				<div class="col-md-3 col-sm-3">
					<div class="item<?=($bActiveDate ? ' wdate' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?if(!$bImage):?>
						<div class="pic">
							<div class="image">			
								<img src="<?=SITE_TEMPLATE_PATH?>/images/noimage_sections.png" alt="no image" title="" class="img-responsive" />	
							</div>
						</div>
							<div class="item"><div class="htext"><?=$textPart?></div></div>							
						<?elseif($arParams['IMAGE_POSITION'] == 'right'):?>
							<div class="pic"><div class="htext"><?=$textPart?></div></div>
							<div class="item"><?=$imagePart?></div>
						<?else:?>
							<div class="pic"><?=$imagePart?></div>
							<div class="item"><div class="htext"><?=$textPart?></div></div>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
		</div>
	<?endif;?>

	<?// bottom pagination?>
	<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
		<?=$arResult['NAV_STRING']?>
	<?endif;?>

	<?// section description?>
	<?if(is_array($arResult['SECTION']['PATH'])):?>
		<?$arCurSectionPath = end($arResult['SECTION']['PATH']);?>
		<?if(strlen($arCurSectionPath['DESCRIPTION']) && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="cat-desc"><hr style="<?=(strlen($arResult['NAV_STRING']) && $arParams['DISPLAY_BOTTOM_PAGER'] ? 'margin-top:16px;' : '')?>" /><?=$arCurSectionPath['DESCRIPTION']?></div>
		<?endif;?>
	<?endif;?>

<?if(is_array($arResult['SECTION_USER_FIELDS_PROPS'])){?>
	<?/*----  ДОПОЛНИТЕЛЬНЫЕ ПОЛЯ  ----*/?>
	<div class="uf-divs">
		<?$arUFProps = ($arResult['SECTION_USER_FIELDS_PROPS']) ?? [];?>
		<?/*----  Блок цен  ----*/?>
			<?if($arResult["SECTION_USER_FIELDS"]['UF_COST']){?>
				<div class="wraps detail ">
					<hr />
					<h4 class="underline">Цены</h4>
					
					<div class="row chars">
						<div class="col-md-12">
							<div class="char-wrapp">
								<table class="props_table">
								<?foreach($arResult["SECTION_USER_FIELDS"]['UF_COST'] as $id){?>
									<tr class="char">
										<td class="char_name">
											<span><?=$arUFProps[$id]['NAME']?>
											<?if($arUFProps[$id]['PREVIEW_TEXT']){?>
												<i class="fa fa-question question" data-trigger="click" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$arUFProps[$id]['PREVIEW_TEXT']?>"></i>
											<?}?>
										</span>
										</td>
										<td class="char_value">
											<?if(!empty($arUFProps[$id]['PROPS']['PRICE']['VALUE'])){?>
												<span>
													<?=$arUFProps[$id]['PROPS']['PRICE']['VALUE']?><br />
													(взрослые)
												</span>
												
											<?}?>	
											<?if(!empty($arUFProps[$id]['PROPS']['PRICE_KIDS']['VALUE'])){?>
												<span>
													<?=$arUFProps[$id]['PROPS']['PRICE_KIDS']['VALUE']?><br />
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

			<?}?>
		<?/*----  Блок цен  ----*/?>

		<?/*----  Ссылка на прайс  ----*/?>
			<?if($arResult["SECTION_USER_FIELDS"]['UF_PRICE_LINK']):?>
				<div class="wraps">
					<hr />
					<h4 class="underline">Ссылка на прайс</h4>
					<div class="row docs">
							<div class="col-md-6 xls">
								<a href="<?=$arResult["SECTION_USER_FIELDS"]['UF_PRICE_LINK']?>" target="_blank" title="Price">Price</a>
							</div>
					</div>
				</div>
			<?endif;?>
		<?/*----  Ссылка на прайс  ----*/?>


		<?/*----  Форма обратной связи  ----*/?>
				<div class="order-block">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12 valign">
						<?if(is_array($arResult['SECTION']['PATH'])){
							$arCurSection = end($arResult['SECTION']['PATH']);
						}else{
							$arCurSection = $arResult['SECTION'];
						}?>
							<span class="btn-custom-sign" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?=$arCurSection['NAME']?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/sign.svg" height="54"/></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 valign">
							<div class="text">
								<?$APPLICATION->IncludeComponent(
									'bitrix:main.include',
									'',
									Array(
										'AREA_FILE_SHOW' => 'file',
										'PATH' => SITE_DIR.'include/ask_services.php',
										'EDIT_TEMPLATE' => ''
									)
								);?>
							</div>
						</div>
					</div>
				</div>
		<?/*----  Форма обратной связи  ----*/?>


		<?/*----  Видео  ----*/?>
		<?if($arResult["SECTION_USER_FIELDS"]['UF_VIDEO_NAME'] && $arResult["SECTION_USER_FIELDS"]['UF_VIDEO_LINK']):?>
			<div >
				
				<h3><?=$arResult["SECTION_USER_FIELDS"]['UF_VIDEO_NAME']?></h3>
				<?
				
				$videoId = str_replace('https://youtu.be/','', $arResult["SECTION_USER_FIELDS"]['UF_VIDEO_LINK']);
				
				?>
				<iframe width="480" height="360" title='<?=$arResult["SECTION_USER_FIELDS"]['UF_VIDEO_NAME']?>' src="https://www.youtube.com/embed/<?=$videoId?>?feature=oembed" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
			<?if($arResult["SECTION_USER_FIELDS"]['UF_VIDEO_DESCRIPTION']):?>
				<div class="video-desc"><?=htmlspecialchars_decode($arResult["SECTION_USER_FIELDS"]['UF_VIDEO_DESCRIPTION'])?></div>
			<?endif;?>
			</div>
		<?endif;?>
	<?/*----  Видео  ----*/?>

	<?/*----  Галерея  ----*/?>
	<?if($arResult['SECTION_USER_FIELDS']['UF_GALLERY']):?>
			<div class="wraps detail">
				<hr />
				<h4 class="underline">Галерея</h4>
				<div class="row galery">
					<div class="inner">
						<div class="flexslider unstyled row" id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :false, "animationLoop": true, "sync": ".detail .galery #carousel", "slideshow": false, "counts": [1, 1, 1]}'>
							<ul class="slides items">
								<?$countAll = count($arResult['SECTION_USER_FIELDS']['UF_GALLERY']);?>
								<?foreach($arResult['SECTION_USER_FIELDS']['UF_GALLERY'] as $i => $arPhotoId):?>
									<?$arFile = CFile::GetFileArray($arPhotoId);?>
									<li class="col-md-1 col-sm-1 item">
										<a href="<?=$arFile['SRC']?>" class="fancybox" rel="gallery" target="_blank" title="<?=$arFile['TITLE']?>">
											<img src="<?=$arFile['SRC']?>" class="img-responsive inline" title="<?=$arFile['TITLE']?>" alt="<?=$arFile['ALT']?>" />
											<span class="zoom">
												<i class="fa fa-16 fa-white-shadowed fa-search-plus"></i>
											</span>
										</a>
									</li>
								<?endforeach;?>
							</ul>
						</div>
						<?if(count($arResult['SECTION_USER_FIELDS']['UF_GALLERY']) > 1):?>
							<div class="thmb flexslider unstyled" id="carousel" style="max-width:<?=ceil(((count($arResult['SECTION_USER_FIELDS']['UF_GALLERY']) <= 4 ? count($arResult['SECTION_USER_FIELDS']['UF_GALLERY']) : 4) * 84.5) - 7.5 + 60)?>px;">
								<ul class="slides">	
									<?foreach($arResult['SECTION_USER_FIELDS']['UF_GALLERY'] as $arPhotoId):?>
										<?$file = CFile::ResizeImageGet($arPhotoId, array('width'=>150, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
										<?$arFile = CFile::GetFileArray($arPhotoId);?>
										<li class="blink">
											<img class="img-responsive inline" border="0" src="<?=$file['src']?>" title="<?=$arFile['TITLE']?>" alt="<?=$arFile['ALT']?>" />
										</li>
									<?endforeach;?>
								</ul>
							</div>
						<?endif;?>
					</div>
					<script type="text/javascript">
					$(document).ready(function(){
						$('.detail .galery .item').sliceHeight({slice: <?=$countAll?>, lineheight: -3});
						$('.detail .galery #carousel').flexslider({
							animation: 'slide',
							controlNav: false,
							animationLoop: true,
							slideshow: false,
							itemWidth: 77,
							itemMargin: 7.5,
							minItems: 2,
							maxItems: 4,
							asNavFor: '.detail .galery #slider'
						});
					});
					</script>
				</div>
			</div>
		<?endif;?>
	<?/*----  Галерея  ----*/?>


		<?/*----  Отзывы  ----*/?>
			<?if($arResult["SECTION_USER_FIELDS"]['UF_REVIEWS']):?>
				<?$arRevies = $CCache->CIBlockElement_GetList(array('CACHE' => array('TAG' => $CCache->GetIBlockCacheTag($CCache::$arIBlocks[SITE_ID]['aspro_scorp_content']['aspro_scorp_reviews'][0]), 'MULTI' => 'Y')), array('ID' => $arResult["SECTION_USER_FIELDS"]['UF_REVIEWS'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'PROPERTY_POST', 'PROPERTY_DOCUMENTS', 'PREVIEW_TEXT'));?>
				<div class="wraps nomargin">
					<hr />
					<h4 class="underline"><a href="/company/reviews/">Отзывы</a></h4>
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
									<div class="item review" id="<?=$this->GetEditAreaId($arItem['ID'])?>" style="margin-bottom:60px;">
										<div class="it">
											<div class="text" id="text_<?=$arItem['ID']?>"><?=$arItem['PREVIEW_TEXT']?></div>
											<?if($arItem['PROPERTY_DOCUMENTS_VALUE']):?>
												<div class="row docs">
													<?foreach((array)$arItem['PROPERTY_DOCUMENTS_VALUE'] as $docID):?>
														<?$arFile = CScorp::get_file_info($docID);?>
														<div class="col-md-6 <?=$arFile['TYPE']?>">
															<?
															$fileName = substr($arFile['ORIGINAL_NAME'], 0, strrpos($arFile['ORIGINAL_NAME'], '.'));
															$fileTitle = (strlen($arFile['DESCRIPTION']) ? $arFile['DESCRIPTION'] : $fileName);
															?>
															<a href="<?=$arFile['SRC']?>" target="_blank" title="<?=$fileTitle?>"><?=$fileTitle?></a>
															<?=GetMessage('CT_NAME_SIZE')?>:
															<?=CScorp::filesize_format($arFile['FILE_SIZE']);?>
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
		<?/*----  Отзывы  ----*/?>

		<?/*----  Специалисты  ----*/?>
		<?/*if($arResult["SECTION_USER_FIELDS"]['UF_SPECIALIST']):?>
				<div class="wraps nomargin">
					<hr />
					<h4 class="underline"><?=(strlen($arParams['T_STAFF']) ? $arParams['T_STAFF'] : (count($arElement['PROPERTY_LINK_STAFF_VALUE']) > 1 ? GetMessage('T_STAFF2') : GetMessage('T_STAFF1')))?></h4>
					<?global $arrrFilter; $arrrFilter = array('ID' => $arResult["SECTION_USER_FIELDS"]['UF_SPECIALIST']);?>
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
						"PAGER_TITLE" => "�������",
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
			<?endif;*/?>
		<?/*----  Специалисты  ----*/?>

		<?/*----  Товары  ----*/?>
		<?/*if($arResult["SECTION_USER_FIELDS"]['UF_ITEMS']):?>
				<?global $arTheme;
				$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');?>
				<div class="wraps nomargin">
					<hr />
					<h4 class="underline">Товары</h4>
					<?global $arrrFilter; $arrrFilter = array('ID' => $arResult["SECTION_USER_FIELDS"]['UF_ITEMS']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"catalog-linked",
						Array(
							"S_ORDER_PRODUCT" => '',//$arParams["S_ORDER_PRODUCT"],
							"IBLOCK_TYPE" => "aspro_scorp_catalog",
							"IBLOCK_ID" => $CCache::$arIBlocks[SITE_ID]["aspro_scorp_catalog"]["aspro_scorp_catalog"][0],
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arrrFilter",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_TEXT",
								2 => "PREVIEW_PICTURE",
								3 => "DETAIL_PICTURE",
								4 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "PRICE",
								1 => "PRICEOLD",
								2 => "ARTICLE",
								3 => "FORM_ORDER",
								4 => "STATUS",
								5 => "",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_STATUS_404" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "Y",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "Y",
							"CACHE_GROUPS" => "N",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "�������",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"SHOW_DETAIL_LINK" => "Y",
							"COUNT_IN_LINE" => "3",
							"IMAGE_POSITION" => "left",
							"ORDER_VIEW" => $bOrderViewBasket,
						),
					false, array("HIDE_ICONS" => "Y")
					);?>
				</div>
			<?endif;*/?>				
		<?/*----  Товары  ----*/?>

	</div>
</div>
<?}?>

<script type="text/javascript">
		$(document).ready(function(){
					$('.item-views.services .item .htext .title').sliceHeight();
					$("[data-toggle='tooltip']").tooltip(); 
						
		});
		</script>