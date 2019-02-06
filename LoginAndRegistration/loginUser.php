<?php
session_start();
require_once __DIR__ . '/../config/config.php';
$dataRegistration = file_get_contents('php://input');
$obj = json_decode($dataRegistration);

$sql = "SELECT Username,s.StatusName as status,UserId,UserPassword from users as u inner join statuses as s on u.StatusId = s.StatusId where Username = :username";

$st = $pdo->prepare($sql);

$ex = $st->execute([
    ':username' => $obj->username
]);
$user = $st->fetch();


if (($obj->username == $user->Username) && password_verify($obj->password, $user->UserPassword)) {
    $_SESSION['logged_in'] = true;
    $_SESSION['UserId'] = $user->UserId;
    $_SESSION['Username'] = $user->Username;
    $_SESSION['StatusUser'] = $user->status;
    header("Location: ../index.php");
    http_response_code(200);
} else {
    http_response_code(330);
}


