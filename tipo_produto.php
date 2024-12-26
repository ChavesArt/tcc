<?php
session_start();
include "conecta.php";
$conexao = conectar();
$tipo = $_POST['opcao'];
$subtipo = $_POST['subtipo'];

$sql_verificaSeExiste = "SELECT * FROM produto WHERE tipo_produto = '$tipo' AND subtipo_produto = '$subtipo'";
$resultado_verificacao = mysqli_query($conexao,$sql_verificaSeExiste);

if($resultado_verificacao->num_rows == 1){
    $_SESSION['ja_existe'] = true;
    header('location:formtipo.php');
}else{

    $sql = "INSERT INTO produto(tipo_produto,subtipo_produto)VALUE('$tipo','$subtipo')";
    $resultado = mysqli_query($conexao,$sql);
    $_SESSION['formtipo_sucess'] = true;

    header("location:formtipo.php");
}

