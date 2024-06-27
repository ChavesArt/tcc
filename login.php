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
            <h1>logue-se para melhor aproveitamento do site:</h1>
            <img src="img/login-animate.svg" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form">
            <div class="card-form">
                <h1>Login</h1>
                <form action="crud/cadastrar.php" method="post">
                    <div class="campo-texto">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuário">

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha">

                        <input type ="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>