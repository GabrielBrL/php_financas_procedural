<?php
if(isset($_COOKIE["usuario"]))
    $usuario = $_COOKIE["usuario"];
if(isset($_COOKIE["senha"]))
    $senha = $_COOKIE["senha"];
if(!(empty($usuario) OR empty($senha))){
    include "conecta_banco.inc";
    $res = $db->query("SELECT * FROM `usuarios_autorizados` WHERE `usuario`='$usuario' and `senha`='$senha'");
    if(sizeof($res->fetchAll()) == 0){
        setcookie("usuario");
        setcookie("senha");
        echo "Você não efetuou o LOGIN!";
        exit;
    }
}

else{
    echo "Você não efetuou o LOGIN!";
    exit;
}

$db = null;
?>