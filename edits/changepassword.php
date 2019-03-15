<?php
session_start();
$file = file_get_contents("php://input");
$obj = json_decode($file);
$old = $obj->old;
$new = $obj->new;
$passRegex = "/^(?=.*[\d])(?=.*[A-ZČĆŠĐŽ])(?=.*[a-zšđžčć])(?=.*[!@#$%^&*])*[\w!@#$%^&*]{8,}$/";
echo $obj->old;
if (preg_match($passRegex,$new) && preg_match($passRegex,$old)) {
    try {
        $sqlSelectUser = "SELECT * from users where UserId = :id";
        require_once __DIR__ . '/../config/config.php';
        $userQuery = $pdo->prepare($sqlSelectUser);
        $userQuery->execute([":id" => $_SESSION["UserId"]]);

        if($userQuery->rowCount() !== 0)
        {
            $userResult = $userQuery->fetch();
            if(password_verify($old,$userResult->UserPassword))
            {
                $sqlUpdate = "UPDATE users SET UserPassword = :new where UserId = :id";
                $updateQuery = $pdo->prepare($sqlUpdate);
                $updateQuery->execute([":id" => $_SESSION["UserId"],":new"=>password_hash($new,PASSWORD_BCRYPT)]);
                unset($pdo);
                if($updateQuery->rowCount() === 0)
                {
                    http_response_code(400);
                }
                else
                {
                    http_response_code(200);

                }
            }
            else
            {
                unset($pdo);
                http_response_code(401);
            }

        }
        else
        {
            unset($pdo);
            http_response_code(400);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
else
{
    http_response_code(422);
}