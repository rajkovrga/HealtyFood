<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
    Header("Location: login.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Zdrava hrana</title>
</head>

<body>
<div class="container-fluid cFluid d-flex flex-justify-center flex-column align-items-center">

   <?php require_once __DIR__ . '/menu/showMenu.php'; ?>
    <?php 
    
    include __DIR__ . '/config/config.php';
    $profileSql = "select * from users where Username = :uname";
    $st = $pdo->prepare($profileSql);
        $rd = $st->execute([
            ':uname'=>$_SESSION['Username']
        ]);
        $pp = $st->fetch();


    ?>
    <h2 class='text-center titlePage '><?php echo $pp->Username; ?></h2>
    <div class="profile d-flex flex-justify-center flex-column align-items-center col-lg-7 col-sm-9 col-md-9 col-12 border  border-success rounded">

        <div class="profile-img rounded-circle">
            <img class="rounded-circle" src="<?php if($pp->UserImg == "")
            {
                echo "img/user-img.png";
            }
            else
            {
                echo "/profileimages/" . $pp->UserImg;
            }
            ?>" alt="">
        </div>

        <div class="user-detalis text-center col-lg-8 col-sm-10 col-11">

            <h4>Ime</h4>
            <p><?php echo $pp->FirstName; ?></p>
            <h4>Prezime</h4>
            <p><?php echo $pp->LastName; ?></p>
            <h4>E-mail</h4>
            <p><?php echo $pp->UserMail; ?></p>
            <h4>Opis</h4>
            <p id="desc"><?php if( $pp->UserDesc)
            {
                echo $pp->UserDesc;
            }
            else
            {
                echo "Nije unet";
            }?></p>

            <a class="text-success border border-success rounded" href="editprofile.php">Edit profile</a>

        </div>

    </div>
        
</div>

</body>

</html>