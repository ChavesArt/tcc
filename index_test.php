<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

    <?php include('links.php'); ?>

    <style>
        .btn-outline-purple {
            color: #6f42c1;
            /* Cor roxa para o texto */
            border-color: #6f42c1;
            /* Cor roxa para a borda */
        }

        .btn-outline-purple:hover {
            color: #fff;
            /* Cor do texto em branco quando o botão é hover */
            background-color: #6f42c1;
            /* Cor de fundo roxa quando hover */
            border-color: #6f42c1;
            /* Mantém a borda roxa no hover */
        }

        .btn-outline-purple:focus,
        .btn-outline-purple.focus {
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.5);
            /* Sombras com a cor roxa quando o botão recebe foco */
        }
    </style>

</head>

<body>



    <?php  include('menu.php'); ?>

    

    <main style="margin-top: 6.5%;" class="container ">

    <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Seu login foi realizado com sucesso!",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['login_success']);
    ?>
<?php } ?>

        <div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

            <ol class="carousel-indicators">
                <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="2"></button>
            </ol>

            <div class="carousel-inner  center-block">
                <div class="carousel-item active">

                    <!--banner1-->
                    <img src="img/fazenda.jpg" class=" w-100" alt="fotos da igreja">
                    <div class="carousel-caption d-md-block">
                        <h2>Conheça-nos: Benjamin Constant 1991</h2>
                        <p></p>
                        <a href="#" class="main-btn">Ver mais</a>
                    </div>
                </div>


                <!--banner2-->
                <div class="carousel-item  ">
                    <img src="img/cidade.png" class="w-100" alt="fotos da igreja">
                    <div class="carousel-caption  d-md-block">
                        <h2>conheça-nos</h2>
                        <p></p>
                        <a href="#" class="main-btn">ver mais</a>
                    </div>
                </div>


                <!--banner3-->
                <div class="carousel-item  ">
                    <img src="img/mapa_noite.png" class=" w-100" alt="Manutenção de Software">
                    <div class="carousel-caption  d-md-block">
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


        <!-- AÇÕES  -->

        <?php include "index2.php"; ?>

        <?php include "doacoes.php"; ?>


        <!--Sobre área-->
        <div id="sobre-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="main-title">Sobre a igreja</h3>
                    </div>
                    <div class="col-md-6">

                        <img class="img-fluid" src="img/fachada_igreja.jpg" alt="Igreja ieq flores">
                    </div>
                    <div class="col-md-6">
                        <h3 class="about-title my-5 text-center">IEQ flores</h3>

                        <p id="p-sobre">A Igreja do Evangelho Quadrangular Flores (IEQ Flores) é uma instituição religiosa, fundada em 1º de julho de 2019, em Uruguaiana (RS), com o objetivo de levar a palavra de Deus e ajudar a comunidade por meio de ações sociais que promovam seu desenvolvimento espiritual.

A instituição foi criada no contexto da pré-pandemia, quando houve uma grande necessidade de ajudar pessoas em situação de precariedade alimentar e espiritual, entre outras coisas. Foi fundada pelo Pastor Tiago Freitas e pela Pastora Graziela Freitas, que desejavam transmitir a palavra de Deus de maneira séria e clara.

Nos primeiros 3 anos, a IEQ Flores já contava com 100 membros, mas ao longo dos anos chegou à marca de 400 membros.

Com o passar do tempo, a instituição se tornou referência no ensino da palavra, chegando a ser uma das grandes igrejas da região 795.

Em 2020, a igreja enfrentou um momento crítico: a pandemia do coronavírus. Para poder atender a todos os seus membros, chegou a fazer 5 cultos por dia, com cada reunião contendo no máximo 25 pessoas. Apesar disso, a igreja conseguiu ajudar todos os seus membros nesse período difícil, além de conseguir avançar no ensino da palavra.

Hoje, a instituição conta com vários departamentos, como: SASIEQ (Serviço de Ação Social da Igreja do Evangelho Quadrangular), Escola Bíblica, Rede de Homens, Rede de Mulheres, Rede Teens, entre outros, oferecendo ajuda nas mais diversas áreas da sociedade.</p>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
<script>

</script>

</html>