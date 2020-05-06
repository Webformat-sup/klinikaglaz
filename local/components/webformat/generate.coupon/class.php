<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Loader as Loader;
\Bitrix\Main\Localization\Loc::loadMessages(__FILE__);

if(!class_exists('WFGenerateCoupon')){
class WFGenerateCoupon extends CBitrixComponent{
	public function executeComponent() {
		$this->checkAndCorrectArParams();
        try{
			$this->executeComponentAnyWay();
            if(!$this->extractDataFromCache()){
				$this->executeComponentWhenNoCache();
                $this->putDataToCache();
            }
			$this->includeComponentTemplate();
        }catch (SystemException $e){
            $this->abortDataCache();
			ShowError($e->getMessage());
        }
		// webformatdebug::log ($this->arParams,'arParams');
		return $this->arResult;
    }
	
	protected function checkAndCorrectArParams() {
		if (!isset($this->arParams['COUPON_DAYS_LIFE']) || 
			!(bool)$this->arParams['COUPON_DAYS_LIFE']
		) {
			if (\Bitrix\Main\Loader::includeModule('askaron.settings')) {
				$this->arParams['COUPON_DAYS_LIFE'] = COption::GetOptionString( "askaron.settings", "UF_COUPON_LIFE_DAYS" );
			}
		}
	}
	
	protected function executeComponentWhenNoCache() {
		// Ничего не делаем! В большинстве случаев эту функцию и не нужно модифицировать!
		return false;
	}
	
	protected function executeComponentAnyWay() {
		global $APPLICATION;
		$curPage = $APPLICATION->GetCurPage();
		if (isset($_SESSION['WEBFORMAT']) && 
			isset($_SESSION['WEBFORMAT']['COUPON']) && 
			isset($_SESSION['WEBFORMAT']['COUPON'][$curPage]) &&
			isset($_SESSION['WEBFORMAT']['COUPON'][$curPage]['VALUE']) &&
			isset($_SESSION['WEBFORMAT']['COUPON'][$curPage]['CREATE_TIME']) &&
			($_SESSION['WEBFORMAT']['COUPON'][$curPage]['CREATE_TIME'] + $this->arParams['COUPON_DAYS_LIFE'] * 60 * 60 * 24 > time())
		) {
			$this->arResult['COUPON'] = $_SESSION['WEBFORMAT']['COUPON'][$curPage]['VALUE'];
		} else {
			$_SESSION['WEBFORMAT']['COUPON'][$curPage]['VALUE'] = $this->arResult['COUPON'] = substr(md5(mt_rand() . microtime(true)), 0, 10);
			$_SESSION['WEBFORMAT']['COUPON'][$curPage]['CREATE_TIME'] = time();
		}
	}
	
	protected function extractDataFromCache() {
		global $USER;
        if($this->arParams['CACHE_TYPE'] == 'N') {return false;}
		$importantCacheParams = array(
			// 'USER_GROUPS' => $USER->GetGroups(),
			// 'PAGE_NUMBER' => $_REQUEST['PAGEN_'.$this->arParams['NAV_NUM']]
		);
        return !($this->StartResultCache(false, $importantCacheParams));
    }
	
    protected function putDataToCache() {
        $this->endResultCache();
    }

	protected function abortDataCache() {
        $this->AbortResultCache();
    }
}
}