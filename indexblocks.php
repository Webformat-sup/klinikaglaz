<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?ob_start();?>
	<div class="blueline">
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-banners-big", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_scorp_content"]["aspro_scorp_advtbig"][0],
		"NEWS_COUNT" => "30",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "BANNERTYPE",
			2 => "TEXTCOLOR",
			3 => "LINKIMG",
			4 => "BUTTON1TEXT",
			5 => "BUTTON1CLASS",
			6 => "BUTTON2TEXT",
			7 => "BUTTON2LINK",
			8 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "front-banners-big",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
		<div class="hidden-xs">
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"front-banners-small_custom",
			array(
				"IBLOCK_TYPE" => "aspro_scorp_content",
				"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_scorp_content"]["aspro_scorp_advtsmall"][0],
				"NEWS_COUNT" => "4",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(
					0 => "NAME",
					1 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "LINK",
					1 => "ICON",
					2 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N"
			),
			false
		);?>
	</div>
	</div>
	<?if($bCatalogIndex || $bCatalogFavoritesIndex):?>
		<?$GLOBALS['arCatalogItemsFilter'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);?>
		<?global $arTheme;
		$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');?>
		<div class="row">
			<div class="maxwidth-theme">
				<div class="col-md-12">
					<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-catalog_custom", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "13",
		"NEWS_COUNT" => "12",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arCatalogItemsFilter",
		"ORDER_VIEW" => $bOrderViewBasket,
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "SHOW_ON_INDEX_PAGE",
			1 => "PRICE",
			2 => "PRICEOLD",
			3 => "STATUS",
			4 => "ARTICLE",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
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
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "front-catalog_custom",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>

				</div>
			</div>
		</div>
	<?endif;?>

	<?if($bCatalogIndex || $bCatalogFavoritesIndex):?>
		<?$GLOBALS['arCatalogItemsFilter'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);?>
		<?global $arTheme;
		$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');?>
		<div class="row custom services">
			<div class="maxwidth-theme">
				<div class="col-md-12">
<div class="pc">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front-services", 
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "13",
		"NEWS_COUNT" => "30",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arCatalogItemsFilter",
		"ORDER_VIEW" => $bOrderViewBasket,
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "SHOW_ON_INDEX_PAGE",
			1 => "STATUS",
			2 => "PRICE",
			3 => "PRICEOLD",
			4 => "ARTICLE",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
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
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "front-services",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SECTIONS_COUNT" => "999"
	),
	false
);?>
</div>
<div class="mobi">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"front-services_custom",
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => "13",
		"NEWS_COUNT" => "30",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arCatalogItemsFilter",
		"ORDER_VIEW" => $bOrderViewBasket,
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "SHOW_ON_INDEX_PAGE",
			1 => "STATUS",
			2 => "PRICE",
			3 => "PRICEOLD",
			4 => "ARTICLE",
			5 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
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
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "front-services_custom",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SHOW_SECTIONS" => "Y",
		"SHOW_GOODS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SECTIONS_COUNT" => "999"
	),
	false
);?>
</div>

				</div>
			</div>
		</div>
	<?endif;?>

	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="styled-block front">
					<div class="row">
						<div class="col-md-9 col-sm-9">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/front-text1.php",
									"EDIT_TEMPLATE" => "standard.php"
								)
							);?>
						</div>
						<div class="col-md-3 col-sm-3">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/front-text2.php",
									"EDIT_TEMPLATE" => "standard.php"
								)
							);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/front-about.php",
								"EDIT_TEMPLATE" => "standard.php"
							)
						);?>
					</div>
					<div class="col-md-6 col-sm-6">
						<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"front-news_custom",
	array(
		"IBLOCK_TYPE" => "aspro_scorp_content",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_scorp_content"]["aspro_scorp_news"][0],
		"NEWS_COUNT" => "7",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "j F Y",
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
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SHOW_DETAIL_LINK" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"COMPONENT_TEMPLATE" => "front-news_custom",
		"SET_LAST_MODIFIED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?$indexProlog = ob_get_clean();?>

<?ob_start();?>

<?$indexEpilog = ob_get_clean();?>


<?ob_start();?>
	<div class="row doctorBlock">
		<div class="maxwidth-theme doctor">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"preim_main_custom",
					array(
						"IBLOCK_TYPE" => "aspro_scorp_content",
						"IBLOCK_ID" => "28",
						"NEWS_COUNT" => "30",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"ORDER_VIEW" => "",
						"FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "LINK",
							1 => "",
						),
						"CHECK_DATES" => "N",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600000",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => "",
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
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SHOW_DETAIL_LINK" => "Y",
						"COMPONENT_TEMPLATE" => "preim",
						"SET_LAST_MODIFIED" => "N",
						"SHOW_SECTIONS" => "N",
						"SHOW_GOODS" => "N",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SHOW_404" => "N",
						"MESSAGE_404" => "",
						"VIEW_TYPE" => "list",
						"SHOW_TABS" => "Y",
						"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y"
					),
					false
				); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"front-partners",
					array(
						"IBLOCK_TYPE" => "aspro_scorp_content",
						"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_scorp_content"]["aspro_scorp_partners"][0],
						"NEWS_COUNT" => "20",
						"SORT_BY1" => "SORT",
						"SORT_ORDER1" => "ASC",
						"SORT_BY2" => "ID",
						"SORT_ORDER2" => "ASC",
						"FILTER_NAME" => "",
						"FIELD_CODE" => array(
							0 => "NAME",
							1 => "PREVIEW_PICTURE",
							2 => "",
						),
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "",
						),
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "100000",
						"CACHE_FILTER" => "Y",
						"CACHE_GROUPS" => "N",
						"PREVIEW_TRUNCATE_LEN" => "",
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
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "Y",
						"ITEM_IN_BLOCK" => "6",
						"SHOW_DETAIL_LINK" => "Y",
						"AJAX_OPTION_ADDITIONAL" => "",
						"SET_BROWSER_TITLE" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_META_DESCRIPTION" => "N",
					),
					false
				);?>
			</div>
		</div>
	</div>
	<div class="blueline footer"></div>

<?$indexPreim = ob_get_clean();?>

<script type="text/javascript">
$(document).ready(function() {
	try{
		if(arScorpOptions.THEME.CATALOG_INDEX == 'Y'){
			$('.catalog.item-views.sections.front').show();
			if(arScorpOptions.THEME.TEASERS_INDEX == 'NONE'){
				$('.catalog.item-views.sections.front').css('margin-top', '47px');
			}
		}
		else{
			$('.catalog.item-views.sections.front').remove();
			$('#front_catalog_separator').remove();
		}
		if(arScorpOptions.THEME.CATALOG_FAVORITES_INDEX == 'Y'){
			$('.catalog.item-views.table.front').show();
			if(arScorpOptions.THEME.TEASERS_INDEX == 'NONE' && arScorpOptions.THEME.CATALOG_INDEX == 'N'){
				$('.catalog.item-views.table.front').css('margin-top', '47px');
			}
			InitFlexSlider();
			$('.catalog.item-views.table.front .blink img').blink();
		}
		else{
			$('.catalog.item-views.table.front').remove();
			$('#front_catalog_separator').remove();
		}
	}
	catch(e){}
});
</script>
