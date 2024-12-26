<?php
include "../conecta.php";
$conexao = conectar();

$item = json_decode(file_get_contents("php://input"), true);

// Agora podemos acessar os dados de forma mais fácil como array
$id_pedido = $item['id_pedido'];
$itens = $item['itens'];

// Exemplo de como acessar os itens:
foreach ($itens as $item) {

    $sql_get_idProduto = "SELECT id_produto FROM produto WHERE subtipo_produto ='" . $item['produto'] . "'";
    $resultado_idProduto = mysqli_query($conexao, $sql_get_idProduto);
    
    $linha = mysqli_fetch_assoc($resultado_idProduto);
    $id_produto = $linha['id_produto'];
    $data_validade = explode(" ", $item['estoque']);
    
    if($data_validade[0] == 'Saldo:'){
        // var_dump('Entrou no IF');die;
        
        $sql_get_IdEstoque = "SELECT id_estoque FROM estoque WHERE data_validade IS NULL AND id_produto = $id_produto";
    }else{
        
        $data_formatada = DateTime::createFromFormat('d/m/Y', $data_validade[0])->format('m/Y'); // Consulta SQL com DATE_FORMAT para pegar apenas mês e ano
        $sql_get_IdEstoque = "SELECT id_estoque FROM estoque WHERE DATE_FORMAT(data_validade, '%m/%Y') = '$data_formatada' AND id_produto = $id_produto";
        
    }
    
    // var_dump($sql_get_IdEstoque);die;
    $resultado_get_IdEstoque = mysqli_query($conexao, $sql_get_IdEstoque);
    
    if($resultado_get_IdEstoque->num_rows == 0){
        
        $sql_criaEstoque="INSERT INTO estoque(data_validade,id_produto)VALUES($id_produto,'$data_formatada')";
        $resultado_criaEstoque = mysqli_query($conexao,$sql_criaEstoque);
        $id_estoque = mysqli_insert_id($conexao);
        
    }else{
        
        $linha_retornada = mysqli_fetch_assoc($resultado_get_IdEstoque);
        $id_estoque = $linha_retornada['id_estoque'];

    }
    
    $quantidade = $item['quantidade'];
    
    $sql_itens_saida = "INSERT INTO itens_saida(quantidade,id_pedido,id_estoque)VALUES($quantidade,$id_pedido,$id_estoque)";
    $resultado_itens_saida = mysqli_query($conexao,$sql_itens_saida);
    // echo "Produto: " . $item['produto'] . "\n";
    // echo "Estoque: " . $item['estoque'] . "\n";
    // echo "Quantidade: " . $item['quantidade'] . "\n\n";
    $sql_pedido = "UPDATE pedido SET deferido = 1 WHERE id_pedido = $id_pedido";
    // var_dump($sql_pedido);die;
    
    $resultado_Update_Pedido = mysqli_query($conexao,$sql_pedido);
}
