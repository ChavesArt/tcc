<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>

    <?php include('../links.php'); ?>


</head>

<body>
    <?php include_once('../menu.php'); ?>

    <div class="main-form">
        <div class="esquerda-form">
            <h1>Cadastre-se já:</h1>
            <img src="../img/formcad.png" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form">
            <div class="card-form">
                <h1>Cadastre-se</h1>
                <form action="cadastrar.php" method="post">
                    <div class="campo-texto">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="nome" id="usuario" placeholder="Usuário" required>

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                        
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" placeholder="Email" required>

                        <label for="senha">endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço" required>

                        <label for="telefone">telefone</label>
                        <input type="text" name="telefone" id="telefone" placeholder="telefone" required>
 
                        <input type ="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>