<?php

$tipo_doacao = $_GET['tipo_doacao'];
if (!$tipo_doacao == "alimento") {

    $nome = $_POST['nome'];
}
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

include_once "../conecta.php";
if ($quantidade < 0) {
    $quantidade = 0;
}
$conexao = conectar();


if ($tipo_doacao == "alimento") {
    $nome = $_POST['alimentos'];
    $sql1 = "SELECT quantidade FROM doacoes WHERE nome='$nome'";
    $quant_alimento = mysqli_query($conexao, $sql1);
    while($info = mysqli_fetch_assoc($quant_alimento))
    {
        $quant_alimentos = $info['quantidade'];
        // var_dump($quant_alimentos);
        // die;
    }

    $data_validade = $_POST['data_validade'];


    $sql2 = "UPDATE doacoes SET quantidade = $quantidade + '$quant_alimentos' where nome = '$nome'";
    $resul = mysqli_query($conexao, $sql2);
    $sql = "INSERT INTO doacoes(nome,descricao,data_validade,tipo_doacao) 
    values('$nome','$descricao','$data_validade','$tipo_doacao'); ";
}

if ($tipo_doacao == "outro") {
    $data_validade = $_POST['data_validade'];
    $tamanho = $_POST['tamanho'];

    $sql = "INSERT INTO doacoes(nome,quantidade,descricao,data_validade,tamanho,tipo_doacao) 
    values('$nome',$quantidade,'$descricao','$data_validade','$tamanho','$tipo_doacao'); ";
}

if ($tipo_doacao == "roupa") {

    $tamanho = $_POST['tamanho'];

    $sql = "INSERT INTO doacoes(nome,quantidade,descricao,tamanho,tipo_doacao) 
    values('$nome',$quantidade,'$descricao','$tamanho','$tipo_doacao'); ";
}
$resultado = mysqli_query($conexao, $sql);
echo "<pre>";
var_dump($sql2);
echo "<br>";
var_dump($sql);
die();
header("location:../formdoar.php");
