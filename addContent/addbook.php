<?php

session_start();
$obj = json_decode($_POST['json']);

$descBook = $obj->desc;
$titleBook = $obj->titleBook;
$regDesc = '/^[A-ZČĆŠĐŽ][a-z0-9A-Zšđžčć,-\/\.\s\']{5,490}$/';
$book = $_FILES['book'];
if (
    preg_match($regDesc, $obj->desc)
    &&
    preg_match('/^([A-ZČĆŠĐŽ][A-ZČĆŠĐŽ\s\-\,\.a-zšđžčć]{2,100})$/', $titleBook)) {
    if (isset($book)) {
        $up = "/../booksfiles/";
        $fileExtensions = array('pdf');
        $r = explode('.', $book['name']);
        if ($resultFile = in_array($r[count($r) - 1], $fileExtensions)) {
            if ($book['size'] < 149715200) {
                $string = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUFLSANCMSAAJJLNALKC897342985372985";
                $file = str_shuffle($string);
                $fileNameEnd = substr($file, 0, 15);
                $src = $fileNameEnd . '.' . $r[count($r) - 1];
                $pathFile = $up . $src;
                $path = __DIR__ . $pathFile;
                $res = move_uploaded_file($book['tmp_name'], $path);
            } else {
                echo "Fajl je prevelik";
            }
        } else {
            echo "Nije dobar format";
        }
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
        header("Location: /../books.php");
    }
}
else
{
    echo "NE";
}