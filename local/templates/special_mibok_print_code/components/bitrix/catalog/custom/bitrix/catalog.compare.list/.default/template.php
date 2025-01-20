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

$itemCount = count($arResult);
$needReload = (isset($_REQUEST["compare_list_reload"]) && $_REQUEST["compare_list_reload"] == "Y");
$idCompareCount = 'compareList'.$this->randString();
$obCompare = 'ob'.$idCompareCount;
$idCompareTable = $idCompareCount.'_tbl';
$idCompareRow = $idCompareCount.'_row_';
$idCompareAll = $idCompareCount.'_count';
$mainClass = 'bx_catalog-compare-list';
$style = ($itemCount == 0 ? ' style="display: none;"' : '');
?>



<div id="<?=$idCompareCount; ?>" class="<?=$mainClass; ?>"><?
unset($style, $mainClass);
if ($needReload)
{
	$APPLICATION->RestartBuffer();
}
$frame = $this->createFrame($idCompareCount)->begin('');

if (!empty($arResult))
{
?>
<div class="wrapper-bx_catalog-compare-list">
    <div class="bx_catalog_compare_count">
        <h4><?=GetMessage('MIBOK_SP_CP_BCCL_TPL_MESS_COMPARE_COUNT'); ?>&nbsp;<b id="<?=$idCompareAll; ?>" class="h3"><?=$itemCount; ?></b></h4>
    </div>

    <div class="bx_catalog_compare_form">
        <table id="<? echo $idCompareTable; ?>" class="compare-items">
            <tbody><?
                foreach($arResult as $arElement)
                {
                    ?><tr id="<? echo $idCompareRow.$arElement['PARENT_ID']; ?>">
                        <td><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></td>
                        <td><noindex><a href="javascript:void(0);" data-id="<?=$arElement['PARENT_ID']; ?>" rel="nofollow" class='btn btn-default btn-sm'><?=GetMessage("MIBOK_SP_CATALOG_DELETE")?></a></noindex></td>
                    </tr><?
                }
            ?>
            </tbody>
        </table>
    </div>
    <p class="compare-redirect pull-right"><a href="<?=$arParams["COMPARE_URL"]; ?>" class='btn btn-default'><?=GetMessage('MIBOK_SP_CP_BCCL_TPL_MESS_COMPARE_PAGE'); ?></a></p>
    <div class="clearfix"></div>    
</div>
    <?
}
$frame->end();
if ($needReload)
{
	die();
}
$currentPath = CHTTP::urlDeleteParams(
	$APPLICATION->GetCurPageParam(),
	array(
		$arParams['PRODUCT_ID_VARIABLE'],
		$arParams['ACTION_VARIABLE'],
		'ajax_action'
	),
	array("delete_system_params" => true)
);

$jsParams = array(
	'VISUAL' => array(
		'ID' => $idCompareCount,
	),
	'AJAX' => array(
		'url' => $currentPath,
		'params' => array(
			'ajax_action' => 'Y'
		),
		'reload' => array(
			'compare_list_reload' => 'Y'
		),
		'templates' => array(
			'delete' => (strpos($currentPath, '?') === false ? '?' : '&').$arParams['ACTION_VARIABLE'].'=DELETE_FROM_COMPARE_LIST&'.$arParams['PRODUCT_ID_VARIABLE'].'='
		)
	),
	'POSITION' => array(
		'fixed' => $arParams['POSITION_FIXED'] == 'Y',
		'align' => array(
			'vertical' => $arParams['POSITION'][0],
			'horizontal' => $arParams['POSITION'][1]
		)
	)
);
?>

</div>
<script type="text/javascript">
var <?=$obCompare; ?> = new JCCatalogCompareList(<? echo CUtil::PhpToJSObject($jsParams, false, true); ?>)
</script>