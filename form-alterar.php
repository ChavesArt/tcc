<?php
//recebendo o id da tabela
$id = $_GET['id_usuario'];

//conectando com o banco
require_once "conecta.php";
$conexao = conectar();
$sql = "SELECT * FROM usuario WHERE id_usuario = $id";
$result = mysqli_query($conexao, $sql);

if ($result) {
    $usuario = mysqli_fetch_assoc($result);
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
    die();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Alteração</title>
    <?php include "links.php"; ?>
</head>

<body  class="body-alterar">
    <form action="crud/alterar.php" method="post">

        <div class="form-geral">

        <div class="form-image-form-alterar">
            <img src="img/form-alterar.gif" alt="Uma pessoa mexendo em um quadro">
        </div>

                <div class="input-group-form-alterar">
                    <div class="input-box">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" value="<?php echo  $usuario['nome']; ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" value="<?php echo  $usuario['endereco']; ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo  $usuario['email']; ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" value="<?php echo  $usuario['senha']; ?>"><br>
                    </div>

                    <div class="input-box">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" value="<?php echo  $usuario['telefone']; ?>"><br>
                    </div>

                    <!-- id enviado escondido--><input type="hidden" name="id_usuario" value="<?php echo  $usuario['id_usuario']; ?>">
                    <div class="input-box">
                        <input type="submit" value="Salvar"><br>
                    </div>
                </div>
        </div>
    </form>
</body>

</html>