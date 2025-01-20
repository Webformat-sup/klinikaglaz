<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(empty($arResult))
	return "";

$strReturn = '<ul class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; ++$index){
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$position = $index + 1; // Позиция текущего элемента хлебных крошек
	if(strlen($arResult[$index]["LINK"]) && $arResult[$index]['LINK'] != GetPagePath() && $arResult[$index]['LINK']."index.php" != GetPagePath())
		$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span></a><meta itemprop="position" content="'.$position.'" /></li>';
	else{
		$strReturn .= '<li class="active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name">'.$title.'</span><meta itemprop="position" content="'.$position.'" /></li>';
		break;
	}
}

$strReturn .= '</ul>';
return $strReturn;?>