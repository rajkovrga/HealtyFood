<?php
if( !isset($_SESSION))
{
    session_start();
}


    include __DIR__ . '/../config/config.php';

    $SQLSurv = "SELECT * FROM answeruser au inner join questions q on au.QuestionId = q.QuestionId inner join answers a on
                        a.AnswerId = au.AnswerId where au.UserId = :id";
    $querySurvAnswer = $pdo->prepare($SQLSurv);
    $querySurvAnswer->execute([":id" => $_SESSION["UserId"]]);
    $querySurvResult = $querySurvAnswer->fetch();
    $sqlPercentage = "SELECT a.AnswerTitle as answer,q.QuestionTitle as question,ROUND((SELECT COUNT(*) FROM answeruser an where an.AnswerId = a.AnswerId)*
                  (SELECT 100/( SELECT COUNT(*) FROM `answeruser`)),1) AS p from answers a
                  inner join questions q on a.QuestionId = q.QuestionId";
    $queryPre = $pdo->prepare($sqlPercentage);
    $queryPre->execute();
    $resultPer = $queryPre->fetchAll();
    $ret = "";
    $ret .= "<h3>" . $resultPer[0]->question . "</h3><div class=' text-center' id='answers'><table  class='table'>";

    foreach ($resultPer as $i) {
        $ret .= " <tr>
      <th class='text-left tr' scope='row'>" . $i->answer . "</th>
      <td>" . $i->p . "%</td>
    </tr>";
    }

    $ret .= "</table>";
    $ret .= "<p>Vaš odgovor: " . $querySurvResult->AnswerTitle . "</p></div>";

    echo $ret;

