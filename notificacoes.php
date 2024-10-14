<?php 
session_start();
include_once ("conecta.php");
$conexao = conectar();
// logar();
$sql = "SELECT * FROM pedido ORDER BY id_pedido ASC";
$resultado = mysqli_query($conexao,$sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <?php include "links.php";?>
</head>
<body>
    <div style="margin-top: 5%;" class="container text-center">
        <div class="row">
            <div class="col-12">
                <h1>Notificações</h1>
            </div>

        <div style="margin-top: 6%;" class="col-12">
            <h2>Pedidos</h2>
        </div>

        <div class="col-12">
            <table class="table table-striped table-hover border border-dark  ">
            <thead>
            <tr>
                <th scope="col">Pessoa</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Pedido de doação</th>
                <th scope="col" >Opções</th>
                
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>João</td>
                <td>1 Kg</td>
                <td>Arroz</td>
                <td><button class="btn btn-primary" type="button">Aprovar</button>
                <button class="btn btn-danger" type="button">Recusar</button></td>


            </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>

    
</body>
</html>