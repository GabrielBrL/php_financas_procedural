<?php

if(!isset($_COOKIE["usuario"]) AND !isset($_COOKIE["senha"])){
    header("Location: cadastro_usuario.php");
}

if(isset($_COOKIE["usuario"]) AND isset($_COOKIE["senha"])){
    header("Location: principal.php");
}

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

include "config/conecta_banco.inc";


$res = $db->query("SELECT * FROM `usuarios_autorizados` WHERE `usuario`='$usuario' and `senha`='$senha'");
$linhas = sizeof($res->fetchAll());
if($linhas == 0){
    echo "<html><body>";
    echo "<p align='center'>O login não foi realizado, dados inválidos.</p>";
    echo "<p align='center'><a href='index.php'>Voltar</a></p>";
    echo "</html></body>";
}

else{
    setcookie("usuario", $usuario);
    setcookie("senha", $senha);
    header("Location:principal.php");
}

$db = null;

?>