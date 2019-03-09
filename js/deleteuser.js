document.addEventListener("DOMContentLoaded", function () {

    let deleteButton = document.getElementsByClassName("deleteBtn");

    for (let i = 0; i < deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function () {

            let id = deleteButton[i].getAttribute("data-id");
            console.log(id)

            let xr = new XMLHttpRequest();
            xr.open("POST", "edits/deleteuser.php");

            xr.addEventListener("load", function () {


            });
            let obj =
                {
                    "id": id
                };
            xr.send(JSON.stringify(obj));
        });

    }

});