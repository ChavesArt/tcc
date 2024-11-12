<?php
//conectando com o banco
include ("../conecta.php");
$conexao = conectar();
// logar();
//recebendo as variáveis
$id = $_POST['id_entrada'];
$pedido = $_POST['entrada'];
$quantidade = $_POST['quantidade'];
$descri = $_POST['descri'];

$array = [$pedido.'#'.$quantidade.'#'.$descri.'#'];
$descricao = implode("#",$array);
//comando SQL
$sql = "UPDATE entrada SET detalhamento='$descricao' WHERE id_entrada=$id";
// var_dump($sql);die;
$result = mysqli_query($conexao, $sql);

//redirecionando para o index.php
if ($result) {
    header("Location: ../entradas.php");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}
?>