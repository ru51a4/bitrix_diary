<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult = array();
if (CModule::IncludeModule('iblock')) {

    $arResult['ITEMS'] = array();
    $arFilter = array("IBLOCK_ID" => IntVal(5), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockSection::GetList(array(), $arFilter, false, array(), ["iNumPage" => $_REQUEST["PAGE_ID"], "nPageSize" => 5]);
    $arResult["COUNT_PAGES"] = CIBlockSection::GetCount([
        "IBLOCK_ID" => 5,
        "DEPTH_LEVEL" => 1
    ]);
    if (!isset($_REQUEST["PAGE_ID"])) {
        $_REQUEST["PAGE_ID"] = 1;
    } else {
        $_REQUEST["PAGE_ID"] = intval($_REQUEST["PAGE_ID"]);
    }
    while ($ob = $res->GetNextElement()) {
        $arItem['Fields'] = $ob->GetFields();
        $arItem['PROP'] = $ob->GetProperties();
        $arResult["ITEMS"][] = $arItem;
    }

}
$this->IncludeComponentTemplate();