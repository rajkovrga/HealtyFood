<?php
session_start();
$file = file_get_contents("php://input");
$obj = json_decode($file);
$id = $obj->id;
echo $id;
$sqlUser = "SELECT * FROM users where UserId = :id AND StatusId != :admin AND StatusId != :moder";
require_once __DIR__ . '/../config/config.php';
$userQuery = $pdo->prepare($sqlUser);
$userQuery->execute([":id"=>$id, ":admin" => "1",":moder" => "2"]);
$userResult = $userQuery->fetch();
try
{
    if($userQuery->rowCount() != 0)
    {
        if($userResult->UserImg != "" || $userResult->UserImg != NULL)
        {
            unlink(__DIR__."/../profileimages/".$userResult->UserImg);
        }
        $SQLMailer = "UPDATE mailer SET UserId = :nullValue where UserId = :id";
        $mailerQuery = $pdo->prepare($SQLMailer);
        $mailerQuery->execute([":id"=>$id, ":nullValue" => null]);

        $SQLRecept = "UPDATE recepts SET UserId = :newValue where UserId = :id";
        $receptQuery = $pdo->prepare($SQLRecept);
        $receptQuery->execute([":id"=>$id, ":newValue" => null]);

        $SQLBook = "UPDATE books SET UserId = :newValue where UserId = :id";
        $bookQuery = $pdo->prepare($SQLBook);
        $bookQuery->execute([":id"=>$id, ":newValue" =>null]);

        $SQLQuestion = "UPDATE questions SET UserId = :newValue where UserId = :id";
        $questionQuery = $pdo->prepare($SQLBook);
        $questionQuery->execute([":id"=>$id, ":newValue" =>null]);

        $SQLAnswer = "UPDATE answeruser SET UserId = :newValue where UserId = :id";
        $questionQuery = $pdo->prepare($SQLBook);
        $questionQuery->execute([":id"=>$id, ":newValue" =>null]);

        $sqlDelete = "DELETE FROM users where UserId = :id";
        $deleteQuery = $pdo->prepare($sqlDelete);
        $deleteQuery->execute([":id"=>$id]);
        if($deleteQuery->rowCount() == 1)
        {
            unset($pdo);
            http_response_code(200);
        }
        else
        {
            unset($pdo);
            http_response_code(422);
        }
    }
    else
    {
        unset($pdo);
        http_response_code(425);
    }

}
catch (PDOException $e)
{
    echo $e->getMessage();
}
