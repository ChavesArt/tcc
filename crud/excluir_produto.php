<?php
session_start();
include "../conecta.php";
$conexao = conectar();

$id_produto =$_GET['id_produto'];

$sql = "DELETE FROM produto WHERE id_produto = $id_produto";
$resultado = mysqli_query($conexao,$sql);

$_SESSION['exclusao_produto_sucess'] = true;
header("location:../formtipo.php");