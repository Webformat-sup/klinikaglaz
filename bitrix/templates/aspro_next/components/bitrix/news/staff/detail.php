<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
// get element
$arItemFilter = CNext::GetCurrentElementFilter($arResult["VARIABLES"], $arParams);
$arElement = CNextCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arItemFilter, false, false, array("ID", 'PREVIEW_TEXT', "IBLOCK_SECTION_ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CNext::goto404Page();?>
<?else:?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CNext::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	}?>
	<?CNext::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['DETAIL_PICTURE'] ? $arElement['DETAIL_PICTURE'] : $arElement['PREVIEW_PICTURE'])) : false),
		)
	);?>
	<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
		<div class="line_block share top <?=($arParams['USE_RSS'] !== 'N' ? 'rss-block' : '');?>">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
		</div>
		<style type="text/css">h1{padding-right:300px;}</style>
		<script type="text/javascript">
			$('h1').addClass('shares-block');
			$(document).ready(function(){
				if($('a.rss').length)
					$('a.rss').after($('.share.top'));
				else
					$('h1').before($('.share.top'));
			})
		</script>
		<?if($arParams['USE_RSS'] !== 'N'):?>
			<style type="text/css">body h1{padding-right:360px;}</style>
		<?endif;?>
	<?endif;?>
	<?//element?>
	<?$sViewElementTemplate = ($arParams["ELEMENT_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["NEWS_PAGE_DETAIL"]["VALUE"] : $arParams["ELEMENT_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
	<?/*
	if(is_array($arElement["IBLOCK_SECTION_ID"]) && count($arElement["IBLOCK_SECTION_ID"]) > 1){
		CNext::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}*/
	?>
<?endif;?>
<div style="clear:both"></div>
<hr class="bottoms" />
<div class="row">
	<div class="col-md-6 share">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<div class="line_block">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
			</div>
		<?endif;?>
	</div>
	<div class="col-md-6">
		<a class="back-url url-block" href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']?>"><i class="fa fa-angle-left"></i><span><?=GetMessage('BACK_LINK')?></span></a>
	</div>
</div>