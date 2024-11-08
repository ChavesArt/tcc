<?php

session_start();
$id_usuario = $_SESSION['id_usuario'];

$tipo_doacao = $_GET['tipo_doacao'];

// Se não for alimento

$nome = $_POST['nome'];


$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

include_once "../conecta.php";
$conexao = conectar();

// verifica se a quantidade é maior que zero para não retirar do banco em vez de somar
if ($quantidade < 0) {
    $quantidade = 0;
}


if ($tipo_doacao == "alimento") {
    $nome = $_POST['alimentos'];

    date_default_timezone_set('America/Sao_Paulo'); // Ajusta para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    
    $descri = "Alimento: $nome; <br> Quantidade: $quantidade; <br> Descrição: $descricao";
    $sql = "INSERT INTO pedido(data_pedido,id_usuario,detalhamento)Values('$tempo',$id_usuario,'$descri')";
    // var_dump($sql);die;
    // header("location:formdoar.php?aviso");
}

if ($tipo_doacao == "outro") {
    $tamanho = $_POST['tamanho'];
    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    
    $descri = "Doação: $nome; <br> Quantidade: $quantidade; <br> Tamanho: $tamanho <br> Descrição: $descricao";
    $sql = "INSERT INTO pedido(data_pedido,id_usuario,detalhamento)Values('$tempo',$id_usuario,'$descri')";
    // $sql = "INSERT INTO doacoes(nome,quantidade,descricao,data_validade,tamanho,tipo_doacao) 
    // var_dump($sql);die;
    // values('$nome',$quantidade,'$descricao','$data_validade','$tamanho','$tipo_doacao'); ";
}

if ($tipo_doacao == "roupa") {
    
    $tamanho = $_POST['tamanho'];

    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    
    $descri = "Roupa: $nome; <br> Quantidade: $quantidade; <br> Tamanho: $tamanho <br> Descrição: $descricao";
    $sql = "INSERT INTO pedido(data_pedido,id_usuario,detalhamento)Values('$tempo',$id_usuario,'$descri')";
    // header("location:formdoar.php?aviso");

    // $sql = "INSERT INTO doacoes(nome,quantidade,descricao,tamanho,tipo_doacao) 
    // values('$nome',$quantidade,'$descricao','$tamanho','$tipo_doacao'); ";
}
$resultado = mysqli_query($conexao, $sql);
header("location:../formreceber.php");
