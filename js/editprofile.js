document.addEventListener('DOMContentLoaded',function()
{
    $("<p class='errorStar'> * </p>").insertAfter("input");
    $("<p class='errorStar'> * </p>").insertAfter("textarea");
    $('.errorStar').hide();
document.getElementById('save').addEventListener('click',function () {
    let regMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let mail = document.getElementById('mailedit');
    var mailResult = regexFind(regMail,mail,"Mejl nije u odgovarajucem formatu");

    let regDesc = /^[A-Z][a-z0-9A-Z,-/'.\s]{5,490}$/;
    let desc = document.getElementById('desc-val');
    var descResult = regexFind(regDesc,desc,"Opis nije u dobrom formatu");

    if(mailResult && descResult)
    {

        let xr = new XMLHttpRequest();
        xr.open('POST','/edits/editprofile.php');
        xr.setRequestHeader('Content-Type','application/json');
        
        let obj = {
        "mail" : mail.value,
            "desc" : desc.textContent
        
        };
        
        xr.send(JSON.stringify(obj));
    }

});


});