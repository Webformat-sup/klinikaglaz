<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$this->setFrameMode(true);
if($arParams["DISPLAY_PICTURE"] != "N"){
	$picture = ($arResult["FIELDS"]["DETAIL_PICTURE"] ? "DETAIL_PICTURE" : "PREVIEW_PICTURE");
	CScorp::getFieldImageData($arResult, array($picture));
	$arPhoto = $arResult[$picture];
	if($arPhoto){
		$arImgs[] = array(
			'DETAIL' => $arPhoto,
			'PREVIEW' => CFile::ResizeImageGet($arPhoto["ID"], array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
			'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME'])),
			'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME'])),
		);
	}
	/*if($arResult["PROPERTIES"]["GALLERY"]["VALUE"]){ 
		foreach($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $arImg){
			$arImgs[] = array(
				'DETAIL' => ($arPhoto = CFile::GetFileArray($arImg)),
				'PREVIEW' => CFile::ResizeImageGet($arImg, array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
				'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME'])),
				'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME'])),
			);
		}
	}*/
}
?>

<div class="detail <?=($templateName = $component->{"__parent"}->{"__template"}->{"__name"})?>">
	<article>
		<?// images?>
		<?if($arImgs):?>
			<div class="detailimage col-md-4">
				<?// images slider?>
				<?/*
				<div class="flexslider" data-plugin-options='{"directionNav":false, "animation":"slide", "slideshow": false}'>
					<ul class="slides">
						<?foreach($arImgs as $arImg):?>
							<li>
								<a class="img-thumbnail fancybox" href="<?=$arImg["DETAIL"]["SRC"]?>" rel="galery" title="<?=$arImg["TITLE"]?>">
									<img class="img-rounded" src="<?=$arImg["PREVIEW"]["src"]?>" border="0" width="<?=$arImg["PREVIEW"]["width"]?>" height="<?=$arImg["PREVIEW"]["height"]?>" title="<?=$arImg["TITLE"]?>" alt="<?=$arImg["ALT"]?>" />
									<span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span>
								</a>
							</li>
						<?endforeach;?>
					</ul>
				</div>
				*/?>
				<?// or single detail image?>
				<?if($arImgs):?>
					<img src="<?=$arImgs[0]["DETAIL"]["SRC"]?>" title="<?=$arImgs[0]["TITLE"]?>" alt="<?=$arImgs[0]["ALT"]?>" class="img-responsive" />
				<?endif;?>
			</div>
		<?endif;?>

	<?
	ob_start();
	$GLOBALS['arrFilter'] = array("PROPERTY_DOCTOR"=>$arResult['ID']);
	$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"reviews_staff",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("", ""),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("", ""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"PROPERTY_CODE" => array("DOCTOR","POST")
	)
);
$reviews_staff = ob_get_contents();
ob_end_clean();

?>
<div class="hidden-xs">
<?=$reviews_staff?>
</div>
	
	
		
		<?// date active from or dates period active?>
		<?if(strlen($arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"]) || ($arResult["DISPLAY_ACTIVE_FROM"] && in_array("DATE_ACTIVE_FROM", $arParams["FIELD_CODE"]))):?>
			<div class="period">
				<?if(strlen($arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"])):?>
					<span class="label label-info"><?=$arResult["DISPLAY_PROPERTIES"]["PERIOD"]["VALUE"]?></span>
				<?else:?>
					<span class="label"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
				<?endif;?>
			</div>
		<?endif;?>
		<div class="order-block">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 valign">
					<span class="btn-custom-sign" data-event="jqm" data-param-id="17"  data-name="questiondock" data-autoload-need_product="<?=$arResult["NAME"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/sign.svg" height="54"/></span>
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

		<div class="post-content">
			<?if($arParams["DISPLAY_NAME"] != "N" && strlen($arResult["NAME"])):?>
				<h2><?=$arResult["NAME"]?></h2>
			<?endif;?>
			<div class="content">
				<?// text?>
				<?if(strlen($arResult["FIELDS"]["PREVIEW_TEXT"].$arResult["FIELDS"]["DETAIL_TEXT"])):?>
					<div class="text">
						<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?>
							<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];?></p>
						<?else:?>
							<?=$arResult["FIELDS"]["PREVIEW_TEXT"];?>
						<?endif;?>
						<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?>
							<p><?=$arResult["FIELDS"]["DETAIL_TEXT"];?></p>
						<?else:?>
							<?=$arResult["FIELDS"]["DETAIL_TEXT"];?>
						<?endif;?>
					</div>
				<?endif;?>
				
				<?php // lightgallery
				$prop_name = 'CERTIFICATS'; // ignore in -  display properties 
				if(!empty($arResult['PROPERTIES']['CERTIFICATS']['VALUE'])){ ?>

					<div id="lightgallery">
						<?php
						foreach($arResult['PROPERTIES'][$prop_name]['VALUE'] as $id){
							$file = CFile::ResizeImageGet($id, ['width'=>300, 'height'=>200], BX_RESIZE_IMAGE_PROPORTIONAL );
							$path = CFile::GetPath($id);
							?>
							<a class="fancybox elem" rel="cert_<?=$arResult["ID"]?>" href="<?=$path?>" data-src="<?=$path?>">
								<img src="<?=$file["src"]?>" alt="Сертификат <?=$arResult["NAME"]?>" />
							</a>
						<?php } ?>
					</div>

				<?php } ?>
			
				<?// display properties?>
				<?if($arResult["DISPLAY_PROPERTIES"]):?>
					<div class="properties">
						<?foreach($arResult["DISPLAY_PROPERTIES"] as $PCODE => $arProperty):?>
							<?php if($PCODE !== $prop_name): ?>
								<div class="property">
									<?if($arProperty["XML_ID"]):?>
										<i class="fa <?=$arProperty["XML_ID"]?>"></i>&nbsp;
									<?else:?>
										<?=$arProperty["NAME"]?>:&nbsp;
									<?endif;?>
									<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
										<?$val = implode("&nbsp;/ ", $arProperty["DISPLAY_VALUE"]);?>
									<?else:?>
										<?$val = $arProperty["DISPLAY_VALUE"];?>
									<?endif;?>
									<?if($PCODE == "SITE"):?>
										<!--noindex-->
										<?=str_replace("href=", "rel='nofollow' target='_blank' href=", $val);?>
										<!--/noindex-->
									<?elseif($PCODE == "EMAIL"):?>
										<a href="mailto:<?=$val?>"><?=$val?></a>
									<?else:?>
										<?=$val?>
									<?endif;?>
								</div>
							<?endif;?>
						<?endforeach;?>
					</div>
				<?endif;?>
			</div>
		</div>




	</article>



	<div class="order-block">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12 valign">
				<span class="btn-custom-sign" data-event="jqm" data-param-id="17"  data-name="questiondock" data-autoload-need_product="<?=$arResult["NAME"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/sign.svg" height="54"/></span>
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





</div>

<div class="hidden-md hidden-sm hidden-lg">
<?=$reviews_staff?>
</div>

	
