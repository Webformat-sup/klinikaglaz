<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("paykeeper");
$APPLICATION->SetPageProperty("description", "Для оплаты введите ваши данные и выберите удобный для Вас способ оплаты");
echo file_get_contents("https://shop-klinikaglaz.server.paykeeper.ru/form/inline/");   
?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>