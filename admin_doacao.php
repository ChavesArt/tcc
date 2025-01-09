<?php
session_start();
include  "conecta.php";

$conexao = conectar();
logar();
if($_SESSION['tipo_cliente'] == 1){
    header('Location:index.php');
}
$logado = $_SESSION['nome'];

$sql_seleciona_doacoes = "SELECT 
(entrada.total_entrada - COALESCE(saida.total_saida, 0)) AS resultado,
entrada.data_validade,
entrada.descricao,
entrada.tamanho,
entrada.nome_produto,
entrada.tipo_produto,
entrada.id_estoque
FROM 
(SELECT e.id_estoque AS id_estoque_saida, 
        SUM(s.quantidade) AS total_saida
 FROM itens_saida s
 INNER JOIN estoque e ON s.id_estoque = e.id_estoque
 INNER JOIN pedido p ON p.id_pedido = s.id_pedido AND p.deferido = true
 GROUP BY e.id_estoque) AS saida
RIGHT JOIN 
(SELECT e.id_estoque AS id_estoque_entrada,
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
WHERE entrada.row_num = 1 AND entrada.tipo_produto ='". $_GET['tabela'] ."'";
// var_dump($sql_seleciona_doacoes);die;
$resultado_todas = mysqli_query($conexao, $sql_seleciona_doacoes);
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

<?php if (isset($_SESSION['exclusao_sucess']) && $_SESSION['exclusao_sucess'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-middle",
            icon: "success",
            title: "Exclusão feita com sucesso!",
            showConfirmButton: false,
            timer: 1500,
            customClass: {
    popup: 'small-popup'  // Aplique uma classe CSS personalizada
  }
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['exclusao_sucess']);
    ?>
<?php } ?>

    <br>
    <div  class="text-center">
        <h4>Olá, <?php echo $logado; ?></h4>
        <h1>Doações</h1>
        <span class="text-muted">Tela das doações</span>

    </div>


    <!--Barra de pesquisa-->
    <div class="caixa-procura">

        <form action="" method="get">
            <input disabled type="search" class="form-control" placeholder="(nome, quantidade, descrição, data de validade, tamanho)" name="pesquisar" id="pesquisar">
            <button disabled class="btn btn-primary btn-btn">
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

                        <a href="pedidos.php?tabela=<?= $_GET['tabela']; ?>" class="btn btn-outline-primary">Pedidos</a>
                        <a href="entradas.php?tabela=<?= $_GET['tabela']; ?>" class="btn btn-outline-primary">Entradas</a>

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
                <?php if ($_GET['tabela'] == 'alimento') { ?>
                    <th>Nome</th>
                    <th>Data de validade</th>
                    <th>Quantidade</th>
                    <th >Opção</th>
                <?php } ?>

                <?php if ($_GET['tabela'] == 'roupa') { ?>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Tamanho</th>
                    <th >Opção</th>
                <?php } ?>

                <?php if ($_GET['tabela'] == 'outro') { ?>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Tamanho</th>
                    <th>Data de validade</th>
                    <th >Opção</th>
                <?php } ?>
            </thead>
            <tbody>
                <?php

                if ($_GET['tabela'] == 'alimento') {

                    // tabela com as informaçoes do banco sobre a roupas
                    while ($info = mysqli_fetch_assoc($resultado_todas)) {
                        $date = date_create($info['data_validade']);
                        $id_estoque = $info['id_estoque'];
                        echo '<tr>';
                        echo '<td>' . $info['nome_produto'] . '</td>';
                        echo "<td>" . date_format($date, "d/m/Y") . "</td>";
                        echo '<td>' . $info['resultado'] . '</td>';
                        echo '<td>
                        
                        <a id="deleteButton" class="btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes="' . $info['id_estoque'] . '">                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        </a>
                        </td>';

                        echo '</tr>';
                    }
                }
                
                if ($_GET['tabela'] == 'roupa') {
                    // tabela com as informaçoes do banco sobre a roupas
                    while ($info = mysqli_fetch_assoc($resultado_todas)) {
                        $id_estoque = $info['id_estoque'];
                        echo '<tr>';
                        echo '<td>' . $info['nome_produto'] . '</td>';
                        echo '<td>' . $info['resultado'] . '</td>';
                        echo '<td>' . $info['tamanho'] . '</td>';
                        echo '<td>
                        
                        <a id="deleteButton" class="btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes="' . $info['id_estoque'] . '">                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        </a>
                        </td>';
                        
                        echo '</tr>';
                    }
                }
                
                if ($_GET['tabela'] == 'outro') {
                    // tabela com as informaçoes do banco sobre a roupas
                    while ($info = mysqli_fetch_assoc($resultado_todas)) {

                        $date = date_create($info['data_validade']);
                        $id_estoque = $info['id_estoque'];
                        echo '<tr>';
                        echo '<td>' . $info['nome_produto'] . '</td>';
                        echo '<td>' . $info['resultado'] . '</td>';
                        echo '<td>' . $info['tamanho'] . '</td>';
                        echo "<td>" . date_format($date, "d/m/Y") . "</td>";
                        echo '<td>
                        
                        <a id="deleteButton" class="btn btn-sm btn-danger" data-tipo-doacoes="' . $_GET['tabela'] . '" data-id_doacoes="' . $info['id_estoque'] . '" data-data_validade="' . $info['data_validade'] . '">                        
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
                const data_validade = this.getAttribute('data-data_validade');
                Swal.fire({
                    title: "Tem certeza que deseja excluir?",
                    icon: "warning",
                    showCancelButton: "Cancelar",
                    confirmButtonColor: "#006400",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crud/excluir_doacao.php?id_doacoes=" + id_doacoes + "&tabela=" + tipo_doacao + "&data_validade=" + data_validade;
                    }
                });
            });
        });
    </script>
</body>

</html>