<?php
session_start();
include_once "../conecta.php";
$conexao = conectar();

$id_usuario = $_SESSION['id_usuario'];
$tipo_doacao = $_GET['tipo_doacao'];
if($tipo_doacao != 'alimento'){
    $nome = $_POST['nome'];
}
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

// verifica se a quantidade é maior que zero para não retirar do banco em vez de somar
if ($quantidade < 0) {
    $quantidade = 0;
}


if ($tipo_doacao == "alimento") {
    $nome = $_POST['alimentos'];

    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    $data_validade = $_POST['data_validade'];
    
    $sql = "INSERT INTO entrada(data_entrada,id_usuario,data_validade,quantidade,descricao,subtipo_doacao,nome)Values('$tempo',$id_usuario,'$data_validade',$quantidade,'$descricao','$tipo_doacao','$nome')";
    // var_dump($sql);die;
}

if ($tipo_doacao == "outro") {
    $data_validade = $_POST['data_validade'];
    $tamanho = $_POST['tamanho'];
    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    
    $sql = "INSERT INTO entrada(data_entrada,id_usuario,data_validade,quantidade,descricao,tamanho,subtipo_doacao,nome)Values('$tempo',$id_usuario,'$data_validade','$quantidade','$descricao','$tamanho','$tipo_doacao','$nome')";
    // $sql = "INSERT INTO doacoes(nome,quantidade,descricao,data_validade,tamanho,tipo_doacao) 
    // values('$nome',$quantidade,'$descricao','$data_validade','$tamanho','$tipo_doacao'); ";
    // var_dump($sql);die;
}

if ($tipo_doacao == "roupa") {
    
    $tamanho = $_POST['tamanho'];
    
    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');
    
    // $descri = "Roupa: $nome;#Quantidade: $quantidade#Tamanho: $tamanho#Descrição: $descricao";
    $sql = "INSERT INTO entrada(data_entrada,id_usuario,descricao,quantidade,tamanho,subtipo_doacao,nome)Values('$tempo',$id_usuario,'$descricao',$quantidade,'$tamanho','$tipo_doacao','$nome')";
    
    // $sql = "INSERT INTO doacoes(nome,quantidade,descricao,tamanho,tipo_doacao) 
    // values('$nome',$quantidade,'$descricao','$tamanho','$tipo_doacao'); ";
    // var_dump($sql);die;
}
$resultado = mysqli_query($conexao, $sql);
// header("location:formdoar.php?aviso");
var_dump($nome);die;
header("location:../formdoar.php");
