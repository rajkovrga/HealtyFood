document.addEventListener('DOMContentLoaded', function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();

    $("#pass-result").hide();
    document.getElementById('save').addEventListener('click', function (e) {
        e.preventDefault();

        let regUsername = /^[a-zšđžčćA-ZČĆŠĐŽ0-9_-]{3,15}$/;
        var username = document.getElementById('useredit');
        let usernameResult = regexFind(regUsername, username, "Korisnicko ime nije u dobrom formatu");

        let regDesc = /^([A-ZČĆŠĐŽ][a-zšđžčć0-9A-ZČĆŠĐŽ,-/'.\s]{0,490})$/;
        let desc = document.getElementById('desc-val');
        let descResult = regexFind(regDesc, desc, "Opis nije u dobrom formatu");

        let file = document.getElementById('file');
        let regFile = /([ČĆŠĐŽa-zA-Z0-9\s_\\.\-\(\):])+(.gif|.png|.jpeg|.jpg)$/i;
        let fileResult = regexFile(regFile, file, 0, "Fajl nije u dobrom formatu");
        if ((descResult || desc.value === "") && usernameResult && (fileResult || file.value === "")) {

            let xr = new XMLHttpRequest();
            xr.open('POST', 'edits/editprofile.php');
            xr.addEventListener('load', function () {
                if (xr.status == 200) {
                    window.location.assign("http://localhost:5501/profile.php")
                } else {
                    alert("Došlo je do greške")
                }

            })
            let fm = new FormData();
            if (file.files[0]) {
                fm.append('file', file.files[0])
            }
            let obj = {
                "desc": desc.value,
                "username": username.value
            };
            fm.append('json', JSON.stringify(obj));
            xr.send(fm);
        }

    });
    document.getElementById("deleteprofile").addEventListener("click", function (e) {
        e.preventDefault();
        let xr2 = new XMLHttpRequest();
        xr2.open("POST", "edits/deleteprofile.php");
        xr2.addEventListener("load", function () {
            if (xr2.status !== 200) {
                alert("Došlo je do greške");
            } else {
                location.assign("login.php")
            }
        });
        if (confirm("Da li ste sigurni?")) {
            let obj = {
                "id": this.getAttribute("data-id")
            }
            xr2.send(JSON.stringify(obj));
        }
    });


    document.getElementById("deleteprofileimg").addEventListener("click", function (e) {

        e.preventDefault();
        let xr2 = new XMLHttpRequest();
        xr2.open("POST", "edits/deleteprofileimage.php");
        xr2.addEventListener("load", function () {
            if (xr2.status !== 200) {
                alert("Došlo je do greške");
            } else {
                location.assign("editprofile.php")
            }
        });
        if (confirm("Da li ste sigurni?")) {
            xr2.send();
        }

    });
    let num = 0;
    document.getElementById("password-button").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("changepassword-box").classList.remove("d-none");
        document.getElementById("changepassword-box").classList.add("d-flex");
        num += 1;
        $("#pass-result").show();
        if (num >= 2) {
            let regPass = /^(?=.*[\d])(?=.*[A-ZČĆŠĐŽ])(?=.*[a-zšđžčć])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/;
            let oldPassword = document.getElementById("oldpassword");
            let newPassword = document.getElementById("newpassword");
            let againPassword = document.getElementById("confirmpassword");

            if ((newPassword.value !== againPassword.value) || newPassword.value.length === 0 || againPassword.value.length === 0) {
                $("#pass-result").text("Lozinke nisu u redu");
            } else if (!regPass.test(newPassword.value) || !regPass.test(oldPassword.value) || oldPassword.value === newPassword.value) {
                $("#pass-result").text("Lozinke nisu u dobrom formatu");
            } else {
                let xr = new XMLHttpRequest();
                xr.open("POST", "edits/changepassword.php");
                xr.addEventListener("load", function () {
                    if (xr.status === 200) {
                        $("#pass-result").text("Uspešno promenjena lozinka");
                        oldPassword.value = "";
                        newPassword.value = "";
                        againPassword.value = "";
                    } else if (xr.status === 400) {
                        $("#pass-result").text("Došlo je do greške");
                    } else if (xr.status === 422) {
                        $("#pass-result").text("Lozinke nisu u dobrom formatu");
                    } else if (xr.status === 401) {
                        $("#pass-result").text("Stara lozinka nije u redu");
                    }


                })

                let obj = {
                    "new": newPassword.value,
                    "old": oldPassword.value
                }
                xr.send(JSON.stringify(obj));

            }

        }


    });


});