<?php
require_once __DIR__ . '/../config/config.php';
try {
    $user = $_GET['username'];
    $token = $_GET['token'];
    $sql = "SELECT * from `users` where `Username` = :username and `MailActivationStatus` = :status and `Token` = :token";
    $st = $pdo->prepare($sql);
    $ex = $st->execute([':username' => $user, ':status' => 0, ':token' => $token]);
    echo '<br/>';
    echo $result = count($st->fetchAll());

    if ($result != 0) {
        $sqlUpdate = "UPDATE `users` SET `MailActivationStatus` = :status , `Token` = :newUserToken WHERE `Username` = :username and `Token` = :token";
        $state = $pdo->prepare($sqlUpdate);
        $execute = $state->execute([
            ':status' => 1,
            ':newUserToken' => NULL,
            ':username' => $user,
            ':token' => $token]);
        header('Location: ../login.php');
    }
    header('Location: ../login.php');
}
catch(Exception $er)
{
    echo $er->getMessage();
}