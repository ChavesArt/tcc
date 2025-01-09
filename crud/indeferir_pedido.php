<?php
include "../conecta.php";
$conexao = conectar();

$id_pedido = $_GET['id_pedido'];
$sql = "UPDATE pedido SET deferido = 0 WHERE id_pedido = $id_pedido";
$resultado = mysqli_query($conexao,$sql);
header('Location:../pedidos.php');
?>