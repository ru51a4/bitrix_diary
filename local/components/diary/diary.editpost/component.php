<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arResult = array();
if (CModule::IncludeModule('iblock')) {
    $el = CIBlockElement::GetByID(intval($_REQUEST["POST_ID"]));
    if ($ar_res = $el->GetNext()) {
        $arResult["EL"] = $ar_res;
        $sectionId = $arResult["EL"]["IBLOCK_SECTION_ID"];
    }
    global $USER;
    if ($arResult["EL"]["MODIFIED_BY"] == $USER->GetID()) {

        if (isset($_REQUEST["delete"])) {
            CIBlockElement::Delete(intval($_REQUEST["POST_ID"]));
            $count = CIBlockSection::GetSectionElementsCount($sectionId, []);
            if ($count == 0) {
                CIBlockSection::Delete($sectionId);
                header('Location: /demo/', true, 301);
            } else {
                header('Location: /demo/diary/' . $arResult["EL"]["IBLOCK_SECTION_ID"], true, 301);
            }
        } else if ($_REQUEST["message"]) {
            $el = new CIBlockElement;
            $arLoadProductArray = array(
                "PREVIEW_TEXT" => $_REQUEST["message"],
            );
            $PRODUCT_ID = intval($_REQUEST["POST_ID"]);
            $res = $el->Update($PRODUCT_ID, $arLoadProductArray);
            header('Location: /demo/diary/' . $arResult["EL"]["IBLOCK_SECTION_ID"], true, 301);
        }
    }

}
$this->IncludeComponentTemplate();