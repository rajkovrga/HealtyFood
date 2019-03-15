<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    Header("Location: login.php");
}
?>
<?php require_once __DIR__ . '/components/head.php';
showHead("Izmeni profil");
?>

<body>
<div class="container-fluid cFluid d-flex flex-justify-center flex-column align-items-center">

    <?php require_once __DIR__ . '/components/showMenu.php'; ?>
    <?php

    include __DIR__ . '/config/config.php';
    $profileSql = "select * from users where UserId = :id";
    $st = $pdo->prepare($profileSql);
    $rd = $st->execute([
        ':id' => $_SESSION['UserId']
    ]);
    $pp = $st->fetch();
    ?>
    <div class="profile d-flex flex-justify-center flex-column align-items-center col-lg-8 col-sm-9 col-md-9 col-12 border  border-success rounded">
        <div class="profile-img rounded-circle">
            <img class="rounded-circle" src="<?php if ($pp->UserImg == "") {
                echo "img/user-img.png";
            } else {
                echo "/profileimages/" . $pp->UserImg;
            }
            ?>" alt="">
        </div>

        <div class="user-detalis text-center">
            <h4>Promeni sliku profila</h4>
            <form enctype="multipart/form-data">
                <input type="file" id='file' name="file">

                <h4  id="changepassword">Obriši sliku profila</h4>
                <a id="deleteprofileimg" href="#" class="text-success border border-success rounded">Obriši profilnu</a>

                <h4>Username</h4>
                <p>
                    <input type="text" id="useredit" class="form-control-success edittxt" name="uname"
                           value="<?php echo $pp->Username; ?>">
                </p>
                <h4>Ime</h4>
                <p><?php echo $pp->FirstName; ?></p>
                <h4>Prezime</h4>
                <p><?php echo $pp->LastName; ?></p>
                <h4>E-mail</h4>
                <p>
                    <?php echo $pp->UserMail; ?>
                </p>
                <h4>Opis</h4>
                <p id="desc"><textarea name="desc" class="form-control-success" id="desc-val"><?php if ($pp->UserDesc) {
                            echo $pp->UserDesc;
                        } else {
                            echo "Nije unet";
                        }
                        ?></textarea></p>
                <input class='btn btn-outline-success ' type="button" id="save" value="Sacuvaj">
                <div class="padding"></div>
                <h4 id="changepassword">Lozinka</h4>

                <div id="changepassword-box" class="password-change d-none flex-column justify-content-center">
                    <h4 class="pass-change" >Stara lozinka</h4>
                    <input type="password"  class="form-control-success edittxt" name="oldpassword" id="oldpassword"
                         >
                    <h4 class="pass-change" >Stara lozinka</h4>

                    <input type="password"  class="form-control-success edittxt" name="newpassword" id="newpassword"
                         >
                    <h4 class="pass-change" >Stara lozinka</h4>

                    <input type="password" class="form-control-success edittxt"name="confirmpassword" id="confirmpassword">

                </div>
                    <p id="pass-result"></p>
                <div class="padding"></div>

                <a id="password-button" class="text-success border border-success rounded" href="#">Promeni lozinku</a>
                <div class="padding"></div>
                <div class="padding"></div>
                <h4  id="changepassword">Obriši profil</h4>
                <a href="#" class="text-success border border-success rounded" data-id="<?php echo $_SESSION["UserId"]; ?>" href="#" id="deleteprofile">Obriši profil</a>

            </form>
               </div>


    </div>
    <?php require_once __DIR__ . '/components/footer.php';?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script src="js/functions.js"></script>
<script src="js/editprofile.js"></script>
</body>
<?php unset($pdo);
?>
</html>