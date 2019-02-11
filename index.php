<!DOCTYPE html>
<html lang="en">
<?php
session_start();

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Zdrava hrana</title>
</head>

<body>
<div class="container-fluid cFluid">

   <?php require_once __DIR__ . '/menu/showMenu.php'; ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="4000" data-pause="false">
        <ol class="carousel-indicators carouselPointers ">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner innerCarousel">
            <div class="carousel-item active carouselItem">
                <img class="d-block " src="img/slider2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item carouselItem">
                <img class="d-block " src="img/slider1.jpg" alt="First slide">
            </div>
            <div class="carousel-item carouselItem">
                <img class="d-block " src="img/slider3.jpg" alt="Third slide">

            </div>
        </div>
        <div class="carouselTitle">
            <div class="title">
                <h1>Dobrodosli </h1>
                <img src="img/apple.png" alt="">

                <p>Na nasem sajtu mozete pronaci sve o zdravlju i ishrani</p>
            </div>
        </div>

    </div>
    <div class="row d-flex justify-content-around flex-wrap boxes">

        <div class=" box">
            <h3>Voce</h3>
            <img src="img/fruit.jpg" alt="">
            <p> <b>Voće</b> je bogat izvor vitamina, mada ih, u poređenju sa povrćem,sadrži manje. Od vitamina voće sadrži
                najviše vitamina C i karotina. Njihova količina zavisi od vrste voća, sorte kao i niza drugih činilaca.
                Vitamin C nije podjednako raspoređen u cijelom plodu. Najviše ga ima u ljusci i ispod nje. Drugi vitamin po
                važnosti i količini je karotin. Najviše ga sadrže: kajsija, ananas, suva šljiva, breskva itd. U manjim
                količinama voće sadrži i druge vitamine: К, Е, vitamine B grupe</p>

        </div>
        <div class=" box">
            <h3>Zitarice</h3>
            <img src="img/zitarice.png" alt="">
            <p>
                <b> Žitarice</b> su jednogodišnje biljke iz porodice trava (Gramineae), čiji zrnasti plodovi (žita) služe za
                ishranu ljudi i životinja i kao sirovina u prehrambenoj industriji. Nazivaju se i hlebna žita ili cerealije.
                Ona su vrsta trave koja se uzgaja iz jestivog zrna koje se zove caryopsis, a u sebi sadrži klice i mekinje.
                Žitarice u zrnu uzgajaju se u većim količinama i pružaju više energije od bilo koje druge vrste useva. One su
                sortirani usevi. </p>
        </div>
        <div class=" box">
            <h3>Povrce</h3>
            <img src="img/vegetables.jpg" alt="">
            <p>
                <b> Povrće</b> na pijaci
                Povrće je zajednički naziv za kultivisane biljke ili njihove delove koje se koriste za ljudsku ishranu. Za
                jelo se priprema na različite načine. Upotrebljava se i kao sveže i kao konzervisano. Bogato je ugljenim
                hidratima i belančevinama, a na njihov ukus prvenstveno utiču eterična ulja. Zahvaljujući visokom sadržaju
                vitamina, minerala, celuloze, a malim količinama masnoće, u prehrani ima neprocenjivu ulogu. Količina
                vitamina i minerala se razlikuje među vrstama i popdnebljima u kojima to povrće uspeva.</p>
        </div>
    </div>
</div>
</body>

</html>