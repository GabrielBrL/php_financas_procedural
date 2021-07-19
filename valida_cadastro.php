<?php

$usuario = $_POST["usuario_cadastro"];
$senha = $_POST["senha_cadastro"];
$senha_confirmar = $_POST["senha_cadastro_confirmar"];

if(strlen($usuario) <= 5){
    echo"<html><body>";
    echo"<p align='center'>O minímo de caracteres para o USUÁRIO é de 5.</p>";
    echo"<p align='center'><a href='cadastro_usuario.php'>Voltar</a></p>";
    echo"</body></html>";
    exit;
}
if(strlen($senha) == 0){
    echo"<html><body>";
    echo"<p align='center'>Campo SENHA vazia.</p>";
    echo"<p align='center'><a href='cadastro_usuario.php'>Voltar</a></p>";
    echo"</body></html>";
    exit;
}
if(strlen($senha) <= 8){
    echo"<html><body>";
    echo"<p align='center'>O minímo de caracteres para a SENHA é de 8.</p>";
    echo"<p align='center'><a href='cadastro_usuario.php'>Voltar</a></p>";
    echo"</body></html>";
    exit;
}
if($senha != $senha_confirmar){
    echo"<html><body>";
    echo"<p align='center'>SENHAS não conferem!!</p>";
    echo"<p align='center'><a href='cadastro_usuario.php'>Voltar</a></p>";
    echo"</body></html>";
    exit;
}

include "config/conecta_banco.inc";

$res = $db->exec("INSERT INTO usuarios_autorizados VALUE ('$usuario', '$senha')");
echo "<html><body>";
echo "<p align='center'>Cadastro realizado com sucesso!</p>";
echo "<p align='center'><a href='index.php'>Login</a></p>";
echo "</html></body>";
$db = null;
?>
