<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Controller;

class PostAjaxController extends Controller
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
        $text = htmlspecialchars_decode($param1);
        \Bitrix\Main\Loader::includeModule('iblock');
        $el = new \CIBlockElement;

        $PROP = array();
        Global $USER;
        $arLoadProductArray = Array(
            "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
            "IBLOCK_SECTION_ID" => $param2,          // элемент лежит в корне раздела
            "IBLOCK_ID"      => 5,
            "PROPERTY_VALUES"=> $PROP,
            "NAME"           => "Элемент",
            "ACTIVE"         => "Y",            // активен
            "PREVIEW_TEXT"   => $text,
            "DETAIL_TEXT"    => "",
        );

        $el->Add($arLoadProductArray);
        return "succsess";
    }

}