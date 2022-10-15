<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// проверяем, установлен ли модуль «Информационные блоки»; если да — то подключаем его
if (!CModule::IncludeModule('iblock')) {
    return;
}
/*
 * Настройки комлексного компонента
 */
$arComponentParameters = array( // кроме групп по умолчанию, добавляем свои группы настроек
    'PARAMETERS' => array(
        'SEF_MODE' => array( // это для работы в режиме ЧПУ
        'dashboard' => array(
            'NAME' => 'Главная страница',
            'DEFAULT' => '#SECTION_ID#',
        ),
        'posts' => array(
            'NAME' => 'Страница раздела',
            'DEFAULT' => '/diary/#SECTION_ID#',
        ),
    ),
        ),

);


?>