<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("paykeeper");
$APPLICATION->SetPageProperty("description", "Для оплаты введите ваши данные и выберите удобный для Вас способ оплаты");
?>
<div id="tmg-page">
	<? echo file_get_contents("https://shop-klinikaglaz.server.paykeeper.ru/form/inline/"); ?>
	<style>
		body {
			overflow-x: auto!important;
		}
	</style>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>