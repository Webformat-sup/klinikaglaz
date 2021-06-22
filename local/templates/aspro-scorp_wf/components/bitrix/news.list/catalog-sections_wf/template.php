

<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

/*echo '<pre>';
print_r($arResult);
echo '</pre>';*/


?>
<?if($arResult['SECTIONS']):?>
<noindex>
	<ul>
		<?foreach($arResult['SECTIONS'] as $arItem):?>
			<li><a class="section" href="#section<?=$arItem['ID']?>" rel="nofollow"><?=$arItem['NAME']?></a></li>
		<?endforeach; ?>
	</ul>
</noindex>


<table class="table table-striped price">
<thead>
<tr>
	
	<th style="width:70%">
		 Наименование
	</th>
	
	<th>
		 Цена(взрослые)
	</th>
	<th>
		 Цена(дети)
	</th>

</tr>
</thead>
<tbody>
	
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 100, 'height' => 87), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : SITE_TEMPLATE_PATH.'/images/noimage_sections.png');
				}
				?>
				<tr height="21">
					<td colspan="3" class="title_centerzag">				
				 		<b><a id="section<?=$arItem['ID']?>"></a><?=$arItem['NAME']?></b>
					</td>
				</tr>	
				<? foreach ($arItem['ITEMS'] as $arElement) {?>
				<tr>					
					<td class="title_left">
						 <a id="<?=$arElement['DISPLAY_PROPERTIES']['anchor']['VALUE']?>"></a>					
						 <?=$arElement['NAME']?>
						 <?if($arElement['~PREVIEW_TEXT']){?>						 
						 <i class="fa fa-question question" data-trigger="click" data-toggle="tooltip" data-placement="right" title="<?=$arElement['~PREVIEW_TEXT']?>"></i>
						 <? } ?>
						  <? if($arElement['~DETAIL_TEXT']){?>
						 <div class="accordion-head accordion-close" data-toggle="collapse" data-parent="#accordion<?=$arElement['ID']?>" href="#accordion<?=$arElement['ID']?>">
							<a href="#">Следует прочесть перед визитом в клинику</a>
						</div>
						<div id="accordion<?=$arElement['ID']?>" class="panel-collapse collapse">
							<div class="accordion-body">
								<?=$arElement['DETAIL_TEXT']?>
							</div>
						</div>
						<? } ?>
					</td>
					<td class="title_center">
						 <?=$arElement['DISPLAY_PROPERTIES']['PRICE']['VALUE']?>
					</td>
					<td class="title_center">
						 <?=$arElement['DISPLAY_PROPERTIES']['PRICE_KIDS']['VALUE']?>
					</td>
				</tr>					
				<?} ?>				

			<?endforeach;?>
	
<?endif;?>
</tbody>
</table>
<script type="text/javascript">
  $(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
  });
</script>
