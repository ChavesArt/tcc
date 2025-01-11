<?php
session_start();
$pastaDestino = "/img/";
include "../conecta.php";
// var_dump($_FILES);die;
// verificar se o tamanho do arquivo é maior que 2 MB
if ($_FILES['foto']['size'] > 2000000) {  // condição de guarda 👮
    echo "O tamanho do arquivo é maior que o limite permitido. Limite máximo: 2 MB.";
    die();
}

// verificar se o arquivo é uma imagem
$extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

if (
    $extensao != "png" && $extensao != "jpg" &&
    $extensao != "jpeg" && $extensao != "gif" &&
    $extensao != "jfif" && $extensao != "svg"
) { // condição de guarda 👮
    echo "O arquivo não é uma imagem! Apenas selecione arquivos 
    com extensão png, jpg, jpeg, gif, jfif ou svg.";
    die();
}

// verificar se é uma imagem de fato
if (getimagesize($_FILES['foto']['tmp_name']) === false) {
    echo "Problemas ao enviar a imagem. Tente novamente.";
    die();
}

$nomeArquivo = uniqid();

// se deu tudo certo até aqui, faz o upload
$fezUpload = move_uploaded_file(
    $_FILES['foto']['tmp_name'],
     "../" . $pastaDestino . $nomeArquivo . "." . $extensao
);
// var_dump($fezUpload);die;

if ($fezUpload == true) {
    $conexao = conectar();

    // se for uma alteração de arquivo
    $id_usuario = $_SESSION['id_usuario'];
    $novoArquivo = $_POST['nome_arquivo'];
    if ($novoArquivo != "user.png") {
        $apagou = unlink(__DIR__ . $pastaDestino . $_POST['nome_arquivo']);
    }
    $sql = "UPDATE  usuario  SET  foto = '$nomeArquivo.$extensao'  WHERE id_usuario = $id_usuario ";
    $resultado2 = mysqli_query($conexao, $sql);
    // var_dump($sql);die;
    if ($resultado2 == false) {
        echo "Erro ao alterar o arquivo do banco de dados.";
        die();
    }
}
header("Location: ../perfil.php");
