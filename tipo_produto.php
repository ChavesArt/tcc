<?php
include "conecta.php";
$conexao = conectar();
$tipo = $_POST['opcao'];
$subtipo = $_POST['subtipo'];

$sql = "INSERT INTO produto(tipo_produto,subtipo_produto)VALUE('$tipo','$subtipo')";
$resultado = mysqli_query($conexao,$sql);
header("location:formtipo.php");