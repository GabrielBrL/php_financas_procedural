<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cadastro</title>
    <script>
        function valida_cadastro(form){
            if(form.usuario_cadastro.value <= 5){
                alert("O minímo de caracteres para o USUÁRIO é de 5.");
                return false;
            }
            if(form.senha_cadastro.value == 0){
                alert("Campo SENHA vazia");
                return false;
            }
            if(form.senha_cadastro.value <= 8){
                alert("O minímo de caracteres para a SENHA é de 8.");
                return false;
            }
            if(form.senha_cadastro.value != form.senha_cadastro_confirmar.value){
                alert("SENHAS não conferem!!");
                return false;
            }
        return true;
        }
    </script>
</head>
<body>
    <h1 align="center" class="mt-4">Cadastramento</h1>
    <hr>
    <form action="valida_cadastro.php" method="post" onsubmit="return valida_cadastro(this)">
        <p align="center">Usuário: <input type="text" name="usuario_cadastro" size="20"></p>
        <p align="center">Senha: <input type="password" name="senha_cadastro"></p>
        <p align="center">Confirmar senha: <input type="password" name="senha_cadastro_confirmar"></p>
        <p align="center"><input type="submit" name="cadastro" class="btn btn-success" value="Cadastrar"></p>
    </form>
    <hr>
    <p align="center"><a href="index.php">Login</a></p>
</body>
</html>

