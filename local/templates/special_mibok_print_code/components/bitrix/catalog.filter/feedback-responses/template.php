<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
CJSCore::Init(array('date'));
?>

<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
    <div class="content">
    <?
    foreach ($arResult["ITEMS"] as $arItem) {
        if (array_key_exists("HIDDEN", $arItem)) {
//            echo $arItem["INPUT"];
        }
    }
    ?>
    <input type="hidden" name="set_filter" value="Y" />
        <div class="element_column_flex">
        <? if (array_key_exists("DATE_ACTIVE_FROM", $arResult["ITEMS"])) { ?>
            <div class="form-control col col-mb-12 col-5 custom_block_position">
                <div class="form-label custom_form_label">
                    <?=GetMessage('MIBOK_SP_REG_DATE'); ?>
                </div>
                <div class="form-calendar">
                    <input autocomplete="off" class="input input-block custom_input " type="text" onclick="BX.calendar({node: this, field: this, bTime: false})" id="DATE_ACTIVE_FROM_1" name="<?echo $arParams["FILTER_NAME"]?>_DATE_ACTIVE_FROM_1" value="<?echo $arResult["ITEMS"]["DATE_ACTIVE_FROM"]["INPUT_VALUES"][0]?>">
                    <input type="hidden" id="DATE_ACTIVE_FROM_2" name="<?echo $arParams["FILTER_NAME"]?>_DATE_ACTIVE_FROM_2" value="">
                    <i class="icon icon-calendar"></i>
                </div>
            </div>
        <? } ?>
        <? if (array_key_exists("NAME", $arResult["ITEMS"])) { ?>
            <div class="form-control col col-mb-12 col-7 custom_block_position">
                <div class="form-label custom_form_label">
                    <?=GetMessage('MIBOK_SP_SEARCH_BY_CASE_NUMBER'); ?>
                </div>
                <div  class="form-search">
                    <form action="/search/index.php">
                        <div class="input_position_flex">
                        <input class="input input-block custom_input" type="text" name="<?echo $arResult["ITEMS"]["NAME"]["INPUT_NAME"]?>" autocomplete="off" value="<?echo $arResult["ITEMS"]["NAME"]["INPUT_VALUE"]?>">
<!--                        <input id="search-submit-button custom_input_icon" type="submit" class="icon icon-search-black" name="set_filter_btn" value="" >-->
							<button id="search-submit-button custom_input_icon" type="submit" class="icon icon-search-black glyphicon glyphicon-search custom_search_button_position" name="set_filter_btn" value="" ></button>
                    </div>
                    </form>
            </div>
        </div>
        <? } ?>
    </div>
</form>