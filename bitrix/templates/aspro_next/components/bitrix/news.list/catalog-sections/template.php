<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['SECTIONS']):?>
	<?
	$bLine = $arParams['VIEW_TYPE_SECTION'] == 'row_block';
	$colmd = ($bLine ? 6 : 12);
	$colsm = 12;
	?>
	<div class="item-views catalog sections">
		<div class="items row margin0 <?=$arParams['VIEW_TYPE_SECTION'];?>">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', (array)$arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 254, 'height' => 254), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/no_photo_medium.png');
				}
				?>
				<div class="col-md-<?=$colmd?> col-sm-<?=$colsm?>">
					<div class="item <?=($bShowSectionImage ? '' : ' wti')?> <?=($bLine ? 'slice-item' : '')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?// icon or preview picture?>
						<?if($bShowSectionImage):?>
							<div class="image">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
								</a>
							</div>
						<?endif;?>
						
						<div class="info">
							<?// section name?>
							<?if(in_array('NAME', (array)$arParams['FIELD_CODE'])):?>
								<div class="title">
									<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
										<?=$arItem['NAME']?>
									</a>
								</div>
							<?endif;?>

							<?// section child?>
							<?if($arItem['CHILD']):?>
								<div class="text childs">
									<ul>
										<?foreach($arItem['CHILD'] as $arSubItem):?>
											<li><a class="colored" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
										<?endforeach;?>
									</ul>
								</div>
							<?endif;?>
							
							<?// section preview text?>
							<?if(strlen($arItem['UF_INFOTEXT']) && !$bLine):?>
								<div class="text">
									<?=$arItem['UF_INFOTEXT']?>
								</div>
							<?endif;?>
							<div class="link-block-more">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="btn-inline sm rounded black">
									<?=GetMessage('TO_ALL');?><i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>