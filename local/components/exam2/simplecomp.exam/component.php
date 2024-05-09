<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if($this->StartResultCache()){
	if(!$iblockProd = (int)$arParams['PRODUCTS_IBLOCK_ID']) return false;
	if(!$iblockNews = (int)$arParams['NEWS_IBLOCK_ID']) return false;
	if(!$propCode = trim($arParams['PROPERTY_CODE'])) return false;
	
	
	$arNews = array();
	$arNewsId = array();
	
	$obNews = CIBlockElement::GetList(
	array(),
	array('IBLOCK_ID' => $arParams['NEWS_IBLOCK_ID'], 'ACTIVE' => 'Y'),
	false,
	false,
	array('NAME', 'DATE_ACTIVE_FROM','ID')

);
	
	
	while($newsElements = $obNews->Fetch()){
		$arNewsId[] = $newsElements["ID"];
		$arNews[$newsElements["ID"]] = $newsElements;
		
		
	}
	
	
	
	$arSections= array();
	$arSectionsId= array();
	
	$obSection = CIBlockElement::GetList(
	array(),
	array('IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'], 'ACTIVE', $arParams['PROPERTY_CODE'] => $arNewsId),
	false,
	false,
	array('NAME', 'IBLOCK_ID','ID', $arParams['PROPERTY_CODE'])

);
	
	
	while($arSectionCatalog = $obSection->Fetch()){
		$arSectionsId[] = $arSectionCatalog["ID"];
		$arSections[$arSectionCatalog["ID"]] = $arSectionCatalog;
		
		
	}
	
	
	
	$obProduct = CIBlockElement::GetList(
	array(),
	array('IBLOCK_ID' => $arParams['PRODUCTS_IBLOCK_ID'], 'ACTIVE' => 'Y', 'SECTION_ID' => $arSectionsId ),
	false,
	false,
	array('NAME', 'IBLOCK_SECTION_ID','ID', 'IBLOCK_ID','PROPERTY_ARTNUMBER','PROPERTY_MATERIAL','PROPERTY_PRICE')

);
	$arResult['PRODUCT_CNT'] = 0;;
	while($arProduct = $obProduct->Fetch()){
		$arResult['PRODUCT_CNT'] ++;
		foreach($arSections[$arProduct['IBLOCK_SECTION_ID']][$arParams['PROPERTY_CODE']] as $newsId){
			$arNews[$newsId]['PRODUCT'][] = $arProduct;
		}
		
		
	}
	echo '<pre>'.htmlspecialchars(print_r($arSections['NAME'], true)).'<pre>';
	foreach($arSections as $arSection){
			$arResult['PRODUCT_CNT'] += $arSection['ELEMENT_CNT'];
			foreach($arSections[$arParams['PROPERTY_CODE']] as $newsId){
				$arNews['NEWS'][$newsId]['SECTIONS'] = $arSection['NAME'];
				
		}
		
	}
	
	$arResult['NEWS'] = $arNews;
	
	
	
	$this->SetResultCacheKeys(array('PRODUCT_CNT'));
	$this->includeComponentTemplate();
	
	
}
$APPLICATION->setTitle(GetMessage('SET_TITLE').$arResult['COUNT_PRODUCTS']);
?>