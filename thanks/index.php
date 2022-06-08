<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("MENU", "N");
$APPLICATION->SetPageProperty("MENU_SHOW_SECTIONS", "N");
$APPLICATION->SetTitle("Спасибо");

echo '
<div style="display: flex;justify-content: center;align-items: center;width: 100%;height: 100%;min-height: 250px;">
    <div style="font-size: 20px;">Благодарим вас за обращение</div>
</div>
<script type="text/javascript">
    window.onload = function() {
        ym(30339732, \'reachGoal\', \'THANKS_PAGE\')
    }
</script>
';
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>