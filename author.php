<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once __DIR__ . '/components/head.php';
showHead("Autor sajta");
?>



<body>
<div class="container-fluid cFluid">

    <?php require_once __DIR__ . '/components/showMenu.php'; ?>

    <div class="col-12 author d-flex justify-content-center align-items-center">
        <div class="col-12 col-sm-8 col-md-7 d-flex flex-column justify-content-center align-items-center col-lg-5 text-center">
            
            <div class="img-author col-12 col-lg-9 rounded ">
                <img class="rounded" src="img/author.png" alt="author image">
            </div>
            <p class="col-11 author-text">Ja sam <b> Rajko Vrga </b>iz Beograda, autor ovoga sajta.
                Trenutno sam student Visoke ICT, završio sam srednju Elektrotehničku školu
                u Zemunu. Za izradu ovog sajta su korišćeni PHP, JavaScript, Ajax kao i biblioteke JQuery i
                 Bootstrap.
            </p>
        </div>
        
    </div>



    <?php require_once __DIR__ . '/components/footer.php';?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>