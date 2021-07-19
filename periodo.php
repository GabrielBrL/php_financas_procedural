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
    <p align="center">Escolha o período de visualização:</p>
    <hr>
    <form action="planilha.php" method="post">
        <p align="center">Mês: 
            <select name="mes" size="1">
                <option value="1">Jan</option>
                <option value="2">Fev</option>
                <option value="3">Mar</option>
                <option value="4">Abr</option>
                <option value="5">Mai</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Ago</option>
                <option value="9">Set</option>
                <option value="10">Out</option>
                <option value="11">Nov</option>
                <option value="12">Dez</option>
            </select>
        Ano: <input type="text" name="ano" size="4" maxlength="4" value="<?= date("Y", time()); ?>">
        </p>
        <p align="center">até</p>
        <p align="center">Mês: 
            <select name="mes2" size="1">
                <option value="1">Jan</option>
                <option value="2">Fev</option>
                <option value="3">Mar</option>
                <option value="4">Abr</option>
                <option value="5">Mai</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Ago</option>
                <option value="9">Set</option>
                <option value="10">Out</option>
                <option value="11">Nov</option>
                <option value="12">Dez</option>
            </select>
            Ano: <input type="text" name="ano2" size="4" maxlength="4" value="<?= date("Y", time()); ?>">
        </p>
    <p align="center">&nbsp;<input type="submit" value="Visualizar" class="btn btn-secondary" name="ok"></p>
    </form><hr>
    <p align="center"><a href="principal.php">Voltar</a></p>
</body>
</html>