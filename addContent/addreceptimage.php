<?php
$detalis = json_decode($_POST['detalis']);
$position = $detalis->pos;
$image = $_FILES['image' . $position];
try {
    if (isset($image)) {
        $up = "/../receptimages/";
        $imgExtensions = array('png', 'gif', 'jpeg', 'jpg');
        $r = explode('.', $image['name']);
        if ($resultFile = preg_match("/(\.jpg|\.jpeg|\.png|\.gif)$/i",$image["name"])) {
            echo " TU SAM ";
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
                    $queryName = 'select ReceptId from `recepts` where ReceptTitle = :name';
                    $recept = $pdo->prepare($queryName);
                    $recept->execute([
                        ':name' => $detalis->name
                    ]);
                    $recF = $recept->fetch();
                    echo $recept->rowCount();
                    if ($recept->rowCount() == 1) {

                        $insertImages = "INSERT INTO `images`(`SrcImage`) VALUES (:src)";
                        $images = $pdo->prepare($insertImages);
                        $images->execute([':src' => $src]);
                        if ($images) {
                            $imgSrcSQL = "SELECT ImageID from `images` where SrcImage = :src";
                            $imgSrc = $pdo->prepare($imgSrcSQL);
                            $imgSrc->execute([':src' => $src]);
                            $imgF = $imgSrc->fetch();

                            $insertRelationSQL = 'INSERT INTO `imagerecept`(`ImageID`, `ReceptId`) VALUES (:img,:rec)';
                            $insertRelation = $pdo->prepare($insertRelationSQL);
                            $insertRelation->execute([
                                ':img' => $imgF->ImageID,
                                ':rec' => $recF->ReceptId
                            ]);
                            unset($pdo);

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