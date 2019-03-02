<?php
try
{    require_once __DIR__ . '/../config/config.php';
    $file = file_get_contents("php://input");
    $req = json_decode($file);
    $sqlRecepts = "SELECT * FROM recepts r INNER JOIN imagerecept ir ON r.ReceptId = ir.ReceptId 
      inner join images i on ir.ImageID = i.ImageID GROUP BY ir.ReceptId 
      order by ReceptDate desc LIMIT :startnumber ,:endnumber ";

    $start = $req->start;
    $end = $req->end;
    $firstRecepts = $pdo->prepare($sqlRecepts);
    $firstRecepts->bindParam(':startnumber', $start, PDO::PARAM_INT);
    $firstRecepts->bindParam(':endnumber', $end, PDO::PARAM_INT);
    $firstRecepts->execute();
    $result = $firstRecepts->fetchAll(PDO::FETCH_ASSOC);
    $recepts = "";
    foreach ($result as $r)
    {

        $recepts .= "
            <div class=\"d-flex  flex-column align-items-center justify-content-between border rounded  recept border-success col-sm-5 col-9\">
                <div class=\" recept-img bg-success\"><img src="."receptimages/".$r['SrcImage']." alt=" . $r['ReceptTitle'] . "></div>
                <h3 class='recepts-title'>". $r['ReceptTitle'] ."</h3>
                <a href=\"#\" class=\"border border-sucess\">Pogledaj</a>
            </div>
            ";

    }
    echo $recepts;
}
catch (PDOException $er)
{
    echo $er->getMessage();
}