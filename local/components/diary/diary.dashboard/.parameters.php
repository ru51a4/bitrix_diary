<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// проверяем, установлен ли модуль «Информационные блоки»; если да — то подключаем его
if (!CModule::IncludeModule('iblock')) {
    return;
}

/*
 * Получаем массив всех типов инфоблоков — для возможности выбора
 */
$arIBlockType = CIBlockParameters::GetIBlockTypes();

/*
 * Получаем массив инфоблоков — для возможности выбора; фильтруем их по
 * выбранному типу и по активности
 */
$arInfoBlocks = array();
$arFilter = array('ACTIVE' => 'Y');
// если уже выбран тип инфоблока, выбираем инфоблоки только этого типа
if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
$rsIBlock = CIBlock::GetList(
    array('SORT' => 'ASC'),
    $arFilter
);
while($iblock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];
}

/*
 * Настройки компонента
 */
$arComponentParameters = array(
    'GROUPS' => array( // кроме групп по умолчанию, добавляем свою группу настроек
        'SEO_SETTINGS' => array(
            'NAME' => 'Настройки SEO',
            'SORT' => 800
        ),
    ),
    'PARAMETERS' => array(
        // выбор типа инфоблока
        'IBLOCK_TYPE' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Выберите тип инфоблока',
            'TYPE' => 'LIST',
            'VALUES' => $arIBlockType,
            'REFRESH' => 'Y',
        ),
        // выбор самого инфоблока
        'IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Выберите инфоблок',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
        ),
    ),
);

// добавляем еще одну настройку — на случай, если элемент инфоблока не найден
CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);