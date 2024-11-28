<?php
session_start();
include_once "../conecta.php";
$conexao = conectar();

$id_usuario = $_SESSION['id_usuario'];

$tipo_doacao = $_GET['tipo_doacao'];
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

if ($tipo_doacao != 'outro') {

    $id_produto = $_POST['id_produto'];
}

// verifica se a quantidade é maior que zero para não retirar do banco em vez de somar
if ($quantidade < 0) {
    $quantidade = 0;
}

if ($tipo_doacao == "alimento") {
    date_default_timezone_set('America/Sao_Paulo'); // Ajusta para o fuso horário
    $tempo = date('Y-m-d H:i');
    $data_validade = $_POST['data_validade'];

    $resultado = pegarMesEAno($data_validade);
    $mes = $resultado['mes'];
    $ano = $resultado['ano'];
    $data_validade = $ano . "/" . $mes;

    

    //buscando se existe um lançamento na tabela estoque para o id_produto escolhida e a data de validade
    $sql1 = "SELECT id_produto, id_estoque From estoque Where id_produto = $id_produto AND YEAR(data_validade) = $ano AND MONTH(data_validade) = $mes";
    $resultado = mysqli_query($conexao, $sql1);
     

    if ($resultado->num_rows == 0) { //se não existe  este lançamento descrito acima, então, cria ele, em seguida, pega o id_estoque do recem registro lançado
        $data_validade = $_POST['data_validade'];
        $sql2 = "INSERT INTO estoque(id_produto,data_validade)VALUES($id_produto, '$data_validade')";
        $resultado2 = mysqli_query($conexao, $sql2);
        $idEstoque = mysqli_insert_id($conexao);
    } else {
        //já que existe o estoque cadastrado para o id_produto e para a validade necessária, então pega o id deste estoque
        $row = mysqli_fetch_assoc($resultado);
        $idEstoque = $row['id_estoque'];  // Atribuindo o id à variável
    }


    // criar a entrada com as informações pertinentes apenas para a entrada (id_produto, validade não fazem parte do lançamento da entrada (tabela))
    //lança e pega o ID da entrada recem criada
    $sql3 = "INSERT INTO entrada(data_entrada,id_usuario,quantidade,descricao)VALUES('$tempo',$id_usuario,$quantidade,'$descricao')";
    $resultado3 = mysqli_query($conexao,$sql3);
    $id_entrada = mysqli_insert_id($conexao);
    
    
    
    
    $sql4 = "INSERT INTO itens_entrada(id_estoque,id_entrada,quantidade)VALUES($id_estoque,$id_entrada,$quantidade)";
    $resultado5 = mysqli_query($conexao,$sql4);
    
    
    
    
    
    
    
    
}


if ($tipo_doacao == "outro") {
    
    $tamanho = $_POST['tamanho'];
    $data_validade = $_POST['data_validade'];
    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');

    // $sql1 = "SELECT id_produto, id_estoque From estoque Where id_produto = '2'";
    $sql1 = "INSERT INTO estoque(id_produto,data_validade)VALUES(2,'$data_validade')";
    $resultado = mysqli_query($conexao, $sql1);

    // if ($resultado->num_rows == 0) { //se não existe  este lançamento descrito acima, então, cria ele, em seguida, pega o id_estoque do recém registro lançado
    //     $data_validade = $_POST['data_validade'];
    //     $sql2 = "INSERT INTO estoque(id_produto,data_validade)VALUES($id_produto, '$data_validade')";
    //     $resultado2 = mysqli_query($conexao, $sql2);
    //     $idEstoque = mysqli_insert_id($conexao);
    // } else {
    //     //já que existe o estoque cadastrado para o id_produto e para a validade necessária, então pega o id deste estoque
    //     $row = mysqli_fetch_assoc($resultado3);
    //     $idEstoque = $row['id_estoque'];  // Atribuindo o id à variável
    // }

    // criar a entrada entrada com as informações pertinentes apena para a entrada (id_produto, validade não fazem parte do lançamento da entrada (tabela))
    //lança e pega o ID da entrada recem criada
    $sql4 = "INSERT INTO entrada(data_entrada,id_usuario,quantidade,descricao)VALUES('$tempo',$id_usuario,$quantidade,'$descricao')";
    $resultado4 = mysqli_query($conexao,$sql4);
    $id_entrada = mysqli_insert_id($conexao);


    

    $sql5 = "INSERT INTO itens_entrada(id_estoque,id_entrada,quantidade)VALUES($id_estoque,$id_entrada,$quantidade)";
    $resultado5 = mysqli_query($conexao,$sql5);
}

if ($tipo_doacao == "roupa") {

    $tamanho = $_POST['tamanho'];

    date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o seu fuso horário
    $tempo = date('Y-m-d H:i');

    $sql1 = "SELECT id_produto, id_estoque From estoque Where id_produto = $id_produto";
    $resultado = mysqli_query($conexao, $sql1);

    if ($resultado->num_rows == 0) { //se não existe  este lançamento descrito acima, então, cria ele, em seguida, pega o idestoque do recem registro lançado
        $data_validade = $_POST['data_validade'];
        $sql2 = "INSERT INTO estoque(id_produto,data_validade)VALUES($id_produto, '$data_validade')";
        $resultado2 = mysqli_query($conexao, $sql2);
        $id_estoque = mysqli_insert_id($conexao);
    } else {
        //já que existe o estoque cadastrado para o id_produto e para a validade necessária, então pega o id deste estoque
        $row = mysqli_fetch_assoc($resultado3);
        $id_estoque = $row['id_estoque'];  // Atribuindo o id à variável
    }

    // criar a entrada entrada com as informações pertinentes apena para a entrada (id_produto, validade não fazem parte do lançamento da entrada (tabela))
    //lança e pega o ID da entrada recem criada
    $sql4 = "INSERT INTO entrada(data_entrada,id_usuario,quantidade,descricao,tamanho)VALUES('$tempo',$id_usuario,$quantidade,'$descricao','$tamanho')";
    $resultado4 = mysqli_query($conexao,$sql4);
    $id_entrada = mysqli_insert_id($conexao);


    

    $sql5 = "INSERT INTO itens_entrada(id_estoque,id_entrada,quantidade)VALUES($id_estoque,$id_entrada,$quantidade)";
    $resultado5 = mysqli_query($conexao,$sql5);
}
// header("location:formdoar.php?aviso");
// var_dump($id_estoque);
// die;
header("location:../formdoar.php");
