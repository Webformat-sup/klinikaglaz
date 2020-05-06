<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$webformatLangPrefix = 'WEBFORMAT_GENERATE_COUPON_';


$arComponentDescription = array(
	"NAME" => GetMessage($webformatLangPrefix."COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage($webformatLangPrefix."COMPONENT_DESCR"),
	"ICON" => "/img/pagination.gif",
	'PATH' => array(
		'ID' => 'WEBFORMAT',
		'NAME' => 'WEBFORMAT'
	),
);
