<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Controller;

class DiaryAjaxController extends Controller
{
    /**
     * @return array
     */
    public function configureActions()
    {
        return [
            'add' => [
                'prefilters' => []
            ]
        ];
    }

    /**
     * @param string $param2
     * @param string $param1
     * @return array
     */
    public static function addAction($param2 = '', $param1 = '')
    {

        \Bitrix\Main\Loader::includeModule('iblock');

        $bs = new CIBlockSection;
        $arFields = array(
            "ACTIVE" => "Y",
            "IBLOCK_ID" => 5,
            "NAME" => $param1,
            "DESCRIPTION" => $param2,
        );
        $ID = $bs->Add($arFields);


        $text = "init diary";
        $el = new \CIBlockElement;

        $PROP = array();
        global $USER;
        $arLoadProductArray = array(
            "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION_ID" => $ID,          // элемент лежит в корне раздела
            "IBLOCK_ID" => 5,
            "PROPERTY_VALUES" => $PROP,
            "NAME" => "Элемент",
            "ACTIVE" => "Y",            // активен
            "PREVIEW_TEXT" => $text,
            "DETAIL_TEXT" => "",
        );

        $el->Add($arLoadProductArray);
        return ["id" => $ID];
    }

}