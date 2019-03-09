<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\vendor\autoload.php';
$file = file_get_contents("php://input");
$obj = json_decode($file);
$userMessage = $obj->userMessage;
$adminMessage = $obj->adminMessage;
$sqlUser = "SELECT * FROM users where UserId = :id";
include __DIR__ . '/../config/config.php';
$queryUser = $pdo->prepare($sqlUser);
$queryUser->execute([":id" => $obj->idUser]);
$resultUser = $queryUser->fetch();


if ($queryUser->rowCount() == 0) {
    unset($pdo);
    http_response_code(422);
} else {

    $sqlMail = "SELECT * FROM mailer where MailId = :id";
    $queryMail = $pdo->prepare($sqlMail);
    $queryMail->execute([":id" => $obj->id]);
    $resultMail = $queryMail->fetch();

    if ($queryMail->rowCount() === 0) {
        unset($pdo);

        http_response_code(422);
    } else {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'healtyfoodsite@gmail.com';
            $mail->Password = '12345healty';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('healtyfoodsite@gmail.com');
            $mail->addAddress($resultUser->UserMail);
            $mail->isHTML(true);
            $mail->Subject = $resultMail->MailTitle . "- odgovor";
            $mail->Body = "
        
        <h2>Vaša poruka:</h2>
        <br />
        <p>" . $userMessage . "</p>
        <br />
        <h2>Odgovor:</h2>
        <br />
        <p>" . $adminMessage . "</p>";
            if ($mail->send()) {
                $mailerUpdate = "UPDATE mailer SET Answered = :num where MailId = :id";
                $mailerUpdateQuery = $pdo->prepare($mailerUpdate);
                $mailerUpdateQuery->execute([
                    ":num" => 1,
                    ":id" => $obj->id
                ]);
                unset($pdo);
                http_response_code(200);
            } else {
                echo "tu sammmm";
                unset($pdo);
                http_response_code(422);
            }
        } catch (Exception $e) {
            echo "tu sam bre";
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            http_response_code(422);
        }

    }
}