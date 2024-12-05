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
                    <form action="crud/receber.php" method="post" class="m-4 p-4 border rounded-3 shadow-lg bg-light">
                        <!-- Seção do select e input de quantidade lado a lado -->
                        <div class="row">
                            <div class="col-md-12">
                            <h4>Qual o kit de cesta básica você deseja receber?</h4>
                            </div>
                            <!-- Campo Select para o tipo de kit -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="tipo">Qual o tipo de kit?</label>
                                <select name="alimentos" id="tipo" class="form-select" required>
                                    <option value="kit_alimento">Kit de alimento</option>
                                    <option value="kit_roupa">Kit de roupa</option>
                                </select>
                            </div>

                            <!-- Campo de Quantidade -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="quantidade">Quantidade:</label>
                                <input class="form-control" type="number" name="quantidade" id="quantidade" min="1" placeholder="Informe a quantidade desejada">
                            </div>
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
