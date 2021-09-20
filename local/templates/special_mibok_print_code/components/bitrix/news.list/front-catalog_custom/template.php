<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
global $arTheme;
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['URL_BASKET_SECTION']['VALUE']) : '');
?>
<div>
<?if($arResult['SECTIONS'] &&  $arParams["SHOW_SECTIONS"] != "N"):?>
	<?
	$qntyItems = count($arResult['SECTIONS']);
	$colmd = 3;
	$colsm = 3;
	$colxs = 6;
	?>
	<div class="item-views catalog sections front">
		<?if($arParams['PAGER_SHOW_ALL']):?>
			<a href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>" class="btn btn-default white btn-xs"><span><?=GetMessage('S_TO_ALL_CATALOG')?></span></a>
		<?endif;?>
		<h3 class="underline">Заболевания</h3>
		<div class="items row custom">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bSectionImage = strlen($arItem['~PICTURE']) && in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$arSectionImage = CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 250, 'height' => 250), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					$imageSectionSrc = $arSectionImage['src'];
				}
				// data item
				$dataItem = ($bOrderViewBasket ? CScorp::getDataItem($arItem) : false);
				?>
				<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
					<div class="item<?=($bSectionImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
						<?// icon or preview picture?>
						<?if($bSectionImage):?>
							<div class="image">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" class="img-responsive" />
								</a>
							</div>
						<?endif;?>
						<?// section name?>
						<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
							<div class="title">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<?=$arItem['NAME']?>
								</a>
							</div>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
		</div>
	
	</div>
<?endif;?>
<?if(($arResult['SECTIONS'] &&  $arParams["SHOW_SECTIONS"] != "N") && ($arResult['ITEMS'] && $arParams["SHOW_GOODS"] != "N")):?>
	<hr id="front_catalog_separator" />
<?endif;?>


</div>
