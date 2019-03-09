document.addEventListener("DOMContentLoaded",function () {
    document.getElementById("deleteRecept").addEventListener("click",function (e) {
        e.preventDefault();
        if(confirm("Da li ste sigurni da želite obrisati ovaj recept?"))
        {
            e.returnValue = true;
        }
    })
    document.getElementById("deleteBook").addEventListener("click",function (e) {
        e.preventDefault();
        if(confirm("Da li ste sigurni da želite obrisati ovaj recept?"))
        {
            e.returnValue = true;
        }
    })

})