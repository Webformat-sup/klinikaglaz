<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div id="services-banners" class="services-banners-container">

	<div class="services-banners-title"></div>
	<div class="services-banners-info"></div>

	<div class="services-banners-items">
		<?foreach($arResult['ITEMS'] as $i => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

				<? if(!$arItem['PREVIEW_TEXT'] || !$arItem['PREVIEW_PICTURE']) continue; ?>
				<div class="services-banners-item">
				<div class="services-banners-img-block">
						<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['PREVIEW_PICTURE']['DESCRIPTION']?>" />
					</div>
					<div class="services-banners-info-block">
						<div class="services-banners-text"><?=$arItem['PREVIEW_TEXT']?></div>
						<div class="services-banners-link">
							<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" target="_blank">Перейти</a>
						</div>
					</div>

				</div>
		<?endforeach;?>
	</div>
</div>