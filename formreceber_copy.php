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



</head>

<body>
    <?php include_once('menu.php'); ?>

    <main>
        <div style="margin-top: 10%;" class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1>Bem-vindo</h1>
                </div>

                <div class="col-md-6">
                    <img class="img-fluid" src="img/receber.svg" alt="formulário de doações">
                </div>

                <div class="col-md-6">

                    <form  action="crud/receber.php" method="post" class="m-4 p-4 border rounded-3 shadow-lg bg-light">

                        <div class="form-check mb-3">
                            <h4>Qual o kit de cesta básica você deseja receber?</h4>
                            <input type="checkbox" class="form-check-input" id="mesmo-endereco" name="kit_alimento" value="kit_alimento">
                            <label class="form-check-label" for="mesmo-endereco">Kit de alimentos</label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="salvar-info" name="kit_roupa" value="kit_vestuario">
                            <label class="form-check-label" for="salvar-info">Kit de vestuários</label>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="number" name="quantidade" id="quantidade" min="1" placeholder="Informe a quantidade desejada">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary px-4 py-2" type="submit">Enviar</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
        


    </main>

</body>

</html>