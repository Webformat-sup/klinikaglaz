<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

ini_set("max_execution_time", "90");
CModule::IncludeModule('mibok.glaza');


$APPLICATION->RestartBuffer();

if(function_exists('opcache_reset'))
	opcache_reset();

if(!empty($_POST['txt'])) {
    $voice = new MibokSpecialVoice();
	if(!empty($_POST['sid'])){
		$voice->sidToVoice($_POST['txt'], $_SERVER['HTTP_REFERER']);
	} else {
		$voice->textToVoice($_POST['txt'], $_SERVER['HTTP_REFERER']);
	}
    echo json_encode(array('url' => $voice->getVoiceUrl($_SERVER['HTTP_REFERER'])));
} else {
    echo json_encode(array('error' => 'y'));
}

