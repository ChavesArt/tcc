<?php
session_start();

include "conecta.php";
$conexao = conectar();


/*barra de pesquisa*/
if (!empty($_GET['pesquisar'])) {

    $data = $_GET['pesquisar'];

    $sql_produto = "SELECT * FROM produto where tipo_produto LIKE '%$data%' or subtipo_produto LIKE '%$data%' ORDER BY tipo_produto ASC, subtipo_produto ASC";
} else {

    $sql_produto = "SELECT * FROM produto ORDER BY tipo_produto ASC, subtipo_produto ASC";
}

$resultado_produto = mysqli_query($conexao, $sql_produto);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">

    <?php include "menu.php"; ?>



    <?php if (isset($_SESSION['formtipo_sucess']) && $_SESSION['formtipo_sucess'] == true) { ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "O tipo de doação foi cadastrado com sucesso!",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
        <?php
        // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
        unset($_SESSION['formtipo_sucess']);
        ?>
    <?php } ?>

    <?php if (isset($_SESSION['exclusao_produto_sucess']) && $_SESSION['exclusao_produto_sucess'] == true) { ?>
        <script>
            Swal.fire({
                position: "top-middle",
                icon: "success",
                title: "exclusão realizada com sucesso!",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'small-popup' // Aplique uma classe CSS personalizada
                }
            });
        </script>
        <?php
        // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
        unset($_SESSION['exclusao_produto_sucess']);
        ?>
    <?php } ?>

    <?php if (isset($_SESSION['alterar_produto_sucess']) && $_SESSION['alterar_produto_sucess'] == true) { ?>
        <script>
            Swal.fire({
                position: "top-middle",
                icon: "success",
                title: "alteração realizada com sucesso!",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'small-popup' // Aplique uma classe CSS personalizada
                }
            });
        </script>
        <?php
        // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
        unset($_SESSION['alterar_produto_sucess']);
        ?>
    <?php } ?>

    <?php if (isset($_SESSION['ja_existe']) && $_SESSION['ja_existe'] == true) { ?>
        <script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "O produto que você colocou já existe!",
                showConfirmButton: false,
                timer: 1500,
            });
        </script>
        <?php
        // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
        unset($_SESSION['ja_existe']);
        ?>
    <?php } ?>

    <div style="left: 2000px; margin-top:2%;">

        <a class="btn btn-danger my-2" href="admin_usuario.php"> <img class="material-icons" style="color: white;" src="img/voltar.svg" alt="voltar"> Voltar</a>

    </div>

    <main class="d-flex align-items-start justify-content-center vh-100" style="margin-top: 0;padding:30px">


        <div class="bg-white p-4 rounded shadow-sm w-90 vh-98" style="max-width: 500px;">
            <h1 class="text-center mb-4">Formulário de Cadastro do Tipo da Doação</h1>
            <form action="tipo_produto.php" method="post">

                <h3 class="text-center mb-3">Tipo de Doação:</h3>

                <!-- Radio Buttons em Linha -->
                <div class="d-flex justify-content-center mb-4">
                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="opcao" id="opcao1" value="alimento" checked>
                        <label class="form-check-label" for="opcao1">
                            Alimento
                        </label>
                    </div>

                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="opcao" id="opcao2" value="roupa">
                        <label class="form-check-label" for="opcao2">
                            Roupa
                        </label>
                    </div>

                </div>

                <!-- Campo para Subtipo de Doação -->
                <div class="mb-4">
                    <label class="form-label" for="subtipo">Subtipo de Doação:</label>
                    <input class="form-control" type="text" placeholder="Ex: arroz, feijão, calça, sapato..." name="subtipo" id="subtipo" required>
                </div>

                <!-- Botão de Submissão -->
                <div class="text-center">
                    <input class="btn btn-primary" type="submit" value="Salvar">
                </div>

            </form>
        </div>

        <div class="container ">
            <h2 class="text-center mb-4">Lista de Tipos de Doação Cadastrados</h2>

            <!--Barra de pesquisa-->
            <div class="caixa-procura">

                <form action="" method="get">
                    <input type="search" class="form-control" placeholder="digite aqui o tipo do produto ou seu nome" name="pesquisar" id="pesquisar">
                    <button class="btn btn-primary btn-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>

                </form>
            </div>

            <table class="table table-striped table-hover border">
                <thead>
                    <tr>
                        <th scope="col">Tipo de Doação</th>
                        <th scope="col">Nome</th>
                        <th colspan="2">Opçõs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($produto = mysqli_fetch_assoc($resultado_produto)) { ?>
                        <tr>
                            <td><?= $produto['tipo_produto']; ?></td>
                            <td><?= $produto['subtipo_produto']; ?></td>
                            <td> <a class="btn btn-sm btn-primary" href="form_alterar_produto.php?id_produto=<?= $produto['id_produto']; ?>">


                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                    </svg>
                                </a>

                                <a id="deleteButton" class="btn btn-sm btn-danger" data-id_usuario="<?= $produto['id_produto']; ?>">


                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>


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
                        window.location.href = "crud/excluir_produto.php?id_produto=" + idUsuario;
                    }
                });
            });
        });
    </script>

</body>

</html>