<?php
session_start();
$file = file_get_contents("php://input");
$obj = json_decode($file);
try {
    include __DIR__ . '/../config/config.php';
    $SQLcountImages = "SELECT * from imagerecept where ReceptId = :id";
    $countImages = $pdo->prepare($SQLcountImages);
    $countImages->execute([":id" => $obj->receptId]);
    if($countImages->rowCount() > 1)
    {
        if ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator") {
            $id = $obj->id;

            $sqlSelect = "SELECT SrcImage as src FROM images where ImageID = :id";
            $unlink = $pdo->prepare($sqlSelect);
            $unlink->execute([":id" => $id]);
            $resUnLink = $unlink->fetch();
            unlink(__DIR__."/../receptimages/".$resUnLink->src);


            $delete = "DELETE FROM imagerecept where ImageID = :id";

            $deleteimages = $pdo->prepare($delete);
            $deleteimages->execute([":id" => $id]);

            if ($deleteimages->rowCount() > 0) {
                $deleteSQL = "DELETE FROM images where ImageID = :id";
                $deleterecept = $pdo->prepare($deleteSQL);
                $deleterecept->execute([":id" => $id]);
                if ($deleterecept->rowCount() != 0) {

                    $sqlShowImages = "SELECT SrcImage as src, i.ImageId as id from imagerecept im inner join images i
                              on im.ImageID = i.ImageID where im.ReceptId = :id";

                    $res = $pdo->prepare($sqlShowImages);
                    $res->execute([":id" => $obj->receptId]);
                    $arr = $res->fetchAll();
                    echo showReceptImages($arr,$obj->receptId);
                    unset($pdo);
                }
            }


        } else {
            header("Location: ../recept.php?ID=" . $_GET["ID"]);
        }

    }
    else
    {
        echo "Nije moguce obrisasti sve slike recepta";
        unset($pdo);
        http_response_code(408);
    }

} catch (PDOException $er) {
    echo $er->getMessage();
}


function showReceptImages($arr,$ReceptId)
{
    $return = "";
    foreach ($arr as $i):
        $return .= "<div class='imgdelete'>
                                <img src='receptimages/" . $i->src . "' alt=''>
                                <div class='deletebutton' data-receptId='" . $ReceptId . "' data-id='" . $i->id . "'>
                                    <a><i class='fa fa-times' aria-hidden='true'></i></a>
                                </div>
                            </div>";
    endforeach;
    $return .= "<div class=\"imgdelete\" id=\"imgdelete\" data-receptImgId='". $ReceptId ."'>

                            <label for='file-images' id='addphoto'><i class='fa fa-plus' aria-hidden='true'></i>
                            </label>
                        <input type='file' multiple name='recept-images' id='file-images'  >
                        </div>";
    return $return;
}


