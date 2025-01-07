<?php
session_start();
include "../conecta.php";
$conexao = conectar();

$sql = "DELETE FROM usuario WHERE id_usuario =" .  $_SESSION['id_usuario'];

$resultado = mysqli_query($conexao,$sql);

header('location:../index.php');
