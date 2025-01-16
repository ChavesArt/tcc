<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Recuperação de Senha</title>
    <?php include_once("links.php"); ?>
    <style>
               .small-popup {
            width: 500px !important;
            /* Ajuste a largura conforme necessário */
            font-size: 14px;
            /* Ajuste o tamanho da fonte */
        }
    </style>
</head>

<body>
    <main>
    <?php if (isset($_SESSION['recuperar_senha']) && $_SESSION['recuperar_senha'] == true) { ?>
            <script>
                Swal.fire({
                    position: "top-middle",
                    icon: "success",
                    title: "Verifique seu email!",
                    showConfirmButton: false,
                    timer: 2000,
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
    <!-- <div class="container border my-5 border-dark text-center">
        
    <h1>Formulário de Recuperação de senha
        </h1>
    <p>Digite o seu email para que você possa criar uma nova senha.<br>
    Será enviado um email com um link de recuperação que você
    usará para criar uma nova senha.<br></p>

    <form action="recuperar.php" method="post">
        <label for="email" class="form-label">Email:</label><br>
         <input class="form-control" id="email" type="email" name="email">
        <input type="submit" value="Enviar email de recuperação">
    </form>
    </div> -->

    <div style="margin-top:30%; padding: 90px;" class="container border my-5 border-dark rounded d-center m-auto">
        <div class="row">
            <div class="col-12 text-center my-1">
                <h1>Formulário de Recuperação de senha</h1>
                <p>Digite o seu email para que você possa criar uma nova senha.<br>
    Será enviado um email com um link de recuperação que você
    usará para criar uma nova senha.<br></p>
            </div>

            <div class="col-12">

                    <div>
                        <div class="mb-3">
                            <form action="recuperar.php" method="post">

                                <label class="form-label" for="email">Email:</label>
                                <input class="form-control" type="email" name="email" id="email"><br>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                <input class="btn btn-primary" type="submit" value="Salvar"><br>
                                </div>
                                </div>
                        </div>
                    </div>
            </form>

        </div>
    </div>
    </main>
</body>

</html>