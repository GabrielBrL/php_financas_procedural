<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Controle gastos</title>
</head>
<body>
    <h1 align="center" class="mt-4">Controle de Gastos</h1>
    <p align="center">Digite seus dados de identificação para acessar o sistema:</p>
    <hr>
    <form action="login.php" method="post">
        <p align="center">Usuario: <input type="text" name="usuario" size="20"></p>
        <p align="center">Senha: <input type="password" name="senha" size="20"></p>
        <p align="center"><input type="submit" class="btn btn-primary" value="Enviar" name="enviar"></p>
    </form>
    <hr>
    <p align="center"><a href="cadastro_usuario.php">Não possui cadastro</a></p>
</body>
</html>