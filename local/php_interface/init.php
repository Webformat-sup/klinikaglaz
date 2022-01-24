<?php
\Bitrix\Main\Loader::includeModule('webformat.utils');
CModule::IncludeModule('webformat.debug1');

AddEventHandler("main", "OnFileDelete", "MyOnFileDelete");

function MyOnFileDelete($arFile)
{
    $fileNameArray = explode('.', $arFile["FILE_NAME"]);
    $ext = $fileNameArray[count($fileNameArray)-1];

    if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
        $fileName = implode('.', explode('.', $arFile["FILE_NAME"], -1));
        $webpFile = $_SERVER["DOCUMENT_ROOT"].'/upload/'.$arFile["SUBDIR"].'/'.$fileName.'.webp';
        if(file_exists($webpFile))
            unlink($webpFile);
    }
}

// создание копии картинок из таблицы b_file в .webp, запускается из агента
// CAgent::AddAgent("newFileHandler(18987);", '', Y , 86400);
function newFileHandler($fileId){  

    global $DB;
    // $fileId = '18988'; для тестирования
    $res_arr=[];
    $id = '';

    if(!empty($fileId)){
        $res = $DB->Query( "select * from `b_file` where `ID` > ".$fileId.";" );


        while($arElement = $res->GetNext()){
            $id = $arElement['ID'];
            $res_arr[$arElement['ID']] = $arElement;
            $path = $_SERVER['DOCUMENT_ROOT']."/upload/".$arElement['SUBDIR'].'/';
            $file = $path.$arElement['FILE_NAME'];

            if(exif_imagetype($file)==IMAGETYPE_JPEG){
                $img = imagecreatefromjpeg($file);
            }elseif(exif_imagetype($file)==IMAGETYPE_PNG){
                $img = imagecreatefrompng($file);
            }
    
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
           
            imagewebp(
                $img, 
                $path.implode('.', explode('.', $arElement['FILE_NAME'], -1)).'.webp', 
                90
            );
        }

        imagedestroy($img);

        return "NewFileHandler($id)";
    } 


}
