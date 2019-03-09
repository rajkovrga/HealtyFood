document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("answer-button").addEventListener("click", function () {
        let result = document.getElementById("result");
        let answerMessage = document.getElementById("answerdesc");
        if (answerMessage.value.length > 10) {
            result.innerHTML = "";
            let xr = new XMLHttpRequest();

            xr.open("POST", "/SendMail/answermail.php");
            xr.addEventListener("load", function () {

                if (xr.status === 200) {
                    location.assign("mailer.php");
                } else if (xr.status === 400) {
                    result.innerHTML = "Došlo je do greške, pokušajte kasnije";
                }
            });

            let obj =
                {
                    "adminMessage": answerMessage.value,
                    "userMessage": document.getElementById("usermessage").textContent,
                    "id": this.getAttribute("data-id"),
                    "idUser": this.getAttribute("data-user")
                };

            xr.send(JSON.stringify(obj));
        } else {
            result.innerHTML = "Nije dobra duzina poruke";
        }
    })


});

