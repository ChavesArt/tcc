<?php
require_once "conecta.php";
$conexao = conectar();

$id = $_GET['id_usuario'];



$sql = "DELETE *  FROM usuario WHERE id_usuario=$id";
$result = mysqli_query($conexao, $sql);
if ($result) {
    header("Location: ../admin.php");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}