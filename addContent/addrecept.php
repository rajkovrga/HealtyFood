<?php
session_start();

$obj = json_decode($_POST['recept']);

$title = $obj->title;
$desc = $obj->desc;
$elements = $obj->elements;
$regexTitle = '/^([A-ZČĆŠĐŽ][\s\-,.a-zšđžčć]{2,100})$/';
$regexDesc = '/^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z,\-.\s]{5,490}$/';
$regexElements = '/^[A-ZČĆŠĐŽ][šđžčća-z()0-9A-Z,-\.\s]{5,490}$/';

if (preg_match($regexTitle, $title)
    && preg_match($regexDesc, $desc)
    && preg_match($regexElements, $elements)) {

    require_once __DIR__ . '/../config/config.php';

    $SQLname = 'SELECT * FROM `recepts` where ReceptTitle = :name';
    $titles = $pdo->prepare($SQLname);
    $titles->execute([':name' => $title]);

    if ($titles->rowCount() == 0) {
        $SQLRecept = "INSERT INTO `recepts`(`UserId`, `ReceptTitle`, `ReceptComponent`, `ReceptDescription`)
        VALUES (:userId,:title,:elements,:description)";

        $insertRecept = $pdo->prepare($SQLRecept);
        $insertRecept->execute([
            ':userId' => $_SESSION['UserId'],
            ':title' => $title,
            ':elements' => $elements,
            ':description' => $desc
        ]);

        if($insertRecept)
        {
            echo "USLO";
        }
        else
        {
            echo "NIJE";
        }

    } else {
        echo "NIJE TACNO";
    }


} else {
    echo "Podaci nisu u dobrom formatu";
}

