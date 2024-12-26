<?php
session_start();
include "conecta.php";
$conexao = conectar();
if (!$_SESSION['email']) {
    header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de doação</title>

    <?php include('links.php'); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

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
        .small-popup {
            width: 500px !important; /* Ajuste a largura conforme necessário */
             font-size: 14px;         /* Ajuste o tamanho da fonte */
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#tipo").on("click", function() {
                hideShow();
            });
            hideShow();
        });

        function hideShow() {
            if ($('#alimento').is(':checked')) {
                $('#inv').show();
                $('#inv2').hide();
                $('#inv3').hide();
            }
            if ($('#roupa').is(':checked')) {

                $('#inv3').show();
                $('#inv2').hide();
                $('#inv').hide();
            }
            if ($('#outro').is(':checked')) {
                $('#inv2').show();
                $('#inv').hide();
                $('#inv3').hide();
            }
        }
    </script>

</head>

<body>
    <?php include_once('menu.php'); ?>

      
<?php if (isset($_SESSION['doacao_sucess']) && $_SESSION['doacao_sucess'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-middle",
            icon: "success",
            title: "Sua doação foi cadastrada com sucesso!",
            showConfirmButton: false,
            timer: 1500,
            customClass: {
            popup: 'small-popup'  // Aplique uma classe CSS personalizada
  }
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['doacao_sucess']);
    ?>
<?php } ?>

    <main>
        <div id="formdoar"  class="container ">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1 class="">Sua doação ajuda muito!</h1>
                </div>

                <div  class="col-md-6">
                    <img class="img-fluid" src="img/doacao.svg" alt="formulário de doações">
                </div>

                <div class="col-md-6">

                    <div class="border bg-light">

                        <h1 class="text-center">Formulário de doação</h1>



                        <div id="tipo">
                            <p>Tipo de doação:
                                <input name="tipoDoacao" type="radio" value="alimento" id="alimento" checked> alimento
                                <input name="tipoDoacao" type="radio" value="roupa" id="roupa"> Roupa
                                <input name="tipoDoacao" type="radio" value="outro" id="outro"> Outro
                            </p>
                        </div>

                        <form id="inv2" action="crud/doar.php?tipo_doacao=outro" method="post" class="m-4">

                            <!-- OUTRO -->

                            <label class="form-label" for="nome">Nome:</label>
                            <input class="form-control" type="text" name="nome" id="nome">

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" min="0" type="number" name="quantidade" id="quantidade">

                            <label class="form-label" for="descri">Descrição:</label>
                            <textarea name="descricao" class="form-control" id="descri" rows="3" placeholder="Coisas referentes a localização ou expecificação da doação" aria-label="With textarea"></textarea>

                            <label class="form-label" for="data">Data de validade:</label>
                            <input class="form-control" type="date" name="data_validade" id="data" placeholder="data de validade">

                            <label class="form-label" for="nome">Tamanho:</label> 
                            <input class="form-control" type="text" name="tamanho" id="tamanho">

                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Enviar">
                                </div>
                            </div>

                        </form>

                        <!-- ROUPA -->
                        <form id="inv3" action="crud/doar.php?tipo_doacao=roupa" method="post" class="m-4">
                            
                        
                        <?php 
                        $sql = "SELECT * FROM produto WHERE tipo_produto ='roupa' ORDER BY subtipo_produto ASC";
                        $resultado = mysqli_query($conexao, $sql);
                        ?>
                        
                        <label class="form-label" for="tipo">qual o tipo de roupa:</label>
                            <select name="id_produto" id="tipo" class="form-select" required>

                                <?php
                                while ($info = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value=" . $info['id_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                                }
                                ?>
                            </select>                        
                        

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" min="0" type="number" name="quantidade" id="quantidade">

                            <label class="form-label" for="nome">Tamanho:</label>
                            <input class="form-control" type="text" name="tamanho" id="tamanho">

                            <label class="form-label" for="descri">Descrição:</label>
                            <textarea name="descricao" class="form-control" id="descri" rows="3" placeholder="Coisas referentes a localização ou expecificação da doação" aria-label="With textarea"></textarea>

                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Enviar">
                                </div>
                            </div>
                        </form>

                        <!-- ALIMENTO -->
                        <form id="inv" action="crud/doar.php?tipo_doacao=alimento" method="post" class="m-4">

                        <?php 
                        $sql = "SELECT * FROM produto WHERE tipo_produto ='alimento' ORDER BY subtipo_produto ASC";
                        $resultado = mysqli_query($conexao, $sql);
                        
                        ?>

                            <label class="form-label" for="alimentos">Escolha o alimento:</label>
                            <select name="id_produto" id="alimentos" class="form-select" required>
                                
                                <?php 
                                while ($info = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value=" . $info['id_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                                } 
                                ?>
                            </select>
                            
                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" min="0" type="number" name="quantidade" id="quantidade">
                            <label class="form-label" for="descri">Descrição:</label>
                            <textarea class="form-control" id="descri" name="descricao" rows="3" placeholder="Coisas referentes a localização ou expecificação da doação" aria-label="With textarea"></textarea>
                            
                            <label class="form-label" for="data">Data de validade:</label>
                            <input class="form-control" type="date" name="data_validade" id="data">
                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Enviar">
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>


    </main>
    <!-- <div class="main-form"> 
         <div class="esquerda-form">
            <h1>Sua doação pode ajuda uma pessoa</h1>
            <img src="img/doacao.svg" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form mx-auto">
            <div class="card-form">
                <h1>Formulário de doação</h1>
                <form action="#" method="post">
                    <div class="campo-texto">
                        <label for="alimento">alimento:</label>
                        <input type="text" name="alimento" id="alimento" placeholder="alimento">

                        <label for="quantidade">quantidade:</label>
                        <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade">
                        <label for="descri">Descrição:</label>
                        <textarea cols="55" rows="2" id="descri" placeholder="Escreva aqui" maxlength="200"></textarea>

                        <label for="data">Data de validade:</label>
                        <input type="date" name="data_validade" id="data" placeholder="data de validade">


                        <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div> -->
</body>

</html>