<?php
session_start();
if (isset($_GET["ID"])) {
    try {
        include __DIR__ . '/../config/config.php';
        if ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator") {

            $id = $_GET["ID"];
            $unlink = "SELECT BookLink from books where BookId = :id";
            $unlinkQuery = $pdo->prepare($unlink);
            $unlinkQuery->execute([":id" => $id]);
            $unlinkQueryResult = $unlinkQuery->fetch();
            unlink(__DIR__."/../booksfiles/".$unlinkQueryResult->BookLink);

            $delete = "DELETE FROM books where BookId = :id";

            $deleteimages = $pdo->prepare($delete);
            $deleteimages->execute([":id" => $id]);
            header("Location: ../books.php");
        } else {
            header("Location: ../books.php");
        }
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}


