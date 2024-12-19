<?php
session_start();
include "../conecta.php";
$conexao = conectar();
//recebendo as variáveis do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$tipo_usuario = 1;
$foto = 'user.png';
// if($nome == 'administrador' or $email == 'admin@gmail.com'){
//     header("location:../formcad.php");
// }

//inserindo no banco
$sql = "INSERT INTO usuario (nome, endereco, email, senha, telefone,tipo_cliente,foto) VALUES ('$nome', '$endereco','$email', '$senha', '$telefone','$tipo_usuario','$foto')";
$result = mysqli_query($conexao, $sql);

//redirecionando para o index.php
if ($result) {
    $_SESSION['cadastrar_success'] = true;
    header("Location: ../index.php");
} else {
    $_SESSION['cadastrar_success'] = false;
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}
?>