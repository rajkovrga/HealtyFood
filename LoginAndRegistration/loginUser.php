<?php
session_start();
require_once __DIR__ . '/../config/config.php';
$dataRegistration = file_get_contents('php://input');
$obj = json_decode($dataRegistration);
echo $obj->email;
$sql = "SELECT UserImg,Username,UserMail,s.StatusName as status,UserId,UserPassword from users as u inner join statuses as s on u.StatusId = s.StatusId where UserMail = :mail and StatusName <> :name" ;

$st = $pdo->prepare($sql);

$ex = $st->execute([
    ':mail' => $obj->email,
    ":name" => "Neaktivan"
]);
$user = $st->fetch();


if ($st->rowCount() > 0 && password_verify($obj->password, $user->UserPassword)) {
    $_SESSION['logged_in'] = true;
    $_SESSION['UserId'] = $user->UserId;
    $_SESSION['Username'] = $user->Username;
    $_SESSION['StatusUser'] = $user->status;
    $_SESSION['FirstName'] = $user->FirstName;
    $_SESSION['LastName'] = $user->LastName;
    $_SESSION['Mail'] = $user->UserMail;
    header("Location: ../index.php");
    http_response_code(200);
} else {
    http_response_code(330);
}


