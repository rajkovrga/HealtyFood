<?php
session_start();
$id = $_SESSION["UserId"];
try
{
    $SQLImage = "SELECT * FROM users where UserId = :id";
    include __DIR__ . '/../config/config.php';
    $imageQuery = $pdo->prepare($SQLImage);
    $imageQuery->execute([":id" => $id]);
    $imageResult = $imageQuery->fetch();

    if($imageQuery->rowCount() !== 0)
    {
        if($imageResult->UserImg !== "" || $imageResult->UserImg !== NULL)
        {
            unlink(__DIR__ . "/../profileimages/" . $imageResult->UserImg);

        }

        $SQLUpdate = "UPDATE users SET UserImg = :new where UserId = :id";
        $updateQuery = $pdo->prepare($SQLUpdate);
        $updateQuery->execute([":new" => NULL,":id" => $id]);

        if($updateQuery->rowCount() === 0 )
        {
            unlink($pdo);
            http_response_code(400);
        }
        else
        {
            unlink($pdo);
            http_response_code(200);
        }


    }

}
catch (PDOException $e)
{
    echo $e->getMessage();
}

