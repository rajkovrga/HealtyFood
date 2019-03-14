document.addEventListener("DOMContentLoaded", function () {

    let deleteButton = document.getElementsByClassName("deleteBtn");

    for (let i = 0; i < deleteButton.length; i++) {
        deleteButton[i].addEventListener("click", function () {
            let id = deleteButton[i].getAttribute("data-id");
            let xr = new XMLHttpRequest();
            xr.open("POST", "edits/deleteuser.php");
            xr.addEventListener("load", function () {
                if (xr.status === 422) {
                    alert("Došlo je do greške")
                } else if (xr.status === 200) {
                    location.assign("users.php")
                } else if (xr.status === 425) {
                    alert("Korisnik kog zelite da obrišete ima neko zaduženje")
                }
            });
            let obj =
                {
                    "id": id
                };
            if (confirm("Da li ste sigurni?")) {
                xr.send(JSON.stringify(obj));
            }

        });

    }

});