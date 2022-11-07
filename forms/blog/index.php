<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if (strlen($captchaPass) <= 0) {
    $captchaPass = randString(10);
    COption::SetOptionString("main", "captcha_password", $captchaPass);
}
$cpt->SetCodeCrypt($captchaPass);

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
                    <input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
                    <input id="captcha_word" name="captcha_word" type="text">
                    <img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>">
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
                    captcha_word: document.querySelector("input[name='captcha_word']").value,
                    captcha_code: document.querySelector("input[name='captcha_code']").value
                }
            });
            request.then(function (response) {
                window.location.href = `/demo/diary/${response.data.id}`;
            });
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>