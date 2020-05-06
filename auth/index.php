<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?$APPLICATION->IncludeComponent(
	"aspro:auth.next",
	"",
	Array(
		"PERSONAL" => "/personal/",
		"SEF_FOLDER" => "/auth/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("auth"=>"","change"=>"change-password/","change_password"=>"change-password/","confirm"=>"confirm-password/","confirm_registration"=>"confirm-registration/","forgot"=>"forgot-password/","forgot_password"=>"forgot-password/","registration"=>"registration/")
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>