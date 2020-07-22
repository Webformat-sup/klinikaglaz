<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("paykeeper");
echo file_get_contents("https://shop-klinikaglaz.server.paykeeper.ru/form/inline/");   
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>