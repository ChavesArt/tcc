<?php
require_once "conecta.php";
$conexao = conectar();

$id_entrada = $_GET['id_entrada'];
$tamanho = $_POST['tamanho'];
$subtipo_produto = $_POST['subtipo_produto'];
$tipo_produto = $_POST['tipo_produto'];
$quantidade = $_POST['quantidade'];

if($tipo_produto != 'roupa'){

    $data_validade = $_POST['data_validade'];

}else{
    $data_validade = 'null';
}
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
                <h1>Formulário de Alteração</h1>
            </div>

            <div class="col-md-12">

                <div>
                    <div class="mb-3">
                        <form action="crud/alterar-entrada.php" method="POST">

                            <label class="form-label" for="tipo_produto">Tipo do produto: <span class="text-muted">Coloque apenas um, nesse formato: 'alimento','roupa' ou 'outro' </span> </label>
                            <input class="form-control" type="text" name="tipo_produto" id="tipo_produto" value="<?= $tipo_produto; ?>"><br>
                            
                            <label class="form-label" for="subtipo_produto">Subtipo do produto:</label>
                            <input class="form-control" type="text" name="subtipo_produto" id="subtipo_produto" value="<?= $subtipo_produto; ?>"><br>
                            
                            <label class="form-label" for="quantidade">Quantidade:</label>
                            <input class="form-control" type="text" name="quantidade" id="quantidade" value="<?= $quantidade; ?>"><br>
                            
                            <?php if($data_validade != 'null'){ ?>
                            
                                <label class="form-label" for="data_validade">Data de validade:</label>
                                <input class="form-control" type="text" name="data_validade" id="data_validade" value="<?= $data_validade ?>"><br>
                        
                                <?php } ?>                           
                            <label class="form-label" for="tamanho">Tamanho:</label>
                            <input class="form-control" type="text" name="tamanho" id="tamanho" value="<?= $tamanho; ?>"><br>
                            <!-- id enviado escondido--><input type="hidden" name="id_entrada" value="<?=  $id_entrada ?>">
                            <!-- data_validade roupa--><?php if($tipo_produto == 'roupa'){?> 
                                <input type='hidden' name='data_validade' value="<?= $data_validade;?>">
                                <?php }?>
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