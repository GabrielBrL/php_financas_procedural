<?php
include "config/valida_cookies.inc";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Controle de gastos mensais</title>
</head>
<body>
    <h1 align="center" class="mt-5">Controle de gastos mensais</h1>
    <p align="center">Usuário: <b><?php echo $_COOKIE["usuario"]; ?></b></p>
    <p align="center">Escolha a opção desejada:</p>
    <hr>
    <p align="center">
    <b>Incluir:</b><br>
    <a href="incluir.php?tipo=RF"><font size="4">Receitas fixas</font></a><br>
    <a href="incluir.php?tipo=RV"><font size="4">Receitas variável</font></a><br>
    <a href="incluir.php?tipo=DF"><font size="4">Despesas fixas</font></a><br>
    <a href="incluir.php?tipo=DV"><font size="4">Despesas variáveis</font></a><br>
    </p>
    <p align="center">
    <b>Visualizar:</b><br>
    <a href="periodo.php"><font size="4">Planilha de gastos mensais</font></a>
    </p>
    <p align="center">
    <b>Excluir:</b><br>
    <a href="excluir.php"><font size="4">Excluir receitas e despesas</font></a><br>
    </p>
    <hr>
    <p align="center"><a href="logout.php" class="btn btn-danger">Logout</a></p>
</body>
</html>