<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<nav>
    <ul class="pagination">

<?if($arResult["bDescPageNumbering"] === true):?>

	<?/*?>
		<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("MIBOK_SP_nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("MIBOK_SP_nav_of")?> <?=$arResult["NavRecordCount"]?><br />	
	<?*/?>
	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
			<?/*?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("MIBOK_SP_nav_begin")?></a>
			<?*/?>
			<li>
				<a class="arrow-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
					<?=GetMessage("MIBOK_SP_nav_prev")?>
				</a>
			</li>
			
		<?else:?>
			<?/*?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("MIBOK_SP_nav_begin")?></a>
			<?*/?>
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<li>
					<a class="arrow-left" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("MIBOK_SP_nav_prev")?></a>
				</li>				
			<?else:?>
				<li>
					<a class="arrow-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
						<?=GetMessage("MIBOK_SP_nav_prev")?>
					</a>
				</li>				
			<?endif?>
		<?endif?>
	<?else:/*?>
		<?=GetMessage("MIBOK_SP_nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("MIBOK_SP_nav_prev")?>&nbsp;|
	<?*/endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <li class="selected"><span><?=$NavRecordGroupPrint?></span></li>
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
		<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a></li>
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	|

	<?if ($arResult["NavPageNomer"] > 1):?>
		<li>
			<a class="arrow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
				<?=GetMessage("MIBOK_SP_nav_next")?>
			</a>
		</li>
		
		<?/*?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("MIBOK_SP_nav_end")?></a><?*/?>
	<?else:/*?>
		<?=GetMessage("MIBOK_SP_nav_next")?>&nbsp;|&nbsp;<?=GetMessage("MIBOK_SP_nav_end")?>
	<?*/endif?>

<?else:?>
	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>			
			<li>
				<a aria-label="<?=GetMessage("MIBOK_SP_nav_prev")?>" class="arrow-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                                    <span aria-hidden="true">&laquo;</span>
				</a>
			</li>
		<?else:?>			
			<?if ($arResult["NavPageNomer"] > 2):?>
				<li aria-label="<?=GetMessage("MIBOK_SP_nav_prev")?>">
					<a class="arrow-left" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">
                                            <span aria-hidden="true">&laquo;</span>
					</a>
				</li>
			<?else:?>
				<li aria-label="<?=GetMessage("MIBOK_SP_nav_prev")?>">
					<a class="arrow-left" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
                                            <span aria-hidden="true">&laquo;</span>
					</a>
				</li>
			<?endif?>			
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <li class="active"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a><li>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	
	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                    <li aria-label="<?=GetMessage("MIBOK_SP_nav_next")?>"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span aria-hidden="true">&raquo;</span></a></li>
        <?endif?>

<?endif?>


<?if ($arResult["bShowAll"]):?>
	<?if ($arResult["NavShowAll"]):?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("MIBOK_SP_nav_paged")?></a></li>
	<?else:?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("MIBOK_SP_nav_all")?></a></li>
	<?endif?>
<?endif?>
</ul>
</nav>