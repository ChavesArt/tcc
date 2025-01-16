<?php
session_start();
include "conecta.php";
$conexao = conectar();
$id_usuario = $_SESSION['id_usuario'];
logar();
if (empty($_GET['tabela'])) {
  $tabela = 'alimento';
} else {

  $tabela = $_GET['tabela'];
}
$sql = "SELECT p.subtipo_produto,p.tipo_produto,ie.quantidade,en.descricao,en.tamanho,en.deferido,en.id_entrada,en.id_usuario,en.data_entrada,e.data_validade 
FROM entrada en
INNER JOIN itens_entrada ie
ON en.id_entrada = ie.id_entrada
INNER JOIN estoque e
ON ie.id_estoque = e.id_estoque
INNER JOIN produto p
ON e.id_produto = p.id_produto
WHERE deferido IS NULL";
// var_dump($sql);die;
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


    <div style="left: 200px;">

      <a class="btn btn-danger my-2" href="admin_doacao.php?tabela=<?= $tabela; ?>"> <img class="material-icons" style="color: white;" src="img/voltar.svg" alt="voltar"> Voltar</a>

    </div>
</body>

</html>
<?php
while ($geral = mysqli_fetch_assoc($resultado)) {

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

    <?php if (isset($_SESSION['deferido']) && $_SESSION['deferido'] == true) { ?>
      <script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Entrada deferida com sucesso!",
          showConfirmButton: false,
          timer: 1500,
          customClass: {
            popup: 'small-popup' // Aplique uma classe CSS personalizada
          }
        });
      </script>
      <?php
      // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
      unset($_SESSION['deferido']);
      ?>
    <?php } ?>

    <?php if (isset($_SESSION['indeferido']) && $_SESSION['indeferido'] == true) { ?>
      <script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Entrada indeferida com sucesso!",
          showConfirmButton: false,
          timer: 1500,
          customClass: {
            popup: 'small-popup' // Aplique uma classe CSS personalizada
          }
        });
      </script>
      <?php
      // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
      unset($_SESSION['indeferido']);
      ?>
    <?php } ?>


    <?php if (isset($_SESSION['alteração_success']) && $_SESSION['alteração_success'] == true) { ?>
      <script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Alteração realizada com sucesso realizada com sucesso!",
          showConfirmButton: false,
          timer: 1500,
        });
      </script>
      <?php
      // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
      unset($_SESSION['alteração_success']);
      ?>
    <?php } ?>

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 d-flex justify-content-center"> <!-- Centraliza o card -->
          <div class="card mb-3" style="border-radius: .5rem; width: 800px;"> <!-- Mantém a largura de 800px -->
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <tr>
                  <td><img class="my-4" src='img/<?php echo $dados['foto'] ?>' width='170px' height='170px'></td>
                </tr>
                <h5 class="text-dark"><?php echo $dados['nome'] ?></h5>
                <i class="far fa-edit mb-5"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>Data da entrada: <?php echo date_format($date, "H:i   d/m/Y"); ?></h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Nome</h6>
                      <?php echo $dados['nome']; ?>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>telefone</h6>
                      <p class="text-muted"> <?php echo  $dados['telefone'] . "</p>"; ?>
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
                    </div>
                  </div>


                  <hr class="mt-0 mb-4">


                  <div class="row pt-1">
                    <div class="col-6 mb-4">
                      <h6>Entrada:</h6>
                      <?php
                      $date = date_create($geral['data_validade']);

                      echo "<b>Produto: </b>" . $geral['tipo_produto'] . "<br>";
                      echo "<b>Nome: </b>" . $geral['subtipo_produto'] . "<br>";
                      if ($geral['tipo_produto'] == 'alimento') {
                        echo "<b>Data de validade: </b>" . date_format($date, "d/m/Y") . "<br>";
                      }
                      echo "<b>Quantidade: </b>" . $geral['quantidade'] . "<br>";
                      if ($geral['tipo_produto'] != 'alimento') {
                        echo "<b>Tamanho: </b>" . $geral['tamanho'] . "<br>";
                      }
                      echo "<b>Descrição:</b> " . $geral['descricao'] . "<br>";
                      ?>
                    </div>

                    <div class="col-6 mb-2">

                      <h6>Ação</h6>


                      <form action="crud/deferir.php?resposta_aceita=sim&id_entrada=<?= $id_entrada; ?>" method="POST">
                        <button class="btn btn-success mb-1">Deferir</button>
                      </form>

                      <form action="crud/deferir.php?id_entrada=<?= $id_entrada; ?>" method="POST">
                        <button class="btn btn-danger mb-1">Indeferir</button>
                      </form>

                      <form action="form_alterar_entrada.php?id_entrada=<?= $id_entrada; ?>" method="POST">
                        <input type="hidden" name="tamanho" value="<?= $geral['tamanho'] ?>">
                        <input type="hidden" name="tipo_produto" value="<?= $geral['tipo_produto'] ?>">
                        <input type="hidden" name="subtipo_produto" value="<?= $geral['subtipo_produto'] ?>">
                        <input type="hidden" name="quantidade" value="<?= $geral['quantidade'] ?>">
                        <button class="btn btn-primary">Alterar</button>
                      </form>
                    </div>

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


  <?php if ($resultado->num_rows == 0) { ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Link do CSS do Bootstrap 5 -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
      <div class="container mt-5">
        <!-- Alerta de "Sem Entradas" -->
        <div class="alert alert-warning" role="alert">
          Não há mais entradas.
        </div>
      </div>

      <!-- Link do JS do Bootstrap 5 -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

  <?php } ?>



  </div>
  </body>

  </html>