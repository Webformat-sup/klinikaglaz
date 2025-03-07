<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Глазные заболевания");
	$template = 'custom';
	//$template = '.default_old';
	//global $USER; if($USER->isAdmin()) $template = 'custom'; 

	$APPLICATION->SetPageProperty("description", "Глазные заболевания, виды хрусталиков и лекарственных препаратов");?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"custom", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_FILTER_CATALOG" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "4",
		"ALSO_BUY_MIN_BUYES" => "2",
		"ASK_FORM_ID" => "2",
		"BASKET_URL" => "/basket/",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"BLOCK_BLOG_NAME" => "",
		"BLOCK_DOCS_NAME" => "",
		"BLOCK_LANDINGS_NAME" => "",
		"BLOCK_SERVICES_NAME" => "",
		"BLOG_IBLOCK_ID" => "",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "A",
		"CHEAPER_FORM_NAME" => "",
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPARE_ELEMENT_SORT_FIELD" => "shows",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"COMPARE_FIELD_CODE" => array(
			0 => "NAME",
			1 => "TAGS",
			2 => "SORT",
			3 => "PREVIEW_PICTURE",
			4 => "",
		),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "VOLUME",
			2 => "SIZES",
			3 => "COLOR_REF",
			4 => "",
		),
		"COMPARE_POSITION" => "top left",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_PROPERTY_CODE" => array(
			0 => "BRAND",
			1 => "CML2_ARTICLE",
			2 => "CML2_BASE_UNIT",
			3 => "PROP_2033",
			4 => "COLOR_REF2",
			5 => "PROP_159",
			6 => "PROP_2052",
			7 => "PROP_2027",
			8 => "PROP_2053",
			9 => "PROP_2083",
			10 => "PROP_2049",
			11 => "PROP_2026",
			12 => "PROP_2044",
			13 => "PROP_162",
			14 => "PROP_2065",
			15 => "PROP_2054",
			16 => "PROP_2017",
			17 => "CML2_MANUFACTURER",
			18 => "PROP_2055",
			19 => "PROP_2069",
			20 => "PROP_2062",
			21 => "PROP_2061",
			22 => "",
		),
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DEFAULT_COUNT" => "1",
		"DEFAULT_LIST_TEMPLATE" => "block",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
			0 => "BUY",
		),
		"DETAIL_ASSOCIATED_TITLE" => "Похожие товары",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => "MAGNIFIER",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_DOCS_PROP" => "-",
		"DETAIL_EXPANDABLES_TITLE" => "Аксессуары",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => "",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "DETAIL_PAGE_URL",
			4 => "",
		),
		"DETAIL_OFFERS_LIMIT" => "0",
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "FRAROMA",
			1 => "ARTICLE",
			2 => "SPORT",
			3 => "VLAGOOTVOD",
			4 => "AGE",
			5 => "RUKAV",
			6 => "KAPUSHON",
			7 => "FRCOLLECTION",
			8 => "FRLINE",
			9 => "FRFITIL",
			10 => "VOLUME",
			11 => "FRMADEIN",
			12 => "FRELITE",
			13 => "SIZES",
			14 => "TALL",
			15 => "FRFAMILY",
			16 => "FRSOSTAVCANDLE",
			17 => "FRTYPE",
			18 => "FRFORM",
			19 => "COLOR_REF",
			20 => "",
		),
		"DETAIL_PICTURE_MODE" => "MAGNIFIER",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "SIZE",
			2 => "BRAND",
			3 => "TYPE",
			4 => "COLOR",
			5 => "MATERIAL",
			6 => "CORRECTION",
			7 => "LENS_DESIGN",
			8 => "RETINAL_FILTER",
			9 => "OPTICS_TYPE",
		),
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_BASIS_PRICE" => "Y",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DIR_PARAMS" => CNext::GetDirMenuParametrs(__DIR__),
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_ELEMENT_COUNT" => "Y",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"DISPLAY_ELEMENT_SLIDER" => "10",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_WISH_BUTTONS" => "Y",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_FIELD_BOX" => "name",
		"ELEMENT_SORT_FIELD_BOX2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ELEMENT_SORT_ORDER_BOX" => "asc",
		"ELEMENT_SORT_ORDER_BOX2" => "desc",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_NAME" => "NEXT_SMART_FILTER",
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "COLOR",
			2 => "CML2_LINK",
			3 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "BASE",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "IN_STOCK",
			2 => "CML2_ARTICLE",
			3 => "",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FORUM_ID" => "1",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "8",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "8",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "8",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "12",
		"IBLOCK_STOCK_ID" => "48",
		"IBLOCK_TYPE" => "aspro_scorp_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => "-",
		"LANDING_SECTION_COUNT" => "7",
		"LANDING_TITLE" => "Популярные категории",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "aspro_next_content",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_DISPLAY_POPUP_IMAGE" => "Y",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "CML2_LINK",
			2 => "DETAIL_PAGE_URL",
			3 => "",
		),
		"LIST_OFFERS_LIMIT" => "10",
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "VOLUME",
			2 => "SIZES",
			3 => "COLOR_REF",
			4 => "",
		),
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "BRAND",
			2 => "CML2_ARTICLE",
			3 => "PROP_2033",
			4 => "COLOR_REF2",
			5 => "PROP_159",
			6 => "PROP_2052",
			7 => "PROP_2027",
			8 => "PROP_2053",
			9 => "PROP_2083",
			10 => "PROP_2049",
			11 => "PROP_2026",
			12 => "PROP_2044",
			13 => "PROP_162",
			14 => "PROP_2065",
			15 => "PROP_2054",
			16 => "PROP_2017",
			17 => "PROP_2055",
			18 => "PROP_2069",
			19 => "PROP_2062",
			20 => "PROP_2061",
			21 => "CML2_LINK",
			22 => "",
		),
		"LIST_PROPERTY_CODE_MOBILE" => "",
		"LIST_SHOW_SLIDER" => "N",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MAIN_TITLE" => "Наличие на складах",
		"MAX_AMOUNT" => "20",
		"MESSAGES_PER_PAGE" => "10",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Под заказ",
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"MIN_AMOUNT" => "10",
		"NO_WORD_LOGIC" => "Y",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_SORT_FIELD" => "shows",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_HIDE_NAME_PROPS" => "N",
		"OFFER_TREE_PROPS" => array(
			0 => "SIZES",
			1 => "COLOR_REF",
		),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "15",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"POST_FIRST_MESSAGE" => "N",
		"PRICE_CODE" => array(
			0 => "Розничная 7 салон",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTIES_DISPLAY_LOCATION" => "DESCRIPTION",
		"PROPERTIES_DISPLAY_TYPE" => "TABLE",
		"RECOMEND_COUNT" => "5",
		"RESTART" => "N",
		"REVIEW_AJAX_POST" => "Y",
		"SALE_STIKER" => "SALE_TEXT",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "Y",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_TYPE_VIEW" => "sections_1",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_DISPLAY_PROPERTY" => "UF_VIEWTYPE",
		"SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_1",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_PREVIEW_DESCRIPTION" => "Y",
		"SECTION_PREVIEW_PROPERTY" => "DESCRIPTION",
		"SECTION_TOP_BLOCK_TITLE" => "Лучшие предложения",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/glaznye-zabolevaniya/",
		"SEF_MODE" => "Y",
		"SEND_GIFT_FORM_NAME" => "",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_ADDITIONAL_TAB" => "Y",
		"SHOW_ARTICLE_SKU" => "Y",
		"SHOW_ASK_BLOCK" => "Y",
		"SHOW_BRAND_PICTURE" => "Y",
		"SHOW_CHEAPER_FORM" => "Y",
		"SHOW_COUNTER_LIST" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DELIVERY" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_DISCOUNT_TIME" => "Y",
		"SHOW_DISCOUNT_TIME_EACH_SKU" => "N",
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GARANTY" => "N",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"SHOW_HINTS" => "Y",
		"SHOW_HOW_BUY" => "N",
		"SHOW_KIT_PARTS" => "Y",
		"SHOW_KIT_PARTS_PRICES" => "Y",
		"SHOW_LINK_TO_FORUM" => "Y",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_MEASURE" => "Y",
		"SHOW_MEASURE_WITH_RATIO" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_ONE_CLICK_BUY" => "Y",
		"SHOW_PAYMENT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_QUANTITY" => "Y",
		"SHOW_QUANTITY_COUNT" => "Y",
		"SHOW_RATING" => "Y",
		"SHOW_SECTION_DESC" => "Y",
		"SHOW_SECTION_LIST_PICTURES" => "Y",
		"SHOW_SECTION_PICTURES" => "Y",
		"SHOW_SECTION_SIBLINGS" => "Y",
		"SHOW_SEND_GIFT" => "Y",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SHOW_UNABLE_SKU_PROPS" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"SKU_DETAIL_ID" => "oid",
		"SORT_BUTTONS" => array(
			0 => "POPULARITY",
			1 => "NAME",
			2 => "PRICE",
		),
		"SORT_PRICES" => "REGION_PRICE",
		"SORT_REGION_PRICE" => "BASE",
		"STIKERS_PROP" => "HIT",
		"STORES" => array(
			0 => "",
			1 => "",
		),
		"STORES_FILTER" => "TITLE",
		"STORES_FILTER_ORDER" => "SORT_ASC",
		"STORE_PATH" => "/contacts/stores/#store_id#/",
		"TAB_CHAR_NAME" => "",
		"TAB_DESCR_NAME" => "",
		"TAB_DOPS_NAME" => "",
		"TAB_FAQ_NAME" => "",
		"TAB_OFFERS_NAME" => "",
		"TAB_REVIEW_NAME" => "",
		"TAB_STOCK_NAME" => "",
		"TAB_VIDEO_NAME" => "",
		"TEMPLATE_THEME" => "blue",
		"TITLE_DELIVERY" => "Доставка",
		"TITLE_GARANTY" => "Условия гарантии",
		"TITLE_HOW_BUY" => "Как купить",
		"TITLE_PAYMENT" => "Оплата",
		"TITLE_SLIDER" => "Рекомендуем",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "8",
		"TOP_ELEMENT_SORT_FIELD" => "shows",
		"TOP_ELEMENT_SORT_FIELD2" => "shows",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "asc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "4",
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "10",
		"TOP_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE_MOBILE" => "",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"URL_TEMPLATES_READ" => "",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"USE_ADDITIONAL_GALLERY" => "N",
		"USE_ALSO_BUY" => "Y",
		"USE_BIG_DATA" => "Y",
		"USE_CAPTCHA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "N",
		"USE_FILTER_PRICE" => "N",
		"USE_GIFTS_DETAIL" => "N",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
		"USE_GIFTS_SECTION" => "N",
		"USE_LANGUAGE_GUESS" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_MIN_AMOUNT" => "N",
		"USE_ONLY_MAX_AMOUNT" => "Y",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"USE_RATING" => "Y",
		"USE_RATIO_IN_RANGES" => "Y",
		"USE_REVIEW" => "Y",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_SHARE" => "Y",
		"USE_STORE" => "N",
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"VIEWED_BLOCK_TITLE" => "Ранее вы смотрели",
		"VIEWED_ELEMENT_COUNT" => "20",
		"VIEW_BLOCK_TYPE" => "N",
		"VISIBLE_PROP_COUNT" => "4",
		"COMPONENT_TEMPLATE" => "custom",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_VIEWED" => "Y",
		"SIDEBAR_SECTION_POSITION" => "right",
		"SIDEBAR_DETAIL_POSITION" => "right",
		"SHOW_SKU_DESCRIPTION" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>