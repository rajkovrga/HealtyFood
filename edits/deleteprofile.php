<?php
session_start();
$file = file_get_contents("php://input");
$obj = json_decode($file);
$id = $obj->id;
echo $id;
$sqlUser = "SELECT * FROM users where UserId = :id ";
require_once __DIR__ . '/../config/config.php';
$userQuery = $pdo->prepare($sqlUser);
$userQuery->execute([":id" => $id]);
$userResult = $userQuery->fetch();
try {
    if ($userResult->UserImg != "" || $userResult->UserImg != NULL) {
        unlink(__DIR__ . "/../profileimages/" . $userResult->UserImg);
    }
    $SQLMailer = "UPDATE mailer SET UserId = :nullValue where UserId = :id";
    $mailerQuery = $pdo->prepare($SQLMailer);
    $mailerQuery->execute([":id" => $id, ":nullValue" => null]);

    $SQLRecept = "UPDATE recepts SET UserId = :newValue where UserId = :id";
    $receptQuery = $pdo->prepare($SQLRecept);
    $receptQuery->execute([":id" => $id, ":newValue" => $_SESSION["UserId"]]);

    $SQLBook = "UPDATE books SET UserId = :newValue where UserId = :id";
    $bookQuery = $pdo->prepare($SQLBook);
    $bookQuery->execute([":id" => $id, ":newValue" => $_SESSION["UserId"]]);

    $sqlDelete = "DELETE FROM users where UserId = :id";
    $deleteQuery = $pdo->prepare($sqlDelete);
    $deleteQuery->execute([":id" => $id]);

    if ($deleteQuery->rowCount() == 1) {
        unset($pdo);
        http_response_code(200);
        unset($_SESSION);
        session_unset();
        session_destroy();
        header('Location: /login.php');

    } else {
        unset($pdo);
        http_response_code(422);
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}
