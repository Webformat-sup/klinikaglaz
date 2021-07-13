<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

function generate_code($length = 16){
    $num = range(0, 9);
    $alf = range('a', 'z');
   // $_alf = range('A', 'Z');
    $symbols = array_merge($num, $alf);
    shuffle($symbols);
    $code_array = array_slice($symbols, 0, (int)$length);
    $code = implode("", $code_array);
    return $code;
}

$kod=generate_code();
$this->setFrameMode(true);

$code ='<strong>Код для акции</strong><br />'.generate_code();
?>
<a href="javascript:window.print();">Распечатайте</a> эту страницу или сфотографируйте, чтобы предоставить код в клинике.
<hr />
<?
echo str_replace("[loyalitycode]", $code, $arResult['DETAIL_TEXT']);
 ?>
