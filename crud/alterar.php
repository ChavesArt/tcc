<?php
//conectando com o banco
include "conecta.php";
$conexao = conectar();

//recebendo as variáveis
$id = $_POST['id_usuario'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];

//comando SQL
$sql = "UPDATE usuario SET nome='$nome', endereco='$endereco', email='$email',senha='$senha',telefone='$telefone' WHERE id_usuario=$id";
$result = mysqli_query($conexao, $sql);

//redirecionando para o index.php
if ($result) {
    header("Location: pagina_admin.php");
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}
?>