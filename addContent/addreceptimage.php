<?php
$detalis = json_decode($_POST['detalis']);
require_once __DIR__ . '/../config/config.php';

$position = $detalis->pos;
$image = $_FILES['image' . $position];
if (isset($image)) {
    $up = "/../receptimages/";
    $imgExtensions = array('png', 'gif', 'jpeg', 'jpg');
    $r = explode('.', $image['name']);
    echo $image['name'];

    if ($resultFile = in_array($r[count($r) - 1], $imgExtensions)) {
        if ($image['size'] < 149715200) {
            $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUFLSANCMSAAJJLNALKC897342985372985";
            $img = str_shuffle($string);
            $imgNameEnd = substr($img, 0, 15);
            $src = $imgNameEnd . '.' . $r[count($r) - 1];
            $pathImg = $up . $src;
            $path = __DIR__ . $pathImg;
            $res = move_uploaded_file($image['tmp_name'], $path);

            if ($resultFile) {

                $queryName = 'select ReceptId from `recepts` where ReceptTitle = :name';
                $recept = $pdo->prepare($queryName);
                $recept->execute([
                    ':name' => $detalis->name
                ]);
                $recF = $recept->fetch();
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


                    }

                }

            }

        } else {
            echo "Fajl je prevelik";
        }

    }
}