<?php
require_once "../conecta.php";

$conexao = conectar();

$id_produto = $_GET['id_produto'];

/*$sql = "SELECT e.id_estoque, e.data_validade, sum(  s.quantidade  ) as total_saida from itens_saida s
INNER JOIN estoque e on s.id_estoque = e.id_estoque
INNER JOIN pedido p on p.id_pedido = s.id_pedido
WHERE e.id_produto = $id_produto and p.deferido = true
GROUP BY e.id_estoque";

$resultadoSaidas = mysqli_query($conexao,$sql);

$sql2 = "SELECT e.id_estoque, e.data_validade, sum(  ie.quantidade  ) as total_entrada from itens_entrada ie
INNER JOIN estoque e on ie.id_estoque = e.id_estoque
INNER JOIN entrada en on en.id_entrada = ie.id_entrada
WHERE e.id_produto = $id_produto and en.deferido = true
GROUP BY e.id_estoque";

$resultadoEntradas = mysqli_query($conexao,$sql2);


// $Produto = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
$entrada = mysqli_fetch_all($resultadoEntradas, MYSQLI_ASSOC);
$saida = mysqli_fetch_all($resultadoSaidas, MYSQLI_ASSOC);
// var_dump($saida);die;
// ID_estoque    data     saldo
$DADOS = [];
*/

$sql = "SELECT *, (total_entrada - total_saida) as resultado FROM (SELECT e.id_estoque as sid, sum( s.quantidade ) as total_saida from itens_saida s INNER JOIN estoque e on s.id_estoque = e.id_estoque INNER JOIN pedido p on p.id_pedido = s.id_pedido WHERE e.id_produto = $id_produto and p.deferido = true GROUP BY e.id_estoque) as saida INNER JOIN (SELECT e.id_estoque as eid, e.data_validade as edata, sum( ie.quantidade ) as total_entrada from itens_entrada ie INNER JOIN estoque e on ie.id_estoque = e.id_estoque INNER JOIN entrada en on en.id_entrada = ie.id_entrada WHERE e.id_produto = $id_produto and en.deferido = true GROUP BY e.id_estoque) as entrada ON sid = eid";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
// echo "<pre>" . var_dump($dados) . "</pre>";die;
echo json_encode($dados);

/*

    para cada resultadoEntradas de entrada

       para cada resultadoSaida 

           quando id estoque da entrada e da saida for o mesmo
                $dado = [
                        "id_estoque" => passar o id do estque
                        "validade" => passar validade
                        "saldo"  = entrada['total_entrada'] - saida['total_saida']
               ]     ;
                $dados[]     = $dado
              



*/

