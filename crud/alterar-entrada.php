<?php
session_start();
$_SESSION['alteração_success'] = true;
include ("../conecta.php");
$conexao = conectar();

// entradas
$id_entrada = $_POST['id_entrada'];
$quantidade = $_POST['quantidade'];
$tamanho = $_POST['tamanho'];

// Verifica se 'data_validade' é uma string vazia ou a string 'null'
$data_validade = $_POST['data_validade'];
if ($data_validade == '' || $data_validade == 'null') {
    $data_validade = NULL; 
}

// produto
$tipo_produto = $_POST['tipo_produto'];
$subtipo_produto = $_POST['subtipo_produto'];

// Prepare o SQL para atualizar os dados
$sql_test = "
    UPDATE entrada en
    INNER JOIN itens_entrada ie ON en.id_entrada = ie.id_entrada
    INNER JOIN estoque e ON ie.id_estoque = e.id_estoque
    INNER JOIN produto p ON e.id_produto = p.id_produto
    SET 
        p.subtipo_produto = '$subtipo_produto', 
        p.tipo_produto = '$tipo_produto',  
        ie.quantidade = $quantidade,  
        en.quantidade = $quantidade, 
        en.tamanho = '$tamanho',  
        e.data_validade = " . ($data_validade === NULL ? 'NULL' : "'$data_validade'") . " 
    WHERE 
        en.id_entrada = $id_entrada
";
$resultado = mysqli_query($conexao, $sql_test);

header('location:../entradas_copy.php');
// var_dump($sql_test);
// die;
?>
