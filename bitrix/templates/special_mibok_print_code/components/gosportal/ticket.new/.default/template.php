<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

use Bitrix\Main\Localization\Loc;
?>

<? if ($arResult["RESULT"] == "SUCCESS") { ?>
	<div class="alert alert-success alert-success-form mb20">
		<div class="col-10 col-mb-12">
			<p class="alert-success-form-title">
				<b><?=Loc::getMessage("MIBOK_SP_FORM_SUCCESS_TITLE");?></b>
			</p>
			<p><?=Loc::getMessage("MIBOK_SP_FORM_SUCCESS_TEXT", ["#ORG_TITLE#" => $arParams["ORG_TITLE"]]);?></p>
		</div>
	</div>
<? } else { ?>
	<? if (count($arResult["ERRORS"]) > 0) { ?>
		<div class="alert alert-error mb20">
			<div class="col-10 col-mb-12">
				<p>
					<b><?=Loc::getMessage("MIBOK_SP_FORM_ERRORS_TITLE");?></b>
				</p>
				<ul><li><?=implode("</li><li>", $arResult["ERRORS"]);?></li></ul>
			</div>
		</div>
	<? } ?>
	<form method="post" action="" enctype="multipart/form-data">
		<?=Loc::getMessage("MIBOK_SP_FORM_INTRO_TEXT");?>
		<b class="form-headline"><?=Loc::getMessage("MIBOK_SP_FORM_HEADLINE");?><span class="required">*</span>:</b>

		<div class="form-choise custom_field_position">
			<a href="#who" class="active custom_position_form_menu" value="who"><?=Loc::getMessage("MIBOK_SP_LABEL_WHOM");?></a><a class="custom_position_form_menu" href="#where" value="where"><?=Loc::getMessage("MIBOK_SP_LABEL_WHERE");?></a>
			<input type="hidden" name="recipient" value="who">
		</div>


		<div id="who" class="form-choosen" style="display: block">
			<div class="">
				<div class="col-mb-12 col-5 form-label">
					<strong><?=Loc::getMessage("MIBOK_SP_LABEL_OFFICIAL");?><span class="required">*</span>:&nbsp</strong>
				</div>
				<div class="col-mb-12 col-7">
					<select class="input-block custom_field_position custom_select_color" style="background: white !important;" name="official" id="">
						<? foreach ($arResult["EXECUTIVES"] as $executiveId => $executiveName) { ?>
							<option value="<?echo $executiveId?>"<? if ($arResult["VALUES"]["official"] == $executiveId) { ?> selected<? } ?>><?echo $executiveName?></option>
						<? } ?>
					</select>
				</div>
			</div>
			<div class="">
				<div class="col-mb-12 col-5 form-label">
					<strong><?=Loc::getMessage("MIBOK_SP_LABEL_POSITION");?><span class="required">*</span>:&nbsp</strong>
				</div>
				<div class="col-mb-12 col-7">
					<select class="input-block custom_field_position" name="position" id="">
						<? foreach ($arResult["EXECUTIVES_POSITIONS"] as $executiveId => $executivePosition) { ?>
							<option value="<?echo $executiveId?>"<? if ($arResult["VALUES"]["official"] == $executiveId) { ?> selected<? } ?>><?echo $executivePosition?></option>
						<? } ?>
					</select>
				</div>
			</div>
		</div>
		<div id="where" class="form-choosen">
			<div class="">
				<div class="col-mb-12 col-5 form-label">
					<strong><?=Loc::getMessage("MIBOK_SP_LABEL_ORG");?><span class="required">*</span>:&nbsp</strong>
				</div>
				<div class="col-mb-12 col-7 ">
					<input class="input input-block custom_field_position" type="text" name="to_org" value="<?echo $arParams["ORG_TITLE"]?>" disabled/>
				</div>
			</div>
		</div>

		<b class="form-headline"><?=Loc::getMessage("MIBOK_SP_LABEL_HEADLINE");?>:&nbsp</b>
		<div class="">
			<div class="col-mb-12 col-12 form-label ">
				<strong><?=Loc::getMessage("MIBOK_SP_LABEL_LASTNAME");?><span class="required">*</span>:&nbsp</strong>
			</div>
			<div class="col-mb-12 col-7">
				<input class="input input-block custom_field_position" type="text" name="user_lastname" value="<?echo $arResult["VALUES"]["user_lastname"]?>">
			</div>
		</div>
		<div class="">
			<div class="col-mb-12 col-12 form-label">
				<strong><?=Loc::getMessage("MIBOK_SP_LABEL_NAME");?><span class="required">*</span>:&nbsp</strong>
			</div>
			<div class="col-mb-12 col-7">
				<input class="input input-block custom_field_position" type="text" name="user_name" value="<?echo $arResult["VALUES"]["user_name"]?>">
			</div>
		</div>
		<div class=" patronymic">
			<div class="col-mb-12 col-12 form-label ">
				<strong><?=Loc::getMessage("MIBOK_SP_LABEL_SURNAME");?><span class="required">*</span>:&nbsp</strong>
			</div>
			<div class="col-mb-12 col-7">
				<input class="input input-block custom_field_position" type="text" name="user_patronymic" value="<?echo $arResult["VALUES"]["user_patronymic"]?>">
			</div>&nbsp&nbsp
			<div class="col-mb-12 col-4 custom_position_checkbox">
				<input class="checkbox" type="checkbox" value="Y" id="user_no_patronymic" name="user_no_patronymic"<? if ($arResult["VALUES"]["user_no_patronymic"] == "Y") { ?> checked<? } ?>>
				<label for="user_no_patronymic" class="patronymic-label"><span></span> <?=Loc::getMessage("MIBOK_SP_LABEL_NO_SURNAME");?></label>
			</div>
		</div>

		<div class="">
			<div class="col-mb-12 col-12 form-label">
				<strong><?=Loc::getMessage("MIBOK_SP_LABEL_ORG_TITLE");?>:&nbsp</strong>
			</div>
			<div class="col-mb-12 col-12">
				<textarea class="input input-block custom_position_textarea" name="user_organization"><?echo $arResult["VALUES"]["user_organization"]?></textarea>
			</div>
		</div>

		<div class=" custom_string_style">
			<div class="col-mb-12 col-12 form-label">
				<b class="form-headline form-headline_mb0 custom_style_head_line_form"><?=Loc::getMessage("MIBOK_SP_LABEL_EMAIL");?><span class="required">*</span>:&nbsp</b>
			</div>
			<div class="col-mb-12 col-7 custom_style_input_head_line_form">
				<input class="input input-block custom_field_position_mail" type="text" name="user_mail" value="<?echo $arResult["VALUES"]["user_mail"]?>">
			</div>
		</div>
		<div class="">
			<div class="col-mb-12 col-12 form-label">
				<b class="form-headline form-headline_mb0"><?=Loc::getMessage("MIBOK_SP_LABEL_PHONE");?>:&nbsp</b>
			</div>
			<div class="col-mb-12 col-7">
				<input class="input input-block custom_field_position" type="text" placeholder="+7" name="user_phone" value="<?echo $arResult["VALUES"]["user_phone"]?>">
			</div>
		</div>

		<b class="form-headline"><?=Loc::getMessage("MIBOK_SP_LABEL_COAUTHORS");?>:&nbsp</b>
		
		<? for ($i = 1; $i < $arResult["CO_AUTHORS_LIMIT"]; $i++) { ?>
			<div class="added-author<? echo ($i <= $arResult["VISIBLE_CO_AUTHORS"] ? ' show-author' : '') ?>" data-author="<?echo $i?>">
				<hr>
				<div class="">
					<div class="col-mb-12 col-12 form-label">
						<strong><?=Loc::getMessage("MIBOK_SP_LABEL_LASTNAME");?><span class="required">*</span>:&nbsp</strong>
					</div>
					<div class="col-mb-12 col-7">
						<input class="input input-block custom_field_position" type="text" name="author_<?echo $i?>_lastname" value="<?echo $arResult["VALUES"]["author_" . $i . "_lastname"]?>">
					</div>
				</div>
				<div class="">
					<div class="col-mb-12 col-12 form-label">
						<strong><?=Loc::getMessage("MIBOK_SP_LABEL_NAME");?><span class="required">*</span>:&nbsp</strong>
					</div>
					<div class="col-mb-12 col-7">
						<input class="input input-block custom_field_position" type="text" name="author_<?echo $i?>_name" value="<?echo $arResult["VALUES"]["author_" . $i . "_name"]?>">
					</div>
				</div>
				<div class=" patronymic">
					<div class="col-mb-12 col-12 form-label">
						<strong><?=Loc::getMessage("MIBOK_SP_LABEL_SURNAME");?><span class="required">*</span>:&nbsp</strong>
					</div>
					<div class="col-mb-12 col-7">
						<input class="input input-block custom_field_position" type="text" name="author_<?echo $i?>_patronymic" value="<?echo $arResult["VALUES"]["author_" . $i . "_patronymic"]?>">
					</div>&nbsp&nbsp
					<div class="col-mb-12 col-4 custom_position_checkbox">&nbsp&nbsp
						<input class="checkbox" type="checkbox" value="Y" id="author_<?echo $i?>_no_patronymic" name="author_<?echo $i?>_no_patronymic"<? if ($arResult["VALUES"]["author_" . $i . "_no_patronymic"] == "Y") { ?> checked<? } ?>>
						<label for="author_<?echo $i?>_no_patronymic" class="patronymic-label"><span></span> <?=Loc::getMessage("MIBOK_SP_LABEL_NO_SURNAME");?></label>

					</div>
				</div>

				<div class="">
					<div class="col-mb-12 col-12 form-label">
						<strong><?=Loc::getMessage("MIBOK_SP_LABEL_ORG_TITLE");?>:&nbsp</strong>
					</div>
					<div class="col-mb-12 col-12">
						<textarea class="input input-block custom_position_textarea" name="author_<?echo $i?>_organization"><?echo $arResult["VALUES"]["author_" . $i . "_organization"]?></textarea>
					</div>
				</div>
				<div class="custom_string_style">
					<div class="col-mb-12 col-12 form-label custom_style_head_line_form">
						<strong><?=Loc::getMessage("MIBOK_SP_LABEL_EMAIL");?><span class="required">*</span>:&nbsp</strong>
					</div>
					<div class="col-mb-12 col-7">
						<input class="input input-block custom_field_position_mail" type="text" name="author_<?echo $i?>_mail" value="<?echo $arResult["VALUES"]["author_" . $i . "_mail"]?>">
					</div>
				</div>

				<a class="form-del-author" href=""><?=Loc::getMessage("MIBOK_SP_LABEL_COAUTHOR_DELETE");?></a>
			</div>
		<? } ?>

		<hr class="btn-add-line">
		<button class="btn form-add-author btn-default no-margin"><?=Loc::getMessage("MIBOK_SP_LABEL_COAUTHOR_ADD");?></button>
		<hr>


		<b class="form-headline"><?=Loc::getMessage("MIBOK_SP_LABEL_TEXT");?><span class="required">*</span>:&nbsp</b>
		<div class="small-text form-more-text"><?=Loc::getMessage("MIBOK_SP_FORM_INTRO_TEXT2");?></div>

		<div class="col-mb-12 col-12">
			<textarea name="text" class="input input-block form-textarea disablecopypaste custom_position_textarea" rows="5" placeholder="<?=Loc::getMessage("MIBOK_SP_PLACEHOLDER_TEXT");?>"><?echo $arResult["VALUES"]["text"]?></textarea>
		</div>
		<div class="form-more-text small-text"><?=Loc::getMessage("MIBOK_SP_FORM_INTRO_TEXT3");?></div>
		<span class="hide more-text" value="<?=Loc::getMessage("MIBOK_SP_FORM_SHOW_TEXT");?>"></span>
		<span class="hide less-text" value="<?=Loc::getMessage("MIBOK_SP_FORM_HIDE_TEXT");?>"></span>


		<b class="form-headline"><?=Loc::getMessage("MIBOK_SP_FORM_INTRO_FILES");?></b>

		<div class="file-block">
			<div class="file-line">
				<span class="filename" ></span>
				<p class="delete-upload del"></p>
			</div>
			<div class="form-file-upload">
				<label>
					<input type="file" name="file[]" data-number="1" multiple="multiple" >
					<span id="load"><?=Loc::getMessage("MIBOK_SP_LABEL_FILES");?></span>
				</label>
			</div>
		</div>



		<div class="small-text"><?=Loc::getMessage("MIBOK_SP_FORM_INTRO_FILES2");?></div>
		<hr>
		
		<?if (class_exists('Bitrix\Main\UserConsent\Agreement') && !empty($arParams['USER_CONSENT_ID'])) {?>
			<div class="col col-12">
				<input type="hidden" name="web_form_submit" value="Y">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.userconsent.request",
					"",
					Array(
						"AUTO_SAVE" => $arParams['USER_CONSENT'],
						"ID" => $arParams['USER_CONSENT_ID'],
						"IS_CHECKED" => $arParams['USER_CONSENT_IS_CHECKED'],
						"IS_LOADED" => $arParams['USER_CONSENT_IS_LOADED'],
						"REPLACE" => array(
							'button_caption' => Loc::getMessage("MIBOK_SP_BUTTON_SEND"),
							'fields' => array(
								Loc::getMessage("MIBOK_SP_LABEL_LASTNAME"),
								Loc::getMessage("MIBOK_SP_LABEL_NAME"),
								Loc::getMessage("MIBOK_SP_LABEL_SURNAME"),
								Loc::getMessage("MIBOK_SP_LABEL_EMAIL"),
								Loc::getMessage("MIBOK_SP_LABEL_PHONE"),
							)
						),
					)
				);?>
			</div>
		<?}?>

		<div class=" col-<? if ($USER->IsAuthorized()) { ?>12<? } else { ?>6<? } ?> col-mb-12 form-act-btn ">
			<button class="btn btn-default no-margin" type="submit" name="action" value="send"><div class="custom_position_button"><?=Loc::getMessage("MIBOK_SP_BUTTON_SEND");?></div></button>
		</div>
		<? if (!$USER->IsAuthorized()) { ?>
			<div class=" col-6 col-mb-12 form-act-btn ">
				<button class="btn btn-empty-blue" name="action" type="submit" value="reg"><?=Loc::getMessage("MIBOK_SP_BUTTON_REG");?></button>
			</div>
		<? } ?>
	</form>
<? } ?>
