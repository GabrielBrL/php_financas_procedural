<html>
<body>
<h2 align="center">Exclusão de registros</h2>
<?php
include 'config/valida_cookies.inc';
$usuario = $_COOKIE["usuario"];
$meses = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];


include "config/conecta_banco.inc";
$res = $db->query("SELECT `id`,`descricao`,`data`,`valor` from receitas_despesas where `usuario`='$usuario' order by `data` desc");
$registros=$res->fetchAll();
$num_linhas = sizeof($registros);

for($i=0 ; $i<$num_linhas; $i++)
{
    $id = $registros[$i][0];
    $descricao = $registros[$i][1];
    $data = $registros[$i][2];
    $valor = $registros[$i][3];
	$aux = explode("-",$data);
	$ano = $aux[0];
	$mes = $aux[1];
	$dia = $aux[2];
    $nome_mes = $meses[$mes-1];

    echo "$nome_mes/$ano - $descricao (R\$$valor) ";
    echo "<a href=\"elimina.php?id=$id\">Excluir</a><br>";
}
$db=null;
?>
</body>
</html>
