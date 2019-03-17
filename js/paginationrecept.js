document.addEventListener("DOMContentLoaded", function () {
    let item = document.querySelector("#pagination-div");
    let start = 0;
    let end = 6;
    let r = 0;
    showRecept(start, end)

    function showRecept(start = 0, end = 6) {


        let xr = new XMLHttpRequest();
        xr.open("POST", "../showContents/showRecepts.php");
        xr.addEventListener("load", function () {
            let returnObj = JSON.parse(xr.responseText)
            if (r === 0) {
                pagination(Math.ceil(returnObj.countItems / 6), 6);
                r = 1;
            }
            function debounce(time, fn) {
                let interval = null;
                return e => {
                    clearTimeout(interval);
                    interval = setTimeout(() => fn(e), time);
                };
            }

            let search = debounce(1100, function (e) {
                if (r === 1) {
                    showRecept();
                    r = 0;
                }

                e.preventDefault();
            });

            document.getElementsByClassName("search-box")[0].addEventListener("input", search)
            document.getElementsByClassName("recepts")[0].innerHTML = returnObj.result;

            if(returnObj.result === "")
            {
                document.getElementsByClassName("recepts")[0].innerHTML += `
                            <div class="col-12 no-result text-center d-flex flex-column
                            justify-content-center align-items-center">
                            <i class="fa fa-ban no-result-icon" aria-hidden="true"></i>

                            <p id="no-result-text">Nema rezultata</p></div>

                            `;
            }

            itemListener()


        });
        let obj = {
            "start": start,
            "end": end,
            "like": document.getElementsByClassName("search-box")[0].value
        };
        xr.send(JSON.stringify(obj));
    }
    itemListener()
    function itemListener()
    {

        item.addEventListener("click", function (e) {
            let starte = document.querySelector(".active-paggination").parentElement.getAttribute("data-start")
            let ende = document.querySelector(".active-paggination").parentElement.getAttribute("data-end")
            showRecept(starte, ende);
            e.preventDefault();
            e.stopImmediatePropagation();
        })
    }


})