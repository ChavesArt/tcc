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
</head>

<body>
    <form action="crud/alterar.php" method="post">
        nome: <input type="text" name="nome" value="<?php echo  $usuario['nome']; ?>" ><br>
        endereço: <input type="text" name="endereco" value="<?php echo  $usuario['endereco']; ?>"><br>
        email: <input type="email" name="email" value="<?php echo  $usuario['email']; ?>"><br>
        senha: <input type="password" name="senha" value="<?php echo  $usuario['senha']; ?>" ><br>
        telefone: <input type="text" name="telefone" value="<?php echo  $usuario['telefone']; ?>"><br>
 <!-- id enviado escondido--><input type="hidden" name="id_usuario" value="<?php echo  $usuario['id_usuario']; ?>" >
        <input type="submit" value="Salvar"><br>
    </form>
</body>

</html>