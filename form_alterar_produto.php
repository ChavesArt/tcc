<?php
require_once "conecta.php";
$conexao = conectar();

$id_produto = $_GET['id_produto'];

$sql_produto = "SELECT tipo_produto,subtipo_produto FROM produto WHERE id_produto= $id_produto";

$resultado_produto = mysqli_query($conexao, $sql_produto);
$produto = mysqli_fetch_assoc($resultado_produto);
$tipo_produto = $produto['tipo_produto'];
$subtipo_produto = $produto['subtipo_produto'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Alteração</title>
    <?php include "links.php"; ?>
</head>

<body>

    <div>
        <a class="btn btn-danger my-2" href="formtipo.php" style="left: 200000px;"> <img class="material-icons" style="color: white;" src="img/voltar.svg" alt="voltar"> Voltar</a>
    </div>

    <div style="padding: 50px;" class="container border my-5 border-dark rounded">
        <div class="row">
            <div class="col-12 text-center my-1">
                <h1>Formulário de Alteração</h1>
            </div>

            <div class="col-md-12">

                <div>
                    <div class="mb-3">
                        <form action="crud/alterar_produto.php" method="POST">

                            <label class="form-label" for="tipo_produto">Tipo do produto: <span class="text-muted">Coloque apenas um, nesse formato: 'alimento','roupa' ou 'outro' </span> </label>
                            <input class="form-control" type="text" name="tipo_produto" id="tipo_produto" value="<?= $tipo_produto; ?>"><br>

                            <label class="form-label" for="subtipo_produto">Subtipo do produto:</label>
                            <input class="form-control" type="text" name="subtipo_produto" id="subtipo_produto" value="<?= $subtipo_produto; ?>"><br>
                            <!-- id enviado escondido--><input type="hidden" name="id_produto" value="<?= $id_produto ?>">
                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Salvar">
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            </form>

        </div>


    </div>


</body>

</html>