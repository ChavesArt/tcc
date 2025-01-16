<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
logar();
if(empty($_GET['tabela'])){
  $tabela = 'alimento';
}else{

  $tabela = $_GET['tabela'];

}
$sql = "SELECT * FROM pedido WHERE deferido IS null";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <section class="vh-25" style="background-color: #f4f5f7;">
  
  <div  style="left: 200px;" >
    
  <a class="btn btn-danger my-2" href="admin_doacao.php?tabela=<?= $tabela; ?>"> <img class="material-icons" style="color: white;" src="img/voltar.svg" alt="voltar"> Voltar</a>
  
</div>
</body>
</html>
<?php
while ($pedido = mysqli_fetch_assoc($resultado)) {
  $sql_usuario = "SELECT * FROM usuario WHERE id_usuario = " . $pedido['id_usuario'];
  $resultado_usuario = mysqli_query($conexao, $sql_usuario);
  $dadosUsuario = mysqli_fetch_assoc($resultado_usuario);
  $date = date_create($pedido['data_pedido']);
  $id_pedido = $pedido['id_pedido'];
?>

  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pedidos</title>
    <?php include "links.php"; ?>
  </head>

  <body>
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem; height: 100%;">
              <div class="row g-0">
                <!-- Coluna da imagem do usuário -->
                <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                  <img class="my-4" src='img/<?php echo $dadosUsuario['foto'] ?>' width='170px' height='170px'>
                  <h5 class="text-dark"><?php echo $dadosUsuario['nome'] ?></h5>
                  <i class="far fa-edit mb-5"></i>
                </div>
                <!-- Coluna do conteúdo do pedido -->
                <div class="col-md-8">
                  <div class="card-body p-4">
                    <h6>Data do pedido: <?php echo date_format($date, "H:i   d/m/Y"); ?></h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Nome</h6>
                        <?php echo $dadosUsuario['nome']; ?>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Telefone</h6>
                        <p class="text-muted"><?php echo  $dadosUsuario['telefone'] . "</p>"; ?>
                      </div>
                    </div>
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Endereço</h6>
                        <p class="text-muted"><?php echo $dadosUsuario['endereco'] ?> </p>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted"><?php echo  $dadosUsuario['email'] . "</p>"; ?>
                      </div>
                    </div>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-12 mb-3">
                        <h6>Pedido:</h6>
                        <?php
                        $sql_kit = "SELECT * FROM produto WHERE tipo_produto ='" .  $pedido['kit'] . "' ORDER BY subtipo_produto ASC";
                        $resultado_kit = mysqli_query($conexao, $sql_kit);
                        ?>
                        <form>
                          <label class="form-label" for="tipo">Qual produto deseja colocar no kit:</label>
                          <select name="produto" onchange="preencherSelectDoEstoque(<?= $id_pedido ?>)" id="selectProduto-<?= $id_pedido ?>" class="form-select selectKits" required>
                            <option value="" selected disabled>Selecione um produto</option>
                            <?php
                            while ($kit = mysqli_fetch_assoc($resultado_kit)) {
                              echo "<option name='subtipo_produto' value='" . $kit['id_produto'] . "'>" . $kit['subtipo_produto'] . "</option>";
                            }
                            ?>
                          </select>
                        </form>

                        <div class="row pt-3">
                          <div class="col-md-4">
                            <label for="estoque" class="form-label">Estoque</label>
                            <select name="estoque" id="selectEstoque-<?= $id_pedido ?>" class="form-select">
                              <option value="" selected disabled>Selecione um estoque</option>
                            </select>
                          </div>

                          <div class="col-md-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input name="quantidade" type="number" id="quantidade-<?= $id_pedido ?>" class="form-control" min="0">
                          </div>

                          <div class="col-md-4 py-4">
                            <button type="submit" onclick="AdicionaLinha(<?= $id_pedido ?>,event);" class="btn btn-danger ">
                              <i class="bi bi-clipboard-plus"></i>
                            </button>
                          </div>

                          <div class="col-md-12 py-4">
                            <a href="crud/indeferir_pedido.php?id_pedido=<?= $id_pedido?>" class="btn btn-danger">Indeferir</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Tabela de Itens -->
                    <div class="container mt-5" id="formTabela">
                      <div id="tabela-wrapper">
                        <table class="table table-striped table-bordered" id="tabela-<?php echo $id_pedido; ?>" style="display:none;">
                          <thead class="table-dark" id="tabela-cabecalho-<?php echo $id_pedido; ?>" style="display:none;">
                            <tr>
                              <th>Item</th>
                              <th>Estoque</th>
                              <th>Quantidade</th>
                              <th>Opções</th>
                            </tr>
                          </thead>
                          <tbody id="cesta_basica-<?php echo $id_pedido; ?>">
                            <!-- Os dados serão inseridos aqui -->
                          </tbody>
                        </table>
                      </div>
                      <button class="btn btn-primary mt-3" id="submitBtn-<?php echo $id_pedido; ?>" style="display:none;" onclick="cadastrar_itens_saida(event,<?= $id_pedido; ?>);">Enviar</button>
                    </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php } ?>
    </section>

 

  <?php if($resultado->num_rows == 0){?>
    <!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensagem - Sem Entradas</title>
  <!-- Link do CSS do Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <!-- Alerta de "Sem Entradas" -->
    <div class="alert alert-warning" role="alert">
      Não há mais pedidos.
    </div>
  </div>

  <!-- Link do JS do Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

  <?php } ?>

  <script src="js/scripts.js"></script>
  </div>
  </body>

  </html>