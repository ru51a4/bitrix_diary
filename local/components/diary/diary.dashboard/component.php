<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult = array();
if (CModule::IncludeModule('iblock')) {
    $arResult['ITEMS'] = array();
    $arFilter = array("IBLOCK_ID" => IntVal(5), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockSection::GetList(array(), $arFilter, false, array(), array());
    while ($ob = $res->GetNextElement()) {
        $arItem['Fields'] = $ob->GetFields();
        $arItem['PROP'] = $ob->GetProperties();
        $arResult["ITEMS"][] = $arItem;
    }

}
$this->IncludeComponentTemplate();