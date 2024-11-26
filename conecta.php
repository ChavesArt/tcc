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
        header("location:login.php");
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

function pegarMesEAno($data_validade) {
    // Converte a string de data para um timestamp
    $timestamp = strtotime($data_validade);
    
    // Formata o mês e o ano
    $mes = date("m", $timestamp);  // "m" retorna o mês com dois dígitos (ex: 01, 02, ..., 12)
    $ano = date("Y", $timestamp);  // "Y" retorna o ano com quatro dígitos (ex: 2024)

    return ['mes' => $mes, 'ano' => $ano];
}
