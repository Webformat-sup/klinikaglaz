<?foreach($arResult["arMap"] as $k => $v){
    if($v['LEVEL'] == 2 && str_contains($v['PATH'], '/projects/')){
        unset($arResult["arMap"][$k]);
    }
    if($v['LEVEL'] == 0 && $v['FULL_PATH'] == '/catalog/'){
        unset($arResult["arMap"][$k]);
    }
    if($v['LEVEL'] == 0 && $v['FULL_PATH'] == '/sale/'){
        unset($arResult["arMap"][$k]);
    }
    if($v['LEVEL'] == 0 && $v['FULL_PATH'] == '/blog/'){
        unset($arResult["arMap"][$k]);
    }
    if($v['LEVEL'] == 0 && $v['FULL_PATH'] == '/contacts/'){
        unset($arResult["arMap"][$k]);
    }
    if($v['LEVEL'] == 1 &&  str_contains($v['PATH'], '/company/') && $v['NAME'] == 'О клинике'){
        unset($arResult["arMap"][$k]);
    }
    if(($v['LEVEL'] == 0 && $v['FULL_PATH'] == '/help/') || ($v['LEVEL'] == 1 && str_contains($v['PATH'], '/help/'))){
        unset($arResult["arMap"][$k]);
    }
}

$res = array_values($arResult["arMap"]);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Отзывы клиентов',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/company',
    'FULL_PATH'=> '/reviews/',
    'SEARCH_PATH'=> '/reviews/',

);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Реквизиты',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/company',
    'FULL_PATH'=> '/requisites/',
    'SEARCH_PATH'=> '/requisites/',

);
/*--- INFO ---*/
$res[] = array(
    'LEVEL'=> 0,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Информация',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/projects/',
    'FULL_PATH'=> '/info/',
    'SEARCH_PATH'=> '/info/',

);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Обязательное медицинское страхование (ОМС)',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/info',
    'FULL_PATH'=> '/oms/',
    'SEARCH_PATH'=> '/oms/',

);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Акции',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/info',
    'FULL_PATH'=> '/stock/',
    'SEARCH_PATH'=> '/stock/',

);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Добровольное медицинское страхование (ДМС)',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/info',
    'FULL_PATH'=> '/dms/',
    'SEARCH_PATH'=> '/dms/',

);
$res[] = array(
    'LEVEL'=> 1,
    'IS_DIR'=> 'Y',
    'NAME'=> 'Вопрос-ответ ',
    'PATH'=> '/home/bitrix/ext_www/klinikaglaz.ru/info',
    'FULL_PATH'=> '/articles/',
    'SEARCH_PATH'=> '/articles/',

);


$arResult["arMap"] = $res;