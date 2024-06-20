<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>

    <?php include('links.php');?>

</head>
<body>

<?php include('menu.php');?>

<main id="main-form">
    <div>
<section class="area-login">
    <div calss="login">
        <div >
        <img src="furia_logo.png">
        </div>

        <form action="" method="post">
           <label for="nome">Nome</label> 
           <input type="text" name="nome" id="nome" placeholder="nome de usuário">
           <label for="senha">Senha</label> 
           <input type="password" name="senha" id="senha" placeholder="senha">
            <input type="submit" value="Entrar">
        </form>
        <p>Ainda não tem uma conta?<a href="formcad.php">Criar uma conta</a></p>
    </div>
</section>
</div>
</main>
















<!--<main id="#tela_login">
    <form>  
     <div class="form-floating mb-3">
        <input type="text" class="form-control" id="login" placeholder="Digite seu nome">
        <label for="floatingInput">Nome</label>
    </div>

    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="senha" placeholder="Digite seu nome">
        <label for="floatingInput">senha</label>
    </div>

        <button type="submit" class="btn btn-primary mb-3"  onclick ="logar()">Enviar </button>

    </form>

</div>
<script>
    function logar(){
        var login = document.getElementById("login").value;
        var senha = document.getElementById("senha").value;

        if(login == "admin" && senha == "admin"){
            alert('Você foi direcionado para tela do administrador');
        }
        else{
            alert('Você foi direcionado para tela do usuário');
        }

    }
</script>
</main>-->
</body>
</html>