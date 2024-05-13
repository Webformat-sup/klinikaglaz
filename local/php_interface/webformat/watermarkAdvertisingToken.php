<?
class WatermarkAdvertisingToken
{
		private static $arWaterMark = [
			[
				'name' => 'watermark',
				'type' => 'text', // image|text
				'text' => 'текст водяного знака!',
				'coefficient' => '0.8', // коэффициент размера text: 1-7 | image: 0.1-1
				'color' => '000000', // type=text
				'position' => 'bottomleft', // tl|tc|tr|ml|mc|mr|bl|bc|br или topleft|topcenter|topright|centerleft|center|centerright|bottomleft|bottomcenter|bottomright
				// 'alpha_level' => 100, // прозрачность 1-100
				'font' => '/home/bitrix/ext_www/shop.klinikaglaz.ru/bitrix/fonts/opensans-light.ttf',
				// 'size' => 'small', // big|medium|small|real; real доступен только для type=image
				'padding' => '20'
			]
		];

		private static $arIblockIds = [1];
		private static $arPropsCode = ['AT_ERID','AT_TEXT','AT_POSITION','AT_COLOR'];


		/**
		 * OnIBlockElementUpdate - событие вызывается в момент изменения элемента информационного блока.
		 * $newFields - массив обновляемых полей и свойств элемента инфоблока.
		 * $ar_wf_element - текущие значения обновляемых полей.
		 */
		public static function start($newFields,$ar_wf_element){
				
				if(!self::checkIblockId($newFields['IBLOCK_ID'])) return false;

				$arPropsValue = self::getPropsValue($newFields,$ar_wf_element);
				if(!$arPropsValue) return false;
				
				$arFileTmp = self::resizeImageGet($arPropsValue);
				return self::saveImg($newFields['ID'], $arFileTmp);
		}


		private static function checkIblockId($iblockId){
				return in_array($iblockId, self::$arIblockIds);
		}


		private static function getPropsValue($newFields, $ar_wf_element){

				if($newFields['PREVIEW_PICTURE']) $idImg = $newFields['PREVIEW_PICTURE'];
				elseif($ar_wf_element['PREVIEW_PICTURE']) $idImg = $ar_wf_element['PREVIEW_PICTURE'];
				else return false;

				$iblockId = $newFields['IBLOCK_ID'];
				$arPropsCode = self::$arPropsCode;
				$arPropsValue = [];

				foreach ($arPropsCode as $k => $prop) {
						$result = CIBlockProperty::GetByID($arPropsCode[$k], $iblockId, false)->GetNext();
						if(!$result) continue;

						$arPropsValue[$arPropsCode[$k]] = [
							'ID' => $result['ID'],
							'TYPE' => $result['PROPERTY_TYPE']
						];

						if($result['PROPERTY_TYPE'] === 'L'){
							$arPropsValue[$arPropsCode[$k]]['VALUE'] = 
								CIBlockPropertyEnum::GetByID(
									array_shift($newFields['PROPERTY_VALUES'][$result['ID']])['VALUE']
								);							
						} else {
							$arPropsValue[$arPropsCode[$k]]['VALUE'] = 
									array_shift($newFields['PROPERTY_VALUES'][$result['ID']])['VALUE'];
						}
				}

				if(!$arPropsValue[$arPropsCode[0]]) return false;

				$arPropsValue['IMAGE'] = CFile::GetByID($idImg)->fetch();
				if(!$arPropsValue['IMAGE']) return false;

				return $arPropsValue;
		}


		private static function resizeImageGet($arPropsValue){

				if(!$arPropsValue['AT_ERID']['VALUE']) return false;
				$arWaterMark = self::$arWaterMark;

				if($arPropsValue['AT_POSITION']['VALUE']['XML_ID']) {
						$arWaterMark[0]['position'] = $arPropsValue['AT_POSITION']['VALUE']['XML_ID'];
				}
				if($arPropsValue['AT_COLOR']['VALUE']['XML_ID']) {
						$arWaterMark[0]['color'] = str_replace('#','',$arPropsValue['AT_COLOR']['VALUE']['XML_ID']);
				}

				$arWaterMark[0]['text'] = 'erid:'.$arPropsValue['AT_ERID']['VALUE'];
				if($arPropsValue['AT_TEXT']['VALUE']) {
						$arWaterMark[0]['text'] = $arPropsValue['AT_TEXT']['VALUE'] . ' ' . $arWaterMark[0]['text'];
				}

				$arFileTmp = CFile::ResizeImageGet(
					$arPropsValue['IMAGE']['ID'],
					["width" => $arPropsValue['IMAGE']['WIDTH'], "height" => $arPropsValue['IMAGE']['HEIGHT']],
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true, // вернуть массив результата размеров измененной картинки 
					$arWaterMark,
					false,
					100 // число, устанавливающее в процентах качество JPG при масштабировании (1-100)
				);

				return $arFileTmp;
		}


		private static function saveImg($elementId, $arFileTmp){

				$elementId = (int) $elementId;
				$arMakeFile = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].$arFileTmp['src']);
				$result = CIBlockElement::SetPropertyValueCode($elementId, 'AT_IMG', $arMakeFile);

				return $result;
		}

		// метод используется в шаблонах
		public static function showWatermarkImg($arItem){

				$origenalReturn = ($arItem['PREVIEW_PICTURE']['SRC']) ? $arItem['PREVIEW_PICTURE']['SRC'] : false;
				if(!$arItem['PROPERTIES']['AT_IMG']['VALUE']) return $origenalReturn;

				$arImg = CFile::GetByID($arItem['PROPERTIES']['AT_IMG']['VALUE'])->fetch();
				return $arImg['SRC'];
		}

		// метод используется в шаблонах
		public static function showTextToken($arItem){

				if(!$arItem['PROPERTIES']['AT_ERID']['VALUE']) return false;

				$string = 'erid:'.$arItem['PROPERTIES']['AT_ERID']['VALUE'];
				if($arItem['PROPERTIES']['AT_TEXT']['VALUE']) {
					$string = $arItem['PROPERTIES']['AT_TEXT']['VALUE'] . ' ' . $string;
				}

				return $string;
		}

}
?>