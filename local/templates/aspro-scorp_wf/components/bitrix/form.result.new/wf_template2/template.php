<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<a href="#" class="close jqmClose"><i></i></a>
<div class="form popup form-wrapp">
	<!--noindex-->
	<?=$arResult["FORM_HEADER"]?>

	<div class="title">Оставьте заявку на индивидуальный расчет</div>
	<div class="desc"><?=$arResult["FORM_DESCRIPTION"]?></div>

		<?if(strlen($arResult["FORM_NOTE"])){?>
			<div class="form-body">
				<div class="form_result <?=($arResult["isFormErrors"] == "Y" ? 'error' : 'success')?>" style="padding-bottom: 50px;">
					<?if($arResult["isFormErrors"] == "Y"):?>
						<?=$arResult["FORM_ERRORS_TEXT"]?>
					<?else:?>
						<?$successNoteFile = SITE_DIR."include/form/success_{$arResult["arForm"]["SID"]}.php";?>
						<?if(file_exists($_SERVER["DOCUMENT_ROOT"].$successNoteFile)):?>
						<?$APPLICATION->IncludeFile($successNoteFile, array(), array("MODE" => "html", "NAME" => "Form success note"));?>
						<?else:?>
							<?=GetMessage("FORM_SUCCESS");?>
						<?endif;?>
						<script>
							if(arNextOptions['THEME']['USE_FORMS_GOALS'] !== 'NONE')
							{
								var eventdata = {goal: 'goal_webform_success' + (arNextOptions['THEME']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?=$arResult["arForm"]["ID"]?>')};
								BX.onCustomEvent('onCounterGoals', [eventdata]);
							}
						</script>
					<?endif;?>
				</div>
			</div>
		<?}else{?>
			<?if($arResult["isFormErrors"] == "Y"):?>
				<div class="form_body error"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
			<?endif;?>
			
			<?=bitrix_sessid_post();?>
			<div class="button-container">
				
				<?if(is_array($arResult["QUESTIONS"])):?>
					<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
					<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'){
						?><input type="hidden" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=(isset($presetFields[$FIELD_SID])?$presetFields[$FIELD_SID]:'')?>" data-name="<?=$FIELD_SID?>"/><?
					}else{?>
						<div class="row" data-sid="<?=$FIELD_SID?>">
							<div class="form-group">
								<div class="col-md-12">
									<?switch($arQuestion['STRUCTURE'][0]['FIELD_TYPE'])
									{
										case "textarea":?>
											<?if(!empty($arQuestion["CAPTION"])){?>
												<label for="<?=$FIELD_SID?>"><?=$arQuestion['CAPTION']?>: <?if($arQuestion['REQUIRED']=='Y'){?><span class="required-star">*</span><?}?></label>
											<?}?>
											<div class="input">
												<textarea id="<?=$FIELD_SID?>" rows="3" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" class="form-control <?if($arQuestion['REQUIRED']=='Y'){?>required<?}?>"></textarea>
												<i class="fa fa-pencil"></i>				
											</div>
										<?
										break;
										case "text":
										?>
											<?/*if(!empty($arQuestion["CAPTION"])){?>
												<label for="<?=$FIELD_SID?>"><?=$arQuestion['CAPTION']?>: <?if($arQuestion['REQUIRED']=='Y'){?><span class="required-star">*</span><?}?></label>
											<?}*/?>
											<div class="input">
												<input
												<?if(mb_strtolower($FIELD_SID)=='phone'){?>placeholder="+7 (999) 999-99-99"<?}?>
												<?if(mb_strtolower($FIELD_SID)=='name' || mb_strtolower($FIELD_SID)=='fio'){?>placeholder="Имя"<?}?>
												id="<?=$FIELD_SID?>"  data-sid="<?=$FIELD_SID?>"
												name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" 
												class="form-control  <?if($arQuestion['REQUIRED']=='Y'){?>required<?}?> <?if(mb_strtolower($FIELD_SID)=='phone'){?>phone<?}?> " 
												<?=$arQuestion['STRUCTURE'][0]['FIELD_PARAM']?>									
												<?if($arQuestion['REQUIRED']=='Y'){?>aria-required="true"<?}?>>
												<?/*if(mb_strtolower($FIELD_SID)=='phone'){?><i class="fa fa-phone"></i><?}?>
												<?if(mb_strtolower($FIELD_SID)=='name' || mb_strtolower($FIELD_SID)=='fio'){?><i class="fa fa-user"></i><?}*/?>
											</div>
										<?
										break;
										case "email":
										?>
											<?if(!empty($arQuestion["CAPTION"])){?>
												<label for="<?=$FIELD_SID?>"><?=$arQuestion['CAPTION']?>: <?if($arQuestion['REQUIRED']=='Y'){?><span class="required-star">*</span><?}?></label>
											<?}?>
											<div class="input">
												<input 
												type="<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>" 
												placeholder="info@email.ru"
												id="<?=$FIELD_SID?>" 
												name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" 
												class="form-control <?if($arQuestion['REQUIRED']=='Y'){?>required<?}?> " 
												value="" 
												<?if($arQuestion['REQUIRED']=='Y'){?>aria-required="true"<?}?>>									
											</div>
										<?
										break;
										case "dropdown":
										?>
						                    <div class="select-style medium-select border-color-dark-gray">
						                        <?if(!empty($arQuestion["CAPTION"])){?><label class="" for="form_dropdown_<?=$FIELD_SID?>"><?=$arQuestion["CAPTION"]?><?if($arQuestion["REQUIRED"] == "Y"){?>*<?}?></label><?}?>
												<select data-name="<?=$FIELD_SID?>" <?if($arQuestion["REQUIRED"] == "Y"){?>required<?}?> name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" id="form_dropdown_<?=$FIELD_SID?>"  data-placeholder="<?=$arQuestion["CAPTION"]?><?if($arQuestion["REQUIRED"] == "Y"){?>*<?}?>" class="bg-transparent no-margin-bottom text-medium-gray">
						                            <option label="выбрать"></option>
													<?/*?><option value=""><?=$arQuestion["CAPTION"]?><?if($arQuestion["REQUIRED"] == "Y"){?>*<?}?></option><?*/?>
													<?
						                            foreach($arQuestion['STRUCTURE'] as $option){
														$selected ='';
														if ((isset($presetArr[$preset][$FIELD_SID]) && $presetArr[$preset][$FIELD_SID]==$option["VALUE"]) || ((bool)$option['VALUE'] && $formSelProp ==$option['VALUE'])){
															$selected ='selected="selected"';
														}?>
														<option value="<?=$option["ID"]?>" data-value="<?=$option["VALUE"]?>" <?=$selected?> <?=$option["FIELD_PARAM"]?>><?=$option["MESSAGE"]?></option>
													<?}?>
												</select>
												<?/*?>
						                        <script>
												BX.ready(function($){
						                        var hsh = window.location.hash?window.location.hash:"#other";
						                        if(hsh && $('option[data-value="'+hsh+'"]').length)
						                        {
						                            var optVal = $('option[data-value="'+hsh+'"]').attr('value');
						                            $('select[name="form_dropdown_<?=$FIELD_SID?>"]').val(optVal).trigger("change");
						                        }})</script><?*/?>
											</div>						
										<?
										break;
										case "checkbox":?>
											<?if($FIELD_SID == "PERSONAL_DATA"){?>
												<label class="form-label text-medium-gray"><?=$arQuestion["CAPTION"]?></label>
												<input data-name="<?=$FIELD_SID?>" type="hidden" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>[]" id="<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$arQuestion['STRUCTURE'][0]['ID']?>">
											<?}
											else
											{?>
											<?foreach($arQuestion['STRUCTURE'] as $i=> $el){?>
												<?if(!empty($arQuestion["CAPTION"])){?>
												<label for="<?=$FIELD_SID?>"><?=$arQuestion['CAPTION']?>: <?if($arQuestion['REQUIRED']=='Y'){?><span class="required-star">*</span><?}?></label>
											<?}?>
											<?}?>
											<?}?>
										<?
										break;
										default:
										?>
											<?if(!empty($arQuestion["CAPTION"])){?>
												<label for="<?=$FIELD_SID?>"><?=$arQuestion['CAPTION']?>: <?if($arQuestion['REQUIRED']=='Y'){?><span class="required-star">*</span><?}?></label>
											<?}?>
											<?=$arQuestion["HTML_CODE"]?>
										<?
										break;
									}
									?>
						
									
								</div>
							</div>
						</div>
						<?}?>
					<?endforeach;?>
				<?endif;?>
				<? /* ?>
				<div class="clearboth"></div>
				<?$bHiddenCaptcha = (isset($arParams["HIDDEN_CAPTCHA"]) ? $arParams["HIDDEN_CAPTCHA"] : COption::GetOptionString("aspro.next", "HIDDEN_CAPTCHA", "Y"));?>
				<?if($arResult["isUseCaptcha"] == "Y"):?>
					<div class="form-control captcha-row clearfix">
						<label><span><?=GetMessage("FORM_CAPRCHE_TITLE")?>&nbsp;<span class="star">*</span></span></label>
						<div class="captcha_image">
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" border="0" />
							<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" />
							<div class="captcha_reload"></div>
						</div>
						<div class="captcha_input">
							<input type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
						</div>
					</div>
				<?elseif($bHiddenCaptcha == "Y"):?>
					<textarea name="nspm" style="display:none;"></textarea>
				<?endif;?>
				<div class="clearboth"></div>
				<? */ ?>
				<button class="btn-custom-sign button" type="submit"><?=$arResult["arForm"]["BUTTON"]?></button>
				<input type="hidden" name="web_form_submit" value="<?=$arResult["arForm"]["BUTTON"]?>">	
			</div>
			<? /* ?>
			<div class="form-footer">
				<div class="pull required-fileds">
						<i class="star">*</i> - Обязательные поля				
				</div>
				<div class="licence_block filter_l label_block">
					<input type="checkbox" id="licenses_popup" <?=(COption::GetOptionString("aspro.next", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses_popup" checked required value="Y">
					<label for="licenses_popup">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
					</label>
				</div>

				<div class="pull-right">
						<button class="btn-lg btn btn-default" type="submit"><?=$arResult["arForm"]["BUTTON"]?></button><br>
						<input type="hidden" name="web_form_submit" value="<?=$arResult["arForm"]["BUTTON"]?>">
				</div>
			</div>
			<? */ ?>
		<?}?>
	<?=$arResult["FORM_FOOTER"]?>
	<!--/noindex-->
	<script type="text/javascript">
	$(document).ready(function(){

		$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').validate({
			highlight: function( element ){
				$(element).parent().addClass('error');
			},
			unhighlight: function( element ){
				$(element).parent().removeClass('error');
			},
			submitHandler: function( form ){
				if( $('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').valid() ){
					setTimeout(function() {
						$(form).find('button[type="submit"]').attr("disabled", "disabled");
					}, 300);
					var eventdata = {type: 'form_submit', form: form, form_name: '<?=$arResult["arForm"]["VARNAME"]?>'};
					BX.onCustomEvent('onSubmitForm', [eventdata]);
				}
			},
			errorPlacement: function( error, element ){
				error.insertBefore(element);
			},
			messages:{
		      licenses_popup: {
		        required : BX.message('JS_REQUIRED_LICENSES')
		      }
			}
		});


			var base_mask = arScorpOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
			$('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone').inputmask('mask', {'mask': arScorpOptions['THEME']['PHONE_MASK'] });
			$('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone').blur(function(){
				if( $(this).val() == base_mask || $(this).val() == '' ){
					if( $(this).hasClass('required') ){
						$(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
					}
				}
			});

		$('.jqmClose').on('click', function(e){
			e.preventDefault();
			$(this).closest('.jqmWindow').jqmHide();
		});

		//$('.popup').jqmAddClose('button[name="web_form_reset"]');
	});
	</script>
</div>
<style>
.form-wrapp { margin-top: 30px; margin-bottom: 30px; }
.form-wrapp .title { font-size: 36px; font-weight: 700; line-height: 52px; text-align: center; color: rgba(1, 105, 194, 1); }
.form-wrapp .desc {
	margin: 15px 0; margin-bottom: 25px; font-size: 20px; font-weight: 400; line-height: 29px; text-align: center; }
.form-wrapp .button { background: rgba(175, 202, 11, 1); padding: 20px 80px; display: flex; flex-direction: column; justify-content: center; color: #fff; font-size: 16px; border-radius: 4px; width: max-content; cursor: pointer; border: none; max-height: 64px; margin-left: 40px; }
.form-wrapp .button-container { display: flex; justify-content: center; }
.form-wrapp #PHONE { margin: 0 20px; }
.form-wrapp .button-container > .row { width: 33%; }
.form-wrapp .button-container > .row div,
.form-wrapp .button-container input.form-control { height: 100%; }
.form-wrapp .button-container input { border: 1px solid #e6e6e6; padding: 0 20px; font-size: 16px; }
@media screen and (max-width: 768px){
	.form-wrapp .button-container { flex-direction: column; }
	.form-wrapp .button-container input { padding: 18px 40px; margin-bottom: 15px; width: 100%; }
	.form-wrapp .title { font-size: 24px; line-height: normal; }
	.form-wrapp .desc { font-size: 15px; line-height: 22px; }
	.form-wrapp .button { padding: 18px 40px; width: 100%; text-align: center; margin-left: 0!important; }
	.form-wrapp .button-container > .row { margin: 0!important; width: 100%!important; }
	.form-wrapp .button-container .row .col-md-12 { padding: 0!important; width: 100%!important; }
	.form-wrapp .button-container .row .col-md-12 .input input.form-control { margin: 0!important; }
}
</style>