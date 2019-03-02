
<?php

try {
    $sqlCount = "SELECT COUNT(*) as num from books";
    require_once __DIR__ . '/../config/config.php';
    $count = $pdo->prepare($sqlCount);
    $count->execute();
    $res = $count->fetch();
    echo $res->num;
}
catch (PDOException $e)
{
    $e->getMessage();
}
