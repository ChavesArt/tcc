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

    <main >
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
                            <input class="form-control" type="text" name="nome" id="nome" pattern="^[A-Za-zÀ-ÿ]+$" required><br>

                            <label class="form-label" for="endereco">Endereço:</label>
                            <input class="form-control" type="text" name="endereco" id="endereco" required><br>

                            <label class="form-label" for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" required><br>

                            <label class="form-label" for="senha">Senha:</label>
                            <input class="form-control" placeholder="Deve conter: 1 número maiúscula, 1 minúscula, 1 caracter especial" type="password" name="senha" id="senha" required><br>

                            <label class="form-label" for="senha">Confirmar senha:</label>
                            <input class="form-control" type="password" name="senha" id="senha" required><br>

                            <label class="form-label" for="telefone">Telefone:</label>
                            <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Formato: XX-X XXXX-XXXX" required><br>

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
   
    <!-- <div class="main-form">
        <div class="esquerda-form">
            <h1>Cadastre-se já:</h1>
            <img src="img/formcad.png" class="esquerda-img" alt="Um homem dando alimento para outro">
        </div>
        <div class="direita-form">
            <div class="card-form">
                <h1>Cadastre-se</h1>
                <form action="crud/cadastrar.php" method="post">
                    <div class="campo-texto">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="nome" id="usuario" placeholder="Usuário" required>

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                        
                        <label for="email">email</label>
                        <input type="email" name="email" id="email" placeholder="Email" required>

                        <label for="senha">endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Digite no formato " required>

                        <label for="telefone">telefone</label>
                        <input type="text" name="telefone" id="telefone" placeholder="Digite no seguinte formato XXX.XXX.XXX-XX" required>
 
                        <input type ="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </div> 
    </div> -->
</body>

</html>