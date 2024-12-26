<?php

session_start();
$_SESSION['receber_success'] = true;

$id_usuario = $_SESSION['id_usuario'];

include_once "../conecta.php";
$conexao = conectar();


date_default_timezone_set('America/Sao_Paulo'); // Ajusta para o seu fuso horário
$tempo = date('Y-m-d H:i');

if(isset($_POST['roupa'])){
    
    $kit_roupa = $_POST['roupa'];
    $quantidade = $_POST['quantidade_roupa'];
    
    $sql = "INSERT INTO pedido(kit,quantidade,id_usuario,data_pedido)VALUES('$kit_roupa',$quantidade,'$id_usuario','$tempo')";
    $resultado = mysqli_query($conexao,$sql);
}
if(isset($_POST['alimento'])){
    
    $kit_alimento = $_POST['alimento'];
    $quantidade = $_POST['quantidade_alimento'];
    $sql = "INSERT INTO pedido(kit,quantidade,id_usuario,data_pedido)VALUES('$kit_alimento',$quantidade,'$id_usuario','$tempo')";
    $resultado = mysqli_query($conexao,$sql);
    
}
header("location:../formreceber.php");
die;