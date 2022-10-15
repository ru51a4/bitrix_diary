<div class="row d-flex justify-content-center">
    <div class="d-flex flex-column col-9 m-4 bg-light">
        <h1 class="display-5 fw-bold"><?=$arResult['DIARY'][0]["name"]?></h1>
        <p class="col-md-8 fs-4">desc</p>
    </div>
</div>
<div class="row">
    <div class="d-flex flex-column justify-content-start">
        <?foreach ($arResult['ITEMS'] as $post):?>
        <div class="col-12 card d-flex flex-row">
            <div class="card-avatar d-flex flex-column justify-content-start">
                <div class="nickname">
                    <b>admin</b>
                    <p class="status">
                        блогер
                    </p>
                </div>
                <img class="avatar" src="http://ufland.moy.su/camera_a.gif">
            </div>
            <div class="card-body diary">
                <div class="card--header">
                </div>
                <p class="card-text"> <?=$post["Fields"]["PREVIEW_TEXT"]?>
                </p>
                <div class="card-bottom">
                    <div style="">
                    </div>
                    <div>
                        <a href="/editpost/1">edit</a>
                    </div>
                </div>
            </div>
        </div>
        <?endforeach;?>
    </div>
</div>
<div class="row add-post">
    <div class="mt-3">
        <form action="/post/1" method="post" class="col-12">
            <div>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1"
                                  rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-2">Добавить</button>
            </div>
        </form>
    </div>
</div>