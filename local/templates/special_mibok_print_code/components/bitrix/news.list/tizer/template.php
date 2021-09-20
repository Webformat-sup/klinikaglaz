<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult['LIST_PAGE_URL'] = str_replace("#SITE_DIR#/", SITE_DIR, $arResult['LIST_PAGE_URL']);
$arResult['LIST_PAGE_URL'] = str_replace("#SITE_DIR#", SITE_DIR, $arResult['LIST_PAGE_URL']);
?>

    <div class="row">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="" tabindex="0">                    
                    <a href="<?=$arItem["DISPLAY_PROPERTIES"]['LINK']['VALUE']?>" class="element-title"><? echo $arItem["NAME"] ?></a>
                </div>                
            </div>
        <? endforeach; ?>
    </div> 
