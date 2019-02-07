<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    Header("Location: login.php");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Zdrava hrana</title>
</head>

<body>
    <div class="container-fluid cFluid">

        <?php require_once __DIR__ . '/menu/showMenu.php'; ?>
        <div id="books" class="d-flex flex-column align-items-center">
            <h2 class='text-center titlePage '>Knjige </h2>
            <div class="book border border-success rounded  col-lg-6 col-md-6 col-xs-9 col-10 col-sm-8">
                <h3 class="book-title "><i class="fa fa-book" aria-hidden="true"></i>
 Knjiga 1 </h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Temporibus quod praesentium natus error
                    sapiente atque! Iste cum et architecto quam, culpa vitae. Vero corporis maxime ut? Voluptas
                    assumenda illo sed?</p>
                <a href="#" class="border border-success">Preuzmite</a>
            </div>
            <div class="book border border-success rounded  col-lg-6 col-md-6 col-xs-9 col-10 col-sm-8">
                <h3 class="book-title "><i class="fa fa-book" aria-hidden="true"></i>
 Knjiga 1 </h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Temporibus quod praesentium natus error
                    sapiente atque! Iste cum et architecto quam, culpa vitae. Vero corporis maxime ut? Voluptas
                    assumenda illo sed?</p>
                <a href="#" class="border border-success">Preuzmite</a>
            </div>
            <div class="book border border-success rounded  col-lg-6 col-md-6 col-xs-9 col-10 col-sm-8">
                <h3 class="book-title "><i class="fa fa-book" aria-hidden="true"></i>
 Knjiga 1 </h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Temporibus quod praesentium natus error
                    sapiente atque! Iste cum et architecto quam, culpa vitae. Vero corporis maxime ut? Voluptas
                    assumenda illo sed?</p>
                <a href="#" class="border border-success">Preuzmite</a>
            </div>

        </div>
    </div>
</body>

</html>