<!DOCTYPE html>
<html lang="en">
<?php
session_start();


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
      <?php require_once __DIR__ . '/menu/showMenu.php'; ?>

      <section id="add-content" class="col-md-12">
        <nav class="nav col-12 nav-pills d-flex flex-row justify-content-center" id="nav-buttons" id="pills-tab" role="tablist">
            <a class=" nav-item nav-link border col-lg-2 col-5 border-success active " id="pills-publication-tab"
                data-toggle="pill" href="#pills-publication" role="tab" aria-controls="pills-publication" aria-selected="true">Dodaj
                objavu</a>
            <a class="nav-item nav-link border col-lg-2 col-5  border-success" id="pills-recepts-tab" data-toggle="pill"
                href="#pills-recepts" role="tab" aria-controls="pills-recepts" aria-selected="false">Dodaj recept</a>
            <a class="nav-item nav-link border col-lg-2 col-5 border-success" id="pills-books-tab" data-toggle="pill"
                href="#pills-books" role="tab" aria-controls="pills-books" aria-selected="false">Dodaj knjigu</a>
            <a class="nav-item nav-link border col-lg-2 col-5 border-success" id="pills-image-tab" data-toggle="pill"
                href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="false">Dodaj sliku</a>

        </nav>


        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane  active-content fade show active" id="pills-publication" role="tabpanel"
                aria-labelledby="pills-publication-tab">

                <h2 class='text-center titlePage title-add'>Dodaj objavu</h2>
                <div class="col-12 loginUser d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Ime objave</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="username"
                                id="username">
                            <p>Prvi pasus</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" name="first-desc"></textarea>
                            <p>Prvi pasus</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success" name="second-desc"></textarea>
                            <p class="p-video">Dodaj video</p>
                            <input type="file" name="eMail" class="add-file">

                            <input type="button" name="registration" id="registration" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>
            </div>
            <div class="tab-pane active-content fade" id="pills-recepts" role="tabpanel" aria-labelledby="pills-recepts-tab">

                <h2 class='text-center titlePage title-add'>Dodaj recept</h2>
                <div class="col-12 loginUser d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Ime recepta</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="username"
                                id="username">
                            <p>Opis recepta</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" name="first-desc"></textarea>
                            <p>Sastav jela</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success" name="second-desc"></textarea>
                            <input type="button" name="registration" id="registration" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>
            </div>
            <div class="tab-pane  active-content fade" id="pills-books" role="tabpanel" aria-labelledby="pills-books-tab">

                <h2 class='text-center titlePage title-add'>Dodaj knjigu</h2>
                <div class="col-12 loginUser d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Naslov knjige</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="username"
                                id="username">
                            <p>Opis knjige</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" name="first-desc"></textarea>
                            <p class="p-video">Fajl knjige</p>
                            <input type="file" name="eMail" class="add-file col-sm-10 col-lg-10 col-md-10 col-xs-11">

                            <input type="button" name="registration" id="registration" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>

            </div>
            <div class="tab-pane  active-content fade" id="pills-image" role="tabpanel" aria-labelledby="pills-image-tab">

                <h2 class='text-center titlePage title-add'>Dodaj sliku</h2>
                <div class="col-12 loginUser d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Vrsta</p>
                            <span><input type="radio" name="vrsta" checked="true"id="vrsta1"><label for="vrsta1">Objava</label> </span>
                            <span><input type="radio" name="vrsta" id="vrsta2"><label for="vrsta2">Recept</label> </span>
                            <p>Objava</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="username"
                            id="username">                         
                            <p class="p-video">Dodaj slike</p>
                            <input type="file" name="eMail" class="add-file">

                            <input type="button" name="registration" id="registration" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>


  </div>
  <script src="js/functions.js"></script>
<script src="js/registration.js"></script>
</body>
</html>