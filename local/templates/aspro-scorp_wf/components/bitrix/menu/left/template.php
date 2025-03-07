<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?
\Bitrix\Main\Loader::incLudeModule('aspro.scorp');
$this->setFrameMode(true);?>
<?
$CScorp = new CScorp;

if(!function_exists("ShowSubItems")){
	function ShowSubItems($arItem){
		?>
		<?if($arItem["SELECTED"] && $arItem["CHILD"]):?>
			<?$noMoreSubMenuOnThisDepth = false;?>
			<ul class="submenu">
				<?foreach($arItem["CHILD"] as $arSubItem):?>
					<li class="<?=($arSubItem["SELECTED"] ? "active" : "")?>">
						<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
						<?if(!$noMoreSubMenuOnThisDepth):?>
							<?ShowSubItems($arSubItem);?>
						<?endif;?>
					</li>
					<?
					if(is_array($arSubItem["CHILD"]) && $CScorp!=null)
						$noMoreSubMenuOnThisDepth |= $CScorp->isChildsSelected($arSubItem["CHILD"]);
					?>
				<?endforeach;?>
			</ul>
		<?endif;?>
		<?
	}
}
?>
<?if($arResult):?>
	<aside class="sidebar">
		<ul class="nav nav-list side-menu">
			<?foreach($arResult as $arItem):?>
				<li class="<?=($arItem["SELECTED"] ? "active" : "")?> <?=($arItem["CHILD"] ? "child" : "")?>">
					<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<?ShowSubItems($arItem);?>
				</li>
			<?endforeach;?>
		</ul>
	</aside>
<?endif;?>