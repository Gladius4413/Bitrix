<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(isset($arParams['SET_SPECIALDATE']) && $arParams['SET_SPECIALDATE'] =='Y'){
	$this->GetComponent()->setResultCacheKeys(array('SPECIALDATE'));
	$arResult['SPECIALDATE'] = $arResult['ITEMS'][0]['ACTIVE_FROM'];
}
