<?php
include 'config/valida_cookies.inc';

if(!isset($_POST["email"]))
{
    $data = $_GET["data"];
    echo "<html><body>";
    echo "<form method=\"POST\" action=\"gera_email.php\">";
    echo "<input type=\"hidden\" name=\"data\" value=\"$data\">";
    echo "Seu e-mail: <input type=\"text\" name=\"email\" size=\"30\">";
    echo " <input type=\"submit\" name=\"enviar\" value=\"Enviar\">";
    echo "</form>";
    echo "</body></html>";
}
else
{
    $email_destino = $_POST["email"];

    if (strlen($email_destino)<8 || substr_count($email_destino, "@")!=1  || substr_count($email_destino, ".")==0)
	   echo "O e-mail digitado é inválido! ";
    else
    {
        $usuario = $_COOKIE["usuario"];
        $data = $_POST["data"];
        $meses = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];

		$aux = explode("-",$data);
		$mes = $aux[0];
		$ano = $aux[1];
        $mes = array_search($mes, $meses)+1;
        $data_buscar = "$ano-$mes-01";

        include "config/conecta_banco.inc";
        $res = $db->query("SELECT `descricao`,`valor` from receitas_despesas where `usuario`='$usuario' and `data`='$data_buscar' and (`tipo`='DF' or `tipo`='DV') order by `descricao`");
		$registros=$res->fetchAll();
		$num_linhas = sizeof($registros);

        for($i=0 ; $i<$num_linhas; $i++)
        {
            $descricoes[] = $registros[$i][0];
            $valores[] = $registros[$i][1];
        }
        $db=null;

        $total = 0;
        $num_linhas = sizeof($descricoes);
        for($i=0 ; $i<$num_linhas; $i++)
            $total += $valores[$i];

        $msg = "Lista de despesas - $data<br>";
        for($i=0 ; $i<$num_linhas; $i++)
        {
            $descricao = $descricoes[$i];
            $valor = $valores[$i];
            $msg .= "$descricao - R\$$valor<br>";
        }

        $msg .= "\nTotal de despesas: R\$$total";

        $email = "contato@".$usuario.".com";

        include '../financas_pdo/mail_mailer/mensagem.inc';
        // mail($email, "Despesas de $data", $msg, "From:contato@gabriel.com", "-r gabriel@teste.com");
        // echo "As despesas de $data foram enviadas para o e-mail especificado.";
    }
}
?>
