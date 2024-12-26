<?php
require_once "../conecta.php";
$conexao = conectar();

$id_estoque = $_GET['id_doacoes'];
$tabela = $_GET['tabela'];

$sql_procuraNoItensIdEstoque = "SELECT id_estoque FROM itens_entrada WHERE id_estoque= $id_estoque";
$resultado_itens_entrada = mysqli_query($conexao,$sql_procuraNoItensIdEstoque);


if($resultado_itens_entrada->num_rows == 1){

    $sql_itens_entradaExclusao = "DELETE FROM itens_entrada
    WHERE id_estoque = $id_estoque";
    $resultado_exclusao = mysqli_query($conexao,$sql_itens_entradaExclusao);
}

$sql_ProcuraNoItens_saidaIdEstoque = "SELECT id_estoque FROM itens_saida WHERE id_estoque=$id_estoque";
$resultado_itens_saida = mysqli_query($conexao,$sql_ProcuraNoItens_saidaIdEstoque);

if($resultado_itens_saida->num_rows == 1){
    
    $sql_itens_entradaExclusao = "DELETE FROM itens_saida
    WHERE id_estoque = $id_estoque";
    $resultado_exclusao = mysqli_query($conexao,$sql_itens_entradaExclusao);

}

if(empty($_GET['data_validade'])){
// var_dump('chegou vazio!');die;

$sql = "DELETE e FROM estoque e
INNER JOIN  produto p ON e.id_produto = p.id_produto
WHERE e.id_estoque=$id_estoque";
    
    
}else{

    $data_validade = $_GET['data_validade'];
    $sql = "DELETE e,p,ie FROM estoque e
    INNER JOIN produto p ON e.id_produto = p.id_produto
    INNER JOIN itens_entrada ie ON e.id_estoque = ie.id_estoque
    WHERE e.id_estoque = $id_estoque AND data_validade = '$data_validade' ";
// var_dump('NÃO chegou vazio!');die;


}

// var_dump($sql);die;
$result = mysqli_query($conexao, $sql);
if ($result) {
    header("Location: ../admin_doacao_copy.php?tabela=".$tabela."");
    session_start();
    $_SESSION['exclusao_sucess'] = true;
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}