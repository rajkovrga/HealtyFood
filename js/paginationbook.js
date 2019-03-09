document.addEventListener("DOMContentLoaded", function () {

    let xt = new XMLHttpRequest();

    xt.open("GET", 'showContents/countBooks.php');

    xt.addEventListener("load", function () {
        let item = document.querySelector("#pagination-div");
        let sumItems = xt.responseText;
        let pageCount = 4;
        let totalPages = Math.floor(sumItems / pageCount);
        item.addEventListener("click", function () {
            let start = document.querySelector(".active-paggination").parentElement.getAttribute("data-start")
            let end = document.querySelector(".active-paggination").parentElement.getAttribute("data-end")

            let xr = new XMLHttpRequest();
            xr.open('POST', '../showContents/showBooks.php');

            xr.addEventListener("load", function () {

                document.getElementById("books").innerHTML = xr.responseText;

            });
            let obj = {
                "start": start,
                "end": end
            };
            xr.send(JSON.stringify(obj));
        });
        pagination(totalPages, 4);
    });
    xt.send();
});