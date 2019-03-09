<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}

$file = file_get_contents("php://input");

$obj = json_decode($file);

$title = $obj->title;
$desc = $obj->desc;
$id = $_SESSION['UserId'];
$mail = $_SESSION["Mail"];
if (preg_match("/^[A-ZČĆŠĐŽ][šđžčća-z0-9A-ZČĆŠĐŽ\,\-\/\'\.\s]{5,}$/", $desc)
    && preg_match("/^([A-ZČĆŠĐŽ][A-ZČĆŠĐŽ\s\-\,\.\(\)a-zšđžčć]{2,})$/", $title)) {
    $sqlSend = "INSERT INTO `mailer`( `UserId`, `MailTitle`, `MailDesc`, `MailUser`) VALUES (:id,:title,:descritpion,:mail)";
    include __DIR__ . '/../config/config.php';
    $query = $pdo->prepare($sqlSend);
    $query->execute([
        ":id" => $id,
        ":title" => $title,
        ":descritpion" => $desc,
        ":mail" => $mail
    ]);
    if($query->rowCount() != 0)
    {
        unset($pdo);

        http_response_code(200);
    }
    else
    {
        unset($pdo);

        http_response_code(402);
    }

} else {
    unset($pdo);

    http_response_code(422);
}