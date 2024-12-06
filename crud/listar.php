<?php
require_once "../conecta.php";

$conexao = conectar();

$id_produto = $_GET['id_produto'];
$sql = "SELECT * FROM estoque WHERE id_produto=$id_produto";
$resultado = executarSql($conexao, $sql);
$Produto = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
echo json_encode($Produto);