document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("addsurvey").addEventListener("click", function () {
        let result = document.getElementById("result");
        let answers = document.getElementsByName("answer");
        let id = null;
        for (let i = 0; i < answers.length; i++) {
            if (answers[i].checked) {
                id = answers[i].value;
                break;
            }
        }
        if (id === null) {

        } else {
            let xr = new XMLHttpRequest();
            xr.open("POST", "/addContent/addSurvey.php");

            xr.addEventListener("load", function () {
                if(xr.status === 200)
                {
                alert("Hvala na odgovoru!");
                    let xr2 =new XMLHttpRequest();
                    xr2.open("POST","/showContents/showAnswers.php");

                    xr2.addEventListener("load",function () {

                        if(xr2.status === 200)
                        {
                        document.getElementById("resultsurvey").innerHTML = xr2.responseText;
                        }

                    });

                    xr2.send();

                }
                else if(xr.status === 400)
                {
                    result.innerHTML = "Već ste dali odgovor";
                }
                else
                {
                    result.innerHTML = "Došo je do greške";

                }

            });
            let obj = {
                "idAnswer": id,
                "idQuestion": document.getElementById("title-survey").getAttribute("data-id"),
                "idUser": this.getAttribute("data-user")
            };
            xr.send(JSON.stringify(obj));
        }


    });


});