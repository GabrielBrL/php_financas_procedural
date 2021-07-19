<?php

include "config/valida_cookies.inc";
$usuario = $_COOKIE["usuario"];
$tipo = $_GET["tipo"];
if($tipo == "RF")
    $titulo = "RECEITAS FIXAS";
elseif($tipo == "RV")
    $titulo = "RECEITAS VARIÁVEIS";
elseif($tipo == "DF")
    $titulo = "DESPESAS FIXAS";
elseif($tipo == "DV")
    $titulo = "DESPESAS VARIÁVEIS";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Controle de gastos mensais</title>
    <script lang="javascript">
        function valida_dados(formulario)
        {
            if(formulario.descricao_nova.value=="" && formulario.descricao[0].checked == true){
                alert("Você não digitou a descrição.");
                return false;
            }
            if(formulario.ano.value.length<4){
                alert("Digite o ano com quatro digitos.")
                return false;
            }
            if(formulario.valor.value==""){
                alert("Você não digitou o valor.");
                return false;
            }
        return true;
        }
    </script>
</head>
<body>
    <h1 align="center" class="mt-4">Controle de gastos mensais</h1>
    <p align="center">Inclusão de <b><?php echo $titulo; ?></b></p>
    <hr>
    <form action="gravar.php" method="post" name="formulario" onsubmit="return valida_dados(this)">
    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" checked>
    <p align="center">
    Descrição: <input type="radio" name="descricao" value="nova" checked>
    Nova: <input type="text" name="descricao_nova" size="20" onkeydown="javascript:formulario.descricao[0].checked=true">
    <input type="radio" name="descricao" value="existente"> Existente:
    <select name="descricao_existente" size="1" onchange="javascript:formulario.descricao[1].checked=true">
    <?php
        include "config/conecta_banco.inc";
        $res = $db->query("SELECT distinct(`descricao`) FROM receitas_despesas WHERE 
        `usuario`='$usuario' and `tipo`='$tipo' ORDER BY `descricao`");
        $registros = $res->fetchAll();
        $linhas = sizeof($registros);
        for($i = 0; $i < $linhas; $i++){
            $descricao = $registros[$i][0];
            echo "<option value='$descricao'>$descricao</option>";
        }
        $db = null;
    ?>
    </select>
    </p>
        <p align="center">Mês: <select name="mes" size="1">
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
        Ano: <input type="text" name="ano" size="4" maxlength="4" value="<?php echo date("Y", time()); ?>">
        </p>
        <p align="center">Valor: <input type="text" name="valor" size="10" maxlength="10"></p>
        <p align="center"><input type="submit" class="btn btn-success" value="Enviar" name="enviar">
        </p>
        <p align="center"><a href="principal.php" class="btn btn-secondary btn-sm">Voltar</a></p>
    </form>
    <hr>
</body>
</html>