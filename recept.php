<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if(!isset($_SESSION['logged_in']))
{
    Header("Location: login.php");
}
?>

<?php require_once __DIR__ . '/menu/head.php';
showHead("Recept");
?>

<body>
    <div class="container-fluid cFluid d-flex flex-wrap justify-content-center flex-column align-items-center">

        <?php require_once __DIR__ . '/menu/showMenu.php'; ?>

        <h2 class='text-center titlePage'>Recepti</h2>
        <div class="recepts col-12 col-lg-8 col-md-10 d-flex flex-wrap justify-content-around">
    <?php

        if(isset($_GET["ID"]))
        {
            echo "IMA " . $_GET["ID"];
        }
        else
        {
           header("Location: recepts.php");
        }

    ?>
        </div>




    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="js/functions.js"></script>


</body>

</html>