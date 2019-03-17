<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if(!isset($_SESSION['logged_in']))
{
    Header("Location: login.php");
}
?>

<?php require_once __DIR__ . '/components/head.php';
showHead("Recepti");
?>

<body>
    <div class="container-fluid cFluid d-flex flex-wrap justify-content-center flex-column align-items-center">

        <?php require_once __DIR__ . '/components/showMenu.php'; ?>

        <h2 class='text-center titlePage'>Recepti</h2>
        <div class="search col-12 d-flex justify-content-center">
        <div class="col-11 col-md-10 col-lg-8 d-flex justify-content-center">
            <form class=" card-sm  col-11">
                <div class="card-body row no-gutters align-items-center searchra">

                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless search-box" type="search" placeholder="Pretraži recept..">
                    </div>
                    <div class="col-auto search-box-button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
            </form>
        </div></div>
        <div class="recepts col-12 col-lg-8 col-md-10 d-flex flex-wrap justify-content-around">

        </div>
        
    
        <div id="pagination-div">
            <ul class="pagination" data-now="1" id="pagination">
                <li id="left"><a href="#">&laquo;</a></li>
                <span id="pagination-items">
                </span>
                <li id="right"><a href="#">&raquo;</a></li>
            </ul>
        </div>
        <?php require_once __DIR__ . '/components/footer.php';?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="js/functions.js"></script>
    <script src="js/paginationrecept.js"></script>

</body>

</html>