<?php
try
{    require_once __DIR__ . '/../config/config.php';
    $file = file_get_contents("php://input");
    $req = json_decode($file);
    $sqlRecepts = "SELECT * FROM books
      order by BookDate desc LIMIT :startnumber ,:endnumber ";

    $start = $req->start;
    $end = $req->end;

    $firstBooks = $pdo->prepare($sqlRecepts);
    $firstBooks->bindParam(':startnumber', $start, PDO::PARAM_INT);
    $firstBooks->bindParam(':endnumber', $end, PDO::PARAM_INT);
    $firstBooks->execute();
    $result = $firstBooks->fetchAll(PDO::FETCH_ASSOC);
    $books = "";
    foreach ($result as $r) {
        $books .= "
            <div class='book border border-success rounded  col-lg-6 col-md-6 col-xs-9 col-10 col-sm-8'>
                <h3 class='book-title'><i class='fa fa-book' aria-hidden='true'></i> " . $r['BookTitle'] . " </h3>
                <p>" . $r['BookDescription'] . "</p>
                <a href='booksfiles/" . $r['BookLink'] . "'class='border border-success'>Preuzmite</a>
            </div>
            ";

    }

    echo $books;
}
catch (PDOException $er)
{
    echo $er->getMessage();
}