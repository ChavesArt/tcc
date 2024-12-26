<?php
session_start();
include "conecta.php";
$conexao = conectar();
if (!$_SESSION['email']) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Recebimento</title>

    <?php include('links.php'); ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

    <style>
        .btn-outline-purple {
            color: #6f42c1;
            /* Cor roxa para o texto */
            border-color: #6f42c1;
            /* Cor roxa para a borda */
        }

        .btn-outline-purple:hover {
            color: #fff;
            /* Cor do texto em branco quando o botão é hover */
            background-color: #6f42c1;
            /* Cor de fundo roxa quando hover */
            border-color: #6f42c1;
            /* Mantém a borda roxa no hover */
        }

        .btn-outline-purple:focus,
        .btn-outline-purple.focus {
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.5);
            /* Sombras com a cor roxa quando o botão recebe foco */
        }
        .small-popup {
            width: 500px !important; /* Ajuste a largura conforme necessário */
             font-size: 14px;         /* Ajuste o tamanho da fonte */
        }
    </style>
    
</head>

<body>
    <?php include_once('menu.php'); ?>

    
<?php if (isset($_SESSION['receber_success']) && $_SESSION['receber_success'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-middle",
            icon: "success",
            title: "Seu pedido foi recebido com sucesso!",
            showConfirmButton: false,
            timer: 1500,
            customClass: {
            popup: 'small-popup'  // Aplique uma classe CSS personalizada
  }
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['receber_success']);
    ?>
<?php } ?>


    <main>
        <div style="margin-top: 10%;" class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <h1>Bem-vindo</h1>
                </div>

                <div class="col-md-6">
                    <img class="img-fluid" src="img/receber.svg" alt="formulário de doações">
                </div>

                <div class="col-md-6">
                    <form action="crud/receber.php" method="post" class="m-4 p-4 border rounded-3 shadow-lg bg-light">
                        <!-- Seção do select e input de quantidade lado a lado -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Qual o kit de cesta básica você deseja receber?</h4>
                            </div>
                            <!-- Campo checkbox para o tipo de kit -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="tipo">Qual o tipo de kit?</label>
                                <div>
                                    <input type="checkbox" name="alimento" id="kit_alimento" value="alimento">
                                    <label for="kit_alimento">Kit de alimento</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="roupa" id="kit_roupa" value="roupa">
                                    <label for="kit_roupa">Kit de roupa</label>
                                </div>
                            </div>

                            <!-- Campos de Quantidade lado a lado -->
                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="quantidade_alimento">Quantidade de alimento:</label>
                                <input class="form-control" type="number" name="quantidade_alimento" id="quantidade_alimento" min="1" placeholder="Informe a quantidade desejada">
                            </div>

                            <div class="mb-3 col-md-3">
                                <label class="form-label" for="quantidade_roupa">Quantidade de roupa:</label>
                                <input class="form-control" type="number" name="quantidade_roupa" id="quantidade_roupa" min="1" placeholder="Informe a quantidade desejada">
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary px-4 py-2" type="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>