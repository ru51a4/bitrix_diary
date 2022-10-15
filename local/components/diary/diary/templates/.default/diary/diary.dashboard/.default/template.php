<div class="row">
    <div class="my-4">
        <a href="/forms/blog">
            <button type="submit" class="btn btn-primary">Создать блог</button>
        </a>
    </div>
</div>
<div class="row">
    <div class="d-flex flex-column justify-content-start dashboard">
        <?foreach ($arResult["ITEMS"] as $diary): ?>
        <a href="/demo/diary/<?=$diary["Fields"]["ID"]?>">
            <div class="col-12 card d-flex flex-row">
                <div class="card-avatar d-flex flex-column justify-content-start">
                    <div class="nickname nickname-author">
                        <?
                        $cUSER = CUser::GetByID($diary["Fields"]['MODIFIED_BY']);
                        $cUSER = $cUSER->Fetch();
                        ?>
                        <b><?= $cUSER["LOGIN"] ?></b>
                        <p class="status">
                            Блогер
                        </p></div>
                    <img class="avatar"
                         src="http://ufland.moy.su/camera_a.gif">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?=$diary["Fields"]["NAME"]?></h5>
                    <p class="card-text"><?=$diary["Fields"]["DESCRIPTION"]?></p>
                </div>
            </div>
        </a>
        <?endforeach;?>
    </div>
</div>
<div class="row mt-4">
    <nav aria-label="...">
        <ul class="pagination d-flex justify-content-end pagination-sm">
            <li class="page-item active" aria-current="page">
                <span class="page-link">1</span>
            </li>
        </ul>
    </nav>
</div>