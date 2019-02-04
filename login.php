<!DOCTYPE html>
<html lang="en">
<?php session_start();

if(isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == true) {
        header("Location: index.php");
    }

}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Zdrava hrana</title>
</head>

<body>
<div class="container-fluid cFluid">

    <nav class="navbar row navbar-expand-sm d-flex flex-row">
        <div class=" menu col-md-4 col-lg-4 col-sm-4 col-4">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="menuContent row collapse navbar-collapse col-md-8 col-lg-8 col-sm-8 col-12" id="navbarTogglerDemo02">
            <ul class=" navbar-nav  d-flex  align-items-center justify-content-between col-12" >
                <li class="nav-link"> <a href="">Pocetna</a> </li>
                <li class="nav-link"> <a href=" ">Zdravlje</a></li>
                <li class="nav-link"> <a href="">Recepti</a></li>
                <li class="nav-link"> <a href="">Knjige</a> </li>
                <li class="nav-link">  <?php
                    require_once __DIR__ . '/LoginAndRegistration/headerUsername.php';
                    ?>
                </li>

            </ul>
        </div>

    </nav>
    <h2 class='text-center titlePage'>Logovanje</h2>
    <div class="col-12 loginUser d-flex justify-content-center">

        <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">

            <p>Korisnicko ime</p>
            <form>
                <input type="text"  class="form-control" name="username" id="username">
                <p>Lozinka</p>
                <input type="password"  class="form-control" name="password" id="password">
                <input class='btn btn-outline-success' type="button" id="login" value="Logovanje">
            </form>
            <p>Niste registrovani? <a href="registration.php">Registrujte se</a></p>
            <p id="result"></p>
        </div>

    </div>



</div>

<script src="js/functions.js"></script>
<script src="js/login.js"></script>
</body>

</html>