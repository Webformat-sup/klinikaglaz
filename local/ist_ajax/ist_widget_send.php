<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$data = json_decode($_POST['other_data']);

if($_POST['saveus']!=''){
	echo "�� ���!";
	die();
}
if($_POST['phone'] and strlen($_POST['phone'])!=18){
	echo "�� ���!";
	die();
}

$values = array();
$content = "";

foreach($data as $item){
	if($item->index=='saveus' and $item->val!=''){
		echo "�� ���!";
		die();
	}else{
		if($item->index=='phone'){
			if(strlen($item->val)!=18){
				echo "�� ���!";
				die();
			}
		}
		if($item->title){
			$values[$item->title] = $item->val;
		}else{
			$values[$item->index] = $item->val;
		}
	}
}

foreach($values as $title => $value){
	if($title!='saveus'){
		$content .= $title.": ".$value."<br>";
	}
}

$arEventFields = array(
	"CONTENT"=>$content
);
CEvent::Send("IST_SERVICE_WIDGET", SITE_ID, $arEventFields);




?>