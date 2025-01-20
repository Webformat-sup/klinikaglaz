<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?//$arOptions from \Aspro\Next\Functions\CAsproNext::showBlockHtml?>
<?
$arOptions = $arConfig['PARAMS'];
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "blog-slider",
    array(
        "IBLOCK_TYPE" => "aspro_next_adv",
        "IBLOCK_ID" => $arOptions['IBLOCK_ID'],
        "NEWS_COUNT" => "100",
        "SHOW_ALL_ELEMENTS" => 'Y',
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "ASC",
        "FIELD_CODE" => array(
            0 => "NAME",
            2 => "PREVIEW_PICTURE",
        ),
        "CHECK_DATES" => "Y",
        "FILTER_NAME" => $arOptions['FILTER_NAME'],
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600000",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "150",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
        "PAGER_SHOW_ALL" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "SHOW_DETAIL_LINK" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "COMPONENT_TEMPLATE" => "banners",
        "SET_LAST_MODIFIED" => "N",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
    ),
    false, array('ACTIVE_COMPONENT' => 'Y', 'HIDE_ICONS' => 'Y')
);?>