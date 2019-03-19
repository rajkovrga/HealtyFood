<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/components/head.php';
showHead("Izmeni knjigu");
?>
<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/components/showMenu.php';


if (!(isset($_SESSION['logged_in']) && ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator"))) {
    Header("Location: login.php");
}
else
{
    if(!isset($_GET['ID']))
    {
        Header("Location: books.php");
    }
    else
    {
        $id = $_GET["ID"];
        $sqlExist = "SELECT * FROM books where BookId = :id";
        include __DIR__ . '/config/config.php';
        $find = $pdo->prepare($sqlExist);
        $find->execute([":id" => $id]);
        if($find->rowCount() == 0)
        {
            unset($pdo);
            header("Location: books.php");
        }
        $r = $find->fetch();
        $sqlImages = "SELECT * from books where BookId = :id";
        $photos = $pdo->prepare($sqlImages);
        $photos->execute([":id" => $id]);
        $result = $photos->fetchAll();

    }
}
?>

    <div id="add-content" class="col-md-12">
                <h2 class='text-center titlePage title-add'>Dodaj knjigu</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Naslov knjige</p>
                            <input value="<?php echo $r->BookTitle; ?>" type="text" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success"
                                   name="username"
                                   id="titlebook">
                            <p>Opis knjige</p>
                            <textarea id="descbook" class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                                      name="first-desc"><?php echo $r->BookDescription; ?></textarea>
                            <p class="p-files">Fajl knjige</p>
                            <div class="custom-file col-8">
                                <input  type="file" name="bookfile" id="bookfile"
                                       class="add-file custom-file-input col-sm-10 col-lg-10 col-md-10 col-xs-11">
                                <label class="custom-file-label" for="bookfile">Choose file</label>

                            </div>
                            <input type="button" name="editbook" id="editbook" data-id="<?php echo $_GET["ID"];?> " class='btn btn-outline-success'
                                   value="Izmeni">

                            <p class="addresult"></p>

                        </form>

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
<script src="js/editbook.js"></script>
</body>
</html>