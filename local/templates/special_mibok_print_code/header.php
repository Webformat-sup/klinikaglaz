<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile(__FILE__);
?>
<?
if($_GET['special_version'] == 'Y'){
    session_start();
    $_SESSION['special_version'] = true;
}
if($_GET['special_version'] == 'N'){
    $query = '';
	if(!empty($_SERVER['QUERY_STRING']))
		$query = $_SERVER['QUERY_STRING'];
    $query = str_replace(array('&special_version=N', '?special_version=N', 'special_version=N'), '', $query);
    session_start();
    $_SESSION['special_version'] = false;
    if(!empty($query))
        LocalRedirect ($APPLICATION->GetCurPage().'?'.$query);
    else
        LocalRedirect ($APPLICATION->GetCurPage());
}

global $MIBOK_GLAZA_LANG;
//$MIBOK_GLAZA_LANG->loadFile('lang_all');
//$MESS = array_merge($MESS, $MIBOK_GLAZA_LANG->arLang);
$MESS = array_merge($MESS);

?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="<?=LANG_CHARSET?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <title>
            <?//if($APPLICATION->GetCurDir() != '/'){?>
                <?$APPLICATION->ShowTitle()?>
            <?/*}else{?>
                <?=GetMessage('INDEX_PAGE')?> -
            <?}*/?>
            <?//$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW"	=> "file", "PATH" => SITE_DIR."glaza_mibok_include/site_slogan.php", "MIBOK_SPECIAL_COMPARE" => "N"));?>
        </title>
        <?=MKSpecial::includesFilesHead(SITE_TEMPLATE_PATH)?>
       
        <?$APPLICATION->ShowHead();?>
    </head>	
    <body>
        <div><?$APPLICATION->ShowPanel();?></div>
        <?$arComponentsParams = $APPLICATION->IncludeComponent("mibok:special_panel", "", array("MIBOK_SPECIAL_COMPARE" => "N"))?>
        <div id="content" class="<?=implode(' ', $arComponentsParams)?> <?if(COption::GetOptionString("mibok.glaza", "bootstrap_adaptive") == 'Y'):?>changebtstrp<?endif;?>" <?if(COption::GetOptionString("mibok.glaza", "voice") == 'Y' || COption::GetOptionString("mibok.glaza", "voice_panel") == 'Y'):?>data-volume="<?=(float)(str_replace('volume-', '', $arComponentsParams['VOLUME']))?>"<?endif;?>>
            <header>
                <div class="bs-docs-header" role="banner">
                    <div class="container wcag">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="template"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW"	=> "file", "PATH" => SITE_DIR."glaza_mibok_include/site_slogan.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="container wcag">
                                                                                                                                                            
                        <?$APPLICATION->IncludeComponent("bitrix:menu", ".default", array(
                                "ROOT_MENU_TYPE" => "glazamibok",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "0",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "N",
                                "MIBOK_SPECIAL_COMPARE" => "N"
                                ),
                                false
                        );?>
                    </div>    
                </div>
            </header>
            <div class="container bs-docs-container wcag">
                <div class="row">
                    <div class="col-md-12">                           
                        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", Array(
                                "START_FROM" => "0",
                                "PATH" => "",
                                "SITE_ID" => SITE_ID,
                                "MIBOK_SPECIAL_COMPARE" => "N"
                                ),
                                false
                        );?>
                    </div>
                </div>
            </div>            
            <div class="container bs-docs-container wcag">
                <div class="row">
                    <div class="col-md-12" role="main" id="main_content">
                        <?if($APPLICATION->GetCurDir() != '/' && COption::GetOptionString("mibok.glaza", "view_h1") == 'Y'){?>
                            <h1 class="page-header"><?$APPLICATION->ShowTitle(false);?></h1>
                        <?}?>   
                                              
						
						<div class="page_body">
