<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
logar();


$sql = "SELECT * FROM pedido WHERE deferido IS null";
$resultado = mysqli_query($conexao, $sql);

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

    <section class="vh-25" style="background-color: #f4f5f7;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <!-- Ajustando as colunas para ocupar metade da largura da tela -->
          <div class="col-md-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem; height: 100%;"> <!-- Definindo altura do card -->
              <div class="row g-0">
                <!-- Coluna da imagem do usuário (40% da largura) -->
                <div class="col-md-4 gradient-custom text-center text-white"
                  style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                  <tr>
                    <td><img class="my-4" src='img/<?php echo $dadosUsuario['foto'] ?>' width='170px' height='170px'>
                    </td>
                  </tr>
                  <h5 class="text-dark"><?php echo $dadosUsuario['nome'] ?></h5>
                  <i class="far fa-edit mb-5"></i>
                </div>
                <!-- Coluna do conteúdo do pedido (60% da largura) -->
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
                        <p class="text-muted"> <?php echo  $dadosUsuario['telefone'] . "</p>"; ?>
                      </div>
                    </div>
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Endereço</h6>
                        <p class="text-muted"><?php echo $dadosUsuario['endereco'] ?> </p>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted"> <?php echo  $dadosUsuario['email'] . "</p>"; ?>
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

                        <form >
                          <input type="hidden" name="tipo_produto" value="<?php  //echo $pedido['kit'] ?>">
                          <label class="form-label" for="tipo">Qual produto deseja colocar no kit:</label>
                          <select name="produto"  onchange="preencherSelectDoEstoque(<?= $id_pedido ?>)"   id="selectProduto-<?= $id_pedido?>" class="form-select selectKits" required>
                            <option value="" selected disabled>Selecione um produto</option>

                            <?php
                            while ($kit = mysqli_fetch_assoc($resultado_kit)) {
                              echo "<option name = 'subtipo_produto' value='" . $kit['id_produto'] . "'>" . $kit['subtipo_produto'] . "</option>";
                            }
                            ?>
                          </select>
                        </form>

                        <div class="row pt-3">
                          <!-- Coluna de 4 unidades para o estoque -->
                          <div class="col-md-4">
                            <label for="estoque" class="form-label">Estoque</label>
                            <select name="estoque" id="selectEstoque-<?= $id_pedido ?>" class="form-select">
                              <option value="" selected disabled>Selecione um estoque</option>
                            </select>
                          </div>

                          <!-- Coluna de 3 unidades para a quantidade -->
                          <div class="col-md-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input name = "quantidade" type="number" id="quantidade-<?= $id_pedido ?>" class="form-control" min="0">
                          </div>

                          <!-- Coluna de 3 unidades para o botão -->
                          <div class="col-md-4 py-4">
                              <button type="submit" onclick="AdicionaLinha(<?= $id_pedido?>);" class="btn btn-danger ">
                                <i class="bi bi-clipboard-plus"></i>
                              </button>
                          </div>
                        </div>
                      </div>
                    </div>
                 <!-- Estrutura da Tabela com as classes do Bootstrap -->
                  <div class="container mt-5">
                    <table class="table table-striped table-bordered">
                      <thead class="table-dark">
                        <tr>
                          <th>Item</th>
                          <th>Estoque</th>
                          <th>Quantidade</th>
                          <th>Opções</th>
                        </tr>
                      </thead>
                      <tbody id="cesta_basica">
                        <!-- Os dados serão inseridos aqui -->
                      </tbody>
                    </table>
                  </div>

                    <!-- <div class="col-6 mb-3">
                      <h6>Ação</h6>
                      <form action="crud/deferir.php?resposta=sim&movimentacao=pedido&id_pedido=<?php echo $id_pedido; ?>"
                        method="POST">
                        <input type="hidden" name="tipo_doacao" value="<?php echo $pedido['tipo_doacao'] ?>">
                        <input type="hidden" name="subtipo_doacao" value="<?php echo $pedido['subtipo_doacao'] ?>">
                        <input type="hidden" name="quantidade" value="<?php echo $pedido['quantidade'] ?>">
                        <button class="btn btn-success mb-1">Deferir</button>
                      </form>
                      <form action="crud/deferir.php?resposta=nao&movimentacao=pedido&id_pedido=<?php echo $id_pedido; ?> "
                        method="POST">
                        <button class="btn btn-danger mb-1">Indeferir</button>
                      </form>
                      <a class="btn btn-primary" href="form-alterar-pedido.php?id_pedido=<?php echo $id_pedido; ?>">Alterar</a>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>

  <?php } ?>

  <script src="js/scripts.js"></script>

  </body>

  </html>