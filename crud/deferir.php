<?php
include '../conecta.php'; 
$conexao = conectar();

$id_pedido = $_GET['id_entrada'];

if (isset($_GET['resposta_aceita'])) {
    
    $sql = "UPDATE entrada SET deferido = 1 WHERE id_entrada = $id_pedido ";
    // var_dump($sql);die;
}else {
    
    $sql = "UPDATE entrada SET deferido = 0 WHERE id_entrada = $id_pedido ";
    // var_dump($sql);die;
}
$resultado = mysqli_query($conexao, $sql);
header('location:../entradas.php');