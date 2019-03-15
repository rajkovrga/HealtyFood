<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}
$obj = json_decode($_POST['json']);
require_once __DIR__ . '/../config/config.php';

$username = $obj->username;
$desc = $obj->desc;
$src = NULL;
if (preg_match("/^[A-ZČĆŠĐŽa-zšđžčć0-9\_\-]{3,15}$/", $username) && preg_match("/^([A-ZČĆŠĐŽ][a-zšđžčć0-9A-ZČĆŠĐŽ,\-\'.\s]{0,490})$/", $desc)) {

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

    $sqlUsername = 'SELECT * FROM `users` where  Username = :username and UserId <> :id';

    $usernameQuery = $pdo->prepare($sqlUsername);
    $usernameQuery->execute([':username' => $username, ':id' => $_SESSION['UserId']]);



    if ($usernameQuery->rowCount() == 0) {
        $sqlEditUser = "UPDATE `users` SET `Username` = :uname, `UserDesc` = :description, `UserImg` = :src
                WHERE `UserId` = :userid";
        $selectImg = "SELECT * from `users` where UserId = :id";
        $select = $pdo->prepare($selectImg);
        $select->execute([":id" => $_SESSION['UserId']]);
        $res = $select->fetch();
        if ($src === NULL) {

            $src = $res->UserImg;
        }
        else
        {
            unlink(__DIR__."/../profileimages/".$res->UserImg);
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
            http_response_code(200);
            header("Location: /../profile.php");
        }

    } else {
        echo "Korisnik sa ovim imenom vec postoji";
    }
} else {
    http_response_code(344);
}

unset($pdo);




