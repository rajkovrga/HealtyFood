<?php


session_start();
$obj = json_decode($_POST['json']);
$descBook = $obj->desc;
$titleBook = $obj->titleBook;
$regDesc = "/^[A-ZČĆŠĐŽ][ČĆŠĐŽa-z0-9A-Zšđžčć,-\/\.\s\']{5,}$/";
$book = isset($_FILES['book']) ? $_FILES['book'] : false;

try {
    if (
        preg_match($regDesc, $obj->desc)
        &&
        preg_match("/^[A-ZČĆŠĐŽ][šđžčća-z0-9A-Z\,\-\/\'\.\s\(\)ČĆŠĐŽ]{5,}$/", $titleBook)) {
        if ($book != false) {
            $up = "/../booksfiles/";
            $r = explode('.', $book['name']);
            if ($resultFile = preg_match("/(\.pdf)$/i", $book['name'])) {
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
        }
            if ($book === false) {
                include __DIR__ . '/../config/config.php';
                $sqlOldLink = "SELECT * FROM books where BookId = :id";
                $oldQuery = $pdo->prepare($sqlOldLink);
                $oldQuery->execute([":id" => $obj->id]);
                $oldResult = $oldQuery->fetch();
                $src = $oldResult->BookLink;
            }
                $sqlAddBook = "UPDATE `books` SET `BookLink`= :link,`BookTitle`= :title,`BookDescription`= :description WHERE BookId = :id";
                $addBook = $pdo->prepare($sqlAddBook);
                $addBook->execute([
                    ":link" => $src,
                    ":title" => $titleBook,
                    ":description" => $descBook,
                    ":id" => $obj->id
                ]);
                unset($pdo);
                header("Location: /../books.php");

        } else {
            unset($pdo);
            http_response_code(400);
        }


} catch (PDOException $e) {
    echo $e->getMessage();
}