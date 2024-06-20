<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
   
    <?php include('links.php');?>


</head>
<body>

<?php include_once('menu.php'); ?>

<div class="area-formulario">
    <form action="crud/cadastrar.php" method="post">

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="nome" placeholder="Digite seu nome">
        <label for="floatingInput">Nome</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="floatingInput" name="telefone" placeholder="Digite seu nome">
        <label for="floatingInput">telefone</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="endereco"  placeholder="Rua presidente Getulio Vargas 3344">
        <label for="floatingInput">endereço</label>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Nome@exemplo.com">
        <label for="floatingInput">email</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="floatingInput" placeholder="" name="senha">
        <label for="floatingInput">senha</label>
    </div>

    <input type="hidden" name="tipo_cliente" value="1">

        <input type="submit" value="enviar"><br>
        
        
    </form>
</div>
</body>
</html>