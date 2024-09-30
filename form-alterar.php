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

<body>

<div style="padding: 50px;" class="container border my-5 border-dark rounded">
    <div class="row">
        <div class="col-12 text-center my-1">
            <h1>Formulário de alteração de dados</h1>
        </div>

        <div class="col-6">
        <img class="img-fluid" src="img/form-alterar.gif" alt="Uma pessoa mexendo em um quadro">
        </div>

        <div class="col-6">

        <form action="crud/alterar.php" method="post">

<div >
    <div class="mb-3">
        <form action="crud/alterar.php" method="post">

        <label class="form-label" for="nome">Nome:</label>
        <input class="form-control" type="text" name="nome" id="nome" value="<?php echo  $usuario['nome']; ?>"><br>

        <label class="form-label" for="endereco">Endereço:</label>
        <input class="form-control" type="text" name="endereco" id="endereco" value="<?php echo  $usuario['endereco']; ?>"><br>

        <label class="form-label" for="email">Email:</label>
        <input class="form-control" type="email" name="email" id="email" value="<?php echo  $usuario['email']; ?>"><br>

        <label class="form-label" for="senha">Senha:</label>
        <input class="form-control" type="password" name="senha" id="senha" value="<?php echo  $usuario['senha']; ?>"><br>

        <label class="form-label" for="telefone">Telefone:</label>
        <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo  $usuario['telefone']; ?>"><br>
   
    <!-- id enviado escondido--><input type="hidden" name="id_usuario" value="<?php echo  $usuario['id_usuario']; ?>">

        <input class="btn btn-primary" type="submit" value="Salvar"><br>
    </div>
</div>
</div>
</form>

        </div>
    </div>
</div>
 
</body>

</html>