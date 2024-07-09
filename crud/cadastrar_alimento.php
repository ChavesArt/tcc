<?php
include "../conecta.php";
$conexao = conectar();

//recebendo as variáveis do formulário
$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
//inserindo no banco
$sql = "INSERT INTO usuario (nome,quantidade) VALUES ('$nome', '$quantidade')";
$result = mysqli_query($conexao, $sql);

//redirecionando para o index.php
if ($result) {
    header("Location: ../admin_alimento.php");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}
?>