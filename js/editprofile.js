document.addEventListener('DOMContentLoaded', function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    document.getElementById('save').addEventListener('click', function (e) {
        e.preventDefault();

        let regUsername = /^[a-zšđžčćA-ZČĆŠĐŽ0-9_-]{3,15}$/;
        var username = document.getElementById('useredit');
        let usernameResult = regexFind(regUsername,username,"Korisnicko ime nije u dobrom formatu");

        let regDesc = /^([A-ZČĆŠĐŽ][a-zšđžčć0-9A-ZČĆŠĐŽ,-/'.\s]{0,490})$/;
        let desc = document.getElementById('desc-val');
        let descResult = regexFind(regDesc, desc, "Opis nije u dobrom formatu");

        let file = document.getElementById('file');
        let regFile = /([ČĆŠĐŽa-zA-Z0-9\s_\\.\-\(\):])+(.gif|.png|.jpeg|.jpg)$/i;
        let fileResult = regexFile(regFile,file,0,"Fajl nije u dobrom formatu");
        if ( (descResult || desc.value === "") && usernameResult && (fileResult || file.value === "")) {

            let xr = new XMLHttpRequest();
            xr.open('POST', 'edits/editprofile.php');
            xr.addEventListener('load',function()
            {
                if(xr.status == 200)
                {
                 window.location.assign("http://localhost:5501/profile.php")
                }

            })
        let fm = new FormData();
        if(file.files[0])
        {
            fm.append('file',file.files[0])
        }
            let obj = {
                "desc" : desc.value,
                "username" : username.value
            };
        fm.append('json',JSON.stringify(obj));
            xr.send(fm);
        }

    });


});