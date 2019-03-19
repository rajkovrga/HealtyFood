<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Odgovaranje na poruku");
?>
<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/components/showMenu.php';

if (!(isset($_SESSION['logged_in']) && $_SESSION["StatusUser"] == "Admin")) {
    Header("Location: index.php");
} else {
    if (!isset($_GET['ID'])) {
        Header("Location: mailer.php");
    } else {

        $id = $_GET["ID"];
        $sqlMail = "SELECT * FROM mailer WHERE MailId = :id and Answered = 0";
        include __DIR__ . '/config/config.php';
        $queryMail = $pdo->prepare($sqlMail);
        $queryMail->execute([":id" => $id]);
        $resultMail = $queryMail->fetch();

        if ($queryMail->rowCount() == 0) {
            unset($pdo);
            Header("Location: mailer.php");
        }
    }
}
?>

    <h2 class='text-center titlePage'>Odgovorite</h2>
    <div class="row">

        <div class="col-12 loginUser d-flex justify-content-center">
            <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                <form>
                    <h4>Poruka: </h4>
                    <p id="usermessage"> <?php echo $resultMail->MailDesc; ?></p>

                    <h4>Odgovor: </h4>
                    <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                              id="answerdesc" name="answer"></textarea>
                    <input type="button" name="answer" data-id="<?php echo $id; ?>"
                           data-user="<?php echo $resultMail->UserId; ?>" id="answer-button"
                           class='btn btn-outline-success' value="Pošalji odgovor">
                </form>
                <p id="result"></p>
            </div>
        </div>
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
<script src="js/answer.js"></script>
</body>
</html>