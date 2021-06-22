<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?// element name?>
<?if(strlen($arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE'])){?>
   
  <? $now = date("d.m.Y H:i:s");     
     if($now<$arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE']){
     	$showtimer = 'Y';
     } 
     else
     {
     	$showtimer = 'N';
     }
  ?>


<?}?>


<div class="detail sale">
<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
	<h2 class="underline"><?=$arResult['NAME']?></h2>
<?endif;?>


<div class="row">
	<div class="col-md-5">	
		<?// date active from or dates period active?>
		<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
			<div class="period">
				<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
					<span><?=$arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>		
				<?endif;?>
			</div>
		<?endif;?>
	</div>
	<div class="col-md-7">
		<?if(strlen($arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE']) && $showtimer=='Y'):?>	
			До окончания акции осталось:
			<div class="view_sale_block">
				<div class="count_d_block">
					<span class="active_to hidden"><?=$arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE']?></span>				
					<span class="countdown values">					
					</span>
				</div>	
			</div>
		<?endif;?>
	</div>	
</div>



<?// single detail image?>
<?if($arResult['FIELDS']['DETAIL_PICTURE']):?>
	<div class="sale_image"> 
		<?
		$atrTitle = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME']));
		$atrAlt = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME']));
		?>
		<?if($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'LEFT'):?>
			<div class="detailimage image-left col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
		<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'RIGHT'):?>
			<div class="detailimage image-right col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
		<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP'):?>
			<script type="text/javascript">
			$(document).ready(function() {
				$('section.page-top').remove();
				$('<div class="row"><div class="col-md-12"><div class="detailimage image-head"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>"/></div></div></div>').insertBefore('.body > .main > .container > .row');
			});
			</script>
		<?else:?>
			<div class="image-wide"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></div>
		<?endif;?>
	</div>
<?endif;?>

<?// ask question?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
	<div class="ask_a_question">
		<div class="inner">
			<span class="btn btn-default wc vert" data-event="jqm" data-param-id="3" data-name="question"><i class="fa fa-comment "></i><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span>		
		</div>
	</div>
<?endif;?>
<?if(strlen($arResult['FIELDS']['DETAIL_TEXT']) || strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
	<div class="content">
		<?// element preview text?>
		<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
			<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
			<?endif;?>
		<?endif;?>

		<?// element detail text?>
		<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
			<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
				<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
			<?else:?>
				<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
			<?endif;?>
		<?endif;?>
	</div>
<?endif;?>
<div style="clear: both;"></div>

<?
if(is_array($arResult['PROPERTIES']['SORT']['VALUE'])){
	foreach($arResult['PROPERTIES']['SORT']['VALUE'] as $Code){
		switch ($Code) {
			case 'FORM_PRIEM':
				if($arResult['PROPERTIES']['FORM_PRIEM']['VALUE_XML_ID'] == 'YES' && $showtimer=='Y'){	
					$APPLICATION->IncludeComponent("bitrix:form.result.new", "wf_page_akciya", array(
				    "DATA_FINISH"=>$arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE'],
					"PHONE" => $arResult['PROPERTIES']['PHONE']['VALUE'],
					"TITLE" => $arResult['PROPERTIES']['FORM_TITLE']['VALUE'],
					"SERVICES" =>$arResult['SERVICES'],
				    "SEF_MODE" => "",
				    "WEB_FORM_ID" => 20,
				    "LIST_URL" => "",
				    "EDIT_URL" => "",
				    "SUCCESS_URL" => "",
				    "AJAX_MODE" => "Y", // режим AJAX
				    "AJAX_OPTION_SHADOW" => "N", // затемнять область
				    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
				    "AJAX_OPTION_STYLE" => "Y", // подключать стили
				    "AJAX_OPTION_HISTORY" => "N",
				    "CHAIN_ITEM_TEXT" => "",
				    "CHAIN_ITEM_LINK" => "",
				    "IGNORE_CUSTOM_TEMPLATE" => "Y",
				    "USE_EXTENDED_ERRORS" => "Y",
				    "CACHE_TYPE" => "N",
				    "CACHE_TIME" => "",
				    "SEF_FOLDER" => "",
				    "VARIABLE_ALIASES" => array()
				    )
				);
				}
				break;
			
			default:
				if($arResult['PROPERTIES']['TEXT']['VALUE']){?>
					<div class="styled-block no-bg">					
						<?=$arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT']?>
					</div>
				<?}
				break;
		}
	}
} else {
	if($arResult['PROPERTIES']['TEXT']['VALUE']){?>
		<div class="styled-block no-bg">
			<?//P($arResult['PROPERTIES']['TEXT']);?>
			<?=$arResult['PROPERTIES']['TEXT']['~VALUE']['TEXT']?>
		</div>
	<?}?>


	<?if($arResult['PROPERTIES']['FORM_PRIEM']['VALUE_XML_ID'] == 'YES' && $showtimer=='Y'){?>
		<?
		$APPLICATION->IncludeComponent("bitrix:form.result.new", "wf_page_akciya", array(
	    "DATA_FINISH"=>$arResult['DISPLAY_PROPERTIES']['DATA_FINISH']['VALUE'],
		"PHONE" => $arResult['PROPERTIES']['PHONE']['VALUE'],
		"TITLE" => $arResult['PROPERTIES']['FORM_TITLE']['VALUE'],
		"SERVICES" =>$arResult['SERVICES'],
	    "SEF_MODE" => "",
	    "WEB_FORM_ID" => 20,
	    "LIST_URL" => "",
	    "EDIT_URL" => "",
	    "SUCCESS_URL" => "",
	    "AJAX_MODE" => "Y", // режим AJAX
	    "AJAX_OPTION_SHADOW" => "N", // затемнять область
	    "AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента
	    "AJAX_OPTION_STYLE" => "Y", // подключать стили
	    "AJAX_OPTION_HISTORY" => "N",
	    "CHAIN_ITEM_TEXT" => "",
	    "CHAIN_ITEM_LINK" => "",
	    "IGNORE_CUSTOM_TEMPLATE" => "Y",
	    "USE_EXTENDED_ERRORS" => "Y",
	    "CACHE_TYPE" => "N",
	    "CACHE_TIME" => "",
	    "SEF_FOLDER" => "",
	    "VARIABLE_ALIASES" => array()
	    )
	);
	}
}
?>


<?if($arResult['PROPERTIES']['TEXT_BOTTOM']['VALUE']){?>
	<div class="text_remark">
		<?//P($arResult['PROPERTIES']['TEXT']);?>
		<?=$arResult['PROPERTIES']['TEXT_BOTTOM']['~VALUE']['TEXT']?>
	</div>
<?}?>



<?// order?>
<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
	<div class="order-block">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-5 valign">
				<span class="btn btn-default btn-lg" data-event="jqm" data-param-id="2<?//=CCache::$arIBlocks[SITE_ID]['aspro_scorp_form']['aspro_scorp_order_services'][0]?>" data-name="order_services" data-autoload-service="<?=$arResult['NAME']?>"><span><?=(strlen($arParams['S_ORDER_SERVISE']) ? $arParams['S_ORDER_SERVISE'] : GetMessage('S_ORDER_SERVISE'))?></span></span>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-7 valign">
				<div class="text">
					<?$APPLICATION->IncludeComponent(
						'bitrix:main.include',
						'',
						Array(
							'AREA_FILE_SHOW' => 'file',
							'PATH' => SITE_DIR.'include/ask_services.php',
							'EDIT_TEMPLATE' => ''
						)
					);?>
				</div>
			</div>
		</div>
	</div>
<?endif;?>

<?// docs files?>
<?if($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE']):?>
	<div class="wraps">
		<hr />
		<h4 class="underline"><?=(strlen($arParams['T_DOCS']) ? $arParams['T_DOCS'] : GetMessage('T_DOCS'))?></h4>
		<div class="row docs">
			<?foreach($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $docID):?>
				<?$arItem = CScorp::get_file_info($docID);?>
				<div class="col-md-6 <?=$arItem['TYPE']?>">
					<?
					$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
					$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);
					?>
					<a href="<?=$arItem['SRC']?>" target="_blank" title="<?=$fileTitle?>"><?=$fileTitle?></a>
					<?=GetMessage('CT_NAME_SIZE')?>:
					<?=CScorp::filesize_format($arItem['FILE_SIZE']);?>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
</div>

<script>
	$(document).ready(function() {
		initCountdownSecond();
	})
</script>