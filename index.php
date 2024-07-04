<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

    <?php include('../links.php'); ?>

</head>

<body>

    <?php include('../menu.php'); ?>

    <main>
        <div class="container-fluid">
            <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">


                        <!--banner1-->
                        <img src="../img/banner1.jpeg" class="d-block w-100" alt="fotos da igreja">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Conheça-nos:Benjamin Constant 1991</h2>
                            <p></p>
                            <a href="#" class="main-btn">Ver mais</a>
                        </div>
                    </div>


                    <!--banner2-->
                    <div class="carousel-item  ">
                        <img src="../img/banner2.jpg" class="d-block w-100" alt="fotos da igreja">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>conheça-nos</h2>
                            <p></p>
                            <a href="#" class="main-btn">ver mais</a>
                        </div>
                    </div>


                    <!--banner3-->
                    <div class="carousel-item  ">
                        <img src="../img/banner3.jpg" class="d-block w-100" alt="Manutenção de Software">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>conheça-nos</h2>
                            <p></p>
                            <a href="#" class="main-btn">Fale conosco</a>
                        </div>
                    </div>
                </div>


                <a href="#mainSlider" class="carousel-control-prev" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#mainSlider" class="carousel-control-next" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
            </div>

            <!--DOAR-->
            <div class="doar-receber">
                <div class="envia-form">
                    <div class="esq-form-envia">
                        <h1>Quer doar alguma coisa?</h1>
                        <div class="img-index">
                            <img src="../img/doar.svg" alt="pessoa doando um alimento">
                            <p>Sua doação pode ajudar muitas pessoas</p>
                        </div>
                    </div>
                    <div class="dir-form-envia">
                        <a class="btn-index" href="..crud/formcad.php">Doar</a>
                    </div>
                </div>
                <!--RECEBER-->
                <div class="envia-form">
                    <div class="esq-form-envia">
                        <h1>Quer receber doações?</h1>
                        <div class="img-index">
                            <img src="../img/receber.svg" alt="recepção alimento">
                            <p>Clique no botão se quiser receber alimentos</p>
                        </div>
                    </div>
                    <div class="dir-form-envia">
                        <a class="btn-index" href="#">Receber</a>
                    </div>
                </div>
            </div>
        </div>

        </div>



        <!--Sobre área-->
        <div id="sobre-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">Sobre a igreja</h3>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="../img/fachada_igreja.jpg" alt="Igreja ieq flores">
                    </div>
                    <div class="col-md-6">
                        <h3 class="about-title">IEQ flores</h3>
                        <p id="p-sobre">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio animi vero quis magni, debitis nesciunt inventore odit quo dolorem cupiditate maiores eum magnam impedit deserunt pariatur doloribus adipisci illum aperiam.Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo similique totam sapiente ducimus debitis minus, iusto rerum illum sequi porro cumque mollitia et sint. Minima asperiores amet quae quasi voluptate!login Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere amet nostrum sequi illum aliquam cum odit saepe. Asperiores numquam, mollitia nemo dolorum ipsam ipsa commodi iure inventore obcaecati. Esse, mollitia!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro repudiandae veritatis natus reprehenderit incidunt dolorem nulla beatae ex, nemo, vitae ducimus. Laudantium nisi error sed minus quam ex eligendi aliquam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic praesentium corrupti eum voluptatem. Qui delectus inventore error magni mollitia voluptas, est, adipisci nam, molestias necessitatibus atque iure dolor natus quo.</p>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>


</body>
<script>

</script>

</html>