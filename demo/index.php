<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


if (!$USER->IsAuthorized()) {
    header('Location: /login', true, 301);

}
?><? $APPLICATION->IncludeComponent(
    "diary:diary",
    "",
    array(
        "SEF_FOLDER" => "/demo/",
        "SEF_MODE" => "Y",
        "SEF_URL_TEMPLATES" => array(
            "dashboard" => "dashboard/#PAGE_ID#",
            "posts" => "diary/#SECTION_ID#",
            "editpost" => "diary/editpost/#POST_ID#",
        ),
    )
); ?><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>