<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?// element name?>
<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
	<h2 class="underline"><?=$arResult['NAME']?></h2>
<?endif;?>

<?// single detail image?>
<?if($arResult['FIELDS']['DETAIL_PICTURE']):?>
	<?
	$atrTitle = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME']));
	$atrAlt = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME']));
	?>
	<?if($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'LEFT'):?>				
		<div class="detailimage image-left col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'RIGHT'):?>
		<div class="detailimage image-right col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP'):?>
		<script type="text/javascript">
		$(document).ready(function() {
			$('section.page-top').remove();
			$('<div class="row"><div class="col-md-12"><div class="detailimage image-head"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></div></div></div>').insertBefore('.body > .main > .container > .row');
		});
		</script>
	<?else:?>
		<div class="detailimage image-wide"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
	<?endif;?>
<?endif;?>

<?// ask question?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
	<div class="ask_a_question">
		<div class="inner">
			<span class="btn btn-default wc vert" data-event="jqm" data-param-id="17" data-autoload-need_product="<?=$arResult['NAME']?>" data-name="question"><i class="fa fa-comment "></i><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span>
			<div class="margin-bottom-20">
				<?$APPLICATION->IncludeComponent(
					 'bitrix:main.include',
					 '',
					 Array(
						  'AREA_FILE_SHOW' => 'file',
						  'PATH' => SITE_DIR.'include/ask_question.php',
						  'EDIT_TEMPLATE' => ''
					 )
				);?>
			</div>
		</div>
	</div>
<?endif;?>


<?// display properties?>
<?/*$arDisplayPropertiesCodes = array_diff(array_keys($arResult['DISPLAY_PROPERTIES']), array('PERIOD', 'PHOTOS', 'DOCUMENTS', 'LINK_GOODS', 'LINK_STAFF', 'LINK_REVIEWS', 'LINK_PROJECTS', 'LINK_PRICE', 'LINK_SERVICES', 'FORM_ORDER', 'FORM_QUESTION', 'PHOTOPOS'));?>
<?if($arResult['DISPLAY_PROPERTIES'] && $arDisplayPropertiesCodes):?>
	<div class="properties">
		<?foreach($arResult['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
			<?if(in_array($PCODE, $arDisplayPropertiesCodes)):?>
				<div class="property">
					<?if($arProperty['XML_ID']):?>
						<i class="fa <?=$arProperty['XML_ID']?>"></i>&nbsp;
					<?else:?>
						<?=$arProperty['NAME']?>:&nbsp;
					<?endif;?>
					<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
						<?$val = implode('&nbsp;/ ', $arProperty['DISPLAY_VALUE']);?>
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
			<?endif;?>
		<?endforeach;?>
	</div>
<?endif;*/?>

	<?// characteristics?>
	<?/*if($arResult['DISPLAY_PROPERTIES'] && $arDisplayPropertiesCodes):?>
		<div class="wraps">
			<hr />
			<h4 class="underline"><?=(strlen($arParams['T_CHARACTERISTICS']) ? $arParams['T_CHARACTERISTICS'] : GetMessage('T_CHARACTERISTICS'))?></h4>
			<div class="row chars">
				<div class="col-md-12">
					<div class="char-wrapp">
						<table class="props_table">
							<?foreach($arResult['CHARACTERISTICS'] as $arProp):?>
								<tr class="char">
									<td class="char_name">
										<?if($arProp['HINT']):?>
											<div class="hint">
												<span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp['HINT']?>"></span>
											</div>
										<?endif;?>
										<span><?=$arProp['NAME']?></span>
									</td>
									<td class="char_value">
										<span>
											<?if(is_array($arProp['DISPLAY_VALUE'])):?>
												<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
													<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
														<?=$value.'&nbsp;/ '?>
													<?else:?>
														<?=$value?>
													<?endif;?>
												<?endforeach;?>
											<?else:?>
												<?=$arProp['DISPLAY_VALUE']?>
											<?endif;?>
										</span>
									</td>
								</tr>
							<?endforeach;?>
						</table>
					</div>
				</div>

			</div>
		</div>
	<?endif;*/?>
<?if($arResult['PRICES']){?>
<div style="clear:both"></div>
<div class="wraps">
	<hr />
	<h4 class="underline"><?=(strlen($arParams['T_CHARACTERISTICS']) ? $arParams['T_CHARACTERISTICS'] : GetMessage('T_CHARACTERISTICS'))?></h4>
	<div class="row chars">
		<div class="col-md-12">
			<div class="char-wrapp">
				<table class="props_table">
				<?foreach($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'] as $arValue){?>
					<tr class="char">
						<td class="char_name">
							<span><?=$arResult['PRICES'][$arValue]['NAME']?>
							<?if($arResult['PRICES'][$arValue]['PREVIEW_TEXT']){?>
								<i class="fa fa-question question" data-trigger="click" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$arResult['PRICES'][$arValue]['PREVIEW_TEXT']?>"></i>
								<?}?></span>
						</td>
						<td class="char_value">
							<?if(!empty($arResult['PRICES'][$arValue]['PROPERTY_PRICE_VALUE'])){?>
								<span>
									<?=$arResult['PRICES'][$arValue]['PROPERTY_PRICE_VALUE']?><br />
									(взрослые)
								</span>
								
							<?}?>	
							<?if(!empty($arResult['PRICES'][$arValue]['PROPERTY_PRICE_KIDS_VALUE'])){?>
								<span>
									<?=$arResult['PRICES'][$arValue]['PROPERTY_PRICE_KIDS_VALUE']?><br />
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
<script>
  $(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
  });
</script>

<?// docs files?>
<?if($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE']):?>
	<div class="wraps">
		<hr />
		<h4 class="underline"><?=(strlen($arParams['T_DOCS']) ? $arParams['T_DOCS'] : GetMessage('T_DOCS'))?></h4>
		<div class="row docs">
			<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
				<?$arItem = CScorp::get_file_info($docID);?>
				<div class="col-md-6 <?=$arItem['TYPE']?>">
					<?
					$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
					$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
					?>
					<a href="<?=$arItem['SRC']?>" target="_blank" title="<?=$fileTitle?>"><?=$fileTitle?></a>
					<?=GetMessage('CT_NAME_SIZE')?>:
					<?=CScorp::filesize_format($arItem['FILE_SIZE']);?>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?// docs files?>

	<div class="wraps">
		<hr />
		<div class="row">
			<div class="col-md-4">
			<h4 class="underline">Ссылка на прайс</h4>
				<div class="row docs">
					<div class="col-md-12 xls">
						<?if($arResult['DISPLAY_PROPERTIES']['LINK_PRICE']['VALUE']):?>
						<a href="<?=$arResult['DISPLAY_PROPERTIES']['LINK_PRICE']['VALUE']?>" target="_blank" title="Price">Price</a>
						<?endif;?>
						<?//=GetMessage('CT_NAME_SIZE')?>
						<?//=CScorp::filesize_format($arItem['FILE_SIZE']);?>
					</div>
				</div>
			</div>
			
			<div class="col-md-5">
				<a href="/paykeeper/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/button_card_1.svg" /></a>
			</div>
			
		</div>
		
		
	</div>


<?// date active from or dates period active?>
<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arResult['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']))):?>
	<div class="period">
		<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
			<span class="label label-info"><?=$arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
		<?else:?>
			<span class="label"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
		<?endif;?>
	</div>
<?endif;?>

<?if(strlen($arResult['FIELDS']['DETAIL_TEXT']) || strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
	<div class="content">
		<?// element preview text?>
		<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
			<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
			<?endif;?>
		<?endif;?>

		<?// element detail text?>
		<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
			<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
			<?endif;?>
		<?endif;?>
	</div>
<?endif;?>

<?// gallery?>
<?if($arResult['GALLERY']):?>
	<div class="wraps">
		<hr />
		<h4 class="underline"><?=(strlen($arParams['T_GALLERY']) ? $arParams['T_GALLERY'] : GetMessage('T_GALLERY'))?></h4>
		<div class="row galery">
			<div class="inner">
				<div class="flexslider unstyled row" id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :false, "animationLoop": true, "sync": ".detail .galery #carousel", "slideshow": false, "counts": [1, 1, 1]}'>
					<ul class="slides items">
						<?$countAll = count($arResult['GALLERY']);?>
						<?foreach($arResult['GALLERY'] as $i => $arPhoto):?>
							<li class="col-md-1 col-sm-1 item">
								<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancybox" rel="gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
									<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
									<span class="zoom">
										<i class="fa fa-16 fa-white-shadowed fa-search-plus"></i>
									</span>
								</a>
							</li>
						<?endforeach;?>
					</ul>
				</div>
				<?if(count($arResult["GALLERY"]) > 1):?>
					<div class="thmb flexslider unstyled" id="carousel" style="max-width:<?=ceil(((count($arResult['GALLERY']) <= 4 ? count($arResult['GALLERY']) : 4) * 84.5) - 7.5 + 60)?>px;">
						<ul class="slides">	
							<?foreach($arResult["GALLERY"] as $arPhoto):?>
								<li class="blink">
									<img class="img-responsive inline" border="0" src="<?=$arPhoto["THUMB"]["src"]?>" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
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

<?// order?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
	<div class="order-block">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-5 valign">
				<span class="btn btn-default btn-lg" data-event="jqm" data-param-id="5" data-name="order_services" data-autoload-service="<?=$arResult['NAME']?>"><span><?=(strlen($arParams['S_ORDER_SERVICE']) ? $arParams['S_ORDER_SERVICE'] : GetMessage('S_ORDER_SERVICE'))?></span></span>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-7 valign">
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
<?endif;?>



<?
$frame = $this->createFrame('video')->begin('');
$frame->setAnimation(true);
?>
<?// video?>
<?if($arResult['VIDEO']):?>
	<div class="wraps">
		<hr />
		<h4 class="underline"><?=(strlen($arParams['T_VIDEO']) ? $arParams['T_VIDEO'] : GetMessage('T_VIDEO'))?></h4>
		<div class="row video">
			<?foreach($arResult['VIDEO'] as $i => $arVideo):?>
				<div class="col-md-6 item">
					<div class="video_body">
						<video id="js-video_<?=$i?>" width="350" height="217"  class="video-js" controls="controls" preload="metadata" data-setup="{}">
							<source src="<?=$arVideo["path"]?>" type='video/mp4' />
							<p class="vjs-no-js">
								To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
							</p>
						</video>
					</div>
					<div class="title"><?=(strlen($arVideo["title"]) ? $arVideo["title"] : $i)?></div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?$frame->end();?>