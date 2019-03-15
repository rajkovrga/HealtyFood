document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("deleteprofile").addEventListener("click", function (e) {
        e.preventDefault();
        let xr2 = new XMLHttpRequest();
        xr2.open("POST", "edits/deleteprofile.php");
        xr2.addEventListener("load", function () {
            if (xr2.status !== 200) {
                alert("Došlo je do greške");
            } else {
             //   location.assign("login.php")
            }
        });
        if (confirm("Da li ste sigurni?")) {
            let obj = {
                "id": this.getAttribute("data-id")
            }
            xr2.send(JSON.stringify(obj));
        }
    });
});