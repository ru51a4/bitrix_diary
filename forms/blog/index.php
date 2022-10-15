<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Название блога</label>
                    <input type="text" class="form-control" name="name" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Описание блога</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                              rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <button type="submit" onclick="addBlog(event)" class="btn btn-primary">Добавить</button>

                </div>
            </div>
        </div>
    </div>
    <script>
        let init = true;
        let addBlog = (event) => {
            if (!init) {
                return;
            }
            init = false;
            var request = BX.ajax.runComponentAction('diary:diary.dashboard', 'add', {
                mode: 'ajax',
                data: {
                    param1: document.querySelector("input[name='name']").value,
                    param2: document.querySelector("textarea[name='description']").value,
                }
            });
            request.then(function (response) {
                window.location.href = `/demo/diary/${response.data.id}`;
            });
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>