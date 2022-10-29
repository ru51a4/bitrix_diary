<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">avatar url:</label>
                    <?GLOBAL $USER;
                    $cUSER = CUser::GetByID($USER->GetID());
                    $cUSER = $cUSER->Fetch();

                    ?>
                    <input type="text" value="<?=$cUSER["UF_AVATAR"]?>" class="form-control" name="avatar" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <button type="submit" onclick="update(event)" class="btn btn-primary">Изменить

                    </button>

                </div>
            </div>
        </div>
    </div>
    <script>
        let init = true;
        let update = (event) => {
            if (!init) {
                return;
            }
            init = false;
            var request = BX.ajax.runComponentAction('diary:diary.dashboard', 'updateuser', {
                mode: 'ajax',
                data: {
                    param1: document.querySelector("input[name='avatar']").value,
                }
            });
            request.then(function (response) {
                window.location.href = `/demo`;
            });
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>