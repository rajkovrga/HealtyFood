<?php
$file = file_get_contents("php://input");
$obj = json_decode($file);

$idUser = $obj->UserId;
$idStatus = $obj->StatusId;
try
{
    $sqlUpdate = "UPDATE users SET StatusId = :idStatus where UserId = :id";
    include  __DIR__ . '/../config/config.php';

    $queryUpdate = $pdo->prepare($sqlUpdate);
    $queryUpdate->execute([":idStatus" => $idStatus,
        ":id"=>$idUser]);
    if($queryUpdate->rowCount() === 0)
    {
        unset($pdo);
        http_response_code(422);
    }
    else
    {
        unset($pdo);
        http_response_code(200);
    }
}
catch (PDOException $e)
{
    echo $e->getMessage();
}

