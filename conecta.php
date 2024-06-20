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