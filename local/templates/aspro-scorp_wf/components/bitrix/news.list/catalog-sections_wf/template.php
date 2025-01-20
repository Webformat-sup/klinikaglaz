<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
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
			<tr class="wrapp-th">
				<th>Код <br />услуги</th>
				<th class="width-control">Наименование</th>
				<th>Цена <br />(взрослые)</th>
				<th>Цена <br />(дети)</th>
			</tr>
		</thead>
		<tbody>
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<tr height="21">
					<td colspan="4" class="title_centerzag">				
						<b><a id="section<?=$arItem['ID']?>"></a><?=$arItem['NAME']?></b>
					</td>
				</tr>	
				<? foreach ($arItem['ITEMS'] as $arElement) {?>
					<tr>
						<td class="service-code"><?=$arElement['DISPLAY_PROPERTIES']['SERVICE_CODE']['VALUE']?></td>
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
									<div class="accordion-body"><?=$arElement['DETAIL_TEXT']?></div>
								</div>
							<? } ?>
						</td>
						<td class="title_center"><?=$arElement['DISPLAY_PROPERTIES']['PRICE']['VALUE']?></td>
						<td class="title_center"><?=$arElement['DISPLAY_PROPERTIES']['PRICE_KIDS']['VALUE']?></td>
					</tr>
				<? } ?>
			<?endforeach;?>
		</tbody>
	</table>
<?endif;?>
<script type="text/javascript">
  $(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
  });
</script>