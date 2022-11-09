<?php

function getUserProfile($userId)
{
    $getStatusName = function ($id) {
        $arFilter = array("IBLOCK_ID" => 6, "ELEMENT_ID" => $id, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, array(), array());
        while ($ob = $res->GetNextElement()) {
            return $ob->GetFields()["NAME"];
        }
    };
    ob_start();
    ?>
    <div class="card-avatar d-flex flex-column justify-content-start">
        <div class="nickname nickname-author">
            <?
            $cUSER = CUser::GetByID($userId);
            $cUSER = $cUSER->Fetch();
            ?>
            <b><?= $cUSER["LOGIN"] ?></b>
            <? if (!$cUSER["UF_STATUS"]): ?>
                <p class="status">
                    Блогер
                </p>
            <? else: ?>
                <? foreach ($cUSER["UF_STATUS"] as $statusId): ?>
                    <p class="status">
                        <?=$getStatusName($statusId);?>
                    </p>
                <? endforeach; ?>
            <? endif; ?>
        </div>
        <img class="avatar"
             src="<?= ($cUSER["UF_AVATAR"]) ? $cUSER["UF_AVATAR"] : "http://ufland.moy.su/camera_a.gif" ?>">
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

function initCaptcha()
{
    include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");
    $cpt = new CCaptcha();
    $captchaPass = COption::GetOptionString("main", "captcha_password", "");
    if (strlen($captchaPass) <= 0) {
        $captchaPass = randString(10);
        COption::SetOptionString("main", "captcha_password", $captchaPass);
    }
    $cpt->SetCodeCrypt($captchaPass);
    return $cpt;
}

class BBCode
{
    public static function replyShit($arr)
    {
        $result = [];
        foreach ($arr as $item) {
            $c = self::lex(htmlspecialchars_decode($item["message"]));
            foreach ($c as $k => $t) {
                if ($t["tag"] == "reply") {
                    $result[$t["t"]][] = $item["id"];
                }
            }
        }
        return $result;
    }

    public static function parseBB($str, $postId = null)
    {
        $result = self::lex(htmlspecialchars_decode($str));
        $generateHTML = function ($arr, $postId) {
            $result = '';
            foreach ($arr as $item) {
                if ($item['tag'] == "img") {
                    $result .= "<img class=\"post_image\" src=" . $item['t'] . ">";
                } else if ($item['tag'] == "b") {
                    $result .= "<b>" . $item['t'] . "</b>";
                } else if ($item["tag"] == "reply") {
                    $result .= '<span id="' . $item['t'] . '" pid="' . $postId . '" class="reply">>>' . $item['t'] . '</span>';
                } else {
                    $result .= $item['t'];
                }
            }
            return str_replace("\n", "<br>", $result);
        };
        return $generateHTML($result, $postId);
    }

    private static function lex($str)
    {
        $result = [];
        $startAttr = false;
        $isOpen = false;
        $t = '';
        $tTag = '';
        for ($i = 0; $i <= strlen($str); $i++) {
            if ($str[$i] == "<") {
                $startAttr = true;
                $isOpen = true;
                if ($str[$i + 1] == "/") {
                    $isOpen = false;
                }
                if (!empty($t)) {
                    $result[] = ["t" => $t, "tag" => $tTag];
                }
                $t = '';
                $tTag = '';
                continue;
            }
            if ($str[$i] == ">") {
                $startAttr = false;
                continue;
            }
            if ($startAttr && $isOpen) {
                $tTag .= $str[$i];
            } else if (!$startAttr) {
                $t .= $str[$i];
            }
        }
        if (!empty($t)) {
            $result[] = ["t" => $t, "tag" => $tTag];
        }
        return $result;
    }

}