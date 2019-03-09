document.addEventListener("DOMContentLoaded", function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    let oldTitle = document.getElementById("recept-title").value;

    document.getElementById("editrecept").addEventListener("click", function () {

        let receptTitle = document.getElementById("recept-title");
        let regTitle = /^([A-ZČĆŠĐŽ][\s\-\,\.a-zšđžčć]{2,100})$/;
        let titleResult = regexFind(regTitle, receptTitle, " Naslov recepta nije u dobrom formatu ")

        let regDesc = /^[A-ZČĆŠĐŽ][šđžčća-z\(\)0-9A-Z\,\-\/\'\.\s]{5,}$/;
        let receptDesc = document.getElementById("recept-desc");
        let descResult = regexFind(regDesc, receptDesc, "Nije dobar opis");

        let regElements = /^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z\,\-\/\'\.\s]{5,}$/;
        let receptElements = document.getElementById("recept-elements");
        let elementsResult = regexFind(regElements, receptElements, "Tekst elemenata nije dobar")

        if (titleResult && descResult && elementsResult) {
            let xr = new XMLHttpRequest();
            xr.open('POST', '/edits/editrecept.php');
            let fm = new FormData();
            let obj = {
                "title": receptTitle.value,
                "oldTitle": oldTitle,
                "desc": receptDesc.value,
                "elements": receptElements.value,
                "id": this.getAttribute("data-id")
            };
            xr.addEventListener("load", function () {
                let result = xr.responseText;
                if (xr.status === 200) {
                    location.assign("recept.php?ID=" + result);
                } else if (xr.status === 401) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Dogodila se greska, pokusati kasnije";
                } else if (xr.status === 403) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Neki podatak nije u dobrom formatu";
                } else if (xr.status === 402) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Objava sa ovim imenom vec postoji";
                }
            })
            fm.append('recept', JSON.stringify(obj));
            xr.send(fm);
        }
    });


});