<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Korisnici");
?>


<body>
<div class="container-fluid cFluid d-flex flex-wrap align-items-center flex-column justify-content-center">

    <?php require_once __DIR__ . '/components/showMenu.php';
    if (!(isset($_SESSION['logged_in']) && ($_SESSION["StatusUser"] == "Admin"))) {
        Header("Location: login.php");
    }

    ?>

    <?php

    include __DIR__ . "/config/config.php";
    $sqlUsers = "SELECT * FROM users u inner join statuses s on u.StatusId = s.StatusId";
    $queryUsers = $pdo->prepare($sqlUsers);
    $queryUsers->execute();
    $resultUsers = $queryUsers->fetchAll();
    $sqlStatuses = "SELECT * FROM `statuses`";
    $queryStatuses = $pdo->prepare($sqlStatuses);
    $queryStatuses->execute();
    $resultStatuses = $queryStatuses->fetchAll();

    ?>

    <h2 class='text-center recept-title '>Korisnici</h2>
    <div class="recepts  col-12 col-lg-8 col-md-10 d-flex flex-wrap align-items-center flex-column justify-content-center">
        <div class=" col-11 text-left d-flex justify-content-center flex-column align-items-center text-users text-recept">
            <h3 class="text-center">Promeni status korisnika</h3>
            <div class="form-user col-lg-6 col-9 d-flex justify-content-start flex-column">

                <label for="user">Korisnik: </label> <select class="form-control  border border-success" name="user"
                                                             id="user">

                    <option value="0" class="success">Izaberite..</option>
                    <?php foreach ($resultUsers as $r): ?>

                        <option value="<?php echo $r->UserId; ?>"><?php echo $r->Username; ?></option>

                    <?php endforeach; ?>
                </select><br/>
                <label for="status">Status: </label> <select class="form-control border border-success" name="status"
                                                             id="status">

                    <option value="0">Izaberite..</option>
                    <?php foreach ($resultStatuses as $s): ?>

                        <option value="<?php echo $s->StatusId; ?>"><?php echo $s->StatusName; ?></option>

                    <?php endforeach; ?>
                </select>
                <input type="button" id="change-status" value="Promeni">
                <p id="result"></p>
            </div>
        </div>

        <div class="col-11 text-left text-recept ">
            <h3>Administratori</h3>

            <?php foreach ($resultUsers as $r): ?>
                <?php if ($r->StatusName === "Admin"): ?>
                    <p><?php echo $r->Username; ?></p>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>


        <div class="col-11 text-left text-recept">
            <h3>Moderatori</h3>
            <?php foreach ($resultUsers as $r): ?>
                <?php if ($r->StatusName === "Moderator"): ?>
                    <p><?php echo $r->Username; ?></p>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

        <div class="col-11 text-left text-recept">
            <h3>Korisnici</h3>

            <?php foreach ($resultUsers as $r): ?>


                <span class="usersall d-flex justify-content-between ">

                <p><?php echo $r->Username; ?></p>
                <div class="tools <?php echo ($r->StatusName == "Neaktivan") ? "text-danger" : ""; ?>"><i
                            data-id="<?php echo $r->UserId; ?>"
                            class="fa fa-user modal-user"></i>
                    <i data-id="<?php echo $r->UserId; ?>"
                       class="fa fa-trash deleteBtn"></i>
            </div>
</span>
            <?php endforeach; ?>


        </div>


    </div>

    <?php require_once __DIR__ . '/components/footer.php'; ?>

</div>
<div class="my-modal col-12 align-items-center justify-content-center">

    <div class=" rounded d-flex justify-content-center align-items-center flex-column col-lg-4 col-sm-6 col-sm-8 col-10 my-modal-content">
        <div class="my-modal-close">
            <i class="fa fa-window-close" id="my-modal-close"></i>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-start col-12 text-response">
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/changestatus.js"></script>
<script src="js/deleteuser.js"></script>
<script src="js/modal.js"></script>

</body>

</html>