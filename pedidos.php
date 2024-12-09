<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
logar();


$sql = "SELECT * FROM pedido WHERE deferido IS null";
$resultadoPedido = mysqli_query($conexao, $sql);

while ($pedido = mysqli_fetch_assoc($resultadoPedido)) {
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
          <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
              <div class="row g-0">
                <div class="col-md-4 gradient-custom text-center text-white"
                  style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                  <tr>
                    <td><img class="my-4" src='img/<?php echo $dadosUsuarioUsuario['foto'] ?>' width='170px' height='170px'></td>
                  </tr>
                  <h5 class="text-dark"><?php echo $dadosUsuarioUsuario['nome'] ?></h5>
                  <i class="far fa-edit mb-5"></i>

                </div>
                <div class="col-md-8">
                  <div class="card-body p-4">
                    <h6>Data do pedido: <?php echo date_format($date, "H:i   d/m/Y"); ?></h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Nome</h6>
                        <?php echo $dadosUsuarioUsuario['nome']; ?>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>telefone</h6>
                        <p class="text-muted"> <?php echo  $dadosUsuarioUsuario['telefone'] . "</p>"; ?>
                        <p class="text-muted"> <?php //echo "<a href='alterar.php?arquivo=$arq'>Alterar</a> </p>";
                                                ?>
                      </div>
                    </div>
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>Endereço</h6>
                        <p class="text-muted"><?php echo $dadosUsuarioUsuario['endereco'] ?> </p>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted"> <?php echo  $dadosUsuarioUsuario['email'] . "</p>"; ?>
                        <p class="text-muted"> <?php //echo "<a href='alterar.php?arquivo=$arq'>Alterar</a> </p>";
                                                ?>
                      </div>
                    </div>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                      <div class="col-6 mb-3">
                        <h6>pedido:</h6>

                        <!-- Kit: <strong> <?php //echo $pedido['kit']; ?></strong> -->
                        
                        <p>Item:</p>
                        <?php

                        if($pedido['kit'] == 'kit_roupa'){
                        
                          $sql = "SELECT * FROM produto WHERE tipo_produto ='roupa' ORDER BY subtipo_produto ASC";
                        }
                        $resultado = mysqli_query($conexao, $sql);



                        ?>

                          <?php
                                while ($info = mysqli_fetch_assoc($resultado)) {
                                    echo "<option value=" . $info['id_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                                }
                                ?>

                        <label class="form-label" for="tipo">qual o tipo de roupa:</label>
                        <select name="alimentos" id="tipo" class="form-select" required>

                          <?php
                          while ($info = mysqli_fetch_assoc($resultado)) {
                            echo "<option value=" . $info['subtipo_produto'] . ">" . $info['subtipo_produto'] . "</option>";
                          }
                          ?>
                        </select>






























                        $date = date_create($pedido['data_validade']);
                        // exibe o tipo do produto 'alimento'
                        echo"<b>Produto: </b>" . $pedido['tipo_doacao'] . "<br>";
                        // exibe o subtipo do produto 'casaco'
                        echo"<b>Nome: </b>" . $pedido['subtipo_doacao'] . "<br>";
                        // exibe data de validade se for alimento
                        if($pedido['subtipo_doacao'] == 'alimento'){echo"<b>Data de validade: </b>" . date_format($date,"d/m/Y") . "<br>";}
                        // exibe a quantidade entregada
                        echo"<b>Quantidade: </b>" . $pedido['quantidade'] . "<br>";
                        // exibe o tamanho ser for roupa
                        if($pedido['tipo_doacao'] !='alimento'){echo"<b>Tamanho: </b>" . $pedido['tamanho'] . "<br>";}
                        // exibe a descrição
                        echo"<b>Descrição:</b> " . $pedido['descricao'] . "<br>";
                        ?>
                      </div>
                      <div class="col-6 mb-3">
                        <h6>Ação</h6>
                        <form action="crud/deferir.php?resposta=sim&movimentacao=pedido&id_pedido=<?php echo $id_pedido; ?>" method="POST">
                          <!-- botão de deferir pega todas essas informações -->
                          <input type="hidden" name="tipo_doacao" value="<?php echo $pedido['tipo_doacao'] ?>">
                          <input type="hidden" name="subtipo_doacao" value="<?php echo $pedido['subtipo_doacao'] ?>">
                          <input type="hidden" name="subtipo_doacao" value="<?php echo $pedido['quantidade'] ?>">
                          <button class="btn btn-success mb-1">Deferir</button>
                        </form>
                        <form action="crud/deferir.php?resposta=nao&movimentacao=pedido&id_pedido=<?php echo $id_pedido; ?>" method="POST">
                          <!-- botão de indeferir pega todas essas informações -->
                          <button class="btn btn-danger mb-1">Indeferir</button>
                        </form>
                        <!-- botão de alterar -->
                        <a class="btn btn-primary" href="form-alterar-pedido.php?id_pedido=<?php echo $id_pedido; ?>">Alterar</a>
                      </div>
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
  </body>

  </html>