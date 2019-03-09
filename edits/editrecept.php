<?php
session_start();
if (!(isset($_SESSION['logged_in']) && ($_SESSION["StatusUser"] == "Admin" || $_SESSION["StatusUser"] == "Moderator"))) {
    Header("Location: login.php");
}
$obj = json_decode($_POST['recept']);
$title = $obj->title;
$oldTitle = $obj->oldTitle;
$desc = $obj->desc;
$elements = $obj->elements;
$id = $obj->id;
$regexTitle = "/^([A-ZČĆŠĐŽ][\s\-,.a-zšđžčć]{2,150})$/";
$regexDesc = "/^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z\,\-\.\s]{5,}$/";
$regexElements = "/^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z\,\-\.\/\s]{5,}$/";
try {
    if (preg_match($regexTitle,$title) && preg_match($regexDesc,$desc) && preg_match($regexElements,$elements)) {
        require_once __DIR__ . '/../config/config.php';
        $SQLname = 'SELECT * FROM `recepts` where ReceptTitle <> :name OR (ReceptTitle = :oldName AND ReceptId = :id)';
        $titles = $pdo->prepare($SQLname);
        $titles->execute([':name' => $title,":id"=>$id,":oldName"=>$oldTitle]);
        if ($titles->rowCount() != 0 ) {
            $SQLRecept = "UPDATE `recepts` SET `ReceptTitle`= :title,`ReceptComponent`= :elements,`ReceptDescription`= :description WHERE ReceptId = :id";
            $insertRecept = $pdo->prepare($SQLRecept);
            $insertRecept->execute([
                ':title' => $title,
                ':elements' => $elements,
                ':description' => $desc,
                ':id' => $id
            ]);
            if ($insertRecept) {
                unset($pdo);
                echo $id;
                http_response_code(200);
            } else {
                unset($pdo);
                http_response_code(401);
            }

        } else {
            unset($pdo);
            http_response_code(402);
        }
    } else {
        unset($pdo);
        http_response_code(403);
    }
    unset($pdo);

} catch (PDOException $e) {
    $e->getMessage();
}


