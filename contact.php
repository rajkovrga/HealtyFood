<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Kontakt");
?>
<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/components/showMenu.php';
    if(!isset($_SESSION['logged_in'])) {
        header("Location: index.php");
    }?>

    <h2 class='text-center titlePage'>Kontakt</h2>
    <div class="row">

        <div class="col-12 loginUser d-flex justify-content-center">
            <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                <form>
                    <p>Naslov poruke</p>
                    <input type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control" name="titlemess" id="titlemess">
                    <p>Tekst poruke</p>
                    <textarea id="descmess" class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                              name="descmess"></textarea>
                    <input type="button" name="send" id="send"  class='btn btn-outline-success'value="Pošalji"/>
                </form>
                <p id="result"></p>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/components/footer.php';?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/contact.js"></script>
</body>
</html>