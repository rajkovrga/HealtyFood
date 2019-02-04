<?php

$dataRegistration = file_get_contents('php://input');

$obj = json_decode($dataRegistration);
$passwordReg = '/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/';
$firstLastNameReg = '/^([A-Z][a-z]{2,12})[\s]*$/';
$uNameReg = '/^[a-z0-9_-]{3,15}$/';
if (preg_match($passwordReg, $obj->UserPassword) &&
    filter_var($obj->UserMail, FILTER_VALIDATE_EMAIL) &&
    preg_match($firstLastNameReg, $obj->LastName) &&
    preg_match($firstLastNameReg, $obj->FirstName) &&
    preg_match($uNameReg, $obj->Username)) {

    require_once __DIR__ . '/../config/config.php';
    $sqlFindUser = 'SELECT * from `users` where `UserMail` = :mail or `Username` = :username';
    $findUser = $pdo->prepare($sqlFindUser);
    $executeUser = $findUser->execute([':username' => $obj->Username, ':mail' => $obj->UserMail]);

    if (count($findUser->fetchAll()) == 0) {
        $sql = "INSERT INTO `users`( `Username`, `UserMail`, `FirstName`, `LastName`, `UserPassword`, `StatusID`, `Token`)
                VALUES (:username , :mail, :fname, :lname, :password,:statusID,:token)";
        $prepare = $pdo->prepare($sql);
        $tokenString = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZCVBNM';
        $token = substr(str_shuffle($tokenString), 0, 10);
        $prepare->execute([
            ':username' => $obj->Username,
            ':mail' => $obj->UserMail,
            ':fname' => $obj->FirstName,
            ':lname' => $obj->LastName,
            ':password' => password_hash($obj->UserPassword, PASSWORD_BCRYPT),
            ':statusID' => 1,
            ':token' => $token
        ]);

        require_once __DIR__ . '\..\SendMail\activationLink.php';
        sendActivationLink($obj->UserMail,$token,$obj->Username);
        http_response_code(200);
        unset($pdo);
    } else {
        http_response_code(423);
        unset($pdo);
    }
} else {
    http_response_code(422);
}
