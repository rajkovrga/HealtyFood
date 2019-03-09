<?php
session_start();
if (isset($_GET["ID"])) {
    try {
        include __DIR__ . '/../config/config.php';
        if ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator") {

            $id = $_GET["ID"];
            $delete = "DELETE FROM imagerecept where ReceptId = :id";

            $deleteimages = $pdo->prepare($delete);
            $deleteimages->execute([":id" => $id]);

            if ($deleteimages->rowCount() > 0) {
                $deleteSQL = "DELETE FROM recepts where ReceptId = :id";
                $deleterecept = $pdo->prepare($deleteSQL);
                $deleterecept->execute([":id" => $id]);
                if ($deleterecept->rowCount() != 0) {
                    header("Location: ../recepts.php");
                    unset($pdo);
                }
            }


        } else {

            header("Location: ../recept.php?ID=" . $_GET["ID"]);
        }

    } catch (PDOException $er) {
        echo $er->getMessage();
    }


}