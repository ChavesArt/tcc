<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
   
    <?php include('links.php');?>


</head>
<body>
<?php //include_once('menu.php'); ?>

<div class  = "main-form">
    <div class= "esquerda-form">
        <h1>Cadastre-se aqui:</h1>
    </div>
    <div class= "direita-form">
        <div class="card-form">
            <h1>Cadastre-se</h1>
            <div class = "campo-texto">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" id="usuario" placeholder = "Usuário">
                    <div class = "campo-texto">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder ="Senha">
                    </div>
                        <button class="btn-form">Cadastrar-se</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>