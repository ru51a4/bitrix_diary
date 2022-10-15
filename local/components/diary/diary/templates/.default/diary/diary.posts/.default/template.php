<div class="row d-flex justify-content-center">
    <div class="d-flex flex-column col-9 m-4 bg-light">
        <h1 class="display-5 fw-bold"><?= $arResult['DIARY'][0]["name"] ?></h1>
        <p class="col-md-8 fs-4"><?= $arResult['DIARY'][0]["desc"] ?></p>
    </div>
</div>
<div class="row">
    <div class="d-flex flex-column justify-content-start">
        <? foreach ($arResult['ITEMS'] as $post): ?>
            <div class="col-12 card d-flex flex-row">
                <div class="card-avatar d-flex flex-column justify-content-start">
                    <div class="nickname">
                        <?
                        $cUSER = CUser::GetByID($post["Fields"]['MODIFIED_BY']);
                        $cUSER = $cUSER->Fetch();
                        ?>
                        <b><?= $cUSER["LOGIN"] ?></b>
                        <p class="status">
                            блогер
                        </p>
                    </div>
                    <img class="avatar" src="http://ufland.moy.su/camera_a.gif">
                </div>
                <div class="card-body diary">
                    <div class="card--header">
                        <button id="<?= $post["Fields"]["ID"] ?>"
                                style=" font-size: 10px; padding: 0px; max-height: 25px;"
                                class="btn btn-primary btn-reply">>><?= $post["Fields"]["ID"] ?></button>
                    </div>
                    <p class="card-text"> <?= $post["Fields"]["PREVIEW_TEXT"] ?>
                    </p>
                    <div class="card-bottom">
                        <div style="">
                            <? if (isset($post["Fields"]["REPLY"])): ?>
                                <? foreach ($arResult["REPLY"][$post["Fields"]["ID"]] as $reply):?>
                                    <span style="background-color: unset!important; color: #FF6600;"
                                          pid="<?= $post["Fields"]["ID"] ?>" id="<?= $reply ?>"
                                          class="reply">>><?= $reply ?></span>
                                <?endforeach; ?>
                            <? endif ?>
                        </div>
                        <div>
                            <a href="/editpost/1">edit</a>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
<? if ($USER->IsAuthorized()): ?>
    <div class="row add-post">
        <div class="mt-3">
            <div>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1"
                                  rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" onclick="add(event)" class="btn btn-primary mt-2">Добавить</button>
            </div>
        </div>
    </div>
<? endif; ?>
<script>


    function add(event) {
        var request = BX.ajax.runComponentAction('diary:diary.posts', 'add', {
            mode: 'ajax',
            data: {
                param1: document.querySelector("textarea").value,
                param2: <?=$arParams["SECTION_ID"]?>
            }
        });
        request.then(function (response) {
            location.reload();
        });
    }

</script>