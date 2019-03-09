document.addEventListener("DOMContentLoaded", function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    let result = document.getElementById('result');
    document.getElementById("send").addEventListener("click", function () {

        let desc = document.getElementById("descmess");
        let title = document.getElementById("titlemess");

        let regDesc = /^[A-ZČĆŠĐŽ][šđžčća-z0-9A-ZČĆŠĐŽ\,\-\/\'\.\s]{5,}$/;
        let regTitle = /^([A-ZČĆŠĐŽ][A-ZČĆŠĐŽ\s\-\,\.\(\)a-zšđžčć]{2,})$/;

        let resultTitle = regexFind(regTitle, title, "Naslov nije u dobrom formatu");
        let resultDesc = regexFind(regDesc, desc, "Opis nije u dobrom formatu");

        if (resultDesc && resultDesc) {

            let xr = new XMLHttpRequest();

            xr.open("POST", "addContent/send.php");
            xr.addEventListener("load", function () {
                if (xr.status === 200) {
                    result.innerHTML = "Poruka uspešno poslata";
                    title.value = "";
                    desc.value = "";
                } else if (xr.status === 422) {
                    result.innerHTML = "Neki podatak nije u dobrom formatu";
                } else if (xr.status === 402) {
                    result.innerHTML = "Došlo je do greške";
                }
            });
            let obj = {
                "title": title.value,
                "desc": desc.value
            }
            xr.send(JSON.stringify(obj));

        }

    })


});