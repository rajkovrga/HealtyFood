<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Recept");
?>


<body>
<div class="container-fluid cFluid d-flex flex-wrap justify-content-center flex-column align-items-center">

    <?php require_once __DIR__ . '/components/showMenu.php';

    if (!isset($_SESSION['logged_in'])) {
        Header("Location: login.php");
    }?>

    <?php

    if (isset($_GET["ID"])) {
        include __DIR__ . '/config/config.php';
        $SQLExist = "select * from recepts where ReceptId = :id";
        $resultExist = $pdo->prepare($SQLExist);
        $resultExist->execute([":id" => $_GET["ID"]]);
        if ($resultExist->rowCount() == 0) {
            header("Location: recepts.php");
            unset($pdo);
        } else {
            $id = $_GET["ID"];
            $sqlImages = "SELECT COUNT(*) as num FROM imagerecept where ReceptId = :id";
            $count = $pdo->prepare($sqlImages);
            $count->bindParam(':id', $id, PDO::PARAM_INT);
            $count->execute();
            $resultCount = $count->fetch();

            $sqlRecept = "SELECT im.ReceptId as IdRecept, SrcImage,
        r.ReceptTitle as title,r.ReceptComponent as element,r.ReceptDescription as description
         FROM imagerecept im inner join recepts r on im.ReceptId = 
        r.ReceptId inner join images i on im.ImageID = i.ImageID where im.ReceptId = :id";

            $recept = $pdo->prepare($sqlRecept);
            $recept->execute([":id" => $_GET["ID"]]);
            $result = $recept->fetchAll(PDO::FETCH_ASSOC);
            $resultOneImage = $recept->fetch();

            $sqlInfo = "SELECT * from recepts s 
                inner join users u on s.UserId = u.UserId where ReceptId = :id";

            $receptInfo = $pdo->prepare($sqlInfo);
            $receptInfo->execute([":id" => $id]);
            $info = $receptInfo->fetch();
            unset($pdo);
        }
    } else {
        header("Location: recepts.php");
    }


    ?>

    <h2 class='text-center recept-title '><?php echo $info->ReceptTitle; ?></h2>
    <div class="recepts  col-12 col-lg-8 col-md-10 d-flex flex-wrap align-items-center flex-column justify-content-center">

        <div id="slider" class="col-12 col-lg-9 col-md-10 n border img-fluid">

            <?php
            if ($resultCount->num == 1) {

                echo "<img class='col-12' id='main-photo' src='' alt=''>";
            } else {
                echo "<img class='col-12' id='main-photo' src='" . $resultOneImage['SrcImage'] . "' alt=''>";
            }

            ?>
            <div class="control col-12
               <?php

            if ($resultCount->num == 1) {
                echo "d-none";
            } else {
                echo "d-flex";
            }
            ?> justify-content-between flex-wrap align-items-center">
                <i class="fa fa-angle-left" aria-hidden="true" id="prev"></i>
                <i class="fa fa-angle-right" aria-hidden="true" id="next"></i>
            </div>

        </div>
        <div class="small-photos delete col-11   d-flex justify-content-space flex-wrap">

            <?php

            $images = "";
            if ($resultCount->num != 1) {
                foreach ($result as $r) {
                    $images .= "<img src='receptimages/" . $r["SrcImage"] . "' alt=''>";

                }
                echo $images;
            } else if ($resultCount->num == 1) {
                foreach ($result as $r) {
                    $images .= "<img class='d-none' src='receptimages/" . $r["SrcImage"] . "' alt=''>";

                }
                echo $images;
            }


            ?>


        </div>
        <div class="detalis col-12 col-lg-8 col-md-10  d-flex flex-wrap align-items-center justify-content-center">
            <div class="text col-12 col-lg-12 col-md-12 d-flex justify-content-between">
                <p><b>Objavio: </b> <?php echo $info->Username; ?></p>
                <p><b>Datum recepta:</b> <?php echo $info->ReceptDate; ?></p></div>

        </div>

        <div class="col-11 text-left text-recept">
            <h3>Sastojci recepta</h3>
            <p><?php echo $info->ReceptComponent; ?></p>
        </div>

        <div class="col-11 text-left text-recept">
            <h3>Opis recepta</h3>
            <p><?php echo $info->ReceptDescription; ?></p>

        </div>
        <?php if ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator"): ?>
            <div class="col-11 text-left text-recept">
                <h3>Admin panel</h3>
                <ul>
                    <li><a class="link" id="deleteRecept" href="edits/deleterecept.php?ID=<?php echo $id; ?>">Obrisi recept</a> </li>
                    <li><a class="link" href="editrecept.php?ID=<?php echo $id;?>">Izmeni recept</a> </li>
                </ul>

            </div>
        <?php endif; ?>

    </div>


    <?php require_once __DIR__ . '/components/footer.php'; ?>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/slider.js"></script>
<script src="js/delete.js"></script>
</body>

</html>