document.addEventListener("DOMContentLoaded", function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    document.getElementById("addbook").addEventListener("click", function () {

        let regBookTitle = /^([A-ZČĆŠĐŽ][A-ZČĆŠĐŽ\s\-\,\.\(\)a-zšđžčć]{2,})$/;
        let bookTitle = document.getElementById('titlebook');
        let bookTitleResult = regexFind(regBookTitle, bookTitle, "Naslov nije u dobrom formatu");

        let regBookDesc = /^[A-ZČĆŠĐŽ][šđžčća-z0-9A-ZČĆŠĐŽ\,\-\/\'\.\s]{5,}$/;

        let bookDesc = document.getElementById('descbook');
        let bookDescResult = regexFind(regBookDesc, bookDesc, "Opis nije u dobrom formatu");

        let fileBook = document.getElementById('bookfile');
        let regFile = /(\.pdf)$/i;
        let fileResult = regexFile(regFile, fileBook, 0, "Fajl nije u dobrom formatu");
        let size = 0;

        if(fileBook.size > 21715200)
        {
            size = 1;
            alert("FAJL JE PREVELIK")
        }


        if (bookTitleResult && bookDescResult && fileResult && size === 0) {
            let xr = new XMLHttpRequest();
            xr.open('POST', '/addContent/addbook.php');
            let fm = new FormData();
            if (fileBook.files[0]) {
                fm.append('book', fileBook.files[0])
            }
            let obj = {
                "desc": bookDesc.value,
                "titleBook": bookTitle.value
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

    document.getElementById("addrecept").addEventListener("click", function () {

        let receptTitle = document.getElementById("recept-title");
        let regTitle = /^([A-ZČĆŠĐŽ][\s\-\,\.a-zšđžčć]{2,100})$/;
        let titleResult = regexFind(regTitle, receptTitle, " Naslov recepta nije u dobrom formatu ")

        let regDesc = /^[A-ZČĆŠĐŽ][šđžčća-z\(\)0-9A-Z\,\-\/\'\.\s]{5,}$/;
        let receptDesc = document.getElementById("recept-desc");
        let descResult = regexFind(regDesc, receptDesc, "Nije dobar opis");

        let regElements = /^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z\,\-\/\'\.\s]{5,}$/;
        let receptElements = document.getElementById("recept-elements");
        let elementsResult = regexFind(regElements, receptElements, "Tekst elemenata nije dobar")


        let receptImages = document.getElementById("recept-images");
        let regFileRec = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        let numImgs = 0;
        let fileResult = emptyFiles(receptImages, "Unesite slike");
        console.log(fileResult);
        for (let i = 0; i < receptImages.files.length; i++) {
            if (findExtensions(regFileRec, receptImages, i)) {
                numImgs = 1;
                break;
            }
        }

        if (titleResult && descResult && elementsResult && numImgs === 0 && fileResult) {
            let xr = new XMLHttpRequest();
            xr.open('POST', '/addContent/addrecept.php');
            let fm = new FormData();
            let obj = {
                "title": receptTitle.value,
                "desc": receptDesc.value,
                "elements": receptElements.value
            };
            fm.append('recept', JSON.stringify(obj));

            xr.addEventListener('load', function () {
                document.getElementsByClassName('addresult')[1].innerHTML = "";

                if (xr.status === 200) {
                    console.log("TU")
                    for (let i = 0; i < receptImages.files.length; i++) {
                        let fmImg = new FormData();
                        let xrs = new XMLHttpRequest();
                        let detalis = {
                            'name': receptTitle.value,
                            'pos': i
                        }
                        xrs.open('POST', '/addContent/addreceptimage.php');
                        fmImg.append('image' + i, receptImages.files[i]);
                        fmImg.append('detalis', JSON.stringify(detalis));

                        xrs.addEventListener('load', function () {

                            if (xrs.status === 400) {
                                document.getElementsByClassName('addresult')[0].innerHTML = "Jedan od fajlova je prevelik";

                            } else if (xrs.status === 406) {
                                document.getElementsByClassName('addresult')[0].innerHTML = "Ekstenzija nekog fajla nije odgovarajuca";

                            }

                        })

                        xrs.send(fmImg);

                    }
                    receptTitle.value = "";
                    receptDesc.value = "";
                    receptElements.value = "";
                    receptImages.value = "";
                    window.location.assign("recepts.php")

                } else if (xr.status === 401) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Dogodila se greska, pokusati kasnije";
                } else if (xr.status === 403) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Neki podatak nije u dobrom formatu";
                } else if (xr.status === 402) {
                    document.getElementsByClassName('addresult')[0].innerHTML = "Objava sa ovim imenom vec postoji";
                }

            })

            xr.send(fm);

        }
    });

    

});