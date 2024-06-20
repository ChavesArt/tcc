<?php
include "conecta.php";
$conexao = conectar();

//recebendo as variáveis do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];
$tipo_usuario = $_POST["tipo_cliente"];

//inserindo no banco
$sql = "INSERT INTO usuario (nome, endereco, email, senha, telefone, tipo_cliente) VALUES ('$nome', '$endereco','$email', '$senha', '$telefone', $tipo_usuario)";
$result = mysqli_query($conexao, $sql);

//redirecionando para o index.php
if ($result) {
    header("Location: pagina_admin.php");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}
?>