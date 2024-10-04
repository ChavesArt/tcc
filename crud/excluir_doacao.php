<?php
require_once "../conecta.php";
$conexao = conectar();
$id = $_GET['id_doacoes'];
$tabela = $_GET['tabela'];


$sql = "DELETE FROM doacoes WHERE id_doacoes=$id";
$result = mysqli_query($conexao, $sql);
if ($result) {
    header("Location: ../admin_doacao.php?tabela=".$tabela."");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}