<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="footer_inner <?=($arTheme["SHOW_BG_BLOCK"]["VALUE"] == "Y" ? "fill" : "no_fill");?> footer-light ext_view">
	<div class="bottom_wrapper">
		<div class="wrapper_inner">
			<div class="row bottom-middle">
				<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="copy">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/copy.php", Array(), Array(
										"MODE" => "php",
										"NAME" => "Copyright",
									)
								);?>
							</div>							
						</div>
						<div class="col-md-9 col-sm-9">
							<div class="row">
								<div class="col-md-8 col-sm-8">
									<div class="col-md-7 col-sm-7">
										<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
											"ROOT_MENU_TYPE" => "bottom_company",
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
									<div class="col-md-5 col-sm-5 bottomhelp">
										<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
											"ROOT_MENU_TYPE" => "bottomhelp",
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
										<div class="pc"> 
										<div class="payment">
											<div class="title">
												<?=GetMessage('PAYMENT');?>
											</div>
											<div class="img">
												<img src="/bitrix/templates/aspro_next/images/visa.png" alt="visa">
												<img src="/bitrix/templates/aspro_next/images/mastercard.png" alt="mastercard">
											</div>
											<div class="img">
												<img src="/bitrix/templates/aspro_next/images/payonline.png" alt="payonline">
												<img src="/bitrix/templates/aspro_next/images/mir.png" alt="mir">
											</div>
										</div></div>
										<div class="mobi">
										<div class="payment">
											<div class="title">
												<?=GetMessage('PAYMENT');?>
											</div>
											<div class="img">
												<img src="/bitrix/templates/aspro_next/images/visa.png" alt="visa">
												<img src="/bitrix/templates/aspro_next/images/payonline.png" alt="payonline">
												
											</div>
											<div class="img">
												<img src="/bitrix/templates/aspro_next/images/mastercard.png" alt="mastercard">
												<img src="/bitrix/templates/aspro_next/images/mir.png" alt="mir">
											</div>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="social">
										<div class="title"><?=GetMessage("SOCIAL")?></div>
										<?$APPLICATION->IncludeComponent(
											"aspro:social.info.next",
											"custom",
											array(
												"CACHE_TYPE" => "A",
												"CACHE_TIME" => "3600000",
												"CACHE_GROUPS" => "N",
												"COMPONENT_TEMPLATE" => ".default"
											),
											false
										);?>
									</div>
									<div class="help">
										<a href="http://klinikaglaz.wfdemo.ru/help/">
											<img src="/bitrix/templates/aspro_next/images/help.png">
											<span class="title"><?=GetMessage("HELP")?></span>
										</a>
									</div>									
								</div>
							</div>
						</div>
		</div>
	</div>
</div>