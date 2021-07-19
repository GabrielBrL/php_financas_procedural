<?php
include "config/valida_cookies.inc";
$usuario = $_COOKIE["usuario"];
$tipo = $_POST["tipo"];
$descricao = $_POST["descricao"];
$mes = $_POST["mes"];
$ano = $_POST["ano"];
$valor = $_POST["valor"];
$valor = str_replace(",", ".", $valor);
$data = "$ano-$mes-01";

if($descricao == "nova")
    $nova_descricao = $_POST["descricao_nova"];
else
    $nova_descricao = $_POST["descricao_existente"];

include "config/conecta_banco.inc";
$res = $db->exec("INSERT INTO receitas_despesas (`usuario`, `descricao`, `tipo`, `data`, `valor`) VALUES 
('$usuario', '$nova_descricao', '$tipo', '$data', $valor)");
    echo "<html><body>";
    echo "<p align='center'>Inclusão realizada com sucesso!</p>";
    echo "<p align='center'><a href='incluir.php?tipo=$tipo'>Incluir outra</a></p>";
    echo "<p align='center'><a href='principal.php'>Voltar</a></p>";
    echo "</html></body>";
$db = null;
?>