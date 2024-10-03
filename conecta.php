<?php

//fazendo conexão no banco
    function conectar()
    {
        require_once "config.php";
        $conexao = mysqli_connect(
            $config['host'],
            $config['user'],
            $config['pass'],
            $config['db']
        );
        if ($conexao === false) {
            echo "Erro ao conectar à base dados. Nº do erro: " .
                mysqli_connect_errno() . ". " .
                mysqli_connect_error();
            die();
        }
        return $conexao;
}
function logar()
{
    if ((!isset($_SESSION['email']))) {
        header("location:index.php");
    } else {
        if($_SESSION['email'] != 'admin@gmail.com'){
            header('location:index.php');
        }
    }
}

function executarSQL($conexao, $sql)
{
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado === false) {
        echo "Erro ao executar o comando SQL. " .
            mysqli_errno($conexao) . ": " . mysqli_error($conexao);
        die();
    }
    return $resultado;
}