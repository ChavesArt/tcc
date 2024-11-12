<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
// logar();

/*
// Pega todos os IDs dos usuarios da tabela pedido
$sql = "SELECT id_usuario From pedido Where deferido IS NULL";
$resultado = mysqli_query($conexao, $sql);
$IDs = mysqli_fetch_assoc($resultado);

// Pega todos os detalhementos da tabela pedido
$sql_detalhamento = "SELECT detalhamento FROM pedido WHERE deferido IS NULL";
$resultado_detalhamento = mysqli_query($conexao,$sql_detalhamento);
$detalhamentos = mysqli_fetch_assoc($resultado_detalhamento);

// Pega todos os IDs da tabela pedido
$sql_id_pedido = "SELECT id_pedido FROM pedido WHERE deferido IS NULL";
$resultado_id_pedido = mysqli_query($conexao,$sql_id_pedido);
$IDs_pedido = mysqli_fetch_assoc($resultado_id_pedido);
*/
$sql ="SELECT * FROM entrada WHERE deferido IS null";
$resultado = mysqli_query($conexao,$sql);

while ($geral = mysqli_fetch_assoc($resultado)) {
  $detalhamento = $geral['detalhamento'];
  $sql_usuario = "SELECT * FROM usuario WHERE id_usuario = " . $geral['id_usuario'];
  $resultado_usuario = mysqli_query($conexao, $sql_usuario);
  $dados = mysqli_fetch_assoc($resultado_usuario);
  $date = date_create($geral['data_entrada']);
  $id_entrada = $geral['id_entrada'];
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entradas</title>
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
                  <h6>Data da entrada: <?php echo date_format($date,"H:i   d/m/Y"); ?></h6>
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
                    <h6>Pedido</h6>
                      <?php 
                      $detalhamento = explode("#",$detalhamento);
                      $total = count($detalhamento);
                      // echo $total;
                      // var_dump($detalhamento);die;
                      for($i = 0;$i < $total;$i++):
                        if($detalhamento[$i] == 'data de validade'){
                          $data = date_create($detalhamento[$i]);
                          date_format($data,"d:m:Y");
                        }
                        echo $detalhamento[$i] . "<br>";
                      endfor;
                       ?>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Ação</h6>
                      <form action="crud/deferir.php?resposta=sim&movimentacao=entrada&id_pedido=<?php echo $id_entrada; ?>" method="POST">
                      <button class="btn btn-success mb-1">Deferir</button>
                    </form>
                    <form action="crud/deferir.php?resposta=nao&movimentacao=entrada&id_pedido=<?php echo $id_entrada; ?>" method="POST">
                    <button class="btn btn-danger mb-1">Indeferir</button>
                    </form>
                    <a class="btn btn-primary" href="form-alterar-entrada.php?id_entrada=<?php echo $id_entrada; ?>">Alterar</a>
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