<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$webformatLangPrefix = 'WEBFORMAT_GENERATE_COUPON_';

$arComponentParameters = array(
	'GROUPS' => array(),
	'PARAMETERS' => array(
		'COUPON_DAYS_LIFE' => array(
			'NAME' => GetMessage($webformatLangPrefix.'COUPON_DAYS_LIFE'),
			'PARENT' => 'BASE',
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		),
	)
);