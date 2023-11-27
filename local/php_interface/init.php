<?php
\Bitrix\Main\Loader::includeModule('webformat.utils');
CModule::IncludeModule('webformat.debug1');
\file_exists($incFile = $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php') && include($incFile);
include_once 'webformat/stringHeadCanonical.php';
include_once 'webformat/stringMicromarkingJson.php';

  //обработчик, который перезаписывает бренд при выгрузке из 1с
  AddEventHandler( "iblock", "OnAfterIBlockElementAdd", array( "aspro_import", "FillTheBrands" ) );
  AddEventHandler( "iblock", "OnAfterIBlockElementUpdate", array( "aspro_import", "FillTheBrands" ) );

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

AddEventHandler("main", "OnBeforeProlog", "registerJquery", 1);

function registerJquery()
{
  //Hack: when init first extension - bitrix register standart extensions
  $emptyHack = [
	 'css' => "",
	 'skip_core' => true,
  ];
  CJSCore::RegisterExt('emptyHack', $emptyHack);
  CJSCore::Init('emptyHack');

  $jquery = [
	 'js' => "/bitrix/js/main/jquery/jquery-old.min.js",
	 'skip_core' => true,
  ];
  CJSCore::RegisterExt('jquery', $jquery);
}


class aspro_import {
    static function FillTheBrands($arFields){
        $arCatalogID=array(46);
        if( in_array($arFields['IBLOCK_ID'], $arCatalogID) ){
         // \Bitrix\Main\Loader::includeModule('catalog');
            $arItem = CIBlockElement::GetList(false, array( 'IBLOCK_ID' => $arFields['IBLOCK_ID'], 'ID' => $arFields['ID']), false, false, array( 'ID', 'PROPERTY_593') )->fetch();
            //проставлем нужный бренд из инфоблока бренда
            if($arItem['PROPERTY_593_VALUE']){
                $arBrand = CIBlockElement::GetList( false, array( 'IBLOCK_ID' => 41, 'NAME' => $arItem['PROPERTY_593_VALUE'] ) )->fetch();
                if( $arBrand ){
                    CIBlockElement::SetPropertyValuesEx( $arFields['ID'], false, array('713' => $arBrand['ID'] ) );
                }else{
                    $el = new CIBlockElement;
                    $arParams = array( "replace_space" => "-", "replace_other" => "-" );
                    $id = $el->Add( array(
                        'ACTIVE' => 'Y',
                        'NAME' => $arItem['PROPERTY_CML2_MANUFACTURER_VALUE'],
                        'IBLOCK_ID' => 41,
                        'CODE' => Cutil::translit( $arItem['PROPERTY_593_VALUE'], "ru", $arParams )
                    ) ); 			    
                    if( $id ){
                        CIBlockElement::SetPropertyValuesEx( $arFields['ID'], false, array( '713' => $id ) );
                    }else{
                        $error = $el->LAST_ERROR;
                    }
                }
            }
            

        }
    }
}