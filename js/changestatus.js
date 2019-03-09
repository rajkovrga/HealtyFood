document.addEventListener("DOMContentLoaded",function () {

    document.getElementById("change-status").addEventListener("click",function () {

        let userId = document.getElementById("user").value;
        let statusId = document.getElementById("status").value;

        if(userId !==0 && statusId !== 0)
        {

            let xr = new XMLHttpRequest();
            xr.open("POST", "edits/changestatus.php");

            xr.addEventListener("load", function () {
                if(xr.status === 200)
                {
                window.location.assign("users.php");
                }
                else if(xr.status === 422)
                {
                    document.getElementById("result").innerHTML = "Došlo je do greške";
                }

            });
            let obj =
                {
                    "UserId": userId,
                    "StatusId":statusId
                };
            xr.send(JSON.stringify(obj));
        }
        else
        {
            document.getElementById("result").innerHTML = "Odaberite obe stvari";
        }



    });


});

