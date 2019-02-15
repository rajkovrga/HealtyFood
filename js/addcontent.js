document.addEventListener("DOMContentLoaded", function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    document.getElementById("addbook").addEventListener("click", function () {

        let regBookTitle = /^([A-ZČĆŠĐŽ][\s\-,.A-ZČĆŠĐŽa-zšđžčć]{2,100})$/;
        let bookTitle = document.getElementById('titlebook');
        let bookTitleResult = regexFind(regBookTitle, bookTitle, "Naslov nije u dobrom formatu");

        let regBookDesc = /^[A-ZČĆŠĐŽ][šđžčća-z0-9A-Z,-/'.\s]{5,490}$/;

        let bookDesc = document.getElementById('descbook');
        let bookDescResult = regexFind(regBookDesc, bookDesc, "Opis nije u dobrom formatu");

        let fileBook = document.getElementById('bookfile');
        let regFile = /([a-zA-ZČĆŠĐŽ0-9\s_\\.\-():])+(.pdf)$/i;
        let fileResult = regexFile(regFile,fileBook,0,"Fajl nije u dobrom formatu");



        if (bookTitleResult && bookDescResult && fileResult) {
            let xr = new XMLHttpRequest();
            xr.open('POST', '/addContent/addbook.php');
            xr.addEventListener('load',function()
            {
                if(xr.status == 200)
                {
                window.location.assign("http://localhost:5501/books.php")
                }

            })
            let fm = new FormData();
            if(fileBook.files[0])
            {
                fm.append('book',fileBook.files[0])
            }
            let obj = {
                "desc" : bookDesc.value,
                "titleBook" : bookTitle.value
            };
            fm.append('json',JSON.stringify(obj));
            xr.send(fm);


        }

    });

    document.getElementById("addrecept").addEventListener("click", function () {

        let receptTitle = document.getElementById("recept-title");
        let regTitle =  /^([A-ZČĆŠĐŽ][\s\-,.a-zšđžčć]{2,100})$/;
        let titleResult = regexFind(regTitle,receptTitle," Naslov recepta nije u dobrom formatu ")

        let regDesc  = /^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z,-/'.\s]{5,490}$/;
        let receptDesc = document.getElementById("recept-desc");
        let descResult = regexFind(regDesc,receptDesc,"Nije dobar opis");

        let regElements = /^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z,-/'.\s]{5,490}$/;
        let receptElements = document.getElementById("recept-elements");
        let elementsResult = regexFind(regElements,receptElements,"Tekst elemenata nije dobar")


        let receptImages = document.getElementById("recept-images");
        let regFileRec = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        let numImgs = 0;
        for(let i = 0; i < receptImages.files.length;i++)
        {
            if(!findExtensions(regFileRec,receptImages.files[i].name))
            {
                console.log(receptImages.files[i].name)
                numImgs = 1;
            }
        }

        if(titleResult && descResult && elementsResult && numImgs === 0)
        {

            let xr = new XMLHttpRequest();
            xr.open('POST', '/addContent/addrecept.php');
            let fm = new FormData();
            let obj = {
                "title" : receptTitle.value,
                "desc" : receptDesc.value,
                "elements" : receptElements.value
            };
            fm.append('recept',JSON.stringify(obj));

            xr.addEventListener('load',function () {

                if(xr.status == 200)
                {
                    for(let i = 0; i < receptImages.files.length;i++)
                    {
                        let fmImg = new FormData();
                        let xrs = new XMLHttpRequest();
                        let detalis = {
                            'name' : receptTitle.value,
                            'pos':i
                        }
                        xrs.open('POST', '/addContent/addreceptimage.php');
                        fmImg.append('image'+i ,receptImages.files[i]);
                        fmImg.append('detalis',JSON.stringify(detalis));
                        xrs.send(fmImg);

                    }
                }
            })

            xr.send(fm);

            receptTitle.value = "";
            receptDesc.value= "";
            receptElements.value = "";
            receptImages.files = "";



        }

    });

    document.getElementById('addpubl').addEventListener("click",function () {

        let publTitle = document.getElementById('publtitle');
        let firstDesc = document.getElementById('first-desc');
        let secondDesc = document.getElementById('second-desc');
        let video = document.getElementById('video');

        let regTitle =  /^([A-ZČĆŠĐŽ][\s\-,.a-zšđžčć]{2,100})$/;
        let titleResult = ;


        let regDesc  = /^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z,-/'.\s]{5,490}$/;
        let firstResult = ;
        let secondResult = ;
        let regFilePub = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        let publImages = document.getElementById();
        let numImgs = 0;
        for(let i = 0; i < receptImages.files.length;i++)
        {
            if(!findExtensions(regFileRec,receptImages.files[i].name))
            {
                numImgs = 1;
            }
        }
    });


});