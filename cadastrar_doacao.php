<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Doações</title>
</head>
<body>

        <form action="salvar_doacao.php" method="post">
            
            Nome:<input type="text" name = "nome"> <br>                                            
            Quantidade<input type="number" name = "quantidade"> <br>                                            
            Descrição<input type="text" name = "descricao"> <br>                                            
            Data de validade<input type="date" name = "data_validade"> <br>                                            
            Tamanho<input type="text" name = "tamanho"> <br>                                            
            
            <input type="submit" value="Enviar">
            
            
        </form>
</body>
</html>