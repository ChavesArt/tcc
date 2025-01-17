<?php
require_once "conecta.php";
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$conexao = conectar();
// Configurar opções do DOMPDF
$options = new Options();

// Permite usar CSS e fontes externas
$options->set('isRemoteEnabled', true); 
$dompdf = new Dompdf($options);

// HTML inicial
$dados = '
<html>
<head>
<style>
/* Reset de margens e padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilo para o corpo */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}

/* Estilo para o conteúdo */
.container {
    width: 100%;
    max-width: 800px; /* Define a largura máxima do conteúdo */
    text-align: center;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Cabeçalho */
.header h1 {
    color: black; /* Cor roxa */
    text-decoration: underline;
    margin-bottom: 20px;
}

/* Tabela */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-top: 20px;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.table th {
    background-color: #7e22ce; /* Cor roxa para o cabeçalho da tabela */
    color: white;
    font-weight: bold;
}

.table td {
    background-color: #f9f9f9;
}

.table tr:nth-child(even) {
    background-color: #f1f1f1;
}

.table tr:hover {
    background-color: #e1e1e1;
}

</style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Relatório de Doações</h1>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nome do Produto</th>
                <th>Data de Validade</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>';

$sql = "SELECT (entrada.total_entrada - COALESCE(saida.total_saida, 0)) AS resultado, 
                entrada.data_validade, 
                entrada.descricao, 
                entrada.tamanho, 
                entrada.nome_produto, 
                entrada.tipo_produto, 
                entrada.id_estoque 
        FROM (SELECT e.id_estoque AS id_estoque_saida, 
                     SUM(s.quantidade) AS total_saida 
              FROM itens_saida s 
              INNER JOIN estoque e ON s.id_estoque = e.id_estoque 
              INNER JOIN pedido p ON p.id_pedido = s.id_pedido AND p.deferido = true 
              GROUP BY e.id_estoque) AS saida 
        RIGHT JOIN (SELECT e.id_estoque AS id_estoque_entrada, 
                           e.data_validade, 
                           SUM(ie.quantidade) AS total_entrada, 
                           en.descricao AS descricao, 
                           en.tamanho AS tamanho, 
                           pr.subtipo_produto AS nome_produto, 
                           pr.tipo_produto AS tipo_produto, 
                           e.id_estoque AS id_estoque, 
                           ROW_NUMBER() OVER (PARTITION BY pr.subtipo_produto, e.data_validade ORDER BY e.id_estoque) AS row_num 
                    FROM itens_entrada ie 
                    INNER JOIN estoque e ON ie.id_estoque = e.id_estoque 
                    INNER JOIN produto pr ON e.id_produto = pr.id_produto 
                    INNER JOIN entrada en ON en.id_entrada = ie.id_entrada AND en.deferido = true 
                    GROUP BY e.id_estoque, e.data_validade, en.descricao, en.tamanho, pr.subtipo_produto, pr.tipo_produto) AS entrada 
        ON saida.id_estoque_saida = entrada.id_estoque_entrada 
        WHERE entrada.row_num = 1 AND entrada.tipo_produto = '". $_GET['tabela'] . "'";

$resultado = mysqli_query($conexao,$sql); 
while($linha = mysqli_fetch_assoc($resultado))
{
    $dados .= "<tr>";
    $dados .= '<td>' . $linha['nome_produto'] . '</td>';
    $dataNasc = date('d/m/Y',strtotime($linha['data_validade']));
    $dados .= '<td>' .$dataNasc . '</td>';
    $dados .= '<td>'. $linha['resultado'] . '</td>'; 
    $dados .= "</tr>";     
}       

$dados .= "</tbody>";
$dados .= "</table>";
$dados .= "</div></body></html>";

// Carrega o HTML no DOMPDF
$dompdf->loadHtml($dados);
// Define tamanho e orientação do papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar o PDF
$dompdf->render();

// Enviar o PDF para o navegador
$dompdf->stream("relatorio.pdf", ["Attachment" => true]); 
// Attachment false para exibir no navegador
?>
