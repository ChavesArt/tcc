<?php
session_start();
if (!empty($_POST['email']) and !empty($_POST['senha'])) {
    include('conecta.php');
    $conecta = conectar();
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conecta, $sql);
    $dado = mysqli_fetch_assoc($result);
    $dado['nome'];
    $tipo = $dado['tipo_cliente'];
    $nome = $dado['nome'];

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
            header("admin.php");
            die();
        }
        header('Location:index.php');
    }
} else {
    header('location:login.php');
}
