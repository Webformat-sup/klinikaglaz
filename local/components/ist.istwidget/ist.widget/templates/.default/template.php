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
$this->setFrameMode(true);
?>
<?if($arResult['SECTIONS']){?>
	<div class="iquiz">
		<div class="iquiz__block">
			<div class="iquiz__header"><?=$arResult['NAME'];?></div>
			<div class="iquiz__steps">
				<?foreach($arResult['SECTIONS'] as $skey=>$arSection){?>
					<div class="iquiz__step"<?if($skey==0){?> style="display:block;"<?}?>>
						<?if($arSection['UF_TITLE']){?>
							<div class="iquiz__title"><?=$arSection['~UF_TITLE'];?></div>
						<?}?>
						<?if($arSection['UF_SUBTITLE']){?>
							<div class="iquiz__text"><?=$arSection['~UF_SUBTITLE'];?></div>
						<?}?>
						<?if($arSection['ITEMS']){?>
							<div class="iquiz__variants">
								<?foreach($arSection['ITEMS'] as $arItem){?>
									<div class="iquiz__variant">
										<div class="iquiz__variant__content" data-iquiz-val="<?=$arItem['NAME'];?>" data-iquiz-id="ist_field_<?=$arSection['ID'];?>"><span><?=$arItem['NAME'];?></span></div>
									</div>
								<?}?>
							</div>
						<?}?>
					</div>
				<?}?>
				<div class="iquiz__step">
					<div class="iquiz__title"><?=($arResult['OPTIONS']['final_title'] ? $arResult['OPTIONS']['final_title'] : GetMessage('ISTWIDGET_FORM_FINAL_TITLE'));?></div>
					<div class="iquiz__text"><?=($arResult['OPTIONS']['final_subtitle'] ? $arResult['OPTIONS']['final_subtitle'] : GetMessage('ISTWIDGET_FORM_FINAL_SUBTITLE'));?></div>
					<div class="iquiz__form">
						<form class="form">
							<div class="istform__body">
								<div class="istform__row">
									<div class="istform__label"><?=GetMessage('ISTWIDGET_FORM_FIELD_LABEL_NAME');?> *</div>
									<input class="istform__val req" type="text" name="name" data-send-title="<?=GetMessage('ISTWIDGET_FORM_FIELD_SEND_NAME');?>">
									<div class="istform__error"><?=GetMessage('ISTWIDGET_FORM_FIELD_REQUIRED');?></div>
								</div>
								<div class="istform__row">
									<div class="istform__label"><?=GetMessage('ISTWIDGET_FORM_FIELD_LABEL_PHONE');?> *</div>
									<input class="istform__val req ist_phonemask" type="tel" name="phone" data-send-title="<?=GetMessage('ISTWIDGET_FORM_FIELD_SEND_PHONE');?>">
									<div class="istform__error"><?=GetMessage('ISTWIDGET_FORM_FIELD_REQUIRED');?></div>
								</div>
								<div class="istform__row -policy">
									<input type="checkbox"  id="form-popup-callback" class="istform__val istform__checkbox policy__checkbox">
									<label class="-checkbox-label-row" for="form-popup-callback"><span><?=GetMessage('ISTWIDGET_FORM_POLICY');?>*</span></label>
									<div class="istform__error"><?=GetMessage('ISTWIDGET_FORM_FIELD_REQUIRED');?></div>
								</div>
								<div class="istform__row -submit">
									<input type="button" class="istform__button istform__send" value="<?=GetMessage('ISTWIDGET_FORM_BUTTON');?>" name="submit">
									<input type="text" style="display:none;" value="<?=GetMessage('ISTWIDGET_FORM_FIELD_FORM_NAME');?>" name="formname" data-send-title="<?=GetMessage('ISTWIDGET_FORM_FIELD_FORM_SEND');?>">
									<input type="text" style="display:none;" value="" name="saveus">
									<?foreach($arResult['SECTIONS'] as $skey=>$arSection){?>
										<input class="istform__val" type="text" name="ist_field_<?=$arSection['ID'];?>" data-send-title="<?=($arSection['UF_FORMTITLE'] ? $arSection['UF_FORMTITLE'] : $arSection['NAME']);?>" style="display:none;">
									<?}?>
								</div>
							</div>
							<div class="istform__result">
								<hr><br>
								<?=($arResult['OPTIONS']['form_result'] ? $arResult['OPTIONS']['form_result'] : GetMessage('ISTWIDGET_FORM_RESULT'));?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?}?>