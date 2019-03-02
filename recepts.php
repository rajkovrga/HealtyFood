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
showHead("Recepti");
?>

<body>
    <div class="container-fluid cFluid d-flex flex-wrap justify-content-center flex-column align-items-center">

        <?php require_once __DIR__ . '/menu/showMenu.php'; ?>

        <h2 class='text-center titlePage'>Recepti</h2>
        <div class="recepts col-12 col-lg-8 col-md-10 d-flex flex-wrap justify-content-around">
    <?php

    include __DIR__ . '/config/config.php';

        $sqlRecepts = "SELECT * FROM recepts r INNER JOIN imagerecept ir ON r.ReceptId = ir.ReceptId 
      inner join images i on ir.ImageID = i.ImageID GROUP BY ir.ReceptId 
      order by ReceptDate desc LIMIT :startnumber ,:endnumber ";

        $start = 0;
        $end = 6;

        $firstRecepts = $pdo->prepare($sqlRecepts);
    $firstRecepts->bindParam(':startnumber', $start, PDO::PARAM_INT);
    $firstRecepts->bindParam(':endnumber', $end, PDO::PARAM_INT);
        $firstRecepts->execute();
        $result = $firstRecepts->fetchAll(PDO::FETCH_ASSOC);
        $recepts = "";
        foreach ($result as $r)
        {

            $recepts .= "
            <div class=\"d-flex  flex-column align-items-center justify-content-between border rounded  recept border-success col-sm-5 col-9\">
                <div class=\" recept-img bg-success\"><img src="."receptimages/".$r['SrcImage']." alt=" . $r['ReceptTitle'] . "></div>
                <h3 class='recepts-title'>". $r['ReceptTitle'] ."</h3>
                <a href=\"#\" class=\"border border-sucess\">Pogledaj</a>
            </div>
            ";

        }

    echo $recepts;

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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="js/functions.js"></script>
    <script src="js/paginationrecept.js"></script>

</body>

</html>