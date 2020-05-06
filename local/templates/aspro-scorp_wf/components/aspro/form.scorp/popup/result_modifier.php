<?
foreach( $arResult["QUESTIONS"] as $FIELD_SID => $arQuestion ){
	/*echo $FIELD_SID;
	echo '<pre>';
	
	print_r($arQuestion['HTML_CODE']);
	echo '</pre>';*/
	$placeholder=GetMessage($FIELD_SID);
	if($FIELD_SID=='EMAIL'){
		$arResult["QUESTIONS"][$FIELD_SID]['HTML_CODE'] = str_replace('type="email"','placeholder="'.$placeholder.'"',$arQuestion['HTML_CODE']);
		
	}
	elseif($FIELD_SID=='NAME' || $FIELD_SID=='PHONE')
	{
		$arResult["QUESTIONS"][$FIELD_SID]['HTML_CODE'] = str_replace('type="text"','placeholder="'.$placeholder.'"',$arQuestion['HTML_CODE']);
	}
	
	
}