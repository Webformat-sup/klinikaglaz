<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	'SHOW_DETAIL_LINK' => array(
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_SECTIONS' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_SECTIONS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'REFRESH' => 'Y',
	),
);

if($arCurrentValues['SHOW_SECTIONS'] != 'N'){
	$arTemplateParameters = array_merge($arTemplateParameters, array(
		'SECTIONS_COUNT' => array(
			'SORT' => 100,
			'NAME' => GetMessage('SECTIONS_COUNT'),
			'TYPE' => 'TEXT',
			'DEFAULT' => '999',
		)
	));
}

$arTemplateParameters = array_merge($arTemplateParameters, array(
	'SHOW_GOODS' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_GOODS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
));
?>