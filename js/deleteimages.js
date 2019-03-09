document.addEventListener("DOMContentLoaded", function () {

    let buttons = document.getElementsByClassName("deletebutton");

    function refreshFunction() {
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function (e) {
                e.preventDefault();
                let xr = new XMLHttpRequest();
                xr.open("POST", "edits/deleteimg.php");
                xr.addEventListener("load", function () {
                    if (xr.status === 200) {
                        document.getElementsByClassName("small-photos")[0].innerHTML = xr.responseText;
                        refreshFunction();
                        refreshInsert()

                    } else if (xr.status === 408) {
                        document.getElementsByClassName("addresult")[1].innerHTML = xr.responseText;
                    }
                });
                let obj = {
                    "id": buttons[i].getAttribute("data-id"),
                    "receptId": buttons[i].getAttribute("data-receptId")
                };
                xr.send(JSON.stringify(obj));
            });
        }
    }
    refreshFunction();
    refreshInsert()
function refreshInsert()
{
    let regexImg = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    let images = document.getElementById("file-images");
    images.addEventListener("change", function () {
        let p = true;
        for (let i = 0; i < images.files.length; i++) {
            if (!regexImg.test(images.files[i].name)) {
                p = false;
                break;
            }
        }
        if (p === true) {

            for (let i = 0; i < images.files.length; i++) {
                let fmImg = new FormData();
                let xrs = new XMLHttpRequest();
                let detalis = {
                    'id': document.getElementById("imgdelete").getAttribute("data-receptimgid"),
                    'pos': i
                }
                xrs.open('POST', '/addContent/updateimages.php');
                fmImg.append('image' + i, images.files[i]);
                fmImg.append('detalis', JSON.stringify(detalis));
                xrs.addEventListener('load', function () {
                    if(xrs.status === 200)
                    {
                        document.getElementsByClassName("small-photos")[0].innerHTML = xrs.responseText;
                        refreshFunction();
                        refreshInsert()
                    }
                    else if (xrs.status === 400) {
                        document.getElementsByClassName('addresult')[1].innerHTML = "Jedan od fajlova je prevelik";

                    } else if (xrs.status === 406) {
                        document.getElementsByClassName('addresult')[1].innerHTML = "Ekstenzija nekog fajla nije odgovarajuca";

                    }
                })

                xrs.send(fmImg);
            }
        }
        else
        {
            document.getElementsByClassName("addresult")[1].innerHTML = "Neki od fajlova nije u dobrom formatu";
        }



    })
}


});