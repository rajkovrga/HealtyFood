<?php
$file = file_get_contents("php://input");
$obj = json_decode($file);
$id = $obj->id;
try {


    $sqlUser = "SELECT * FROM users where UserId = :id";
    require_once __DIR__ . '/../config/config.php';
    $queryUser = $pdo->prepare($sqlUser);
    $queryUser->execute([":id" => $id]);

    if ($queryUser->rowCount() != 0) {
        $result = $queryUser->fetch();
        $resultText = "";
        $resultText .= "
         <div class='  text-center '>
         <div id='profile-img'>
                <img class='rounded-circle' 
        ";
        if ($result->UserImg === NULL) {
            $resultText .= "' src='img/user-img.png'";
        } else {
            $resultText .= "' src='profileimages/" . $result->UserImg . "'";
        }

        $resultText .= " alt='User img'></div>
                <h4>Korisničko ime</h4>
                <p>" . $result->Username . "</p>
            </div>
            <div class='my-modal-detalis text-center'>
                <h4>Ime</h4>
                <p>" . $result->FirstName . "</p>
                <h4>Prezime</h4>
                <p>" . $result->LastName . "</p>
                <h4>E-mail</h4>
                <p>" . $result->UserMail . "</p>
                <h4>Opis</h4>";
        if ($result->UserDesc === NULL) {
            $resultText .= "Nije unet";
        } else {
            $resultText .= $result->UserDesc;
        }
        $resultText .= "</div>";
        echo $resultText;
        unset($pdo);
    }


} catch (PDOException $e) {
    echo $e->getMessage();
}