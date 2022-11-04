<div class="row d-flex justify-content-center">

</div>
<div class="row">
    <div class="d-flex flex-column justify-content-start">

    </div>
</div>
<div class="row add-post">
    <div class="mt-3">
        <form action="/demo/diary/editpost/<?= $_REQUEST["POST_ID"] ?>"
              method="post" class="col-12">
            <div>
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1"
                                      rows="3"><?= $arResult["EL"]["PREVIEW_TEXT"] ?></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button name="btn" type="submit" class="btn btn-primary mt-2 mx-2">
                    Редактировать
                </button>
                <button name="delete" type="submit" class="btn btn-primary mt-2">
                    Удалить
                </button>
            </div>
        </form>
    </div>
</div>