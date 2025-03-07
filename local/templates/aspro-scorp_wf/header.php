<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<!DOCTYPE html>
<html class="<?=($_SESSION['SESS_INCLUDE_AREAS'] ? 'bx_editmode ' : '')?><?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0' ) ? 'ie ie7' : ''?> <?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0' ) ? 'ie ie8' : ''?> <?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0' ) ? 'ie ie9' : ''?>">
	<head>
		<?global $APPLICATION;?>
		<?IncludeTemplateLangFile(__FILE__);?>

		<?php $stringCanonical = stringHeadCanonical(); ?>
		<?php $APPLICATION->AddHeadString($stringCanonical, true); ?>

		<title><?$APPLICATION->ShowTitle()?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <meta name="facebook-domain-verification" content="ipjnk5aqwfeobiv2wv5x9al1hy9lv9" /> -->
		<meta name="yandex-verification" content="35e7310e1899d525" />
		<meta name="google-site-verification" content="5HdL2zYKlGmJLBsT2oQTTx99svZtxQcpKflVtlapAEA" />
		<link href='<?=CMain::IsHTTPS() ? 'https' : 'http'?>://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
		<link href='<?=CMain::IsHTTPS() ? 'https' : 'http'?>://fonts.googleapis.com/css?family=Ubuntu:400,700italic,700,500italic,500,400italic,300,300italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
		<link href='<?=CMain::IsHTTPS() ? 'https' : 'http'?>://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/fonts/font-awesome/css/font-awesome.min.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/vendor/flexslider/flexslider.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.fancybox.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/theme-elements.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jqModal.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/theme-responsive.css');?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/swiper-bundle.min.css');?>
		<?$APPLICATION->ShowHead()?>
		<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/webformat.css');?>
		<?CJSCore::Init(array('jquery', 'fx', 'popup'));?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/swiper-bundle.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.actual.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/blink.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.easing.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.appear.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.cookie.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/bootstrap.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/flexslider/jquery.flexslider-min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.validate.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.uniform.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jqModal.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.inputmask.bundle.min.js', true)?>		
		<?$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject( $MESS, false ).')</script>', true);?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/detectmobilebrowser.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/readmore.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/general.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.plugin.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.countdown.min.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.countdown-ru.js');?>
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/custom.js');?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-161721051-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-161721051-1');
			setTimeout(function(){gtag('event', location.pathname, {'event_category': 'Новый посетитель'});}, 15000);
		</script>
		<?/*?>
		<script src='https://salebot.pro/js/salebot.js' charset='utf-8'></script>
		<script>
		SaleBotPro.init({
			onlineChatId: '1351'
		});
		</script>
		<?*/?>
	</head>
	<body>
		<?CAjax::Init();?>
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<?if(!CModule::IncludeModule("aspro.scorp")):?>
			<?$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_SCORP_TITLE"));?>
			<div class="include_module_error">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/error.jpg" title=":-(">
				<p><?=GetMessage("ERROR_INCLUDE_MODULE_SCORP_TEXT")?></p>
			</div>
			<?die();?>
		<?endif;?>
		<? $CScorp = new CScorp; ?>
		<?$CScorp->SetJSOptions();?>
		<?global $arSite, $arTheme, $isMenu, $isIndex, $is404;?>
		<?$is404 = defined("ERROR_404") && ERROR_404 === "Y"?>
		<?$arSite = CSite::GetByID(SITE_ID)->Fetch();?>
		<?$isMenu = ($APPLICATION->GetProperty('MENU') !== "N" ? true : false);?>
		<?$arTheme = $APPLICATION->IncludeComponent("aspro:theme.scorp", "", array(), false);?>
		<?$isForm = CSite::inDir(SITE_DIR.'form/');?>
		<?$isContacts = CSite::inDir(SITE_DIR.'contacts/index.php');?>
		<?if($isIndex = CSite::inDir(SITE_DIR."index.php")):?>
			<?$sTeasersIndexTemplate = ($arTheme["TEASERS_INDEX"]["VALUE"] == 'PICTURES' ? 'front-teasers-pictures' : ($arTheme["TEASERS_INDEX"]["VALUE"] == 'ICONS' ? 'front-teasers-icons' : false));?>
			<?$bCatalogIndex = $arTheme["CATALOG_INDEX"]["VALUE"] == 'Y';?>
			<?$bCatalogFavoritesIndex = $arTheme["CATALOG_FAVORITES_INDEX"]["VALUE"] == 'Y';?>

			<?php // размещаем микроразметку Json LD на главной странице 
			$path = $_SERVER['DOCUMENT_ROOT'] . '/include/description_jsonld_main.php';
			if(\Bitrix\Main\IO\File::isFileExists($path))
			{
				$stringValue = \Bitrix\Main\IO\File::getFileContents($path);
				$mictoFormatJson = stringMicromarkingJson($_SERVER['SERVER_NAME'], $stringValue);
				$APPLICATION->AddHeadString("<script type=\"application/ld+json\">" . $mictoFormatJson . "</script>");
			}
			?>

		<?endif;?>
		<?/*<!--- фон -->
		<span class="bg_image_site opacity1 opacity" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/bg.jpg);"></span>
		<!--  -->*/?>
		
		<?/*-------верхнее меню для мобилки-------*/?>
		<script>
			window.addEventListener('b24:form:init', (event) => {
				let form = event.detail.object;
				let yaCID;
				ym(30339732, 'getClientID', function (clientID) {
					yaCID = clientID;
				});
				form.setProperty("clientID", yaCID);
			});
		</script>
			<div id="drop-menu-mobile" class=" ">
				<div class="mobile-drop-wrap ">
					<ul>
						<li class="mobile-drop-close"><a href="#" class="jqmClose">×</a></li>
						
						<li>
							<script data-b24-form="click/8/07efvh" data-skip-moving="true">
									(function(w,d,u){
											var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
											var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
									})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_8_07efvh.js');
							</script> 
							<a href="javascript:;">Обратный звонок</a>
							<!-- <a href="" data-event="jqm" data-param-id="6" data-name="callback">Обратный звонок</a> -->
						</li>
						
						<li>
							<script data-b24-form="click/7/y2aq9g" data-skip-moving="true">
									(function(w,d,u){
											var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
											var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
									})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_7_y2aq9g.js');
							</script> 
							<a href="javascript:;">Записаться на прием</a>
						</li>
						<li>
							<script data-b24-form="click/9/cw20wf" data-skip-moving="true">
									(function(w,d,u){
											var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
											var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
									})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_9_cw20wf.js');
									// })(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_8_07efvh.js');
							</script> 
							<a href="javascript:;">Задать вопрос</a>
						</li>
					</ul>
				</div>
			</div>
		<?/*------верхнее меню для мобилки--------*/?>
		<div class="body <?=($isIndex ? 'index' : '')?>">
			
			<a href="https://shop.klinikaglaz.ru/auth/<?/*=($USER->IsAuthorized() ? '/presonal/' : '/auth/')*/?>" rel="nofollow">
				<div class="personal_cabinet">
					<svg xmlns="https://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17">
						<defs>
							<style>
								.loccls-1 {
									fill: #222;
									fill-rule: evenodd;
								}
							</style>
						</defs>
						<path class="loccls-1" d="M14,17H2a2,2,0,0,1-2-2V8A2,2,0,0,1,2,6H3V4A4,4,0,0,1,7,0H9a4,4,0,0,1,4,4V6h1a2,2,0,0,1,2,2v7A2,2,0,0,1,14,17ZM11,4A2,2,0,0,0,9,2H7A2,2,0,0,0,5,4V6h6V4Zm3,4H2v7H14V8ZM8,9a1,1,0,0,1,1,1v2a1,1,0,0,1-2,0V10A1,1,0,0,1,8,9Z"></path>
					</svg>
				</div>
			</a>
			<div class="body_media"></div>
			<header class="topmenu-<?=($arTheme["TOP_MENU"]["VALUE"])?><?=($arTheme["TOP_MENU_FIXED"]["VALUE"] == "Y" ? ' canfixed' : '')?>">
				<div class="logo_and_menu-row custom">
					<div class="logo-row row">
						<div class="maxwidth-theme">
							<div class="col-md-3 col-sm-3">
								<div class="logo<?=($arTheme["COLORED_LOGO"]["VALUE"] !== "Y" ? '' : ' colored')?> hidden-xs">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/logo.php", array(), array(
											"MODE" => "php",
											"NAME" => "Logo",
										)
									);?>
								</div>
								<div class="logo mobile<?=($arTheme["COLORED_LOGO"]["VALUE"] !== "Y" ? '' : ' colored')?>">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/logo_mobile.php", array(), array(
											"MODE" => "php",
											"NAME" => "Logo",
										)
									);?>
								</div>
								<div class="license hidden-xs">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/license.php", array(), array(
											"MODE" => "php",
											"NAME" => "license",
										)
									);?> 
								</div>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="headerTitle">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/header-title.php", array(), array(
											"MODE" => "html",
											"NAME" => "Text in title",
										)
									);?>
								</div>
								<div class="top-description  hidden-xs col-md-6" >
									<img src="/local/templates/aspro-scorp_wf/images/location.png">
									<div class="description">
										<?$APPLICATION->IncludeFile(SITE_DIR."include/header-text.php", array(), array(
											"MODE" => "html",
											"NAME" => "Text in title",
											)
										);?>
									</div>
								</div>
								<div class="top-callback col-md-6 col-sm-6">
									<div class="callback desctop col-md-12">
										<div class="phone pull-right hidden-xs">
											<div class="phone-number" itemprop="telephone">
												<img src="/local/templates/aspro-scorp_wf/images/phone.png" alt="phone">
												<div><?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
														"MODE" => "html",
														"NAME" => "Phone",
													)
												);?></div>
											</div>
										</div>
										
										<div class="phone pull-right callbackTitle">
											<script data-b24-form="click/8/07efvh" data-skip-moving="true">
													(function(w,d,u){
															var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
															var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
													})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_8_07efvh.js');
											</script> 
											<span href="javascript:;"><?=GetMessage("S_CALLBACK")?></span>
										</div>
										
									</div>
									<style type="text/css">
										@media(min-width: 768px){
											#drop-menu-mobile,.mobile-ver{display:none;}
										}
										@media(max-width: 767px){
											.callback.desctop.col-md-12 {
										    	display: none;
											}
											.mobile-ver{
												display: block;
												position: absolute;
												top: -45px;
												padding-left: 122px;
											}
											.mobile-ver .mobile-phone-callback,
											.mobile-ver .mobile-form-callback,
											.mobile-ver .mobile-contacts-callback {
											    width: 30px;
												height: 30px;
												float: left;
												margin-left: 10px;
											}
											.mobile-ver .mobile-phone-callback div,
											.mobile-ver .mobile-form-callback,
											.mobile-ver .mobile-contacts-callback div
											 {
											    width: 30px;
											    height: 30px;
											    color: #fff;
											    background-size: contain;
											}
											.mobile-ver .mobile-phone-callback div {
											    background: url(/local/templates/aspro-scorp_wf/images/mobile-header/phone-s.svg) no-repeat center center;
											}
											.mobile-ver .mobile-form-callback{
											    background: url(/local/templates/aspro-scorp_wf/images/mobile-header/zapis_na_priem-s.svg) no-repeat center center;
											}
											.mobile-ver .mobile-contacts-callback div {
											    background: url(/local/templates/aspro-scorp_wf/images/mobile-header/work_hours-s.svg) no-repeat center center;
											}
											.mobile-ver .mobile-phone-callback div a, 
											.mobile-ver .mobile-contacts-callback div a {
												display: block;
												width: 30px;
												height: 30px;
												font-size: 0.7px;
												opacity: 0;
											}
											#drop-menu-mobile{
												display: none;
												position: fixed;
												top: 0;
												left: 0;
												height: 100vh;
												width: 100vw;
											}
											#drop-menu-mobile .mobile-drop-wrap {
												margin: 0 auto;
												display: table-cell;
												vertical-align: middle;
												height: 100vh;
												width: 100vw;
											}
											#drop-menu-mobile .mobile-drop-wrap ul {
												position: relative;
											    padding: 50px 20px;
											    margin: 0 auto;
											    max-width: 240px;
											    background-color: #fff;
											    -webkit-box-shadow: 0px 0px 39px -12px rgba(0,0,0,0.75);
											    -moz-box-shadow: 0px 0px 39px -12px rgba(0,0,0,0.75);
											    box-shadow: 0px 0px 39px -12px rgb(0, 0, 0);
											}
											li.mobile-drop-close {
											    position: absolute;
											    color: black;
											    list-style: none;
											    top: 0;
											    right: 0;
											    padding: 10px;
											    line-height: 10px;
											}
											#drop-menu-mobile a {
											    padding: 9px 0;
											    margin: 0 10px;
											    line-height: 24px;
											    position: relative;
											    border-radius: 0;
											    clear: both;
											    float: none;
											    display: block;
											    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
											    white-space: normal;
											    color: #444444;
											    font-size: 13pt;
											    font-weight: 500;
											}
											#drop-menu-mobile ul li{
												list-style: none;
											}	
											a.jqmClose {
											    font-size: 22pt!important;
											}

										}
									</style>
									<script type="text/javascript">
										$(document).ready(function(){
											$('#drop-menu-mobile').jqm(
												{
													trigger: '.mobile-form-callback'
												});
										});
									</script>

									<div class="mobile-ver">
										<div class="mobile-phone-callback">
												<div><?$APPLICATION->IncludeFile(SITE_DIR."include/site-phone.php", array(), array(
														"MODE" => "html",
														"NAME" => "Phone",
													)
												);?></div>
											</div>
										<div class="mobile-form-callback">
											<div></div>											
										</div>
										<div class="mobile-contacts-callback">
											<div><a href="/company/contacts/">&nbsp;</a></div>
										</div>
									</div>

									<button class="btn btn-responsive-nav visible-xs" data-toggle="collapse" data-target=".nav-main-collapse">
										<i class="fa fa-bars"></i>
									</button>
									<button class="btn btn-responsive-nav visible-xs" data-toggle="collapse" data-target=".nav-main-collapse">
										<i class="fa fa-bars"></i>
									</button>
								</div>
							</div>
							<div class="col-md-2 col-sm-2 socialNetwork">
								<?$tLink = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_TELEGRAM_LINK"); ?>
								<? if($tLink) { ?>
									<div class="telegram">
										<a href="<?=$tLink?>" target="_blank" rel="nofollow" title="Написать в telegram">
											<img src="<?= SITE_TEMPLATE_PATH."/images/telegram.svg" ?>" alt="telegram" />
										</a>
									</div>
								<? } ?>
								<div class="whatsApp">
									<a href="https://api.whatsapp.com/send?phone=79221588731" rel="nofollow"><img src="/local/templates/aspro-scorp_wf/images/whatsapp.png"></a>
								</div>
								<div class="viber">
									<a href="viber://chat?number=79221588731" rel="nofollow"><img src="/local/templates/aspro-scorp_wf/images/viber.png"></a>
								</div>
								<div class="glaz">
									<a href="?special_version=Y"><img src="/local/templates/aspro-scorp_wf/images/glaz.png"></a>
								</div>
								<div class="questionTitle">
									<img src="/local/templates/aspro-scorp_wf/images/question.png">
									<script data-b24-form="click/9/cw20wf" data-skip-moving="true">
											(function(w,d,u){
													var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0);
													var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
											})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_9_cw20wf.js');
									</script> 
									<a href="javascript:;"><?=GetMessage("S_QUESTION")?></a>
								</div>
								<div class="questiondockTitle">									
									<script data-b24-form="click/7/y2aq9g" data-skip-moving="true">
											(function(w,d,u){ 
													var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/180000|0); 
													var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h); 
											})(window,document,'https://bitrix.klinikaglaz.ru/upload/crm/form/loader_7_y2aq9g.js');
									</script>
									<span href="javascript:;"><?=GetMessage("S_QUESTIONDOCK")?></span>
								</div>
							</div>
						</div>
					</div><?// class=logo-row?>

					<div class="menu-row row custom">
						<div class="maxwidth-theme">
							<div class="col-md-12">
								<div class="nav-main-collapse collapse">
									<div class="menu-only">
										<nav class="mega-menu">
											<?$APPLICATION->IncludeComponent(
												"bitrix:menu", 
												"top", 
												array(
													"ROOT_MENU_TYPE" => "top",
													"MENU_CACHE_TYPE" => "A",
													"MENU_CACHE_TIME" => "3600000",
													"MENU_CACHE_USE_GROUPS" => "N",
													"MENU_CACHE_GET_VARS" => array(
													),
													"MAX_LEVEL" => "4",
													"CHILD_MENU_TYPE" => "left",
													"USE_EXT" => "Y",
													"DELAY" => "N",
													"ALLOW_MULTI_SELECT" => "N",
													"COUNT_ITEM" => "6",
													"COMPONENT_TEMPLATE" => "top",
													"COMPOSITE_FRAME_MODE" => "A",
													"COMPOSITE_FRAME_TYPE" => "AUTO"
												),
												false
											);?>
										</nav>
									</div>
								</div>
							</div><?// class=col-md-9 col-sm-8 col-xs-2 / class=col-md-12?>
						</div>
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
					</div><?// class=logo-row row / class=menu-row row?>
				</div>
				<div class="line-row visible-xs"></div>
			</header>

			<div role="main" class="main">
				<?if($isIndex):?>
					<?@include(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'/indexblocks.php'));?>
					<?=$indexProlog; // buffered from indexblocks.php?>
				<?endif;?>
				<?if(!$isIndex && !$is404 && !$isForm):?>
					<section class="page-top">
						<div class="row">
							<div class="maxwidth-theme">
								<div class="col-md-12">
								
									<?php if(CSite::InDir('/price/')) { ?>
									<div class="onlinepay-page-top-block">
										<a href="/paykeeper/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/button_card_1.svg" /></a>
									</div>
									<?php } ?>
									<? if(!CSite::InDir('/glaznye-zabolevaniya/')) { ?>
										<div class="row">
											<div class="col-md-12">
												<h1><?$APPLICATION->ShowTitle(false)?></h1>
											</div>
										</div>
									<? } ?>
									<div class="row">
										<div class="col-md-12">
											<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"corp", 
	array(
		"START_FROM" => "1",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "corp",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				<?endif; // if !$isIndex && !$is404 && !$isForm?>
				<div class="container">
					<?if(!$isIndex):?>
						<div class="row">
							<div id="maxwidth-custom" class="maxwidth-theme">
								<?if(!$isMenu):?>
									<div class="col-md-12 col-sm-12 col-xs-12 content-md">
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
									<div class="col-md-9 col-sm-9 col-xs-8 content-md">
								<?elseif($isMenu && $arTheme["SIDE_MENU"]["VALUE"] == "LEFT" && !CSite::InDir('/glaznye-zabolevaniya/')):?>
									<div class="col-md-3 col-sm-3 col-xs-4 left-menu-md">
										<?$APPLICATION->IncludeComponent(
												"bitrix:menu", 
												"left", 
												array(
													"ROOT_MENU_TYPE" => "left",
													"MENU_CACHE_TYPE" => "N",
													"MENU_CACHE_TIME" => "10",
													"MENU_CACHE_USE_GROUPS" => "N",
													"MENU_CACHE_GET_VARS" => array(
														0 => "SECTION_CODE",
														1 => "SECTION_ID",
														2 => "",
													),
													"MAX_LEVEL" => "4",
													"CHILD_MENU_TYPE" => "left",
													"USE_EXT" => "Y",
													"DELAY" => "N",
													"ALLOW_MULTI_SELECT" => "Y",
													"COMPONENT_TEMPLATE" => "left",
													"COMPOSITE_FRAME_MODE" => "A",
													"COMPOSITE_FRAME_TYPE" => "AUTO"
												),
												false
											);?>
										<div class="sidearea">
											<?$APPLICATION->ShowViewContent('under_sidebar_pay_btn');?>
											<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/under_sidebar.php"), false);?>
										</div>
										<?
										$APPLICATION->IncludeComponent(
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
									<div class="col-md-9 col-sm-9 col-xs-8 content-md">
								<?endif;?>
					<?endif;?>
					<?$CScorp->checkRestartBuffer();?>
