<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent(
	"aspro:marketing.popup.next", 
	".default", 
	array(
		'SHOW_FORM' => 'Y'
	),
	false, array('HIDE_ICONS' => 'Y')
);?>

<a href="#" class="close jqmClose"><?=CNext::showIconSvg('', SITE_TEMPLATE_PATH.'/images/svg/Close.svg')?></a>
