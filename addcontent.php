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
        <nav class=" row nav col-12 nav-pills d-flex flex-row justify-content-center" id="nav-buttons" id="pills-tab" role="tablist">
            <a class=" nav-item nav-link border col-lg-3 col-3 border-success active " id="pills-publication-tab"
                data-toggle="pill" href="#pills-publication" role="tab" aria-controls="pills-publication" aria-selected="true">Dodaj
                objavu</a>
            <a class="nav-item nav-link border col-lg-3 col-3  border-success" id="pills-recepts-tab" data-toggle="pill"
                href="#pills-recepts" role="tab" aria-controls="pills-recepts" aria-selected="false">Dodaj recept</a>
            <a class="nav-item nav-link border col-lg-3 col-3 border-success" id="pills-books-tab" data-toggle="pill"
                href="#pills-books" role="tab" aria-controls="pills-books" aria-selected="false">Dodaj knjigu</a>


        </nav>


        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active-content fade show active" id="pills-publication" role="tabpanel"
                aria-labelledby="pills-publication-tab">

                <h2 class='text-center titlePage title-add'>Dodaj objavu</h2>
                <div class="col-12 d-flex justify-content-around  flex-column align-items-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form class="d-flex justify-content-around  flex-column align-items-center">
                            <p>Ime objave *</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="publtitle"
                                id="publtitle">
                            <p>Prvi pasus *</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" id="first-desc" name="first-desc"></textarea>
                            <p>Drugi pasus *</p>
                            <textarea id="second-desc" class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success" name="second-desc"></textarea>
                            <p class="p-video">Dodaj URL za video</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="video"
                                   id="video">                            <p class="p-files">Dodaj slike objave *</p>
                            <input type="file" name="publictaion-images" id="publictaion-images" class="add-file col-sm-10 col-lg-10 col-md-10 col-xs-11">
                            <input type="button" name="addpubl" id="addpubl" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane active-content fade" id="pills-recepts" role="tabpanel" aria-labelledby="pills-recepts-tab">

                <h2 class='text-center titlePage title-add'>Dodaj recept</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Ime recepta *</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="recept-title"
                                id="recept-title">
                            <p>Opis recepta *</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" id="recept-desc" name="recept-desc"></textarea>
                            <p>Sastav jela *</p>

                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success" name="recept-elements" id="recept-elements"></textarea>
                            <p class="p-files">Dodaj slike recepta *</p>
                            <input type="file" multiple name="recept-images" id="recept-images" class="add-file col-sm-10 col-lg-10 col-md-10 col-xs-11">

                            <input type="button" name="addrecept" id="addrecept" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>
            </div>
            <div class="tab-pane  active-content fade" id="pills-books" role="tabpanel" aria-labelledby="pills-books-tab">

                <h2 class='text-center titlePage title-add'>Dodaj knjigu</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Naslov knjige *</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success" name="username"
                                id="titlebook">
                            <p>Opis knjige *</p>
                            <textarea id="descbook" class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success" name="first-desc"></textarea>
                            <p class="p-files">Fajl knjige *</p>
                            <input type="file" name="bookfile" id="bookfile" class="add-file col-sm-10 col-lg-10 col-md-10 col-xs-11">

                            <input type="button" name="addbook" id="addbook" class='btn btn-outline-success'
                                value="Dodaj">
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>


  </div>
  <script src="js/functions.js"></script>
<script src="js/addcontent.js"></script>
</body>
</html>