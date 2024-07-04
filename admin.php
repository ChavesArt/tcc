<?php
include  "conecta.php";

$conexao = conectar();


if (!empty($_GET['pesquisar'])) {
    $data = $_GET['pesquisar'];
    $sql = "SELECT * FROM usuario where nome LIKE '%$data%' or email LIKE '%$data%' or endereco LIKE '%$data%' or  telefone LIKE '%$data%' order by nome DESC";
} else {
    $sql = "SELECT * FROM usuario order by nome DESC";
}
$resultado = mysqli_query($conexao, $sql);
$res = mysqli_affected_rows($conexao);
if($res < 1){
    echo "Não retornou nenhum resultado.";
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
    <br><br>

    <!--Barra de pesquisa-->
    <div class="caixa-procura">
        <form action="" method="get" >
        <input type="search" class="form-control" placeholder="Pesquisar" name="pesquisar" id="pesquisar">
        </form>
        <button class="btn btn-primary btn-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
        </button>
      
    </div>

    <div class="m-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Email</th>
                    <th scope="col">telefone</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while ($usuario = mysqli_fetch_assoc($resultado)) {

                    echo '<tr>';

                    echo '<td>' . $usuario['nome'] . '</td>';
                    echo "<td>" . $usuario['endereco'] . "</td>";
                    echo '<td>' . $usuario['email'] . '</td>';
                    echo "<td>" . $usuario['telefone'] . "</td>";
                    echo '<td>

        <a class = "btn btn-sm btn-primary" href="form-alterar.php?id_usuario=' . $usuario['id_usuario'] . '">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
        </a>

        <a id="deleteButton"  class = "btn btn-sm btn-danger data-id_usuario=' . $usuario['id_usuario'] . '">

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
                        window.location.href = "crud/excluir.php?id_usuario="+ idUsuario;
                    }
                });
            });
        });
    </script>
</body>

</html>