<?php

/*fazendo a sessão*/
session_start();
include  "conecta.php";

$conexao = conectar();
logar();
$logado = $_SESSION['nome'];

/*barra de pesquisa*/
if (!empty($_GET['pesquisar'])) {
    $data = $_GET['pesquisar'];
    $sql = "SELECT * FROM usuario where nome LIKE '%$data%' or email LIKE '%$data%' or endereco LIKE '%$data%' or  telefone LIKE '%$data%' order by nome DESC";
}if (empty($_GET['pesquisar'])) {
    $sql = "SELECT * FROM usuario order by nome DESC";
}
$resultado = mysqli_query($conexao, $sql);
$res = mysqli_affected_rows($conexao);

// head-table

if(!empty($_GET['tabela'])){
    $tipo_doacao = $_GET['tabela'];
    $sql_doacao = "SELECT * FROM doacoes WHERE tipo_doacao=$tipo_doacao";
    $resultado = mysqli_query($conexao,$sql_doacao);
}
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
    <?php //include('menu.php'); ?>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <center>
        <h1>Olá, <?php echo $logado; ?></h1>
    </center>


    <!--Barra de pesquisa-->
    <div class="caixa-procura">

        <form action="" method="get">
            <input type="search" class="form-control" placeholder="(nome, telefone, email, endereço)" name="pesquisar" id="pesquisar">
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
                <div class="btn-group">
                    <form action="" method = "get">
                        <div class="btn btn-primary dropdown-toggle ">
                        <button type="button" class="btn btn-primary" data-bs-toggle="dropdown">Usuários </button>
                        <div class="dropdown-menu">
                                <input type="submit" class = "dropdown-item" name = "tabela" value="Usuários">
                                <input type="submit" class = "dropdown-item" name = "tabela" value="Voluntários">
                            </div>
                        </div>
                    </form>
                    <div class="btn-group">
                        <form action="" method = "get">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Doações</button>
                            <div class="dropdown-menu">
                                <input type="submit" class = "dropdown-item" name = "tabela" value="Alimento">
                                <input type="submit" class = "dropdown-item" name = "tabela" value="Roupas">
                                <input type="submit" class = "dropdown-item" name = "tabela" value="Outros">
                            </div>
                        </form>
                        <!-- div abaixo do btn-group dropdown -->
                    </div>
                    <!-- div abaixo do btn-group geral -->
                </div>

            </div>

            <?php
            if(empty($_GET['tabela'])){
                
                echo "<tr>";
                echo"<th scope='col'>Nome</th>";
                echo "<th scope='col'>Quantidade</th>";
                echo "<th scope='col'>Descrição</th>";
                echo "<th scope='col'>Opções</th>";
                echo "</tr>";
   
            } 
            
            
            
            if($_POST){

                if($_GET['tabela'] == "Usuários"){
                    
                    echo "<tr>";
                    echo"<th scope='col'>Nome</th>";
                    echo "<th scope='col'>Endereço</th>";
                    echo "<th scope='col'>Email</th>";
                    echo "<th scope='col'>telefone</th>";
                    echo "<th scope='col'>Opções</th>";
                    echo "</tr>";
                    
                }
            }
                ?>
            </thead>
            <tbody>
                <?php
                // tabela com as informaçoes do banco
                while ($info = mysqli_fetch_assoc($resultado)) {

                    echo '<tr>';
                    echo '<td>' . $info['nome'] . '</td>';
                    echo "<td>" . $info['endereco'] . "</td>";
                    echo '<td>' . $info['email'] . '</td>';
                    echo "<td>" . $info['telefone'] . "</td>";
                    echo '<td>

        <a class = "btn btn-sm btn-primary" href="crud/form-alterar.php?id_usuario=' . $info['id_usuario'] . '">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
        </a>

        <a id="deleteButton"  class = "btn btn-sm btn-danger" data-id_usuario=' . $info['id_usuario'] . '>

        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
        </svg>
        </a>
        </td>';

                    echo '</tr>';
                }

                ?>

            </tbody>
        </table>
    </div>

    <script>
        var id = document.querySelectorAll('[id^="deleteButton"]').forEach(button => {
            button.addEventListener('click', function() {
                const idUsuario = this.getAttribute('data-id_usuario');
                Swal.fire({
                    title: "Tem certeza que deseja excluir?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crud/excluir.php?id_usuario=" + idUsuario;
                    }
                });
            });
        });
    </script>
</body>

</html>