<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


if (!$USER->IsAuthorized()) {
    header('Location: /login', true, 301);

}
?><? $APPLICATION->IncludeComponent(
    "diary:diary.editpost",
    "",
    array(
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/forms/posts/",
        "SEF_URL_TEMPLATES" => array(
            "posts" => "/#POST_ID#",
        ),
    )
); ?><?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>