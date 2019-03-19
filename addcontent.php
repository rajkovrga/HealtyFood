<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Dodaj sadržaj");
?>
<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/components/showMenu.php';
    if (!(isset($_SESSION['logged_in']) && ( $_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator"))) {
        Header("Location: login.php");
    }?>

    <div id="add-content" class="col-md-12">
        <nav class=" row nav col-12 nav-pills d-flex flex-row justify-content-center" id="nav-buttons" id="pills-tab"
             role="tablist">

            <a class="nav-item nav-link border col-lg-3 col-3  border-success active" id="pills-recepts-tab"
               data-toggle="pill"
               href="#pills-recepts" role="tab" aria-controls="pills-recepts" aria-selected="true">Dodaj recept</a>
            <a class="nav-item nav-link border col-lg-3 col-3 border-success" id="pills-books-tab" data-toggle="pill"
               href="#pills-books" role="tab" aria-controls="pills-books" aria-selected="false">Dodaj knjigu</a>


        </nav>


        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane active-content fade active show" id="pills-recepts" role="tabpanel"
                 aria-labelledby="pills-recepts-tab">

                <h2 class='text-center titlePage title-add'>Dodaj recept</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Ime recepta *</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success"
                                   name="recept-title"
                                   id="recept-title">
                            <p>Opis recepta *</p>
                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                                      id="recept-desc" name="recept-desc"></textarea>
                            <p>Sastav jela *</p>

                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success"
                                      name="recept-elements" id="recept-elements"></textarea>
                            <p class="p-files">Dodaj slike recepta *</p>
                            <div class="custom-file col-lg-8 col-11">
                            <input type="file"  multiple name="recept-images" id="recept-images"
                                   class="add-file custom-file-input col-sm-10 col-lg-10 col-md-10 col-xs-11">
                            <label class="custom-file-label" for="recept-images">Choose file</label>

                    </div>
                            <input type="button" name="addrecept" id="addrecept" class='btn btn-outline-success'
                                   value="Dodaj">
                            <p class="addresult"></p>

                        </form>

                    </div>
                </div>
            </div>
            <div class="tab-pane  active-content fade" id="pills-books" role="tabpanel"
                 aria-labelledby="pills-books-tab">

                <h2 class='text-center titlePage title-add'>Dodaj knjigu</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Naslov knjige *</p>
                            <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success"
                                   name="username"
                                   id="titlebook">
                            <p>Opis knjige *</p>
                            <textarea id="descbook" class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                                      name="first-desc"></textarea>
                            <p class="p-files">Fajl knjige *</p>
                            <div class="custom-file col-8">
                            <input type="file" name="bookfile" id="bookfile"
                                   class="add-file custom-file-input col-sm-10 col-lg-10 col-md-10 col-xs-11">
                                <label class="custom-file-label" for="bookfile">Choose file</label>

                            </div>
                            <input type="button" name="addbook" id="addbook" class='btn btn-outline-success'
                                   value="Dodaj">

                            <p class="addresult"></p>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <?php require_once __DIR__ . '/components/footer.php';?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/addcontent.js"></script>
</body>
</html>