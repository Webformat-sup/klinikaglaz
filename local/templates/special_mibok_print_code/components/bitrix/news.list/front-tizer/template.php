<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="news front tizers custom">

	<div class="items row">
		<?foreach($arResult['ITEMS'] as $key => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			
			?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="item<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?// element name?>
					<?if(in_array('NAME', $arParams['FIELD_CODE']) && strlen($arItem['NAME'])):?>
						<div class="title">
							<a href="<?=$arItem["DISPLAY_PROPERTIES"]['LINK']['VALUE']?>">
								<?=$arItem['NAME']?>
							</a>
						</div>
					<?endif;?>

					
				</div>
			</div>
		<?endforeach;?>
	
	</div>
</div>
