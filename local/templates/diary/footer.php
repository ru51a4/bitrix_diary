<footer class="pt-3 text-muted border-top">
    ru51a4 &copy; 2022
</footer>
</div>
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalzoomimage" src="">
            </div>

        </div>
    </div>
</div>

<script>
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
    }
    function getBg(){
        fetch(`https://wall.alphacoders.com/api2.0/get.php?method=wallpaper_info&id=${getRandomInt(100000,999999)}&auth=5319095c1bc840c137ad33138d7f997f`).then(response => response.json())
            .then((data) => {
                if(data?.wallpaper?.url_thumb){
                    setTimeout(()=>{
                        document.body.style.background = `url('${data.wallpaper.url_thumb}') repeat`;
                    }, 700)
                }else{
                    getBg();
                }
            });
    }
    getBg();

    document.addEventListener("DOMContentLoaded", ()=>{
        document.querySelector("footer").addEventListener('click', event => {
            console.log("asd")
            document.body.style.background = `url(https://thumbs.gfycat.com/PotableEmbarrassedFrenchbulldog-max-1mb.gif) repeat`;
            getBg();
        });

    })


    let cReply = 0;
    let replys = [];
    let zIndex = 999;
    let getCountReply = () => {
        return document.querySelectorAll("span.reply").length;
    }

    function getOffset(el) {
        const rect = el.getBoundingClientRect();
        return {
            left: rect.left + window.scrollX,
            top: rect.top + window.scrollY
        };
    }

    let typeAdd = 0;
    let setEventsReply = (init = false) => {
        $("span.reply").unbind();
        $("span.reply").on("mouseenter", (el) => {
            let id = el.target.getAttribute("id");
            let div = document.createElement("div");
            let clone = replys.find((el) => Number(el.getAttribute("id")) === Number(id));
            if (clone) {
                clone.remove();
                replys = replys.filter((el) => el !== clone);
                cReply = getCountReply();
            }
            replys.push(div);
            div.setAttribute("id", id);
            div.onmouseenter = (el) => {
                while (Number(replys[replys.length - 1].getAttribute("id")) !== Number(el.target.getAttribute("id"))) {
                    replys.pop().remove();
                }
                cReply = getCountReply();
            };
            div.style.position = "absolute";
            div.style.zIndex = zIndex++;
            div.style.backgroundColor = "white";
            div.style.display = "flex";
            div.style.border = "1px solid black";
            div.style.width = "50vw";
            div.innerHTML = document.querySelector(`.btn-reply[id="${id}"]`).parentElement.parentElement.parentElement.innerHTML;
            document.querySelector(".row > .d-flex").insertAdjacentElement("afterbegin", div);
            //1-bottom
            //2-up
            if (typeAdd == 2) {
                typeAdd = 1;
            } else {
                typeAdd++;
            }
            switch (typeAdd) {
                case 1:
                    div.style.left = getOffset(el.target).left + "px";
                    div.style.top = getOffset(el.target).top + "px";
                    break;
                case 2:
                    div.style.left = (replys[replys.length - 1]) ? replys[replys.length - 1].style.left : getOffset(el.target).left + "px";
                    div.style.top = getOffset(el.target).top - div.offsetHeight + "px";
                    break;
            }
            if (cReply !== getCountReply()) {
                cReply = getCountReply();
                setEventsReply();
            }
        })
    };
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.querySelectorAll(".d-flex > .col-12").forEach((el) => {
            el.addEventListener("mouseenter", () => {
                while (replys.length) {
                    replys.pop().remove();
                }
                cReply = getCountReply();
            });
        })
        $(".card-body img").on('click', (image) => {
            $("#modalzoomimage").attr("src", image.target.currentSrc);
            $('#myModal').modal('toggle')
        });
        $(".modal .close").on("click", () => {
            $('#myModal').modal('toggle')
        })
        $(".btn-reply").on("click", (el) => {
            let c = $("textarea").val() + "<reply>" + el.target.getAttribute("id") + "</reply>";
            $("textarea").val(c);
        });
        cReply = getCountReply();
        setEventsReply();
    });
</script>
<style>
    .modal-dialog {
        max-width: max-content !important;
    }

    .modal-body {
        display: flex;
        justify-content: center;
    }
</style>
</body>
</html>
