<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if ($arParams['SEF_MODE'] == 'Y') {
    /*
     * Если включен режим поддержки ЧПУ
     */

    // В этой переменной будем накапливать значения истинных переменных
    $arVariables = array();


    // Определим имя файла (popular, section, element), которому соответствует текущая запрошенная
    // страница. Кроме того, восстанавим те переменные, которые были заданы с помощью шаблона.
    $componentPage = CComponentEngine::ParseComponentPath(
        $arParams['SEF_FOLDER'],
        $arParams['SEF_URL_TEMPLATES'],
        $arVariables // переменная передается по ссылке
    );

    // Метод выше не обрабатывает случай, когда шаблон пути равен пустой строке,
    // (например 'popular' => ''), поэтому делаем это сами
    if ($componentPage === false && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == $arParams['SEF_FOLDER']) {
        $componentPage = 'dashboard';
    }

    // Если определить файл шаблона не удалось, показываем  страницу 404 Not Found


    /*
     * Метод служит для поддержки псевдонимов переменных в комплексных компонентах. Восстанавливает
     * истинные переменные из $_REQUEST на основании их псевдонимов из $arParams['VARIABLE_ALIASES'].
     */
    CComponentEngine::InitComponentVariables(
        $componentPage,
        null,
        array(),
        $arVariables
    );

    $arResult['VARIABLES'] = $arVariables;
    $arResult['FOLDER'] = $arParams['SEF_FOLDER'];
    $arResult['SECTION_URL'] = $arParams['SEF_FOLDER'] . $arParams['SEF_URL_TEMPLATES']['section'];
    $arResult['ELEMENT_URL'] = $arParams['SEF_FOLDER'] . $arParams['SEF_URL_TEMPLATES']['element'];

}

$this->IncludeComponentTemplate($componentPage);

?>