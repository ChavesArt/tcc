<?php



$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$tipo_doacao = $_GET['tipo_doacao'];

$descricao = $_POST['descricao'];


$nulo = NULL;

include_once "../conecta.php";

$conexao = conectar();

if($tipo_doacao == "alimento"){
    $data_validade = $_POST['data_validade'];


    $sql = "INSERT INTO doacoes(nome,quantidade,descricao,data_validade,tipo_doacao) 
    values('$nome',$quantidade,'$descricao','$data_validade','$tipo_doacao'); ";
}

if($tipo_doacao == "outro"){

    $data_validade = $_POST['data_validade'];
$tamanho = $_POST['tamanho'];

    $sql = "INSERT INTO doacoes(nome,quantidade,descricao,data_validade,tamanho,tipo_doacao) 
    values('$nome',$quantidade,'$descricao','$data_validade','$tamanho','$tipo_doacao'); ";
}

if($tipo_doacao == "roupa"){

   
$tamanho = $_POST['tamanho'];

    $sql = "INSERT INTO doacoes(nome,quantidade,descricao,tamanho,tipo_doacao) 
    values('$nome',$quantidade,'$descricao','$tamanho','$tipo_doacao'); ";
}
// var_dump($sql);
// die();
$resultado = mysqli_query($conexao,$sql);
header("location:../formdoar.php");
?>