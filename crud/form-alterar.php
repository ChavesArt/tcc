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
    <form action="alterar.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo  $usuario['nome']; ?>" ><br>
        <label for="endereco">endereço</label>
        <input type="text" name="endereco" id ="endereco" value="<?php echo  $usuario['endereco']; ?>"><br>
       <label for="email">Email</label>
       <input type="email" name="email" id="email" value="<?php echo  $usuario['email']; ?>"><br>
       <label for="senha">senha</label> 
       <input type="password" name="senha" id="senha" value="<?php echo  $usuario['senha']; ?>" ><br>
       <label for="telefone">Telefone</label>
       <input type="text" name="telefone" id = "telefone" value="<?php echo  $usuario['telefone']; ?>"><br>
 <!-- id enviado escondido--><input type="hidden" name="id_usuario" value="<?php echo  $usuario['id_usuario']; ?>" >
        <input type="submit" value="Salvar"><br>
    </form>
</body>

</html>