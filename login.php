<!DOCTYPE html>
<html lang="en">
<?php session_start();

if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == true) {
        header("Location: index.php");
    }

}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Zdrava hrana</title>
</head>

<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/menu/showMenu.php'; ?>
    <h2 class='text-center titlePage '>Logovanje</h2>
    <div class="row">

    <div class="col-12 loginUser d-flex justify-content-center">

        <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
            <form>
                <p>E-mail</p>
                <input type="text" class=" col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control " name="mail" id="mail">
                <p>Lozinka</p>
                <input type="password" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control" name="password" id="password">
                <input class='btn btn-outline-success border border-success' type="button" id="login" value="Logovanje">
            </form>
            <p>Niste registrovani? <a href="registration.php">Registrujte se</a></p>
            <p id="result"></p>
        </div>

    </div>
</div>
</div>
<script src="js/functions.js"></script>
<script src="js/login.js"></script>
</body>

</html>