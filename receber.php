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
    <title>Formulário</title>
    <?php include_once "links.php";?>
</head>
<body>
    <?php include_once "menu.php"; ?>

    <div style="margin-top:9%;" class="container">
        <div class="row">
            <div style="margin-bottom: 15px;" class="col-12 text-center">
                <h1>Formulário de recebimento:</h1>
            </div>
            
            <div class="col-12">

                <div  class="mb-3 bg-light">
                <form action="crud/receber.php">

                

                    <label class="form-label" for="comp">Comprovante de renda</label><br>
                    <input class="form-input" type="file" id="comp"><br>
                    <small class="text-muted">Para melhorarmos nossa seleção de recebidores coloque uma foto de sua renda mensal.</small><br>
                </form>
            </div>
            </div>
        </div>
    </div>

    
</body>
</html>