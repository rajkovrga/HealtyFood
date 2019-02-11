document.addEventListener('DOMContentLoaded', function () {
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
    document.getElementById('save').addEventListener('click', function (e) {
        e.preventDefault();

        let regUsername = /^[a-z0-9_-]{3,15}$/;
        var username = document.getElementById('useredit');
        let usernameResult = regexFind(regUsername,username,"Korisnicko ime nije u dobrom formatu");

        let regDesc = /^[A-Z][a-z0-9A-Z,-/'.\s]{5,490}$/;
        let desc = document.getElementById('desc-val');
        var descResult = regexFind(regDesc, desc, "Opis nije u dobrom formatu");
        let file = document.getElementById('file');
        // let regFile = /\.(gif|jpg|jpeg|tiff|png)$/i;
        // console.log(regexFind(regFile, file, ''));
        if ( descResult && usernameResult) {

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