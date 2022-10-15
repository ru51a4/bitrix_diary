<?php
$arUrlRewrite = array(
    3 =>
        array(
            'CONDITION' => '#^/demo/diary/([0-9]+)#',
            'RULE' => 'SECTION_ID=\\$1',
            'ID' => 'diary.diary',
            'PATH' => '/demo/index.php',
            'SORT' => 100,
        ),
    4 =>
        array(
            'CONDITION' => '#^/forms/posts/([0-9]+)#',
            'RULE' => 'SECTION_ID=\\$1',
            'PATH' => '/forms/posts/index.php',
            'SORT' => 100,
        ),
    0 =>
        array(
            'CONDITION' => '#^/services/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/services/index.php',
            'SORT' => 100,
        ),
    1 =>
        array(
            'CONDITION' => '#^/products/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/products/index.php',
            'SORT' => 100,
        ),
    2 =>
        array(
            'CONDITION' => '#^/news/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/news/index.php',
            'SORT' => 100,
        ),
);
