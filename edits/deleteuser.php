<?php

$file = file_get_contents("php://input");
$obj = json_decode($file);

$id = $obj->id;
echo $id;

$sqlUpdateMailer = "";
$sqlUpdate = "";
