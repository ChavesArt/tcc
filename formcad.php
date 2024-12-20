<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>

    <?php include('links.php'); ?>


</head>

<body>
    <?php include_once('menu.php'); ?>

    <main>

        <?php if (isset($_SESSION['cadastrar_success']) && $_SESSION['cadastrar_success'] == false) { ?>
            <script>
                Swal.fire({
                    position: "top-middle",
                    icon: "danger",
                    title: "Houve um erro ao se cadastrar!",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'small-popup' // Aplique uma classe CSS personalizada
                    }
                });
            </script>
            <?php
            // Apagar a variável de sessão para evitar que o alerta apareça novamente após a próxima atualização da página
            unset($_SESSION['login_success']);
            ?>
        <?php } ?>

        <div style="margin-top:9%;padding-right:50px;" class="container border border-dark rounded">
            <div class="row">

                <div class="col-md-12 text-center">
                    <h1>Formulário de cadastro</h1>
                </div>

                <div class="col-md-6 col-lg-6">
                    <img class="img-fluid" src="img/formcad.png" alt="Homem de rua recebendo alimento">
                </div>

                <div class="col-md-6 col-xs-12 pl-1">

                    <div class="mb-3">
                        <form action="crud/cadastrar.php" method="post">

                            <label class="form-label" for="nome">Nome:</label>
                            <input class="form-control" type="text" name="nome" id="nome" pattern="^[A-Za-zÀ-ÿ\s]+$" required><br>

                            <label class="form-label" for="endereco">Endereço:</label>
                            <input class="form-control" type="text" name="endereco" id="endereco" required><br>

                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" required><br>

                            <label class="form-label" for="telefone">Telefone:</label>
                            <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Formato: XX-X XXXX-XXXX" pattern="^\d{2}-\d \d{4}-\d{4}$" required><br>

                            <label class="form-label" for="senha">Senha:</label>
                            <input class="form-control" placeholder="Deve conter: 1 número maiúscula, 1 minúscula, 1 caracter especial" type="password" name="senha" id="senha" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[\W_]).+$" required><br>

                            <label class="form-label" for="senha_confirm">Confirmar senha:</label>
                            <input class="form-control" type="password" name="senha_confirm" id="senha_confirm" required><br>

                            <!-- Mensagem de erro se as senhas não coincidirem -->
                            <span id="error-message" style="color: red; display: none;">As senhas não coincidem!</span>

                            <div class="col-12">
                                <div class="row">
                                    <input class="btn btn-primary my-2" type="submit" value="Salvar">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
    // Função para verificar se as senhas coincidem
    document.getElementById("senha_confirm").addEventListener("input", function() {
        var senha = document.getElementById("senha").value;
        var senhaConfirm = document.getElementById("senha_confirm").value;
        var errorMessage = document.getElementById("error-message");

        if (senha !== senhaConfirm) {
            // Exibe a mensagem de erro caso as senhas não coincidam
            errorMessage.style.display = "block";
        } else {
            // Esconde a mensagem de erro caso as senhas coincidam
            errorMessage.style.display = "none";
        }
    });
</script>

</body>

</html>