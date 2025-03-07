<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?global $isShowBottomBanner;?>
<?if($isShowBottomBanner):?>
	<?$APPLICATION->IncludeComponent(
		"aspro:com.banners.next", 
		"adv_bottom", 
		array(
			"IBLOCK_TYPE" => "aspro_next_adv",
			"IBLOCK_ID" => "33",
			"TYPE_BANNERS_IBLOCK_ID" => "30",
			"SET_BANNER_TYPE_FROM_THEME" => "N",
			"NEWS_COUNT" => "10",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "ID",
			"SORT_ORDER2" => "DESC",
			"PROPERTY_CODE" => array(
				0 => "URL",
				1 => "",
			),
			"CHECK_DATES" => "Y",
			"CACHE_GROUPS" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"BANNER_TYPE_THEME" => "WIDE"
		),
		false
	);?>
<?endif;?>