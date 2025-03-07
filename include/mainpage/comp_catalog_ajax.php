<?$bAjaxMode = (isset($_POST["AJAX_POST"]) && $_POST["AJAX_POST"] == "Y");
if($bAjaxMode)
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	global $APPLICATION;
	if(\Bitrix\Main\Loader::includeModule("aspro.next"))
	{
		$arRegion = CNextRegionality::getCurrentRegion();
	}
}?>
<?if((isset($arParams["IBLOCK_ID"]) && $arParams["IBLOCK_ID"]) || $bAjaxMode):?>
	<?
	$arIncludeParams = ($bAjaxMode ? $_POST["AJAX_PARAMS"] : $arParamsTmp);
	$arGlobalFilter = ($bAjaxMode ? $_POST["GLOBAL_FILTER"] : '');
	$signer = new \Bitrix\Main\Component\ParameterSigner();
	try {
		$componentName = CNext::partnerName.':tabs.'.CNext::solutionName;
		$arComponentParams = $signer->unsignParameters($componentName, $arIncludeParams);
		$arGlobalFilter = strlen($arGlobalFilter) ? $signer->unsignParameters($componentName, $arGlobalFilter) : [];
	} catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
		die($e->getMessage());
	}
	$arComponentParams['TYPE_SKU'] = \Bitrix\Main\Config\Option::get('aspro.next', 'TYPE_SKU', 'TYPE_1', SITE_ID);
	$propertyCodeList = CNext::GetFrontParametrValue("CATALOG_LINKED_PROP", SITE_ID);
	?>

	<?
	if($bAjaxMode && (is_array($arGlobalFilter) && $arGlobalFilter))
		$GLOBALS[$arComponentParams["FILTER_NAME"]] = $arGlobalFilter;

	if($bAjaxMode && $_POST["FILTER_HIT_PROP"])
		$arComponentParams["FILTER_HIT_PROP"] = $_POST["FILTER_HIT_PROP"];

	/* hide compare link from module options */
	if (CNext::GetFrontParametrValue('CATALOG_COMPARE') == 'N') {
		$arComponentParams["DISPLAY_COMPARE"] = 'N';
	}
	/**/

	if ($_POST["ajax_get"] && $_POST["ajax_get"] === 'Y') {
		$arComponentParams["AJAX_REQUEST"] = 'Y';
	}

	$arComponentParams["PROPERTY_CODE"] = (strlen(trim($propertyCodeList)) ? explode(',', $propertyCodeList) : []);
	?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"catalog_block_front",
		$arComponentParams,
		false, array("HIDE_ICONS"=>"Y")
	);?>

<?endif;?>