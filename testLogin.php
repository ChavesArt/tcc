<?php
session_start();
// verifica se alguém enviou algum form
if (!empty($_POST['email']) and !empty($_POST['senha'])) {
    include('conecta.php');
    // conecta com o banco
    $conecta = conectar();
    // recebe as váriaveis do form
    $email = $_POST['email'];
    $senha = $_POST['senha'];
// Procura no banco para ver se existe o email e senha
    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conecta, $sql);
    // Pega o usuário do banco
    $dado = mysqli_fetch_assoc($result);
    //pega o nome
    $dado['nome'];
    // o tipo 
    $tipo = $dado['tipo_cliente'];
    $nome = $dado['nome'];
// se não existe alguém já cadastrado no banco 
    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['nome']);
        header('Location:login.php');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $nome;
        if($tipo == 0){
            // se for o admin
            header("location:admin.php");
            die();
        }
        // se for usuário
        header('location:index.php');
        die();
    }
    // se não foi enviado nada por form
} else {
    header('location:login.php');
}
