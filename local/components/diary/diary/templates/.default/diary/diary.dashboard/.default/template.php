<div class="row">
    <div class="my-4">
        <a href="/forms/blog">
            <button type="submit" class="btn btn-primary">Создать блог</button>
        </a>
    </div>
</div>
<div class="row">
    <div class="d-flex flex-column justify-content-start dashboard">
        <? foreach ($arResult["ITEMS"] as $diary): ?>
            <a href="/demo/diary/<?= $diary["Fields"]["ID"] ?>">
                <div class="col-12 card d-flex flex-row">
                    <?=getUserProfile($diary["Fields"]['MODIFIED_BY']);?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $diary["Fields"]["NAME"] ?></h5>
                        <p class="card-text"><?= $diary["Fields"]["DESCRIPTION"] ?></p>
                    </div>
                </div>
            </a>
        <? endforeach; ?>
    </div>
</div>
<div class="row mt-4">
    <nav aria-label="...">
        <ul class="pagination d-flex justify-content-end pagination-sm">
            <? if ($_REQUEST["PAGE_ID"] - 1 >= 1): ?>
                <a href="/demo/dashboard/<?= $_REQUEST["PAGE_ID"] - 1 ?>">
                    <li class="page-item" aria-current="page">
                        <span class="page-link">prev</span>
                    </li>
                </a>
            <? endif; ?>
            <li class="page-item mx-2 active" aria-current="page">
                <span class="page-link"><?= $_REQUEST["PAGE_ID"] ?></span>
            </li>
            <? if ($_REQUEST["PAGE_ID"] + 1 <= ceil($arResult["COUNT_PAGES"] / 5)): ?>
                <a href="/demo/dashboard/<?= $_REQUEST["PAGE_ID"] + 1 ?>">
                    <li class="page-item" aria-current="page">
                        <span class="page-link">next</span>
                    </li>
                </a>
            <? endif; ?>
        </ul>
    </nav>
</div>