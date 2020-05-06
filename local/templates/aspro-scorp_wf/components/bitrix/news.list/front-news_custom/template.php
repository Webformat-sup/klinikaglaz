<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="news front custom">
	<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."include/front-news.php",
				"EDIT_TEMPLATE" => "standard.php"
			)
		);?>
	<div class="items row">
		<?foreach($arResult['ITEMS'] as $key => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$arItem['DETAIL_PAGE_URL'] = str_replace('#YEAR#/', '', $arItem['DETAIL_PAGE_URL']);
			// use detail link?
			$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
			// preview image
			$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
			$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 105, 'height' => 70), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
			$imageSrc = ($bImage ? $arImage['src'] : false);
			$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
			?>
			<div class="col-md-12 col-sm-12">
				<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?// element name?>
					<?if(in_array('NAME', $arParams['FIELD_CODE']) && strlen($arItem['NAME'])):?>
						<div class="title">
							<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
								<?=$arItem['NAME']?>
							<?if($bDetailLink):?></a><?endif;?>
						</div>
					<?endif;?>

					<?// element preview text?>
					<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
						<div class="text">
							<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
						</div>
						<div class="textMore">
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('MORE')?></a>
						</div>
					<?endif;?>
				</div>
			</div>
		<?endforeach;?>
		<?if($arParams['PAGER_SHOW_ALL']):?>
		<div class="moreNews">
			<a href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>" class=""><span><?=GetMessage('S_TO_ALL_NEWS')?></span></a>
		</div>
		<?endif;?>
	</div>
</div>
