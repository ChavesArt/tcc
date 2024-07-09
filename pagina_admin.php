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
    <title>Página Inicial</title>
</head>

<body>
    <a href="formcad.php">Cadastrar</a> <a href= "login.php"> Entrar</a>

    <table>
        <thead>
            <tr>
                <th>usuario</th>
                <th>endereço</th>
                <th>email</th>
                <th>senha</th>
                <th>tipo_cliente</th>
                <th>telefone</th>
                <th colspan="2">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
          foreach ($usuarios as $usuario) {

            echo '<tr>';
            
            echo '<td>' . $usuario['nome'] . '</td>';
            echo "<td>" . $usuario['endereco'] . "</td>";
            echo '<td>' . $usuario['email'] . '</td>';
            echo "<td>" . $usuario['senha'] . "</td>";
            echo '<td>' . $usuario['telefone'] . '</td>';
            echo '<td><a href="form-alterar.php?id_usuario=' .
                $usuario['id_usuario'] . '">Alterar</td>'; 
            echo '<td><a href="crud/excluir.php?id_usuario=' .
                $usuario['id_usuario'] . '">Excluir</td>';
        }
        echo '</tr>';

            ?>
        </tbody>
    </table>
</body>

</html>