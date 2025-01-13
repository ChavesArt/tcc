<?php
session_start();
include '../conecta.php'; 
$conexao = conectar();

$id_entrada = $_GET['id_entrada'];

if (isset($_GET['resposta_aceita'])) {
    
    $sql = "UPDATE entrada SET deferido = 1 WHERE id_entrada = $id_entrada ";
    $_SESSION['deferido'] = TRUE;
}else {
    
    $sql = "UPDATE entrada SET deferido = 0 WHERE id_entrada = $id_entrada ";
    $_SESSION['indeferido'] = TRUE;
}
$resultado = mysqli_query($conexao, $sql);
header('location:../entradas.php');