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

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Formulário para Nova Senha</h1>
                <p class="text-center">Digite sua nova senha.</p>

                <!-- Formulário de recuperação de senha -->
                <form action="recuperar.php" method="post">
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <input type="hidden" name="token" value="<?= $token ?>">

                    <div class="mb-3">
                        <label for="senha" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <div class="mb-3">
                        <label for="repete" class="form-label">Repita a Senha</label>
                        <input type="password" class="form-control" id="repete" name="repetirSenha" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Salvar Nova Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>