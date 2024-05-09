<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

echo '<pre>'.htmlspecialchars(print_r($arResult, true)).'<pre>';

file_put_contents(__dir__.'/1.txt', print_r($arResult, true), FILE_APPEND);

global $APPLICATION;

global $USER;