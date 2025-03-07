<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$theme = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";
foreach($arResult["ITEMS"] as $key => $arItem)
{
	/*unset empty values*/
	if (
		(
		 ($arItem["DISPLAY_TYPE"] == "A" || isset($arItem["PRICE"]))
		 && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
		)
		|| !$arItem["VALUES"]
	)
		unset($arResult["ITEMS"][$key]);
	/**/
		
	if ($arItem["CODE"] === "IN_STOCK") {
		if (
			isset($arResult["ITEMS"][$key]["VALUES"]) 
			&& is_array($arResult["ITEMS"][$key]["VALUES"])
			&& $arResult["ITEMS"][$key]["VALUES"]
		) {
			sort($arResult["ITEMS"][$key]["VALUES"]);
			$arResult["ITEMS"][$key]["VALUES"][0]["VALUE"] = $arItem["NAME"];
		}
	}
}

\Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__);

// sort
include 'sort.php';

global $sotbitFilterResult;
$sotbitFilterResult = $arResult;