document.addEventListener("DOMContentLoaded", function () {

    let xt = new XMLHttpRequest();

     xt.open("GET",'showContents/countRecepts.php');

xt.addEventListener("load",function () {
    let item = document.querySelector("#pagination-div");
    let sumItems = xt.responseText;
    let pageCount = 6;
    let totalPages = Math.ceil(sumItems/pageCount);
        item.addEventListener("click",function () {
            let start = document.querySelector(".active-paggination").parentElement.getAttribute("data-start")
            let end =  document.querySelector(".active-paggination").parentElement.getAttribute("data-end")

            let xr = new XMLHttpRequest();
             xr.open('POST','../showContents/showRecepts.php');

             xr.addEventListener("load",function () {
                document.getElementsByClassName("recepts")[0].innerHTML = xr.responseText;
             });
             let obj = {
                 "start" : start,
                 "end" : end
             };
             xr.send(JSON.stringify(obj));
        });
    pagination(totalPages,6);

});
     xt.send();
});