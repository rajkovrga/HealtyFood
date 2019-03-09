document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('login').addEventListener('click', function () {
        let mail = document.getElementById('mail');
        let password = document.getElementById('password');
        let err = document.getElementById("result");
        if (password.value.length === 0 || mail.value.length === 0) {
            err.textContent = "Popunite sva polja";
        } else  {
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
                    window.location.assign("http://localhost:5501/index.php")
                }
            });

            xtr.send(JSON.stringify(obj));
        }

    })
});
    
    
    