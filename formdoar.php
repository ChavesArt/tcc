<?php
session_start();
include "conecta.php";
logar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>

    <?php include('links.php'); ?>


</head>

<body>
    <?php include_once('menu.php'); ?>

    <div class="main-form">
        <div class="esquerda-form">
            <h1>Sua doação pode ajuda uma pessoa</h1>
            <img src="" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form mx-auto">
            <div class="card-form">
                <h1>Formulário de doação</h1>
                <form action="#" method="post">
                    <div class="campo-texto">
                        <label for="alimento">alimento</label>
                        <input type="text" name="alimento" id="alimento" placeholder="alimento">

                        <label for="quantidade">quantidade</label>
                        <input type="number" name="quantidade" id="quant" placeholder="Quantidade">

                        <label for="descri">Descrição</label>
                        <textarea cols="50" class="mx-auto" rows="10" id = "descri"placeholder="Descrição" maxlength="200">
                        </textarea>

                        <label for="data">Data de validade</label>
                        <input type="date" name="data_validade" id="data" placeholder="data de validade">


                        <input type ="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>