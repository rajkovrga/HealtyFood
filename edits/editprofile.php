<?php

session_start();
$obj = json_decode($_POST['json']);
require_once __DIR__ . '/../config/config.php';

$username = $obj->username;
$desc = $obj->desc;
$src = NULL;
if (isset($_FILES['file'])) {
    $up = "/../profileimages/";
    $imageExtensions = array('jpeg', 'gif', 'jpg', 'png');
    $r = explode('.', $_FILES['file']['name']);
    if (in_array($r[count($r) - 1], $imageExtensions)) {
        if ($_FILES['file']['size'] < 2097152) {
            $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUFLSANCMSAAJJLNALKC897342985372985";
            $file = str_shuffle($string);
            $fileNameEnd = substr($file, 0, 15);
            $src = $fileNameEnd . $_SESSION['UserId'] . '.' . $r[count($r) - 1];
            $pathFile = $up . $src;
            $path = __DIR__ . $pathFile;

            $res = move_uploaded_file($_FILES['file']['tmp_name'], $path);
        } else {
            echo "Fajl je prevelik";
        }
    } else {
        echo "Nije dobar format";
    }
}

$sqlUsername = 'SELECT * FROM `users` where  Username = :username where UserId <> :id';
$usernameQuery = $pdo->prepare($sqlUsername);
$usernameQuery->execute([':username' => $username, ':id' => $_SESSION['UserId']]);
if ($usernameQuery->rowCount() == 0) {
    $sqlEditUser = "UPDATE `users` SET `Username` = :uname, `UserDesc` = :description, `UserImg` = :src
                WHERE `UserId` = :userid";
    if ($src === NULL) {
        $selectImg = "SELECT * from `users` where UserId = :id";
        $select = $pdo->prepare($selectImg);
        $select->execute([":id" => $_SESSION['UserId']]);
        $res = $select->fetch();
        echo $res->UserImg;
        $src = $res->UserImg;
        echo $src . "null";
    }
    $editUser = $pdo->prepare($sqlEditUser);
    $editUser->execute([
        ':uname' => $username,
        ':description' => $desc,
        ':src' => $src,
        ':userid' => $_SESSION['UserId']
    ]);
    if ($editUser) {
        $_SESSION['Username'] = $username;
//            $objAjax = [
//                "src" =>
//            ];
        http_response_code(200);
        header("Location: /../profile.php");
    }

} else {
    echo "Korisnik sa ovim imenom vec postoji";

}
unset($pdo);




