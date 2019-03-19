<?php
$file = file_get_contents("php://input");
$obj = json_decode($file);

$idQuestion = $obj->idQuestion;
$idUser = $obj->idUser;
$idAnswer = $obj->idAnswer;

try {
    include __DIR__ . '/../config/config.php';
    $sqlUser = "SELECT * FROM answeruser where UserId = :id";
    $userQuery = $pdo->prepare($sqlUser);
    $userQuery->execute([":id" => $idUser]);

    if ($userQuery->rowCount() != 0) {
        unset($pdo);
        http_response_code(400);
    } else {

        $insertAnswer = "INSERT INTO `answeruser`(`QuestionId`, `AnswerId`, `UserId`) VALUES (:question,:answer,:userid)";
        $queryAnswer = $pdo->prepare($insertAnswer);
        $queryAnswer->execute([":question" => $idQuestion, ":answer" => $idAnswer, ":userid" => $idUser]);

        if ($queryAnswer->rowCount() == 0) {
            unset($pdo);
            http_response_code(422);
        } else {
            unset($pdo);
            http_response_code(200);
        }

    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

