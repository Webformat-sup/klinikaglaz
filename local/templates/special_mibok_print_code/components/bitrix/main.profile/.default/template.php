<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?if($arResult["strProfileError"]){?>
    <div class="alert alert-danger" role="alert" tabindex="0">
        <p><span class="glyphicon glyphicon glyphicon-remove-sign"></span>&nbsp; <?=$arResult["strProfileError"];?></p>
    </div>    
<?}?>
<?if ($arResult['DATA_SAVED'] == 'Y'){?>
    <div class="alert alert-success" role="alert" tabindex="0">
        <p><span class="glyphicon glyphicon glyphicon-ok-sign"></span>&nbsp;<?=GetMessage('MIBOK_SP_PROFILE_DATA_SAVED');?></p>
    </div>    
<?}?>    
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
    <?=$arResult["BX_SESSION_CHECK"]?>
    <input type="hidden" name="lang" value="<?=LANG?>" />
    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
    <h3><?=GetMessage("MIBOK_SP_REG_SHOW_HIDE")?></h3>
    <div class="help-form-wrapper">
        <button type="button" class="btn btn-default btn-help-form" aria-label="<?=GetMessage('MIBOK_SP_PROFILE_FORM_DESC_TITLE');?>" tabindex="0"><span class="glyphicon glyphicon glyphicon-info-sign"></span>&nbsp;<?=GetMessage('MIBOK_SP_PROFILE_FORM_DESC_TITLE');?></button>
        <div class="alert alert-info alert-info-form" role="alert" tabindex="-1">		
            <?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
        </div>	
    </div>
    <?if($arResult["ID"]>0){?>
        <?if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0){?>
            <p><strong><?=GetMessage('MIBOK_SP_LAST_UPDATE')?></strong>&nbsp;<span><?=$arResult["arUser"]["TIMESTAMP_X"]?></span></p>
        <?}?>
        <?if (strlen($arResult["arUser"]["LAST_LOGIN"])>0){?>
            <p><strong><?=GetMessage('MIBOK_SP_LAST_LOGIN')?></strong>&nbsp;<span><?=$arResult["arUser"]["LAST_LOGIN"]?></span></p>
        <?}?>
    <?}?>
    <div class="form-group">
        <label class="control-label" id="bx_profile_main_profile_title"><?echo GetMessage("MIBOK_SP_main_profile_title")?></label>
        <input class="form-control" type="text" name="TITLE" value="<?=$arResult["arUser"]["TITLE"]?>" aria-describedby="bx_profile_main_profile_title" autocomplete="honorific-prefix"/>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_NAME"><?=GetMessage('MIBOK_SP_NAME')?></label>
        <input class="form-control" type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" aria-describedby="bx_profile_NAME" autocomplete="given-name"/>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_LAST_NAME"><?=GetMessage('MIBOK_SP_LAST_NAME')?></label>
        <input class="form-control" type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" aria-describedby="bx_profile_LAST_NAME" autocomplete="family-name"  />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_SECOND_NAME"><?=GetMessage('MIBOK_SP_SECOND_NAME')?></label>
        <input class="form-control" type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" aria-describedby="bx_profile_SECOND_NAME" autocomplete="additional-name" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_EMAIL"><?=GetMessage('MIBOK_SP_EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></label>
        <input class="form-control" type="email" name="EMAIL" required="required" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" aria-describedby="bx_profile_EMAIL" autocomplete="email" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_LOGIN"><?=GetMessage('MIBOK_SP_LOGIN')?><span class="starrequired">*</span></label>
        <input class="form-control" type="text" name="LOGIN" required="required" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" aria-describedby="bx_profile_LOGIN" autocomplete="username"  />
    </div>
    <?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''){?>
        <div class="form-group">
            <label class="control-label" id="bx_profile_NEW_PASSWORD_REQ"><?=GetMessage('MIBOK_SP_NEW_PASSWORD_REQ')?></label>
            <input class="form-control" type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" aria-describedby="bx_profile_NEW_PASSWORD_REQ" autocomplete="new-password"  />
            <?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("MIBOK_SP_AUTH_SECURE_NOTE")?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                </span>
                <noscript>
                <span class="bx-auth-secure" title="<?echo GetMessage("MIBOK_SP_AUTH_NONSECURE_NOTE")?>">
                    <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                </span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                </script>
            <?endif?>
        </div>                
        <div class="form-group">
            <label class="control-label" id="bx_profile_NEW_PASSWORD_CONFIRM"><?=GetMessage('MIBOK_SP_NEW_PASSWORD_CONFIRM')?></label>
            <input class="form-control" type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" aria-describedby="bx_profile_NEW_PASSWORD_CONFIRM" autocomplete="new-password" />
        </div>
    <?}?>
    <?if($arResult["TIME_ZONE_ENABLED"] == true){?>
        <div class="form-group">
            <h4><?echo GetMessage("MIBOK_SP_main_profile_time_zones")?></h4>
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_main_profile_time_zones_auto"><?echo GetMessage("MIBOK_SP_main_profile_time_zones_auto")?></label>		
            <select class="form-control" name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')" aria-describedby="bx_profile_main_profile_time_zones_auto">
                <option value=""><?echo GetMessage("MIBOK_SP_main_profile_time_zones_auto_def")?></option>
                <option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("MIBOK_SP_main_profile_time_zones_auto_yes")?></option>
                <option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("MIBOK_SP_main_profile_time_zones_auto_no")?></option>
            </select>		
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_main_profile_time_zones_zones"><?echo GetMessage("MIBOK_SP_main_profile_time_zones_zones")?></label>		
            <select class="form-control" name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?> aria-describedby="bx_profile_main_profile_time_zones_zones">
                <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name){?>
                    <option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
                <?}?>
            </select>		
        </div>
    <?}?>
    <h3><?=GetMessage("MIBOK_SP_USER_PERSONAL_INFO")?></h3>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_PROFESSION"><?=GetMessage('MIBOK_SP_USER_PROFESSION')?></label>
        <input class="form-control" type="text" name="PERSONAL_PROFESSION" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PROFESSION"]?>" aria-describedby="bx_profile_USER_PROFESSION" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_WWW"><?=GetMessage('MIBOK_SP_USER_WWW')?></label>
        <input class="form-control" type="text" name="PERSONAL_WWW" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_WWW"]?>" aria-describedby="bx_profile_USER_WWW" autocomplete="url" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_ICQ"><?=GetMessage('MIBOK_SP_USER_ICQ')?></label>
        <input class="form-control" type="text" name="PERSONAL_ICQ" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ICQ"]?>" aria-describedby="bx_profile_USER_ICQ" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_GENDER"><?=GetMessage('MIBOK_SP_USER_GENDER')?></label>
        <select class="form-control" name="PERSONAL_GENDER" aria-describedby="bx_profile_USER_GENDER">
            <option value=""><?=GetMessage("MIBOK_SP_USER_DONT_KNOW")?></option>
            <option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("MIBOK_SP_USER_MALE")?></option>
            <option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("MIBOK_SP_USER_FEMALE")?></option>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_BIRTHDAY_DT"><?=GetMessage("MIBOK_SP_USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>):</label>
        <?
        $APPLICATION->IncludeComponent(
            'bitrix:main.calendar',
            '',
            array(
                    'SHOW_INPUT' => 'N',
                    'FORM_NAME' => 'form1',
                    'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
                    'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
                    'SHOW_TIME' => 'N'
            ),
            null,
            array('HIDE_ICONS' => 'Y')
        );
        ?>
        <input class="form-control" type="text" name="PERSONAL_BIRTHDAY" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>" aria-describedby="bx_profile_USER_BIRTHDAY_DT" autocomplete="bday" />        
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_PHOTO"><?=GetMessage("MIBOK_SP_USER_PHOTO")?></label>			
        <?=str_replace('<input ', '<input class="form-control" aria-describedby="bx_profile_USER_PHOTO"  autocomplete="photo"', $arResult["arUser"]["PERSONAL_PHOTO_INPUT"])?>
        <?if (strlen($arResult["arUser"]["PERSONAL_PHOTO"])>0){?>
            <br /><?=$arResult["arUser"]["PERSONAL_PHOTO_HTML"]?>
        <?}?>
    </div>
    <div class="form-group">
        <h4><?=GetMessage("MIBOK_SP_USER_PHONES")?></h4>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_PHONE"><?=GetMessage('MIBOK_SP_USER_PHONE')?></label>
        <input class="form-control" type="text" name="PERSONAL_PHONE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" aria-describedby="bx_profile_USER_PHONE" autocomplete="tel" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_FAX"><?=GetMessage('MIBOK_SP_USER_FAX')?></label>
        <input class="form-control" type="text" name="PERSONAL_FAX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_FAX"]?>" aria-describedby="bx_profile_USER_FAX" autocomplete="tel" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_MOBILE"><?=GetMessage('MIBOK_SP_USER_MOBILE')?></label>
        <input class="form-control" type="text" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" aria-describedby="bx_profile_USER_MOBILE" autocomplete="tel" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_PAGER"><?=GetMessage('MIBOK_SP_USER_PAGER')?></label>
        <input class="form-control" type="text" name="PERSONAL_PAGER" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_PAGER"]?>" aria-describedby="bx_profile_USER_PAGER" />
    </div>
    <div class="form-group">
        <h4><?=GetMessage("MIBOK_SP_USER_POST_ADDRESS")?></h4>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_COUNTRY"><?=GetMessage('MIBOK_SP_USER_COUNTRY')?></label>
        <?=str_replace('<select ', '<select class="form-control" aria-describedby="bx_profile_USER_COUNTRY" autocomplete="country-name"', $arResult["COUNTRY_SELECT"])?>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_STATE"><?=GetMessage('MIBOK_SP_USER_STATE')?></label>
        <input class="form-control" type="text" name="PERSONAL_STATE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_STATE"]?>" aria-describedby="bx_profile_USER_STATE" autocomplete="address-levell" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_CITY"><?=GetMessage('MIBOK_SP_USER_CITY')?></label>
        <input class="form-control" type="text" name="PERSONAL_CITY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" aria-describedby="bx_profile_USER_CITY" autocomplete="address-level2" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_ZIP"><?=GetMessage('MIBOK_SP_USER_ZIP')?></label>
        <input class="form-control" type="text" name="PERSONAL_ZIP" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" aria-describedby="bx_profile_USER_ZIP" autocomplete="postal-code" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_STREET"><?=GetMessage("MIBOK_SP_USER_STREET")?></label>
        <textarea class="form-control" cols="30" rows="5" name="PERSONAL_STREET" aria-describedby="bx_profile_USER_STREET" autocomplete="street-address"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_MAILBOX"><?=GetMessage('MIBOK_SP_USER_MAILBOX')?></label>
        <input class="form-control" type="text" name="PERSONAL_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MAILBOX"]?>" aria-describedby="bx_profile_USER_MAILBOX" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_NOTES"><?=GetMessage("MIBOK_SP_USER_NOTES")?></label>
        <textarea class="form-control" cols="30" rows="5" name="PERSONAL_NOTES" aria-describedby="bx_profile_USER_NOTES"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>
    </div>
    <h3><?=GetMessage("MIBOK_SP_USER_WORK_INFO")?></h3>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_COMPANY"><?=GetMessage('MIBOK_SP_USER_COMPANY')?></label>
        <input class="form-control" type="text" name="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" aria-describedby="bx_profile_USER_COMPANY" autocomplete="organization" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_WWW"><?=GetMessage('MIBOK_SP_USER_WWW')?></label>
        <input class="form-control" type="text" name="WORK_WWW" maxlength="255" value="<?=$arResult["arUser"]["WORK_WWW"]?>" aria-describedby="bx_profile_USER_WWW" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_DEPARTMENT"><?=GetMessage('MIBOK_SP_USER_DEPARTMENT')?></label>
        <input class="form-control" type="text" name="WORK_DEPARTMENT" maxlength="255" value="<?=$arResult["arUser"]["WORK_DEPARTMENT"]?>" aria-describedby="bx_profile_USER_DEPARTMENT" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_POSITION"><?=GetMessage('MIBOK_SP_USER_POSITION')?></label>
        <input class="form-control" type="text" name="WORK_POSITION" maxlength="255" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" aria-describedby="bx_profile_USER_POSITION" autocomplete="organization-title" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_WORK_PROFILE"><?=GetMessage("MIBOK_SP_USER_WORK_PROFILE")?></label>
        <textarea class="form-control" cols="30" rows="5" name="WORK_PROFILE" aria-describedby="bx_profile_USER_WORK_PROFILE"><?=$arResult["arUser"]["WORK_PROFILE"]?></textarea>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_USER_LOGO"><?=GetMessage("MIBOK_SP_USER_LOGO")?></label>	
        <?=str_replace('<input ', '<input class="form-control" aria-describedby="bx_profile_USER_LOGO"', $arResult["arUser"]["WORK_LOGO_INPUT"])?>
        <?if (strlen($arResult["arUser"]["WORK_LOGO"])>0){?>
            <br /><?=$arResult["arUser"]["WORK_LOGO_HTML"]?>
        <?}?>
    </div>
    <div class="form-group">
        <h4><?=GetMessage("MIBOK_SP_USER_PHONES")?></h4>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_PHONE"><?=GetMessage('MIBOK_SP_USER_PHONE')?></label>
        <input class="form-control" type="text" name="WORK_PHONE" maxlength="255" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" aria-describedby="bx_profile_WORK_PHONE" autocomplete="tel" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_FAX"><?=GetMessage('MIBOK_SP_USER_FAX')?></font></label>
        <input class="form-control" type="text" name="WORK_FAX" maxlength="255" value="<?=$arResult["arUser"]["WORK_FAX"]?>" aria-describedby="bx_profile_WORK_FAX" autocomplete="tel" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_PAGER"><?=GetMessage('MIBOK_SP_USER_PAGER')?></font></label>
        <input class="form-control" type="text" name="WORK_PAGER" maxlength="255" value="<?=$arResult["arUser"]["WORK_PAGER"]?>" aria-describedby="bx_profile_WORK_PAGER" />
    </div>
    <div class="form-group">
        <h4><?=GetMessage("MIBOK_SP_USER_POST_ADDRESS")?></h4>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_COUNTRY_SELECT_WORK"><?=GetMessage('MIBOK_SP_USER_COUNTRY')?></label>
        <?=str_replace('<select ', '<select class="form-control" aria-describedby="bx_profile_COUNTRY_SELECT_WORK" autocomplete="country-name"', $arResult["COUNTRY_SELECT_WORK"])?>        
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_STATE"><?=GetMessage('MIBOK_SP_USER_STATE')?></label>
        <input class="form-control" type="text" name="WORK_STATE" maxlength="255" value="<?=$arResult["arUser"]["WORK_STATE"]?>" aria-describedby="bx_profile_WORK_STATE" autocomplete="address-levell"/>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_CITY"><?=GetMessage('MIBOK_SP_USER_CITY')?></label>
        <input class="form-control" type="text" name="WORK_CITY" maxlength="255" value="<?=$arResult["arUser"]["WORK_CITY"]?>" aria-describedby="bx_profile_WORK_CITY" autocomplete="address-level2"/>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_ZIP"><?=GetMessage('MIBOK_SP_USER_ZIP')?></label>
        <input class="form-control" type="text" name="WORK_ZIP" maxlength="255" value="<?=$arResult["arUser"]["WORK_ZIP"]?>" aria-describedby="bx_profile_WORK_ZIP" autocomplete="postal-code"/>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_STREET"><?=GetMessage("MIBOK_SP_USER_STREET")?></label>
        <textarea class="form-control" cols="30" rows="5" name="WORK_STREET" aria-describedby="bx_profile_WORK_STREET" autocomplete="street-address"><?=$arResult["arUser"]["WORK_STREET"]?></textarea>
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_MAILBOX"><?=GetMessage('MIBOK_SP_USER_MAILBOX')?></label>
        <input class="form-control" type="text" name="WORK_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["WORK_MAILBOX"]?>" aria-describedby="bx_profile_WORK_MAILBOX" />
    </div>
    <div class="form-group">
        <label class="control-label" id="bx_profile_WORK_NOTES"><?=GetMessage("MIBOK_SP_USER_NOTES")?></label>
        <textarea class="form-control" cols="30" rows="5" name="WORK_NOTES" aria-describedby="bx_profile_WORK_NOTES"><?=$arResult["arUser"]["WORK_NOTES"]?></textarea>
    </div>	
    <?if ($arResult["INCLUDE_FORUM"] == "Y"){?>
        <h3><?=GetMessage("MIBOK_SP_forum_INFO")?></h3>
        <div class="form-group">
            <label class="control-label" id="bx_profile_forum_SHOW_NAME"><?=GetMessage("MIBOK_SP_forum_SHOW_NAME")?></label>
            <input type="checkbox" name="forum_SHOW_NAME" value="Y" <?if ($arResult["arForumUser"]["SHOW_NAME"]=="Y") echo "checked=\"checked\"";?> aria-describedby="bx_profile_forum_SHOW_NAME" />
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_forum_DESCRIPTION"><?=GetMessage('MIBOK_SP_forum_DESCRIPTION')?></label>
            <input class="form-control" type="text" name="forum_DESCRIPTION" maxlength="255" value="<?=$arResult["arForumUser"]["DESCRIPTION"]?>" aria-describedby="bx_profile_forum_DESCRIPTION" />
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_forum_INTERESTS"><?=GetMessage('MIBOK_SP_forum_INTERESTS')?></label>
            <textarea class="form-control" cols="30" rows="5" name="forum_INTERESTS" aria-describedby="bx_profile_forum_INTERESTS"><?=$arResult["arForumUser"]["INTERESTS"]; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_forum_SIGNATURE"><?=GetMessage("MIBOK_SP_forum_SIGNATURE")?></label>
            <textarea class="form-control" cols="30" rows="5" name="forum_SIGNATURE" aria-describedby="bx_profile_forum_SIGNATURE"><?=$arResult["arForumUser"]["SIGNATURE"]; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_forum_AVATAR"><?=GetMessage("MIBOK_SP_forum_AVATAR")?></label>
            <?=str_replace('<input ', '<input class="form-control" aria-describedby="bx_profile_forum_AVATAR"', $arResult["arForumUser"]["AVATAR_INPUT"])?>
            <?if(strlen($arResult["arForumUser"]["AVATAR"])>0){?>
                <br /><?=$arResult["arForumUser"]["AVATAR_HTML"]?>
            <?}?>
        </div>	
    <?}?>
    <?if ($arResult["INCLUDE_BLOG"] == "Y"){?>
        <h3><?=GetMessage("MIBOK_SP_blog_INFO")?></h3>
        <div class="form-group">
            <label class="control-label" id="bx_profile_blog_ALIAS"><?=GetMessage('MIBOK_SP_blog_ALIAS')?></label>
            <input class="form-control" class="typeinput" type="text" name="blog_ALIAS" maxlength="255" value="<?=$arResult["arBlogUser"]["ALIAS"]?>" aria-describedby="bx_profile_blog_ALIAS" autocomplete="nickname" />
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_blog_DESCRIPTION"><?=GetMessage('MIBOK_SP_blog_DESCRIPTION')?></label>
            <input class="form-control" class="typeinput" type="text" name="blog_DESCRIPTION" maxlength="255" value="<?=$arResult["arBlogUser"]["DESCRIPTION"]?>" aria-describedby="bx_profile_blog_DESCRIPTION" />
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_blog_INTERESTS"><?=GetMessage('MIBOK_SP_blog_INTERESTS')?></label>
            <textarea class="form-control" cols="30" rows="5" class="typearea" name="blog_INTERESTS" aria-describedby="bx_profile_blog_INTERESTS"><?echo $arResult["arBlogUser"]["INTERESTS"]; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_blog_AVATAR"><?=GetMessage("MIBOK_SP_blog_AVATAR")?></label>
            <?=str_replace('<input ', '<input class="form-control" aria-describedby="bx_profile_blog_AVATAR"', $arResult["arBlogUser"]["AVATAR_INPUT"])?>
            <?if (strlen($arResult["arBlogUser"]["AVATAR"])>0){?>
                <br /><?=$arResult["arBlogUser"]["AVATAR_HTML"]?>
            <?}?>
        </div>	
    <?}?>
    <?if($arResult["INCLUDE_LEARNING"] == "Y"){?>
        <h3><?=GetMessage("MIBOK_SP_learning_INFO")?></h3>		
        <div class="form-group">
            <label class="control-label" id="bx_profile_learning_PUBLIC_PROFILE"><?=GetMessage("MIBOK_SP_learning_PUBLIC_PROFILE");?>:</label>
            <input class="form-control" type="checkbox" name="student_PUBLIC_PROFILE" value="Y" <?if ($arResult["arStudent"]["PUBLIC_PROFILE"]=="Y") echo "checked=\"checked\"";?> aria-describedby="bx_profile_learning_PUBLIC_PROFILE" />
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_learning_RESUME"><?=GetMessage("MIBOK_SP_learning_RESUME");?>:</label>
            <textarea class="form-control" cols="30" rows="5" name="student_RESUME" aria-describedby="bx_profile_learning_RESUME"><?=$arResult["arStudent"]["RESUME"]; ?></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" id="bx_profile_learning_TRANSCRIPT"><?=GetMessage("MIBOK_SP_learning_TRANSCRIPT");?>:</label>
            <?=$arResult["arStudent"]["TRANSCRIPT"];?>-<?=$arResult["ID"]?>
        </div>			
    <?}?>
    <?if($arResult["IS_ADMIN"]){?>
        <h3><?=GetMessage("MIBOK_SP_USER_ADMIN_NOTES")?></h3>		
        <div class="form-group">
            <label class="control-label" id="bx_profile_USER_ADMIN_NOTES"><?=GetMessage("MIBOK_SP_USER_ADMIN_NOTES")?>:</label>
            <textarea class="form-control" cols="30" rows="5" name="ADMIN_NOTES" aria-describedby="bx_profile_USER_ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea>
        </div>			
    <?}?>	
    <?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
        <h3><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("MIBOK_SP_USER_TYPE_EDIT_TAB")?></h3>					
        <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
            <div class="form-group">
                <label class="control-label" id="bx_profile_USER_PROPERTIES_<?=$FIELD_NAME?>"><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?><?=$arUserField["EDIT_FORM_LABEL"]?>:</label>                
                <?$APPLICATION->IncludeComponent("bitrix:system.field.edit", $arUserField["USER_TYPE"]["USER_TYPE_ID"], array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
            </div>
        <?endforeach;?>			
    <?endif;?>    
    <p><input class="btn btn-default" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MIBOK_SP_SAVE") : GetMessage("MIBOK_SP_ADD"))?>">&nbsp;&nbsp;<input class="btn btn-default" type="reset" value="<?=GetMessage('MIBOK_SP_RESET');?>"></p>
</form>
<?
if($arResult["SOCSERV_ENABLED"]){
    $APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
        "SHOW_PROFILES" => "Y",
        "ALLOW_DELETE" => "Y"
            ), false
    );
}
?>