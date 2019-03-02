<?php

session_start();
$obj = json_decode($_POST['json']);
$descBook = $obj->desc;
$titleBook = $obj->titleBook;
$regDesc = "/^[A-ZČĆŠĐŽ][ČĆŠĐŽa-z0-9A-Zšđžčć,-\/\.\s\']{5,}$/";
$book = $_FILES['book'];
echo $obj->titleBook;
try {
    if (
        preg_match($regDesc, $obj->desc)
        &&
        preg_match("/^[A-ZČĆŠĐŽ][šđžčća-z0-9A-Z\,\-\/\'\.\s\(\)ČĆŠĐŽ]{5,}$/", $titleBook)) {
        if (isset($book)) {
            $up = "/../booksfiles/";
            $r = explode('.', $book['name']);
            if ($resultFile = preg_match("/(\.pdf)$/i",$book['name'])) {
                if ($book['size'] < 21715200) {
                    $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUFLSANCMSAAJJLNALKC897342985372985";
                    $file = str_shuffle($string);
                    $fileNameEnd = substr($file, 0, 15);
                    $src = $fileNameEnd . '.' . $r[count($r) - 1];
                    $pathFile = $up . $src;
                    $path = __DIR__ . $pathFile;
                    $res = move_uploaded_file($book['tmp_name'], $path);
                } else {
                    unset($pdo);
                    http_response_code(401);
                }
            } else {
                unset($pdo);
                http_response_code(402);

            }
            if ($resultFile) {
                include __DIR__ . '/../config/config.php';
                $sqlAddBook = "INSERT INTO `books`( `UserId`, `BookLink`, `BookTitle`,`BookDescription`) 
            VALUES ( :userID , :link , :title, :description)";
                $addBook = $pdo->prepare($sqlAddBook);
                $addBook->execute([
                    ":userID" => $_SESSION['UserId'],
                    ":link" => $src,
                    ":title" => $titleBook,
                    ":description" => $descBook
                ]);
                unset($pdo);
                //    header("Location: /../books.php");
            }
        } else {
            unset($pdo);
            echo preg_match("/^[A-ZČĆŠĐŽ][šđžčća-z0-9A-ZČĆŠĐŽ\,\-\/'\.\s]{5,}$/", $titleBook);
            http_response_code(400);
        }
        }

}
catch (PDOException $e)
{
    echo $e->getMessage();
}