<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

<?php include('links.php');?>

</head>
<body>

<?php include('menu.php');?>

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
                          <img src="img/banner1.jpeg" class="d-block w-100" alt="fotos da igreja">
                         <div class="carousel-caption d-none d-md-block">
                              <h2>Conheça-nos:Benjamin Constant 1991</h2>
                              <p></p>
                              <a href="#" class="main-btn">Ver mais</a>
                         </div>
                    </div>
                       <!--banner2-->
                        <div class="carousel-item  ">
                            <img src="img/banner2.jpg" class="d-block w-100" alt="fotos da igreja">
                         <div class="carousel-caption d-none d-md-block">
                                <h2>conheça-nos</h2>
                             <p></p>
                            <a href="#" class="main-btn">ver mais</a>
                         </div>
                        </div>
                    <!--banner3-->     
                 <div class="carousel-item  ">
                         <img src="img/banner3.jpg" class="d-block w-100" alt="Manutenção de Software">
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
        <!--Sobre área-->
        <div id="sobre-area">
            <div class="container">
                <div class="row">
                  <div class="col-12">
                        <h3 class="main-title">Sobre a igreja</h3>
                  </div>  
                  <div class="col-md-6">
                        <img class="img-fluid" src = "img/fachada_igreja.jpg" alt="Igreja ieq flores">
                  </div>
                  <div class="col-md-6">
                    <h3 class="about-title">IEQ flores</h3>
                    <p id="p-sobre">Os povos indígenas são os primeiros habitantes do território brasileiro, 
                        possuindo uma história ancestral rica e diversa. Antes da chegada dos europeus, o Brasil era habitado por diferentes etnias indígenas, com suas próprias línguas, costumes e formas de organização social. Esses povos ocupavam diferentes regiões do país, 
                        adaptando-se aos variados ecossistemas e desenvolvendo técnicas de sobrevivência adequadas às necessidades locais. Alguns exemplos de povos indígenas no Brasil são os Tupi-Guarani, os Tapajó, os Kaingang, os Xavante, os Yanomami, 
                        entre muitos outros, cada um com sua história particular e contribuições para a cultura brasileira.</p>
                  </div>
                </div>
            </div>

        </div>

    </div> 
</main>


</body>
</html>