<?php
session_start();

include("../conecta.php");
$conexao = conectar();

$id = $_POST['id_usuario'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];

$sql = "UPDATE usuario SET nome='$nome', endereco='$endereco', email='$email', senha='$senha', telefone='$telefone' WHERE id_usuario=$id";
$result = mysqli_query($conexao, $sql);

if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == true) {
    header('Location: ../perfil.php');  
    die();  
} else {
    header("Location: ../admin_usuario.php");
    die();  
}
?>
