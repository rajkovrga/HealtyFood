document.addEventListener('DOMContentLoaded', function () {
    $("<label class='errorStar'> * </label>").insertAfter("input");

    $('.errorStar').hide();
    $('#passSecond').attr("disabled", true);
    document.getElementById('login').addEventListener('click', function () {
        let mail = document.getElementById('mail');
        let password = document.getElementById('password');
        let err = document.getElementById("result");
        let regMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zšđžčćA-ZČĆŠĐŽ\-0-9]+\.)+[a-zšđžčćA-ZČĆŠĐŽ]{2,}))$/;
        let regPass = /^(?=.*[\d])(?=.*[A-ZČĆŠĐŽ])(?=.*[a-zšđžčć])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/;
        let mailResult = regexFind(regMail,mail,"Mejl nije u dobrom formatu");
        let passResult = regexFind(regPass,password,"Šifra nije u dobrom formatu");
        if (mailResult && passResult) {


                    err.textContent = "";
                    let xtr = new XMLHttpRequest();
                    xtr.open('POST', '../LoginAndRegistration/loginUser.php');
                    xtr.setRequestHeader('Content-Type', 'application/json');
                    let obj = {
                        'email': mail.value,
                        'password': password.value
                    };

                    xtr.addEventListener('load',function () {
                        if(xtr.status == 330)
                        {
                            err.textContent = "Korisnik ne postoji ili je nalog neaktivan";
                        }
                        else if(xtr.status == 200)
                        {
                            window.location.assign("index.php")
                        }
                        else if(xtr.status === 400)
                        {
                            err.textContent = "Neki podatak nije u dobrom formatu";
                        }
                        else
                        {
                            err.textContent = "Došlo je do greške";
                        }
                    });

                    xtr.send(JSON.stringify(obj));
                }

    })
});
    
    
    