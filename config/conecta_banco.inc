<?php
$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "Gabriel3456";
$banco = "financas";

$db = new PDO("mysql:host=$servidor;dbname=$banco", $usuario_bd, $senha_bd);

?>