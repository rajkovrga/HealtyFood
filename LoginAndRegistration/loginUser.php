<?php
session_start();
require_once __DIR__ . '/../config/config.php';
$dataRegistration = file_get_contents('php://input');
$obj = json_decode($dataRegistration);

$sql = "SELECT * from `users` where Username = :username";

$st = $pdo->prepare($sql);

$ex = $st->execute([
    ':username' => $obj->username
]);
$user = $st->fetch();
if($user && password_verify($obj->password,$user['UserPassword']))
{
    $_SESSION['logged_in'] = true;
    $_SESSION['UserId'] = $user['UserId'];
    $_SESSION['Username'] = $user['Username'];

    header("Location: ../index.php");
http_response_code(200);
}
else if(!password_verify($obj->password,$user['UserPassword'],PASSWORD_BCRYPT))
{
    http_response_code(330);
}

