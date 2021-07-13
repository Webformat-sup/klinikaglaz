<?IncludeTemplateLangFile(__FILE__);?>	
</div>
                    </div>
                </div>
            </div>      
            <?if($APPLICATION->GetCurDir() == '/'){?>
                            
            <?}?>
            <footer class="bs-docs-footer" role="contentinfo">
                <div class="container wcag">
                    <div class="panel-group">
                        <button type="button" class="btn btn-default go-top" tabindex="0" aria-label="<?=GetMessage('MIBOK_GO_TOP_BUTTON_TITLE')?>"><span class="glyphicon glyphicon-circle-arrow-up"></span>&nbsp;<?=GetMessage('MIBOK_GO_TOP_BUTTON_TITLE')?><span class="hover"></span></button>
                    </div>    
                    
					<?if(CModule::IncludeModule('advertising')):?>
                                   
					<?endif;?>					
                    <div class="row">
                        <div class="col-md-12" tabindex="0">
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_ADDRESS')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_address.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_EMAIL')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_email.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                            <div class="address"><strong><?=GetMessage('MIBOK_SITE_PHONE')?>:</strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_phone.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="copy"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."glaza_mibok_include/site_copy.php", "MIBOK_SPECIAL_COMPARE" => "N"));?></div>
                        </div>
                    </div>
                </div>                 
            </footer>
        </div>        
		
        <?$APPLICATION->IncludeComponent("mibok:special_check_auth", "", array("MIBOK_SPECIAL_COMPARE" => "N"))?>
        <?=MKSpecial::includesFilesFooter(SITE_TEMPLATE_PATH)?>
		
    </body>
</html>
