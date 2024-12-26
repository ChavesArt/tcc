<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">

<?php if (isset($_SESSION['formtipo_sucess']) && $_SESSION['formtipo_sucess'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "O tipo de doação foi cadastrado com sucesso!",
            showConfirmButton: false,
            timer: 1500,
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['formtipo_sucess']);
    ?>
<?php } ?>

<?php if (isset($_SESSION['ja_existe']) && $_SESSION['ja_existe'] == true) { ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "O produto que você colocou já existe!",
            showConfirmButton: false,
            timer: 1500,
        });
    </script>
    <?php
    // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
    unset($_SESSION['ja_existe']);
    ?>
<?php } ?>

    <main style="margin-top: 10%;" class="d-flex align-items-start justify-content-center vh-95">
        <div class="bg-white p-4 rounded shadow-sm w-95" style="max-width: 500px;">
            <h1 class="text-center mb-4">Formulário de Cadastro do Tipo da Doação</h1>
            <form action="tipo_produto.php" method="post">

                <h3 class="text-center mb-3">Tipo de Doação:</h3>

                <!-- Radio Buttons em Linha -->
                <div class="d-flex justify-content-center mb-4">
                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="opcao" id="opcao1" value="alimento" checked>
                        <label class="form-check-label" for="opcao1">
                            Alimento
                        </label>
                    </div>

                    <div class="form-check me-4">
                        <input class="form-check-input" type="radio" name="opcao" id="opcao2" value="roupa">
                        <label class="form-check-label" for="opcao2">
                            Roupa
                        </label>
                    </div>

                </div>

                <!-- Campo para Subtipo de Doação -->
                <div class="mb-4">
                    <label class="form-label" for="senha">Subtipo de Doação:</label>
                    <input class="form-control" type="text" placeholder="Ex: Arroz, feijão, calça, sapato, copo, TV..." name="subtipo" id="senha" required>
                </div>

                <!-- Botão de Submissão -->
                <div class="text-center">
                    <input class="btn btn-primary" type="submit" value="Salvar">
                </div>

            </form>
        </div>
    </main>

</body>

</html>