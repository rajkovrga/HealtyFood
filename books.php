<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    Header("Location: login.php");
}
?>

<?php require_once __DIR__ . '/menu/head.php';
showHead("Knjige");
?>

<body>
<div class="container-fluid cFluid">

    <?php require_once __DIR__ . '/menu/showMenu.php'; ?>
    <h2 class='text-center titlePage '>Knjige </h2>
    <div id="books" class="d-flex flex-column align-items-center">


        <?php

        include __DIR__ . '/config/config.php';

        $sqlRecepts = "SELECT * FROM books r 
      order by BookDate desc LIMIT :startnumber ,:endnumber ";

        $start = 0;
        $end = 4;

        $firstBooks = $pdo->prepare($sqlRecepts);
        $firstBooks->bindParam(':startnumber', $start, PDO::PARAM_INT);
        $firstBooks->bindParam(':endnumber', $end, PDO::PARAM_INT);
        $firstBooks->execute();
        $result = $firstBooks->fetchAll(PDO::FETCH_ASSOC);
        $books = "";
        foreach ($result as $r) {
            $books .= "
            <div class='book border border-success rounded  col-lg-6 col-md-6 col-xs-9 col-10 col-sm-8'>
                <h3 class='book-title'><i class='fa fa-book' aria-hidden='true'></i> " . $r['BookTitle'] . " </h3>
                <p>" . $r['BookDescription'] . "</p>
                <a href='booksfiles/" . $r['BookLink'] . "'class='border border-success'>Preuzmite</a>
            </div>
            ";
        }

        echo $books;

        ?>
    </div>
    <div id="pagination-div">
        <ul class="pagination" data-now="1" id="pagination">
            <li id="left"><a href="#">&laquo;</a></li>
            <span id="pagination-items">
                </span>
            <li id="right"><a href="#">&raquo;</a></li>
        </ul>
    </div>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/paginationbook.js"></script>
</html>