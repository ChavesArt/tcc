<?php
require_once "../conecta.php";
$conexao = conectar();

$id_produto = $_GET['id_produto'];

$sql = "SELECT entrada.edata, (total_entrada - COALESCE(saida.total_saida, 0)) as resultado 
FROM (SELECT 
 e.id_estoque as sid, 
 sum( s.quantidade ) as total_saida 
from itens_saida s 
INNER JOIN estoque e on s.id_estoque = e.id_estoque 
INNER JOIN pedido p on p.id_pedido = s.id_pedido 
WHERE e.id_produto = $id_produto and p.deferido = true GROUP BY e.id_estoque) as saida 

RIGHT JOIN 

(SELECT 
 e.id_estoque as eid, 
 e.data_validade as edata, 
 sum( ie.quantidade ) as total_entrada 
 from itens_entrada ie 
 INNER JOIN estoque e on ie.id_estoque = e.id_estoque 
 INNER JOIN entrada en on en.id_entrada = ie.id_entrada 
WHERE e.id_produto = $id_produto and en.deferido = true GROUP BY e.id_estoque) as entrada 
ON sid = eid";
// var_dump($sql);die;
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
// echo "<pre>" . var_dump($dados) . "</pre>";die;
echo json_encode($dados);

