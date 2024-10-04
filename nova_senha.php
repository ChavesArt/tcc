<?php

// verificar o email
// verificar o token
$email = $_GET['email'];
$token = $_GET['token'];

require_once "conecta.php";
$conexao = conectar();
$sql = "SELECT * FROM `recuperar_senha` WHERE email='$email' AND 
        token='$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "Email ou token incorreto. Tente fazer um novo pedido 
          de recuperação de senha.";
    die();
} else {
    // verificar a validade do pedido (data_criacao)
    // verificar se o link jah foi usado
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat(
        'Y-m-d H:i:s',
        $recuperar['data_criacao']
    );
    $umDia = DateInterval::createFromDateString('1 day');
    $dataExpiracao = date_add($data_criacao, $umDia);

    if ($agora > $dataExpiracao) {
        echo "Essa solicitação de recuperação de senha expirou!
              Faça um novo pedido de recuperação de senha.";
        die();
    }

    if ($recuperar['usado'] == 1) {
        echo "Esse pedido de recuperação de senha já foi utilizado
        anteriormente! Para recuperar a senha faça um novo pedido
        de recuperação de senha.";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha</title>
    <?php include_once("links.php"); ?>
</head>

<body>
    <!-- <form action="salvar_nova_senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        Email: <?= $email ?><br>
        <label>Senha: <input type="password" name="senha"></label><br>
        <label>Repita a senha: <input type="password" name="repetirSenha"></label><br>
        <input type="submit" value="Salvar nova senha">
    </form> -->

    <div style="margin-top:30%; padding: 90px;" class="container border my-5 border-dark rounded d-center m-auto">
        <div class="row">
            <div class="col-12 text-center my-1">
                <h1>Formulário para nova senha</h1>
                <p>Digite seu email e nova senha.<br></p>
            </div>

            <div class="col-12">

                <div>
                    <div class="mb-3">
                        <form action="recuperar.php" method="post">

                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">

                            Email: <?= $email ?><br>
                            <label for="senha">Senha:</label> 
                            <input type="password" id="senha" name="senha"><br>

                            <label for="repete">Repita a senha:</label> 
                            <input id="repete" type="password"  name="repetirSenha"><br>

                    </div>
                    <div class="col-12">
                        <div class="row">
                            <input class="btn btn-primary" type="submit" value="Salvar nova senha"><br>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
</body>

</html>