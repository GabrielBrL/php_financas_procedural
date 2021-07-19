<html>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
<h2 align="center">Exclusão de registros</h2>
<?php
include 'config/valida_cookies.inc';
$usuario = $_COOKIE["usuario"];
$id = $_GET["id"];

include "conecta_banco.inc";
$res = $db->exec("DELETE from receitas_despesas where `usuario`='$usuario' and `id`='$id'");
$db=null;
?>
<p align="center">Exclusão realizada!</p>
<p align="center"><a href="excluir.php">Excluir outra</a> -
<a href="principal.php">Voltar</a></p>
</body>
</html>
