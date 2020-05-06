<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$webformatLangPrefix = 'WEBFORMAT_GENERATE_COUPON_DEFAULT_';

$arTemplateParameters = array(
	"PRINT_TEMPLATE_CONDITION"=>array(
		"NAME" => GetMessage($webformatLangPrefix . "PRINT_TEMPLATE_CONDITION"),
		"PARENT" => "BASE",
		"TYPE" => "STRING",
		"DEFAULT" => "={isset(\$_REQUEST['print'])&&(\$_REQUEST['print']==1 || \$_REQUEST['print']=='Y')}",	
	)
);
?>
