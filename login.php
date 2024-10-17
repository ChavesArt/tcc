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
    <div style="margin-top: 9%;" class="container border border-dark rounded">
        <div class="row">
            <div class="col-md-12 text-center pt-2">
                <h1>Login</h1>
            </div>

            <div class="col-xs-6 col-lg-6">
                <img src="img/login-animate.svg" alt="Uma mulher colocando seu login">
            </div>

            <div class="col-xs-6 col-lg-6">
            <div  class="mb-3 bg-light">
                        <form style="margin-top: 20%;" action="testLogin.php" method="post">

                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" ><br>

                            <label class="form-label" for="senha">Senha:</label>
                            <input class="form-control" type="password" name="senha" id="senha" ><br>

                            <a href="form_recuperar_senha.php">Esqueceu a senha?</a>

                            <div style="padding-right: 15px; padding-left:15px;" class="col-12 ">
                                <div class="row">
                                    <input  class="btn btn-primary my-2" type="submit" value="Salvar">
                                </div>
                            </div>

                            <div class="col-12 text-center">
                            <p>Ainda não é cadastrado?<a href="formcad.php">Cadastre-se</a></p>
                            </div>
                    </div>

            </div>
        </div>
    </div>

    </main>
    <!-- <div class="main-form">
        <div class="esquerda-form">
            <h1>logue-se para melhor aproveitamento do site:</h1>
            <img src="img/login-animate.svg" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form">
            <div class="card-form">
                <h1>Login</h1>
                <form action="testLogin.php" method="post">
                    <div class="campo-texto">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="usuario" placeholder="Email">

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha">
                        <a href="form_recuperar_senha.php">Esqueceu a senha?</a>
                        
                        <input type ="submit" value="Login">
                    </form>
                <p>Ainda não é cadastrado?<a href="formcad.php">Cadastre-se</a></p>
            </div>
        </div>
    </div> -->
</body>

</html>