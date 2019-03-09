<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!(isset($_SESSION['logged_in']) && ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator"))) {
    Header("Location: login.php");
}
else
{
    if(!isset($_GET['ID']))
    {
        Header("Location: recepts.php");
    }
    else
    {
        $id = $_GET["ID"];
        $sqlExist = "SELECT * FROM recepts where ReceptId = :id";
        include __DIR__ . '/config/config.php';
        $find = $pdo->prepare($sqlExist);
        $find->execute([":id" => $id]);
        if($find->rowCount() == 0)
        {
            unset($pdo);
            header("Location: recepts.php");
        }
        $r = $find->fetch();
        $sqlImages = "SELECT SrcImage as src, i.ImageId as id from imagerecept im inner join images i
  on im.ImageID = i.ImageID where im.ReceptId = :id";
        $photos = $pdo->prepare($sqlImages);
        $photos->execute([":id" => $id]);
       $result = $photos->fetchAll();

    }
}
?>
<?php require_once __DIR__ . '/components/head.php';
showHead("Izmeni recept");
?>
<body>
<div class="container-fluid cFluid">
    <?php require_once __DIR__ . '/components/showMenu.php'; ?>

    <div id="add-content" class="col-md-12">


        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane active-content fade active show" id="pills-recepts" role="tabpanel"
                 aria-labelledby="pills-recepts-tab">

                <h2 class='text-center titlePage title-add'>Izmeni recept</h2>
                <div class="col-12 d-flex justify-content-center">
                    <div class=" col-lg-5 col-md-7  d-flex justify-content-around  flex-column align-items-center formLogin">
                        <form>
                            <p>Ime recepta</p>
                            <input type="text" value="<?php echo $r->ReceptTitle; ?>" class="col-sm-7 col-lg-7 col-md-7 col-xs-12 form-control-success"
                                   name="recept-title"
                                   id="recept-title">
                            <p>Opis recepta</p>
                            <textarea  class="col-sm-10 col-lg-10 col-md-10 col-xs-11 form-control-success"
                                      id="recept-desc" name="recept-desc"><?php echo $r->ReceptDescription; ?></textarea>
                            <p>Sastav jela</p>

                            <textarea class="col-sm-10 col-lg-10 col-md-10 col-xs-12 form-control-success"
                                      name="recept-elements" id="recept-elements"><?php echo $r->ReceptComponent; ?></textarea>

                            <input type="button" name="editrecept" data-id="<?php echo $id; ?>" id="editrecept" class='btn btn-outline-success'
                                   value="Izmeni">
                            <p class="addresult"></p>

                        </form>

                    </div>
                </div>
            </div>
            <div class="tab-pane active-content fade active show" id="pills-recepts" role="tabpanel"
                 aria-labelledby="pills-recepts-tab">

                <h2 class='text-center titlePage title-add'>Obrisi slike recepta</h2>
                <div class="col-12 d-flex">
                    <div class="small-photos col-11 flex-row d-flex justify-content-center flex-wrap">

                        <?php foreach($result as $i):?>
                            <div class="imgdelete">
                                <img src='receptimages/<?php echo $i->src;?>' alt=''>
                                <div class="deletebutton" data-receptId="<?php echo $id; ?>" data-id="<?php echo $i->id;?>">
                                    <a  href=""><i class="fa fa-times" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="imgdelete" id="imgdelete" data-receptImgId="<?php echo $id; ?>">
                            <label for="file-images" id="addphoto"><i class="fa fa-plus" aria-hidden="true"></i>
                            </label>
                        <input type="file" multiple name="recept-images" id="file-images">
                        </div>
                    </div>


                </div>
                <p class="addresult"></p>
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
<script src="js/editrecept.js"></script>
<script src="js/deleteimages.js"></script>

</body>
</html>