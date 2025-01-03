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
    <title>Formulário de Recebimento</title>

    <?php include('links.php'); ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

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

    <main>
        <div style="margin-top: 10%;" class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1>Bem-vindo</h1>
                </div>

                <div  class="col-md-6">
                    <img class="img-fluid" src="img/receber.svg" alt="formulário de doações">
                </div>

                <div class="col-md-6">

                    <div class="border bg-light">

                        <h1 class="text-center">Formulário de recebimento</h1>



                        <div id="tipo">
                            <p>Tipo de doação:
                                <input name="tipoDoacao" type="radio" value="alimento" id="alimento" checked> alimento
                                <input name="tipoDoacao" type="radio" value="roupa" id="roupa"> Roupa
                                <input name="tipoDoacao" type="radio" value="outro" id="outro"> Outro
                            </p>
                        </div>

                        <form id="inv2" action="crud/receber.php?tipo_doacao=outro" method="post" class="m-4">

                            <!-- OUTRO -->

                            <label class="form-label" for="nome">Nome:</label>
                            <input class="form-control" type="text" name="nome" id="nome">

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="number" name="quantidade" id="quantidade">

                            <label class="form-label" for="descri">Descrição:</label>
                            <textarea name="descricao" class="form-control" id="descri" rows="3" placeholder="Coisas referentes a localização ou expecificação da doação" aria-label="With textarea"></textarea>

                            <label class="form-label" for="nome">Tamanho:</label>
                            <input class="form-control" type="text" name="tamanho" id="tamanho">

                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Enviar">
                                </div>
                            </div>

                        </form>

                        <!-- ROUPA -->
                        <form id="inv3" action="crud/receber.php?tipo_doacao=roupa" method="post" class="m-4">
                            
                        
                        <?php 
                        $sql = "SELECT * FROM produto WHERE tipo_produto ='roupa' ORDER BY subtipo_produto ASC";
                        $resultado = mysqli_query($conexao, $sql);
                        ?>
                        
                        <label class="form-label" for="tipo">qual o tipo de roupa:</label>
                            <select name="alimentos" id="tipo" class="form-select" required>

                                <?php
                                while ($info = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value=" . $info['subtipo_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                                }
                                ?>
                            </select>                        
                        

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="number" name="quantidade" id="quantidade">

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
                        <form id="inv" action="crud/receber.php?tipo_doacao=alimento" method="post" class="m-4">

                        <?php 
                        $sql = "SELECT * FROM produto WHERE tipo_produto ='alimento' ORDER BY subtipo_produto ASC";
                        $resultado = mysqli_query($conexao, $sql);
                        
                        ?>

                            <label class="form-label" for="alimentos">Escolha o alimento:</label>
                            <select name="alimentos" id="alimentos" class="form-select" required>

                                <?php
                                while ($info = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value=" . $info['subtipo_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                                }
                                ?>
                            </select>

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="number" name="quantidade" id="quantidade">
                            <label class="form-label" for="descri">Descrição:</label>
                            <textarea class="form-control" id="descri" name="descricao" rows="3" placeholder="Coisas referentes a localização ou expecificação da doação" aria-label="With textarea"></textarea>

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

</body>
</html>