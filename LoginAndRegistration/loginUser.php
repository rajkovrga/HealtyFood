<?php
session_start();
$dataRegistration = file_get_contents('php://input');
$obj = json_decode($dataRegistration);
echo $obj->email;
$regPass = "/^(?=.*[\d])(?=.*[A-ZČĆŠĐŽ])(?=.*[a-zšđžčć])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/";
$regMail = "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zšđžčćA-ZČĆŠĐŽ\-0-9]+\.)+[a-zšđžčćA-ZČĆŠĐŽ]{2,}))$/";
if (preg_match($regMail, $obj->email) && preg_match($regPass, $obj->password))
{
    try {
        require_once __DIR__ . '/../config/config.php';
        $sql = "SELECT UserImg,Username,UserMail,s.StatusName as status,UserId,UserPassword 
from users as u inner join statuses as s on u.StatusId = s.StatusId
 where UserMail = :mail and StatusName <> :name AND MailActivationStatus = :num";
        $st = $pdo->prepare($sql);
        $ex = $st->execute([
            ':mail' => $obj->email,
            ":name" => "Neaktivan",
            ":num" => 1
        ]);
        $user = $st->fetch();
        unset($pdo);
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
    } catch (PDOException $er) {
        echo $er->getMessage();
    }

    }
else
{
    http_response_code(400);

}
