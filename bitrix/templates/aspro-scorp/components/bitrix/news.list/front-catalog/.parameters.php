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
	),
	'SHOW_GOODS' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_GOODS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'ORDER_VIEW' => array(
		'SORT' => 100,
		'NAME' => GetMessage('ORDER_VIEW'),
		'TYPE' => 'STRING',
		'DEFAULT' => '$bOrderViewBasket',
	),
);
?>