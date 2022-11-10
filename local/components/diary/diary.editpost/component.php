<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult = array();
if (CModule::IncludeModule('iblock')) {


    $arFilter = array("IBLOCK_ID" => 5, "ID" => intval($_REQUEST["POST_ID"]));
    $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
    while ($ob = $res->GetNextElement()) {
        $arItem = $ob->GetFields();
        $arItem['PROP'] = $ob->GetProperties();
        $arResult["EL"] = $arItem;
        $sectionId = $arResult["EL"]["IBLOCK_SECTION_ID"];
        $is_op = $arResult["EL"]["PROP"]["IS_OP"]["VALUE"];
        $arResult["is_op"] = $is_op;
    }

    global $USER;
    if ($arResult["EL"]["MODIFIED_BY"] == $USER->GetID()) {
        if (isset($_REQUEST["delete"])) {
            CIBlockElement::Delete(intval($_REQUEST["POST_ID"]));
            $count = CIBlockSection::GetSectionElementsCount($sectionId, []);
            if ($count == 0 || $is_op == 1) {
                //delete all elements
                $arFilter = array("IBLOCK_SECTION_ID" => $arParams["SECTION_ID"]);
                $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
                while ($ob = $res->GetNextElement()) {
                    CIBlockElement::Delete($ob->GetFields()["ID"]);
                }
                //
                CIBlockSection::Delete($sectionId);
                header('Location: /demo/', true, 301);
            } else {
                header('Location: /demo/diary/' . $sectionId, true, 301);
            }
        } else if ($_REQUEST["message"]) {
            $el = new CIBlockElement;
            $arLoadProductArray = array(
                "PREVIEW_TEXT" => $_REQUEST["message"],
            );
            $PRODUCT_ID = intval($_REQUEST["POST_ID"]);
            $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
            header('Location: /demo/diary/' . $sectionId, true, 301);
        }
    }

}
$this->IncludeComponentTemplate();