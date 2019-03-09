<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!(isset($_SESSION['logged_in']) && $_SESSION["StatusUser"] == "Admin") ) {
    Header("Location: index.php");
}

 require_once __DIR__ . '/components/head.php';
showHead("Sanduče");

$sqlMessages = "SELECT * from mailer where Answered = 0";
require_once  __DIR__ . '/config/config.php';
$messages = $pdo->prepare($sqlMessages);
$messages->execute();
$result = $messages->fetchAll();

?>
<body>
<div class="container-fluid cFluid">

    <?php require_once __DIR__ . '/components/showMenu.php'; ?>
    <h2 class='text-center titlePage'>Sanduče</h2>
    
    <div class="col-12 d-flex   flex-column align-items-center justify-content-center" id="messages">

        <?php foreach ($result as $r): ?>

            <div class=" bg-success col-11 col-sm-8  col-lg-6 border border-circle">
                <h3 class="text-center" ><?php echo $r->MailTitle; ?></h3>
                <p class="text-center"> <?php echo $r->MailDesc; ?></p>
                <div class="div-button  col-12 d-flex justify-content-center"><a href="answer.php?ID=<?php echo $r->MailId; ?>"  id="answer">Odgovori</a></div>
            </div>

        <?php endforeach; ?>

    <?php if ($messages->rowCount() === 0): ?>

        <div class=" bg-success col-11  col-lg-7 border border-circle">

            <p class="text-center">Trenutno nema novih poruka</p>
        </div>

    <?php endif; ?>
    </div>

    <?php require_once __DIR__ . '/components/footer.php';?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>