<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult['LIST_PAGE_URL']=str_replace("#SITE_DIR#/",SITE_DIR,$arResult['LIST_PAGE_URL']);
$arResult['LIST_PAGE_URL']=str_replace("#SITE_DIR#",SITE_DIR,$arResult['LIST_PAGE_URL']);
?>
<?php

?>
<div class="bs-docs-section">
    <h3 class="page-header" tabindex="0"><?=$arResult['NAME']?></h3>                                
    <div class="element-list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="element-item">
                <div class="element-content" tabindex="0">
                    <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                    <div class="element-date"><?echo ToLower($arItem["DISPLAY_ACTIVE_FROM"])?></div>
                    <?endif?>	
                    <h4 class="element-title"><?echo $arItem["NAME"]?></h4>
                </div>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <? if (isset($arItem["DETAIL_PAGE_URL"])): ?>
                    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" title="<?=GetMessage("MIBOK_SP_READ_MORE")?>"><?=GetMessage("MIBOK_SP_READ_MORE")?></a>
               <?endif;?>
                <?endif;?>
            </div>
        <?endforeach;?>											
    </div>	    
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>
<script>

</script>