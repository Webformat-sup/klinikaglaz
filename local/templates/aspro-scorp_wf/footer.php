					<?CScorp::checkRestartBuffer();?>
					<?IncludeTemplateLangFile(__FILE__);?>
					<?if(!$isIndex):?>
								<?if(!$isMenu):?>
									</div><?// class=col-md-12 col-sm-12 col-xs-12 content-md?>
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
									</div>
								<?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
									</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<div class="col-md-3 col-sm-3 col-xs-4 right-menu-md">
										<?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
											"ROOT_MENU_TYPE" => "left",
											"MENU_CACHE_TYPE" => "A",
											"MENU_CACHE_TIME" => "3600",
											"MENU_CACHE_USE_GROUPS" => "Y",
											"MENU_CACHE_GET_VARS" => array(
											),
											"MAX_LEVEL" => "4",
											"CHILD_MENU_TYPE" => "subleft",
											"USE_EXT" => "Y",
											"DELAY" => "N",
											"ALLOW_MULTI_SELECT" => "Y"
											),
											false
										);?>
										<div class="sidearea">
											<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/under_sidebar.php"), false);?>
										</div>
									</div>
								<?endif;?>
						<?if(!$isContacts):?>
							</div><?// class="maxwidth-theme?>
						</div><?// class=row?>						
						</div>
						</div>
						<div class="row hidden-md hidden-sm hidden-lg hidden-xs mobile">
							<div class="maxwidth-theme">
								<hr><div class="col-md-12">
								<h3>Наши преимущества</h3>
									<?$APPLICATION->IncludeComponent(
										"bitrix:news.list",
										"preim",
										array(
											"IBLOCK_TYPE" => "aspro_scorp_content",
											"IBLOCK_ID" => "28",
											"NEWS_COUNT" => "30",
											"SORT_BY1" => "SORT",
											"SORT_ORDER1" => "ASC",
											"SORT_BY2" => "ID",
											"SORT_ORDER2" => "ASC",
											"FILTER_NAME" => "",
											"ORDER_VIEW" => "",
											"FIELD_CODE" => array(
												0 => "",
												1 => "",
											),
											"PROPERTY_CODE" => array(
												0 => "LINK",
												1 => "",
											),
											"CHECK_DATES" => "N",
											"DETAIL_URL" => "",
											"AJAX_MODE" => "N",
											"AJAX_OPTION_JUMP" => "N",
											"AJAX_OPTION_STYLE" => "Y",
											"AJAX_OPTION_HISTORY" => "N",
											"CACHE_TYPE" => "A",
											"CACHE_TIME" => "3600000",
											"CACHE_FILTER" => "Y",
											"CACHE_GROUPS" => "N",
											"PREVIEW_TRUNCATE_LEN" => "",
											"ACTIVE_DATE_FORMAT" => "d.m.Y",
											"SET_TITLE" => "N",
											"SET_STATUS_404" => "N",
											"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
											"ADD_SECTIONS_CHAIN" => "N",
											"HIDE_LINK_WHEN_NO_DETAIL" => "N",
											"PARENT_SECTION" => "",
											"PARENT_SECTION_CODE" => "",
											"INCLUDE_SUBSECTIONS" => "Y",
											"PAGER_TEMPLATE" => ".default",
											"DISPLAY_TOP_PAGER" => "N",
											"DISPLAY_BOTTOM_PAGER" => "N",
											"PAGER_TITLE" => "",
											"PAGER_SHOW_ALWAYS" => "N",
											"PAGER_DESC_NUMBERING" => "N",
											"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
											"PAGER_SHOW_ALL" => "N",
											"AJAX_OPTION_ADDITIONAL" => "",
											"SET_BROWSER_TITLE" => "N",
											"SET_META_KEYWORDS" => "N",
											"SET_META_DESCRIPTION" => "N",
											"SHOW_DETAIL_LINK" => "Y",
											"COMPONENT_TEMPLATE" => "preim",
											"SET_LAST_MODIFIED" => "N",
											"SHOW_SECTIONS" => "N",
											"SHOW_GOODS" => "N",
											"COMPOSITE_FRAME_MODE" => "A",
											"COMPOSITE_FRAME_TYPE" => "AUTO",
											"PAGER_BASE_LINK_ENABLE" => "N",
											"SHOW_404" => "N",
											"MESSAGE_404" => "",
											"VIEW_TYPE" => "list",
											"SHOW_TABS" => "Y",
											"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
											"DISPLAY_DATE" => "Y",
											"DISPLAY_NAME" => "Y",
											"DISPLAY_PICTURE" => "Y",
											"DISPLAY_PREVIEW_TEXT" => "Y"
										),
										false
									); ?>
								</div>
						<?endif;?>
					<?endif;?>
				</div><?// class=container?>

				<?if($isIndex):?>
					<?=$indexEpilog; // buffered from indexblocks.php?>
					<?=$indexPreim; // buffered from indexblocks.php?>
				<?endif;?>

			</div><?// class=main?>
		</div><?// class=body?>

		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="corp">
						<?$APPLICATION->IncludeComponent("bitrix:search.title", "corp", array(
							"NUM_CATEGORIES" => "2",
							"TOP_COUNT" => "3",
							"ORDER" => "date",
							"USE_LANGUAGE_GUESS" => "Y",
							"CHECK_DATES" => "Y",
							"SHOW_OTHERS" => "Y",
							"PAGE" => SITE_DIR."search/",
							"CATEGORY_OTHERS_TITLE" => GetMessage("S_OTHER"),
							"CATEGORY_0_TITLE" => GetMessage("S_CONTENT"),
							"CATEGORY_0" => array(
								0 => "iblock_aspro_scorp_content",
							),
							"CATEGORY_1_TITLE" => GetMessage("S_CATALOG"),
							"CATEGORY_1" => array(
								0 => "iblock_aspro_scorp_catalog",
							),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "title-search",
							"PRICE_CODE" => array(
							),
							"PRICE_VAT_INCLUDE" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "",
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "25",
							"PREVIEW_HEIGHT" => "25"
							),
							false
						);?>
					</div>
					<div class="socials--mobile">
						<?$APPLICATION->IncludeComponent(
							"aspro:social.info.scorp",
							".default",
							array(
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_GROUPS" => "N",
								"COMPONENT_TEMPLATE" => ".default"
							),
							false
						);?>
					</div>
				</div>
				<div class="row"><hr>
					<div class="maxwidth-theme">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="copy">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/copy.php", Array(), Array(
										"MODE" => "php",
										"NAME" => "Copyright",
									)
								);?>
							</div>
							<div id="bx-composite-banner"></div>
						</div>
						<div class="col-md-9 col-sm-9">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="col-md-6 col-sm-6">
										<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_custom", array(
											"ROOT_MENU_TYPE" => "bottom",
											"MENU_CACHE_TYPE" => "A",
											"MENU_CACHE_TIME" => "3600000",
											"MENU_CACHE_USE_GROUPS" => "N",
											"MENU_CACHE_GET_VARS" => array(
											),
											"MAX_LEVEL" => "1",
											"CHILD_MENU_TYPE" => "",
											"USE_EXT" => "Y",
											"DELAY" => "N",
											"ALLOW_MULTI_SELECT" => "Y"
											),
											false
										);?>
									</div>
									<div class="col-md-6 col-sm-6">
										<?$APPLICATION->IncludeComponent(
											"bitrix:menu", 
											"bottom_custom", 
											array(
												"ROOT_MENU_TYPE" => "bottom-right",
												"MENU_CACHE_TYPE" => "A",
												"MENU_CACHE_TIME" => "3600000",
												"MENU_CACHE_USE_GROUPS" => "N",
												"MENU_CACHE_GET_VARS" => array(
												),
												"MAX_LEVEL" => "1",
												"CHILD_MENU_TYPE" => "",
												"USE_EXT" => "Y",
												"DELAY" => "N",
												"ALLOW_MULTI_SELECT" => "Y",
												"COMPONENT_TEMPLATE" => "bottom_custom"
											),
											false
										);?>
										<div class="pc"> 
										<div class="payment">
											<div class="title">
												<?=GetMessage('PAYMENT');?>
											</div>
											<div class="img">
												<img src="/local/templates/aspro-scorp_wf/images/visa.png" alt="visa" style="padding-top: 10px; padding-bottom: 0px">
												<img src="/local/templates/aspro-scorp_wf/images/mastercard.png" alt="mastercard" style="padding-top: 0px; padding-bottom: 0px">
											</div>
											<div class="img">
												<img src="/local/templates/aspro-scorp_wf/images/paykeeper.png" alt="paykeeper">
												<img src="/local/templates/aspro-scorp_wf/images/mir.png" alt="mir" style="padding-top: 4px;">
											</div>
										</div></div>
										<div class="mobi">
										<div class="payment">
											<div class="title">
												<?=GetMessage('PAYMENT');?>
											</div>
											<div class="img">
												<img src="/local/templates/aspro-scorp_wf/images/visa.png" alt="visa">
												<img src="/local/templates/aspro-scorp_wf/images/paykeeper.png" alt="paykeeper">
												
											</div>
											<div class="img">
												<img src="/local/templates/aspro-scorp_wf/images/mastercard.png" alt="mastercard">
												<img src="/local/templates/aspro-scorp_wf/images/mir.png" alt="mir">
											</div>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="social">
										<div class="title"><?=GetMessage("SOCIAL")?></div>
										<?$APPLICATION->IncludeComponent("aspro:social.info.scorp", ".default", Array(
											"CACHE_TYPE" => "A",	// Тип кеширования
												"CACHE_TIME" => "3600000",	// Время кеширования (сек.)
												"CACHE_GROUPS" => "N",	// Учитывать права доступа
												"COMPONENT_TEMPLATE" => ".default"
											),
											false
										);?>
									</div>
									<div><a class="special-version" href="?special_version=Y">Версия для слабовидящих</a></div>
									<div class="help">
										<img src="/local/templates/aspro-scorp_wf/images/help.png" data-event="jqm" data-param-id="3" data-name="question">
										<span class="title"><?=GetMessage("HELP")?></span>
									</div>
									<div class="help mob">
									<div class="phone-number">
												<img src="/local/templates/aspro-scorp_wf/images/phone.png" alt="phone">
												<?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
														"MODE" => "html",
														"NAME" => "Phone",
													)
												);?>
											</div>
									</div>
									
									<div class="footer-onlinepay-btn">
										<a href="/paykeeper/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/button_online_1.svg" /></a>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="maxwidth-theme maxwidth-theme--custom">
						<div class="col-md-12 copy info">
							<?$APPLICATION->IncludeFile(SITE_DIR."include/footer/info.php", Array(), Array(
								"MODE" => "php",
								"NAME" => "Copyright",
								)
							);?>
						</div>
					</div>
				</div>
				<div class="mobi">
				<div class="row">
					<div class="maxwidth-theme maxwidth-theme--custom">
						<div class="socialinf">
							<?$APPLICATION->IncludeFile(SITE_DIR."include/footer/info1.php", Array(), Array(
								"MODE" => "php",
								"NAME" => "Copyright",
								)
							);?>
						</div>
					</div>
				</div></div>
			</div>
		</footer>
		<div class="bx_areas">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/invis-counter.php", Array(), Array(
					"MODE" => "text",
					"NAME" => "Counters place for Yandex.Metrika, Google.Analytics",
				)
			);?>
		</div>
		<?CScorp::SetMeta();?>
		<?//всплывающий баннер ?>
		<?	$curDir = $APPLICATION->GetCurDir();
			if(strpos($curDir,'/special/','/sale/') === false){?>
		<div class="banner modal fade in" id="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="jqmClose close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<picture>
							<source media="(max-width: 768px)" srcset="/local/templates/aspro-scorp_wf/images/ticket_show_file.png">
							<img src="/local/templates/aspro-scorp_wf/images/banner_bg.png" class="img-responsive">
						</picture>
						<div class="row">				       	
							<div class="col-xs-6 col-sm-6 col-md-6 text-right">
								<img class="imgchat" src="/local/templates/aspro-scorp_wf/images/banner-img/chat.png">
								<br />				       		
								<a class="link" href="/sale/proydite-ekspress-diagnostiku-i-uznayte-o-vozmozhnosti-lazernoy-korrektsii-zreniya/">Подробнее</a>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6 text-left">
								<a href="/sale/proydite-ekspress-diagnostiku-i-uznayte-o-vozmozhnosti-lazernoy-korrektsii-zreniya/"><img src="/local/templates/aspro-scorp_wf/images/banner-img/order.png"></a>
								<br />
								<a class="link" href="/company/staff/starunov-eduard-vadimovich/">О враче</a>
							</div>
						</div>
					<div>
				</div>
			</div>
		</div>	
			<?}?>
		<script>
		        (function(w,d,u){
		                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
		                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
		        })(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/site_button/loader_1_8v7204.js');
		</script>

<script>
    window.addEventListener('onBitrixLiveChat', function(event){
        var widget = event.detail.widget;
        widget.setOption('checkSameDomain', false);
    });
</script>




	<script src="<?=SITE_TEMPLATE_PATH?>/data/lightgallery/dist/js/lightgallery.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/data/lightgallery/lib/jquery.mousewheel.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/data/lightgallery/modules/lg-thumbnail.min.js"></script>
	</body>
</html>
