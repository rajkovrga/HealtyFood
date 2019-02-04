document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('login').addEventListener('click', function () {
        let uName = document.getElementById('username');
        let password = document.getElementById('password');
        let err = document.getElementById("result");
        if (password.value.length == 0 || uName.value.length == 0) {
            err.textContent = "Popunite sva polja";
        } else  {
            err.textContent = "";
            let xtr = new XMLHttpRequest();
            xtr.open('POST', '../LoginAndRegistration/loginUser.php');
            xtr.setRequestHeader('Content-Type', 'application/json');
            let obj = {
                'username': uName.value,
                'password': password.value
            };

            xtr.addEventListener('load',function () {
                if(xtr.status == 330)
                {
                    err.textContent = "Korisnik ne postoji";
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
    
    
    