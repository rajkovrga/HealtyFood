document.addEventListener("DOMContentLoaded", function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();

    document.getElementById("editbook").addEventListener("click", function () {

        let regBookTitle = /^([A-ZČĆŠĐŽ][A-ZČĆŠĐŽ\s\-\,\.\(\)a-zšđžčć]{2,})$/;
        let bookTitle = document.getElementById('titlebook');
        let bookTitleResult = regexFind(regBookTitle, bookTitle, "Naslov nije u dobrom formatu")
        let regBookDesc = /^[A-ZČĆŠĐŽ][šđžčća-z0-9A-ZČĆŠĐŽ\,\-\/\'\.\s]{5,}$/;

        let bookDesc = document.getElementById('descbook');
        let bookDescResult = regexFind(regBookDesc, bookDesc, "Opis nije u dobrom formatu");

        let fileBook = document.getElementById('bookfile');
        let regFile = /(\.pdf)$/i;
        let fileExist = 0;


        if(fileBook.files.length !== 0)
        {
            fileExist = 1;
        }

        let size = 0;

        if (fileBook.size > 21715200) {
            size = 1;
            alert("FAJL JE PREVELIK")
        }


        if (bookTitleResult && bookDescResult && ((fileExist === 0) || (regexFile(regFile, fileBook, 0, "Fajl nije u dobrom formatu") && size === 0))) {
            let xr = new XMLHttpRequest();
            xr.open('POST', '/edits/editbook.php');
            let fm = new FormData();
            if (fileBook.files[0]) {
                fm.append('book', fileBook.files[0])
            }
            let obj = {
                "desc": bookDesc.value,
                "titleBook": bookTitle.value,
                "id": this.getAttribute("data-id")
            };
            fm.append('json', JSON.stringify(obj));

            xr.addEventListener('load', function () {
                if (xr.status === 200) {
                  window.location.assign("books.php")
                } else if (xr.status === 400) {
                    document.getElementsByClassName('addresult')[1].innerHTML = "Neki podatak nije u dobrom formatu";
                } else if (xr.status === 401) {
                    document.getElementsByClassName('addresult')[1].innerHTML = "Fajl je prevelik";
                } else if (xr.status === 402) {
                    document.getElementsByClassName('addresult')[1].innerHTML = "Format fajla nije dobar";
                }
            })
            xr.send(fm);


        }

    });
});