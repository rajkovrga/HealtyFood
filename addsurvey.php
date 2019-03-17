<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once __DIR__ . '/components/head.php';
showHead("Dodaj anketu");
?>


<body>
<div class="container-fluid cFluid">

    <?php require_once __DIR__ . '/components/showMenu.php'; ?>
    <form>
    <div class="row d-flex justify-content-center align-items-center">

            <div class="col-lg-4 col-md-7 col-sm-9 text-center col-12 form-survey">
                <label>Naziv ankete</label>
                <input type="text" class="form-control col-12" id="question">
                <label>Odgovori:</label>
                <div class="answers col-12">
                <input type="text" placeholder="Odgovor 1" class="form-control col-12" id="question">
                <input type="text" placeholder="Odgovor 2" class="form-control col-12" id="question">
                <input type="text" placeholder="Odgovor 3" class="form-control col-12" id="question">
                </div>
                <div class="col-11" id="add-more">Dodaj još</div>

            </div>

    </div>
    </form>
    <?php require_once __DIR__ . '/components/footer.php'; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>