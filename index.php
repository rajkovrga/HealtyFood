<!DOCTYPE html>
<html lang="en">
<?php
session_start();
 require_once __DIR__ . '/components/head.php';
showHead("Zdrava ishrana");
?>



<body>
<div class="container-fluid cFluid">

   <?php require_once __DIR__ . '/components/showMenu.php'; ?>

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
            <img src="img/fruit.jpg" alt="Voće">
            <p> Voće je bogat izvor vitamina, mada ih, u poređenju sa povrćem,sadrži manje. Od vitamina voće sadrži
                najviše vitamina C i karotina. Njihova količina zavisi od vrste voća, sorte kao i niza drugih činilaca.
                Vitamin C nije podjednako raspoređen u cijelom plodu. Najviše ga ima u ljusci i ispod nje. Drugi vitamin po
                važnosti i količini je karotin. Najviše ga sadrže: kajsija, ananas, suva šljiva, breskva itd.</p>

        </div>
        <div class=" box">
            <h3>Zitarice</h3>
            <img src="img/zitarice.jpg" alt="Žitarice">
            <p>
                Žitarice su jednogodišnje biljke iz porodice trava (Gramineae), čiji zrnasti plodovi (žita) služe za
                ishranu ljudi i životinja i kao sirovina u prehrambenoj industriji. Nazivaju se i hlebna žita ili cerealije.
                Ona su vrsta trave koja se uzgaja iz jestivog zrna koje se zove caryopsis, a u sebi sadrži klice i mekinje.
                Žitarice u zrnu uzgajaju se u većim količinama i pružaju više energije od bilo koje druge vrste useva. One su
                sortirani usevi. </p>
        </div>
        <div class=" box">
            <h3>Povrce</h3>
            <img src="img/vegetables.jpg" class="bg-index" alt="Povrće">
            <p>
                Povrće na pijaci
                Povrće je zajednički naziv za kultivisane biljke ili njihove delove koje se koriste za ljudsku ishranu. Za
                jelo se priprema na različite načine. Upotrebljava se i kao sveže i kao konzervisano. Bogato je ugljenim
                hidratima i belančevinama, a na njihov ukus prvenstveno utiču eterična ulja. Zahvaljujući visokom sadržaju
                vitamina, minerala, celuloze, a malim količinama masnoće, u prehrani ima neprocenjivu ulogu.</p>
        </div>
    </div>
    <div class="text-center bottom-content position-relative row col-12 d-flex justify-content-center align-items-center flex-column">
        <h3>Šta raditi sa ovim namirnicama?</h3>
        <div class="col-12 bottom-img"> <img src="img/bg-index.jpg" alt=""></div>

        <p class="position-absolute top-10">Ulogujte se i pronadjite brojne recepte, vaše zdravlje dovedite na maksimu.</p>
    </div>

    <div class="row col-12 d-flex justify-content-center align-items-center flex-column">
        <h3>Anketa</h3>
        <div class="col-lg-5"></div>
    </div>

    <?php require_once __DIR__ . '/components/footer.php';?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>