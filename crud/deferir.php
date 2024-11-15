<?php
include '../conecta.php';
$conexao = conectar();
if ($_GET['resposta'] == 'sim' and $_GET['movimentacao'] == 'pedido') {
    $id_pedido = $_GET['id_pedido'];
    
    $sql = "UPDATE pedido SET deferido = TRUE WHERE id_pedido = $id_pedido ";
    // var_dump($sql);die;
    $resultado = mysqli_query($conexao, $sql);

    
    header('location:../pedidos.php');
}

if ($_GET['resposta'] == 'nao' and $_GET['movimentacao'] == 'pedido') {
    $id_pedido = $_GET['id_pedido'];
    $sql = "UPDATE pedido SET deferido = FALSE WHERE id_pedido = $id_pedido ";
    $resultado = mysqli_query($conexao, $sql);
    header('location:../pedidos.php');
}



























if ($_GET['resposta'] == 'sim' and $_GET['movimentacao'] == 'entrada') {
    $id_entrada = $_GET['id_entrada'];
    
    $tipo_doacao = $_POST['tipo_doacao'];
    $subtipo = $_POST['subtipo_doacao'];
    // quantidade que chega da entrada
    $quantidade1 = $_POST['quantidade'];
    
    
    // Pega no banco o id do Produto
    $sql1 = "SELECT id_produto From produto WHERE tipo_produto= '$tipo_doacao' AND subtipo_produto ='$subtipo'";
    $resultado_get_id_produto = mysqli_query($conexao, $sql1);
    
    if ($resultado_get_id_produto) {
        // Pega o valor da primeira (e única) linha retornada como array associativo
        $linha = mysqli_fetch_assoc($resultado_get_id_produto);
        
        $id_produto = $linha['id_produto'];  // Pega o Id_produto
        $sql2 = "SELECT id_estoque FROM estoque WHERE id_produto= $id_produto";
        $resultado_estoque = mysqli_query($conexao, $sql2);
        
        $linha2 = mysqli_fetch_assoc($resultado_estoque);
            $id_estoque = $linha2['id_estoque']; //pega o Id_estoque

            $sql3 = "SELECT quantidade FROM itens_entrada Where id_estoque = $id_estoque";
            $resultado_item = mysqli_query($conexao, $sql3);

            if($resultado_item){
            //pega a quantidade da tabela itens_entrada
            $quantidade = mysqli_fetch_assoc($resultado_item);
            $quantidade = $quantidade['quantidade'];
            $total = $quantidade + $quantidade1; 
            $sql3 = "UPDATE itens_entrada SET quantidade= $total "; // soma o que tem no banco mais o que tem na entrega
        }
        if($resultado_item == FALSE){
            $sql3 = "INSERT INTO itens_entrada(id_estoque,id_entrada,quantidade)values($id_estoque,$id_entrada,$quantidade1)";
        }
        $resultado_item_entrada = mysqli_query($conexao,$sql3);
    }
    if($resultado_get_id_produto == FALSE){
        ECHO "Produto não cadastrado";
    }
    // Se ele clicou em deferir então muda no banco para TRUE
    $sql = "UPDATE entrada SET deferido = TRUE WHERE id_entrada = $id_entrada ";
    $resultado = mysqli_query($conexao, $sql);

    
    header('location:../entradas.php');
}

if ($_GET['resposta'] == 'nao' and $_GET['movimentacao'] == 'entrada') {
    $id_entrada = $_GET['id_entrada'];
    $sql = "UPDATE entrada SET deferido = FALSE WHERE id_entrada = $id_entrada ";
    $resultado = mysqli_query($conexao, $sql);
    header('location:../entradas.php');
}
