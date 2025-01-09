<?php
session_start();
include  "conecta.php";

$conexao = conectar();
logar();
$logado = $_SESSION['nome'];

$sql_seleciona_doacoes = "SELECT (total_entrada - total_saida) AS resultado,data_validade,descricao,tamanho,nome_produto,tipo_produto
FROM (SELECT 
e.id_estoque AS sid, SUM(s.quantidade) AS total_saida 
FROM itens_saida s
INNER JOIN estoque e ON s.id_estoque = e.id_estoque
INNER JOIN pedido p ON p.id_pedido = s.id_pedido AND p.deferido = true
GROUP BY e.id_estoque
) AS saida

INNER JOIN 

(SELECT e.id_estoque AS eid, e.data_validade AS data_validade, SUM(ie.quantidade) AS total_entrada,en.descricao AS descricao,en.tamanho AS tamanho,pr.subtipo_produto AS nome_produto,pr.tipo_produto AS tipo_produto
FROM itens_entrada ie
INNER JOIN estoque e ON ie.id_estoque = e.id_estoque
INNER JOIN produto pr ON e.id_produto = pr.id_produto
INNER JOIN entrada en ON en.id_entrada = ie.id_entrada AND en.deferido = true
GROUP BY e.id_estoque
) AS entrada

ON saida.sid = entrada.eid;
";

// if ($_GET) {
//     /*barra de pesquisa*/

//     if (!empty($_GET['pesquisar'])) {

//         $data = $_GET['pesquisar'];



//         if (empty($_GET['tabela'])) {

//             $sql_doacao = "SELECT * FROM doacoes where nome LIKE '%$data%' or quantidade LIKE '%$data%' or descricao LIKE '%$data%' or  data_validade LIKE '%$data%' or tamanho LIKE '%$data%' or tipo_doacao LIKE '%$data%' order by nome DESC";
//         }
//     }

//     if (empty($_GET['pesquisar'])) {

// $sql_seleciona_doacoes = "SELECT (total_entrada - total_saida) AS resultado,data_validade,descricao,tamanho,nome_produto,tipo_produto
// FROM (SELECT 
// e.id_estoque AS sid, SUM(s.quantidade) AS total_saida 
// FROM itens_saida s
// INNER JOIN estoque e ON s.id_estoque = e.id_estoque
// INNER JOIN pedido p ON p.id_pedido = s.id_pedido AND p.deferido = true
// GROUP BY e.id_estoque
// ) AS saida

// INNER JOIN 

// (SELECT e.id_estoque AS eid, e.data_validade AS data_validade, SUM(ie.quantidade) AS total_entrada,en.descricao AS descricao,en.tamanho AS tamanho,pr.subtipo_produto AS nome_produto,pr.tipo_produto AS tipo_produto
// FROM itens_entrada ie
// INNER JOIN estoque e ON ie.id_estoque = e.id_estoque
// INNER JOIN produto pr ON e.id_produto = pr.id_produto
// INNER JOIN entrada en ON en.id_entrada = ie.id_entrada AND en.deferido = true
// GROUP BY e.id_estoque
// ) AS entrada

// ON saida.sid = entrada.eid;
// ";
//     }

//     if (!empty($_GET['tabela'])) {
//         // SELECIONA TODAS AS ROUPAS
//         if ($_GET['tabela'] == 'roupa') {
//             $tipo_doacao = $_GET['tabela'];
//             $sql_doacao = "SELECT * FROM doacoes WHERE tipo_doacao = '$tipo_doacao'";
//         }
//         // SELECIONA TODOS OS OUTROS CADASTROS
//         if ($_GET['tabela'] == 'outro') {
//             $tipo_doacao = $_GET['tabela'];
//             $sql_doacao = "SELECT * FROM doacoes WHERE tipo_doacao = '$tipo_doacao'";
//         }
//         // SELECIONA TODOS OS ALIMENTOS
//         if ($_GET['tabela'] == 'alimento') {
//             $tipo_doacao = $_GET['tabela'];
//             $sql_doacao = "SELECT * FROM doacoes WHERE tipo_doacao = '$tipo_doacao'";
//         }
//     }
// }



// head-table
if (empty($_GET)) {
    $tipo_doacao = 'alimento';
    $sql_doacao = "SELECT * FROM doacoes WHERE tipo_doacao='$tipo_doacao'";
}
$resultado_doacao = mysqli_query($conexao, $sql_doacao);
// var_dump($resultado_doacao);die();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página administrador</title>
    <?php include("links.php"); ?>
</head>

<body>
    <?php include('menu.php');
    ?>
    <br>
    <div style="margin-top: 10%;" class="text-center">
        <h4>Olá, <?php echo $logado; ?></h4>
        <h1>Doações</h1>
        <span class="text-muted">Tela das doações</span>

    </div>


    <!--Barra de pesquisa-->
    <div class="caixa-procura">

        <form action="" method="get">
            <input type="search" class="form-control" placeholder="(nome, quantidade, descrição, data de validade, tamanho)" name="pesquisar" id="pesquisar">
            <button class="btn btn-primary btn-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
            </button>

        </form>
    </div>

    <div class=" container p-5 ">
        <table class="table table-striped table-hover border border-dark  ">
            <thead>

                <div class="head-table">

                    <!-- grupo de botões -->

                    <div class="btn-group" role="group" aria-label="Basic outlined example">

                        <a href="admin_usuario.php" type="button" class="btn btn-outline-primary">Usuários</a>

                        <a href="pedidos.php" class="btn btn-outline-primary">Pedidos</a>
                        <a href="entradas.php" class="btn btn-outline-primary">Entradas</a>

                        <form action="admin_doacao.php" method="GET">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Doações</button>
                            <div class="dropdown-menu">

                                <input type="submit" class="dropdown-item" name="tabela" value="alimento">
                                <input type="submit" class="dropdown-item" name="tabela" value="roupa">
                                <input type="submit" class="dropdown-item" name="tabela" value="outro">

                            </div>
                        </form>



                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Cadastrar</button>
                        <div class="dropdown-menu">

                            <a href="formdoar.php" class="dropdown-item">alimento</a>
                            <a href="formcad.php" class="dropdown-item">usuário</a>
                            <a href="formtipo.php" class="dropdown-item">tipo de doação</a>

                        </div>
                    </div>
                </div>
                <?php
                // HEAD do Alimento
                if (empty($_GET['tabela']) or $_GET['tabela'] == 'alimento' or $_GET['tabela'] == 'outro') {

                    if (isset($_GET['pesquisar'])) {

                        echo "<tr>";
                        echo "<th scope='col'>Nome</th>";
                        echo "<th scope='col'>Quantidade</th>";
                        echo "<th scope='col'>Descrição</th>";
                        echo "<th scope='col'>Data de validade</th>";
                        echo "<th scope='col'>Tamanho</th>";
                        echo "<th scope='col'>Opções</th>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<th scope='col'>Nome</th>";
                        echo "<th scope='col'>Quantidade</th>";
                        echo "<th scope='col'>Descrição</th>";
                        echo "<th scope='col'>Data de validade</th>";
                        // verificando se é a tabela outro e diferenete de pesquisar para poder aparecer o tamanho na tabela 'outro'
                        if (!empty($_GET) and !isset($_GET['pesquisar'])) {
                            if ($_GET['tabela'] == 'outro') {
                                echo "<th scope='col'>Tamanho</th>";
                            }
                        }
                        echo "<th scope='col'>Opções</th>";
                        echo "</tr>";
                    }
                }


                if (!empty($_GET['tabela'])) {

                    if ($_GET['tabela'] == 'roupa') {

                        echo "<tr>";
                        echo "<th scope='col'>Nome</th>";
                        echo "<th scope='col'>Quantidade</th>";
                        echo "<th scope='col'>Tamanho</th>";
                        echo "<th scope='col'>Descrição</th>";
                        echo "<th scope='col'>Opções</th>";
                        echo "</tr>";
                    }
                }
                ?>
            </thead>
            <tbody>
                <?php

                if (!empty($_GET['tabela'])) {

                    if ($_GET['tabela'] == 'roupa') {

                        // tabela com as informaçoes do banco sobre a roupas
                        while ($info = mysqli_fetch_assoc($resultado_doacao)) {
                            echo '<tr>';
                            echo '<td>' . $info['nome'] . '</td>';
                            echo '<td>' . $info['quantidade'] . '</td>';
                            echo '<td>' . $info['tamanho'] . '</td>';
                            echo "<td>" . $info['descricao'] . "</td>";
                            echo '<td>
                        
                        <a class = "btn btn-sm btn-primary" href="form-alterar.php?id_doacoes=' . $info['id_doacoes'] . '">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                        </a>
                        
                        <a id="deleteButton"  class = "btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes=' . $info['id_doacoes'] . '>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        </a>
                        </td>';

                            echo '</tr>';
                        }
                    }

                    if (empty($_GET) or $_GET['tabela'] == 'outro' or $_GET['tabela'] == 'alimento') {

                        // tabela com as informaçoes do banco sobre o alimento ou outro
                        while ($info = mysqli_fetch_assoc($resultado_doacao)) {
                            $date = date_create($info['data_validade']);
                            echo '<tr>';
                            echo '<td>' . $info['nome'] . '</td>';
                            echo "<td>" . $info['quantidade'] . "</td>";
                            echo '<td>' . $info['descricao'] . '</td>';
                            echo "<td>" . date_format($date, "d/m/Y");
                            " . </td>";
                            if ($_GET['tabela'] == 'outro') {
                                echo '<td>' . $info['tamanho'] . '</td>';
                            }
                            echo '<td>
                        
                        <a class = "btn btn-sm btn-primary" href="form-alterar.php?id_doacoes=' . $info['id_doacoes'] . '">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                        </a>
                        
                        <a id="deleteButton"  class = "btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes =' . $info['id_doacoes'] . '>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        </a>
                        </td>';

                            echo '</tr>';
                        }
                    }
                }

                if (isset($_GET['pesquisar'])) {

                    // tabela com as informaçoes do banco sobre os usuários
                    while ($info = mysqli_fetch_assoc($resultado_doacao)) {
                        $date = date_create($info['data_validade']);

                        echo '<tr>';
                        echo '<td>' . $info['nome'] . '</td>';
                        echo '<td>' . $info['quantidade'] . '</td>';
                        echo '<td>' . $info['descricao'] . '</td>';
                        echo "<td>" . date_format($date, "d/m/Y");
                        echo '<td>' . $info['tamanho'] . '</td>';
                        echo '<td>
                    
                    <a class = "btn btn-sm btn-primary" href="form-alterar.php?id_doacoes=' . $info['id_doacoes'] . '">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                    </svg>
                    </a>
                    
                    <a id="deleteButton"  class = "btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes=' . $info['id_doacoes'] . '>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                    </svg>
                    </a>
                    </td>';

                        echo '</tr>';
                    }
                }

                ?>

            </tbody>
        </table>
    </div>

    <script>
        var id = document.querySelectorAll('[id^="deleteButton"]').forEach(button => {
            button.addEventListener('click', function() {
                const id_doacoes = this.getAttribute('data-id_doacoes');
                const tipo_doacao = this.getAttribute('data-tipo-doacoes');
                Swal.fire({
                    title: "Tem certeza que deseja excluir?",
                    icon: "warning",
                    showCancelButton: "Cancelar",
                    confirmButtonColor: "#006400",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crud/excluir_doacao.php?id_doacoes=" + id_doacoes + "&tabela=" + tipo_doacao;
                    }
                });
            });
        });
    </script>
</body>

</html>