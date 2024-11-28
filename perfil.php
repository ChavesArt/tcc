<?php
session_start();
include "conecta.php";
$conexao = conectar();
logar();
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$resultado = mysqli_query($conexao,$sql);
while ($geral = mysqli_fetch_assoc($resultado)) {
    $sql_usuario = "SELECT * FROM usuario WHERE id_usuario = " . $geral['id_usuario'];
    $resultado_usuario = mysqli_query($conexao, $sql_usuario);
    $dados = mysqli_fetch_assoc($resultado_usuario);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
 <?php include "links.php"; ?>
    <title>Perfil</title>
</head>

<body>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="img/<?php echo $geral['foto']; ?>"
                                    alt="Avatar" class="img-fluid my-5" style="width: 170px; border-radius: 100px" />
                                  <a class="btn btn-primary" href="form_trocar_foto.php">Trocar foto de perfil</a> 
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Informações </h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <h6>Email:</h6>
                                            <p class="text-muted"><?php echo $geral['email']; ?></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6>Nome:</s></h6>
                                            <p class="text-muted"><?php echo $geral['nome']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <h6>Endereço:</h6>
                                            <p class="text-muted"><?php echo $geral['endereco']; ?></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6>Telefone:</s></h6>
                                            <p class="text-muted"><?php echo $geral['telefone']; ?></p>
                                        </div>
                                    </div>

                                    <div class="row pt-1">
                                        <div class="col-md-12 mb-3">
                                            <h6>Senha:</h6>
                                            <p class="text-muted"><?php echo $geral['senha']; ?></p>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-md-6 mb-3">
                                            <a class="btn btn-primary" href="crud/excluir_usuario.php">Excluir perfil</a>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                        <a class="btn btn-primary" href="tela_update_usuario.php">Editar perfil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>