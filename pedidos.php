<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
// logar();


// while ($i = 1;$i>10){
// // Pega todos os IDs dos usuarios da tabela pedido
// $sql = "SELECT id_usuario From pedido Where deferido IS NULL";
// $resultado = mysqli_query($conexao, $sql);
// $IDs = mysqli_fetch_assoc($resultado);

// // Pega todos os detalhementos da tabela pedido
// $sql_detalhamento = "SELECT detalhamento FROM pedido WHERE deferido IS NULL";
// $resultado_detalhamento = mysqli_query($conexao,$sql_detalhamento);
// $detalhamentos = mysqli_fetch_assoc($resultado_detalhamento);

// // Pega todos os IDs da tabela pedido
// $sql_id_pedido = "SELECT id_pedido FROM pedido WHERE deferido IS NULL";
// $resultado_id_pedido = mysqli_query($conexao,$sql_id_pedido);
// $IDs_pedido = mysqli_fetch_assoc($resultado_id_pedido);
// }

$sql ="SELECT * FROM pedido WHERE deferido IS null";
$resultado = mysqli_query($conexao,$sql);

while ($geral = mysqli_fetch_assoc($resultado)) {
  $sql_usuario = "SELECT * FROM usuario WHERE id_usuario = " . $geral['id_usuario'];
  $resultado_usuario = mysqli_query($conexao, $sql_usuario);
  $dados = mysqli_fetch_assoc($resultado_usuario);
  $date = date_create($geral['data_pedido']);
  $id_pedido = $geral['id_pedido'];
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

  <section  class="vh-25" style="background-color: #f4f5f7;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
          <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

                  <tr><td><img class="my-4" src='img/<?php echo $dados['foto'] ?>' width='170px' height='170px'></td></tr>
                  <h5 class="text-dark"><?php echo $dados['nome'] ?></h5>
                  <i class="far fa-edit mb-5"></i>

              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>Data do pedido: <?php echo date_format($date,"H:i   d/m/Y"); ?></h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Nome</h6>
                      <?php echo $dados['nome'];?>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>telefone</h6>
                      <p class="text-muted"> <?php echo  $dados['telefone'] . "</p>"; ?>
                      <p class="text-muted"> <?php //echo "<a href='alterar.php?arquivo=$arq'>Alterar</a> </p>";?>
                    </div>
                  </div>
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                  <h6>Endereço</h6>
                  <p class="text-muted"><?php echo $dados['endereco'] ?> </p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"> <?php echo  $dados['email'] . "</p>"; ?>
                    <p class="text-muted"> <?php //echo "<a href='alterar.php?arquivo=$arq'>Alterar</a> </p>";?>
                  </div>
                  </div>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                    <h6>pedido:</h6>
                    <?php 
                    $date = date_create($geral['data_validade']);
                    // exibe o tipo do produto 'alimento'
                     echo"<b>Produto: </b>" . $geral['tipo_doacao'] . "<br>";
                    //  exibe o subtipo do produto 'casaco'
                     echo"<b>Nome: </b>" . $geral['subtipo_doacao'] . "<br>";
                    //  exibe data de validade se for alimento
                     if($geral['subtipo_doacao'] == 'alimento'){echo"<b>Data de validade: </b>" . date_format($date,"d/m/Y") . "<br>";}
                    //  exibe a quantidade entregada
                     echo"<b>Quantidade: </b>" . $geral['quantidade'] . "<br>";
                    //  exibe o tamanho ser for roupa
                     if($geral['tipo_doacao'] !='alimento'){echo"<b>Tamanho: </b>" . $geral['tamanho'] . "<br>";}
                    //  exibe a descrição
                     echo"<b>Descrição:</b> " . $geral['descricao'] . "<br>";
                       ?>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Ação</h6>
                      <form action="crud/deferir.php?resposta=sim&movimentacao=pedido&id_pedido=<?php echo $id_pedido; ?>" method="POST">
                        <!-- botão de deferir pega todas essas informações -->
                        <input type="hidden" name="tipo_doacao" value="<?php echo $geral['tipo_doacao'] ?>">
                        <input type="hidden" name="subtipo_doacao" value ="<?php echo $geral['subtipo_doacao'] ?>">
                        <input type="hidden" name="subtipo_doacao" value ="<?php echo $geral['quantidade'] ?>">
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