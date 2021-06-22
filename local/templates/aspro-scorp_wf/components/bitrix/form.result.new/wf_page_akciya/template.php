<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?//POST_FORM_ACTION_URI="/test/";?>
<?$frame = $this->createFrame()->begin('')?>
<?//P($arResult["FORM_HEADER"])?>


				<div class="form inline contacts akciya <?=$arResult["arForm"]["SID"]?>">					
					<div class="row">						
						<?if(strlen($arResult["FORM_NOTE"])){?>
							<div class="col-md-12 col-sm-12">
								<h4>Записаться на прием по акции</h4>	
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
									<?endif;?>
								</div>
							</div>
						<?}else{?>
							<?if($arResult["isFormErrors"] == "Y"):?>
								<div class="form_body error"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
							<?endif;?>
							<?=$arResult["FORM_HEADER"]?>
							<?=bitrix_sessid_post();?>
							<div class="form_body col-md-12 col-sm-12" >
								<?if(is_array($arResult["QUESTIONS"])):?>
									<div class="row">	
										<div class="col-md-6 col-sm-6">
										<?if(!empty($arParams['TITLE'])){?>	
											<h4><?=$arParams['TITLE']?></h4>
										<?} else{?>
											<h4>Записаться на прием по акции</h4>
										<?}?>	
										<div class="row">
										<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
										<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea'){continue;}?>
											<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'){
												if($FIELD_SID=="URL_PAGE"){
													?><input type="hidden" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=$APPLICATION->GetCurPage();?>" data-name="<?=$FIELD_SID?>"/><?
												}else{
													?><input type="hidden" name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>" value="<?=(isset($presetFields[$FIELD_SID])?$presetFields[$FIELD_SID]:'')?>" data-name="<?=$FIELD_SID?>"/><?
												}
											}else{?>
											        	<?$col="12"?>
											        	<?if($FIELD_SID=="DATE" || $FIELD_SID=="TIME"){?>
											        		<?$col="6";?>
											        	<?}?>	
											        	<?if($FIELD_SID=="COUPON"){?>
															<div style="clear: both"></div>
													    <?}?>									
													
														<div class="form-group col-md-<?=$col?>" data-sid="<?=$FIELD_SID?>">
																<?switch($arQuestion['STRUCTURE'][0]['FIELD_TYPE'])
																{
																	case "text":
																	?>

																		<?if($FIELD_SID=="NEED_PRODUCT"){?>
																			<?if($arParams['SERVICES']){?>
																			<div class="input">						                        
																				<select class="form-control" data-name="<?=$FIELD_SID?>" <?if($arQuestion["REQUIRED"] == "Y"){?>required<?}?> name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" id="form_dropdown_<?=$FIELD_SID?>"  data-placeholder="<?=$arQuestion["CAPTION"]?><?if($arQuestion["REQUIRED"] == "Y"){?>*<?}?>" class="bg-transparent no-margin-bottom text-medium-gray">
														                            <option label="Выберите услугу" selected hidden disabled></option>		
																					<?
														                            foreach($arParams['SERVICES'] as $key=>$option){?>
																						<option value="<?=$option?>" data-value="<?=$option?>">  <?=$option?></option>
																					<?}?>
																				</select>
																			</div>
																		<?}?>	
																		<?} else {?>
																		<div class="input">
																			<input 											
																			id="<?=$FIELD_SID?>" 
																			name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']?>" 
																			class="form-control  <?if($arQuestion['REQUIRED']=='Y'){?>required<?}?> <?if(mb_strtolower($FIELD_SID)=='phone'){?>phone<?}?> " 
																			<?=$arQuestion['STRUCTURE'][0]['FIELD_PARAM']?>							
																			<?if($arQuestion['REQUIRED']=='Y'){?>aria-required="true"<?}?>>
																		</div>
																		<?}?>
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
																			<?/*<i class="fa fa-user"></i>*/?>										
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
													
												
											<?}?>
										<?endforeach;?>
										</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<?if($arParams['DATA_FINISH']){?>
											<div class="timefinish">
												До окончания акции осталось:
												<div class="view_sale_block">
													<div class="count_d_block">
														<span class="active_to hidden"><?=$arParams['DATA_FINISH']?></span>
														<?/*div class="title"><?=GetMessage("UNTIL_AKC");?></div*/?>
														<span class="countdown values">														
														</span>
													</div>	
												</div>
											</div>
											<?}?>
											<?//кнопка?>
											<div>
												<button class="btn-lg btn btn-default red100" type="submit"><?=$arResult["arForm"]["BUTTON"]?></button>
												<input type="hidden" name="web_form_submit" value="<?=$arResult["arForm"]["BUTTON"]?>">			
											</div>
											<input type="checkbox" style="display: none;" id="licenses_inline" <?=(COption::GetOptionString("aspro.next", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses_popup" checked required value="Y">
											<label for="licenses_inline">
												<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text2.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
											</label>
											<?if($arParams['PHONE']){?>
											<div class="phone">
												<i class="fa fa-phone"></i><?=$arParams['PHONE']?>
											</div>
											<?}?>

											
										</div>
									</div>
								<?endif;?>
								
								<?/*$bHiddenCaptcha = (isset($arParams["HIDDEN_CAPTCHA"]) ? $arParams["HIDDEN_CAPTCHA"] : COption::GetOptionString("aspro.next", "HIDDEN_CAPTCHA", "Y"));?>
								<?if($arResult["isUseCaptcha"] == "Y"):?>
									<div class="row captcha-row">
										<div class="col-md-7 col-sm-7 col-xs-7">
											<div class="form-group">
												<label  for="captcha_word"><span><?=GetMessage("FORM_CAPRCHE_TITLE")?>&nbsp;<span class="required-star">*</span></span></label>
												<div>
													<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" border="0" class="captcha_img" />
													<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" />
													<span class="refresh"><a href="javascript:;" rel="nofollow">Поменять картинку</a></span>
												</div>
											</div>
										</div>
										<div class="col-md-5 col-sm-5 col-xs-5">
											<div class="form-group" style="margin-top:25px;">
												<div class="input ">
													<input type="text" class="form-control captcha required" name="captcha_word" size="30" maxlength="50" value="" required />
												</div>
											</div>
										</div>
									</div>

								<?elseif($bHiddenCaptcha == "Y"):?>
									<textarea name="nspm" style="display:none;"></textarea>
								<?endif;?>
								<div class="clearboth"></div*/?>
							</div>
						<?}?>
						</div>
					<?=$arResult["FORM_FOOTER"]?>
					<script type="text/javascript">
	$(document).ready(function(){
		//заменяем action у формы
		$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').attr('action', '/include/form_akciya.php')

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
			/*messages:{
		      licenses_popup: {
		        required : BX.message('JS_REQUIRED_LICENSES')
		      }
			}*/
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

		
	});
	</script>
				</div>

	

	<?$frame->end()?>