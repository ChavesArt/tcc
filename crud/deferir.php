<?php
include '../conecta.php';
$conexao = conectar();
$id = $_GET['id_pedido'];

if($_GET['resposta'] =='sim' AND $_GET['movimentacao'] == 'pedido'){

    $sql = "UPDATE pedido SET deferido = TRUE WHERE id_pedido = $id ";
    // var_dump($sql);die;
    $resultado = mysqli_query($conexao,$sql);
    header('location:../pedidos.php');
}

if($_GET['resposta'] == 'nao' AND $_GET['movimentacao'] == 'pedido'){
    $sql = "UPDATE pedido SET deferido = FALSE WHERE id_pedido = $id ";
    $resultado = mysqli_query($conexao,$sql);
    header('location:../pedidos.php');
}

if($_GET['resposta'] =='sim' AND $_GET['movimentacao'] == 'entrada'){

    $sql = "UPDATE entrada SET deferido = TRUE WHERE id_entrada = $id ";
    $resultado = mysqli_query($conexao,$sql);
    header('location:../entradas.php');
}

if($_GET['resposta'] == 'nao' AND $_GET['movimentacao'] == 'entrada'){
    $sql = "UPDATE entrada SET deferido = FALSE WHERE id_entrada = $id ";
    $resultado = mysqli_query($conexao,$sql);
    header('location:../entradas.php');
}