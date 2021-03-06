<?php
try
{    include __DIR__ . '/../config/config.php';
    $file = file_get_contents("php://input");
    $req = json_decode($file);
    $sqlRecepts = "SELECT r.ReceptId as IdRecept,SrcImage,ReceptTitle FROM recepts r INNER JOIN imagerecept ir ON r.ReceptId = ir.ReceptId 
      inner join images i on ir.ImageID = i.ImageID where ReceptTitle LIKE :likee GROUP BY ir.ReceptId 
      order by ReceptDate desc LIMIT :startnumber , :endnumber ";

    if(isset($req->like) )
    {
        if($req->like != "")
        {
            $like = "%".$req->like."%";
        }
        else
        {
            $like = "%%";

        }
    }



    $start = $req->start;
    $end = $req->end;
    $firstRecepts = $pdo->prepare($sqlRecepts);
    $firstRecepts->bindParam(':startnumber', $start, PDO::PARAM_INT);
    $firstRecepts->bindParam(':endnumber', $end, PDO::PARAM_INT);
    $firstRecepts->bindParam(':likee', $like);

    $firstRecepts->execute();
    $result = $firstRecepts->fetchAll(PDO::FETCH_ASSOC);
    $recepts = "";
    $num = 1;
    foreach ($result as $r)
    {
    $num += 1;
        $recepts .= "
            <div class=\"d-flex  flex-column align-items-center justify-content-between border rounded  recept border-success col-sm-5 col-9\">
                <div class=\" recept-img \"><img src="."receptimages/".$r['SrcImage']." alt=" . $r['ReceptTitle'] . "></div>
                <h3 class='recepts-title'>". $r['ReceptTitle'] ."</h3>
                <a href='recept.php?ID=".$r['IdRecept']."' class=\"border border-sucess\">Pogledaj</a>
            </div>
            ";
    }

    $sqlAll = "SELECT r.ReceptId as IdRecept,SrcImage,ReceptTitle FROM recepts r INNER JOIN imagerecept ir ON r.ReceptId = ir.ReceptId 
      inner join images i on ir.ImageID = i.ImageID where ReceptTitle LIKE :likee GROUP BY ir.ReceptId 
      order by ReceptDate desc";
    $allRecepts = $pdo->prepare($sqlAll);
    $allRecepts->execute([":likee" => $like]);
$objRet = ["countItems" => $allRecepts->rowCount(),
    "result" =>$recepts];
unset($pdo);
        echo json_encode($objRet);

}
catch (PDOException $er)
{
    echo $er->getMessage();
}