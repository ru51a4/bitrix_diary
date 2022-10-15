<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult = array();
if (CModule::IncludeModule('iblock')) {
    $arResult['ITEMS'] = array();
    $arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
    //
    $db_list = CIBlockSection::GetList(array(), ["ID" => $arParams["SECTION_ID"]], true);
    $diary = [];
    while ($ar_result = $db_list->GetNext()) {
        $diary["desc"] = $ar_result['DESCRIPTION'];
        $diary["name"] = $ar_result['NAME'];
        $diary["author"] = $arResult["CREATED_BY"];
        $arResult['DIARY'][] = $diary;
    }
    ///
    $arFilter = array("IBLOCK_SECTION_ID" => $arParams["SECTION_ID"]);
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());

    while ($ob = $res->GetNextElement()) {
        $arItem['Fields'] = $ob->GetFields();
        $arItem['PROP'] = $ob->GetProperties();
        $arResult["ITEMS"][] = $arItem;
    }
    $arResult["REPLY"] = \BBCode::replyShit(array_map(function ($item) {
        return ["id" => $item["Fields"]["ID"], "message" => $item["Fields"]["PREVIEW_TEXT"]];
    }, $arResult["ITEMS"]));
    $arResult["ITEMS"] = array_map(function ($item) {
        $item["Fields"]['PREVIEW_TEXT'] = \BBCode::parseBB($item["Fields"]["PREVIEW_TEXT"]);
        return $item;
    }, $arResult["ITEMS"]);

}
$this->IncludeComponentTemplate();