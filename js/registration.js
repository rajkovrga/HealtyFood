document.addEventListener('DOMContentLoaded',function () {

    $("<label class='errorStar'> * </label>").insertAfter("input");

    $('.errorStar').hide();
    $('#passSecond').attr("disabled", true);
    let passFirst = document.getElementById('passFirst');
    let passSecond = document.getElementById('passSecond');

    document.getElementById('registration').addEventListener('click',function () {

        let regUsername = /^[a-z0-9_-]{3,15}$/;
        let uName = document.getElementById('username');
        let usernameResult = regexFind(regUsername,uName,"Uneto korisnicko ime je u pogresnom formatu");

        let regFLName = /^([A-Z][a-z]{2,12})[\s]*$/;
        let fName = document.getElementById('fName');
        let lName = document.getElementById('lName');

        var fNameResult = regexFind(regFLName,fName,"Prezime nije u odgovarajucem formatu");
        var lNameResult = regexFind(regFLName,lName,"Ime nije u odgovarajucem formatu");

        let regMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let email = document.getElementById('eMail');
        var mailResult = regexFind(regMail,email,"Mejl nije u odgovarajucem formatu");

        let regPass = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/;
        let passwordResult = regexFind(regPass,passFirst,"Lozinka nije odgovarajuca");
        let passEquals = equalsFind(passFirst,passSecond);

        if(usernameResult && fNameResult && lNameResult && mailResult && passwordResult && passEquals)
        {

            let ht = new XMLHttpRequest();

            ht.open('POST','LoginAndRegistration/registrator.php');
            let regData = {
                "Username":uName.value,
                "FirstName":fName.value,
                "LastName":lName.value,
                "UserMail":email.value,
                "UserPassword":passFirst.value
            }

            ht.addEventListener('load',function () {
                let result = document.getElementById('result');
                if(ht.status == 422)
                {
                    result.textContent = "Podaci nisu dobro uneti";
                }
                else if(ht.status == 423)
                {
                    result.textContent = "Korisnik sa unetim podacima postoji";
                }
                else if(ht.status == 200)
                {
                    result.textContent = "Poslat aktivacioni link";
                }

            })

            ht.send(JSON.stringify(regData));

        }

    });
    passFirst.addEventListener('keyup',function () {
        if(this.value.length != 0)
        {
            $('#passSecond').attr("disabled", false);
        }
        else
        {
            $('#passSecond').attr("disabled", true);
        }
    });
    passSecond.addEventListener('keyup',function () {

        let res = equalsFind(passFirst,passSecond);

    });

})