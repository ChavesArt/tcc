<?php

//fazendo conexão no banco
function conectar()
{
    $conexao = mysqli_connect("localhost", "root", "", "sasieq");
    if ($conexao == false) {
        die("Erro ao conectar a base de dados! " .
            mysqli_connect_errno() . ": " .
            mysqli_connect_error());
    }

    return $conexao;
}
function logar()
{
    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        header('location:logout.php');
    } 
}