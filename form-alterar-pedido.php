<?php
//recebendo o id da tabela
$id = $_GET['id_pedido'];

//conectando com o banco
require_once "conecta.php";
$conexao = conectar();
$sql = "SELECT * FROM pedido WHERE id_pedido = $id";
$result = mysqli_query($conexao, $sql);

if ($result) {
    $pedido = mysqli_fetch_assoc($result);
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
    die();
}
$detalhamento = explode("#",$pedido['detalhamento']);
$total = count($pedido);

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

    <div style="padding: 50px;" class="container border my-5 border-dark rounded">
        <div class="row">
            <div class="col-12 text-center my-1">
                <h1>Pedido</h1>
            </div>

            <div class="col-md-12">

                <div>
                    <div class="mb-3">
                        <form action="crud/alterar-pedido.php" method="post">

                            <label class="form-label" for="pedido">Pedido:</label>
                            <input class="form-control" type="text" name="pedido" id="pedido" value="<?php echo  $detalhamento[0]; ?>"><br>

                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="text" name="quantidade" id="quantidade" value="<?php echo  $detalhamento[1]; ?>"><br>

                            <label class="form-label" for="descri">Descrição:</label>
                            <input class="form-control" type="text" name="descri" id="descri" value="<?php echo  $detalhamento[2]; ?>"><br>
                            <!-- id enviado escondido--><input type="hidden" name="id_pedido" value="<?php echo  $pedido['id_pedido']; ?>">

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
        <div class="text-center">
                                
             <a class="btn btn-danger my-2" href="#"> <img class="material-icons" style="color: white;" src="img/voltar.svg" alt="voltar"> Voltar</a>
   
        </div>
   
    </div>


</body>

</html>