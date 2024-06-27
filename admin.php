<?php 
include  "conecta.php";
$conexao = conectar();
$sql = "SELECT * FROM usuario";
$result = mysqli_query($conexao, $sql);
if ($result) {
    $usuarios = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página administrador</title>
    <?php include("links.php");?>
</head>
<body>
    <div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">Endereço</th>
            <th scope="col">Email</th>
            <th scope="col">telefone</th>
            <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
        <?php
          foreach ($usuarios as $usuario) {

            echo '<tr>';
            
            echo '<td>' . $usuario['nome'] . '</td>';
            echo "<td>" . $usuario['endereco'] . "</td>";
            echo '<td>' . $usuario['email'] . '</td>';
            echo "<td>" . $usuario['telefone'] . "</td>";
            echo '<td><a href="form-alterar.php?id_usuario=' .
            $usuario['id_usuario'] . '">Alterar</td>'; 
        echo '<td><a href="crud/excluir.php?id_usuario=' .
            $usuario['id_usuario'] . '">Excluir</td>';
    }
    echo '</tr>';

        ?>
           
  </tbody>
</table>
    </div>
    
</body>
</html>