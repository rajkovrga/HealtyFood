<?php

$detalis = json_decode($_POST['detalis']);
$position = $detalis->pos;
$id = $detalis->id;

$image = $_FILES['image' . $position];
try {
    if (isset($image)) {
        $up = "/../receptimages/";
        $imgExtensions = array('png', 'gif', 'jpeg', 'jpg');
        $r = explode('.', $image['name']);
        if ($resultFile = preg_match("/(\.jpg|\.jpeg|\.png|\.gif)$/i",$image["name"])) {
            if ($image['size'] < 190715200) {
                $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUFLSANCMSAAJJLNALKC897342985372985";
                $img = str_shuffle($string);
                $imgNameEnd = substr($img, 0, 15);
                $src = $imgNameEnd . '.' . $r[count($r) - 1];
                $pathImg = $up . $src;
                $path = __DIR__ . $pathImg;
                $res = move_uploaded_file($image['tmp_name'], $path);
                if ($resultFile) {
                    include __DIR__ . '/../config/config.php';

                    $insertImages = "INSERT INTO `images`(`SrcImage`) VALUES (:src)";
                    $images = $pdo->prepare($insertImages);
                    $images->execute([':src' => $src]);

                    if ($images->rowCount() != 0) {
                        $sqlIdImage = "SELECT ImageID FROM images where SrcImage = :src ";

                        $idImage = $pdo->prepare($sqlIdImage);
                        $idImage->execute([":src" => $src]);
                        $resultId = $idImage->fetch();
                        if ($idImage->rowCount() != 0) {
                            $insertRelationSQL = 'INSERT INTO `imagerecept`(`ImageID`, `ReceptId`) VALUES (:img,:rec)';
                            $insertRelation = $pdo->prepare($insertRelationSQL);
                            $insertRelation->execute([
                                ':img' => $resultId->ImageID,
                                ':rec' => intval($id)
                            ]);

                            if($insertRelation->rowCount() != 0)
                            {
                                $sqlShowImages = "SELECT SrcImage as src, i.ImageId as id from imagerecept im inner join images i
                              on im.ImageID = i.ImageID where im.ReceptId = :id";
                                $res = $pdo->prepare($sqlShowImages);
                                $res->execute([":id" => $id]);
                                $arr = $res->fetchAll();
                                echo showReceptImages($arr,$id);
                            }
                        }
                    }
                }
                else
                {
                    unset($pdo);
                    http_response_code(400);
                }
            } else {
                unset($pdo);
                http_response_code(406);
            }

        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
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
