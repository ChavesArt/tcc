<?php
session_start();
include "../conecta.php";
$conexao = conectar();

$tipo_produto = $_POST['tipo_produto'];
$subtipo_produto = $_POST['subtipo_produto'];
$id_produto = $_POST['id_produto'];

$sql_alterar = "UPDATE produto SET tipo_produto = '$tipo_produto', subtipo_produto = '$subtipo_produto' WHERE id_produto = $id_produto";
$resultado = mysqli_query($conexao,$sql_alterar);
$_SESSION['alterar_produto_sucess'] = true;
header("Location:../formtipo.php");