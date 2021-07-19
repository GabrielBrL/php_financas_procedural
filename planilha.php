<?php
include "config/valida_cookies.inc";
$meses = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];
$usuario = $_COOKIE["usuario"];

$mes = $_POST["mes"];
$ano = $_POST["ano"];
$mes2 = $_POST["mes2"];
$ano2 = $_POST["ano2"];

$data = "$ano-$mes-01";
$data2 = "$ano2-$mes2-01";
$array_datas = $RF = $RV = $DF = $DV = array();

include "config/conecta_banco.inc";
$res = $db->query("SELECT `descricao`,`tipo`,`data`,`valor` FROM receitas_despesas 
WHERE usuario='$usuario' and `data`>='$data' and `data`<='$data2' order by `data`,`descricao`");
$registros=$res->fetchAll();
$linhas = sizeof($registros);

if($linhas==0)
{
    echo "Não há receitas e despesas no período escolhido!";
    exit;
}
else
{
    for($i=0; $i<$linhas; $i++)
    {
        $descricao = $registros[$i][0];
        $tipo = $registros[$i][1];
        $data = $registros[$i][2];
        $valor = $registros[$i][3];
        
		$aux = explode("-",$data);
		$ano = $aux[0];
		$mes = $aux[1];
		$dia = $aux[2];
        $numero_mes = $mes-1;
        $data = $meses[$numero_mes] . "-" . $ano;
        
        if (!in_array($data, $array_datas))
            $array_datas[] = $data;

        if($tipo=="RF")
        {
            if (!in_array($descricao, $RF))
                $RF[]=$descricao;
            $receitas_fixas[$descricao][$data]= $valor;
            if(isset($total_receitas[$data]))
                $total_receitas[$data] += $valor;
            else
                $total_receitas[$data] = $valor;
        }
        elseif($tipo=="RV")
        {
            if (!in_array($descricao, $RV))
                $RV[]=$descricao;
            $receitas_variaveis[$descricao][$data]= $valor;
            if(isset($total_receitas[$data]))
                $total_receitas[$data] += $valor;
            else
                $total_receitas[$data] = $valor;
        }
        elseif($tipo=="DF")
        {
            if (!in_array($descricao, $DF))
                $DF[]=$descricao;
            $despesas_fixas[$descricao][$data]= $valor;
            if(isset($total_despesas[$data]))
                $total_despesas[$data] += $valor;
            else
                $total_despesas[$data] = $valor;
        }
        elseif($tipo=="DV")
        {
            if (!in_array($descricao, $DV))
                $DV[]=$descricao;
            $despesas_variaveis[$descricao][$data]= $valor;
            if(isset($total_despesas[$data]))
                $total_despesas[$data] += $valor;
            else
                $total_despesas[$data] = $valor;
        }
    }
}

$db=null;

$numero_colunas = sizeof($array_datas);
$colunas_html = $numero_colunas+1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Controle de gastos mensais</title>
</head>
<body>
    <h1 align="center" class="mt-3">Controle de gastos mensais</h1>
    <div align="center">
    <center>
    <table border="1" cellspacing="0">
        <tr>
        <td width="142"></td>

        <?php
            foreach($array_datas as $data)
                echo "<td align=\"center\" width=\"100\"><b><font color=\"#000080\">$data</font></b></td>";
        ?>

        </tr>
        <tr>
        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5"><b>RECEITAS FIXAS</b></td>
        </tr>

        <?php
        for($i=0; $i<sizeof($RF); $i++)
        {
            $descricao = $RF[$i];
            echo "<tr><td width=\"142\">$descricao</td>";

            for($j=0; $j<$numero_colunas; $j++)
            {
                $data = $array_datas[$j];
                if(isset($receitas_fixas[$descricao][$data]))
                {
                    $valor = $receitas_fixas[$descricao][$data];
                    echo "<td align=\"center\" width=\"100\">$valor</td>";
                }
                else
                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
            }
            echo "</tr>";
        }
        ?>

        <tr>
        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5"><b>RECEITAS VARIÁVEIS</b></td>
        </tr>

        <?php
        for($i=0; $i<sizeof($RV); $i++)
        {
            $descricao = $RV[$i];
            echo "<tr><td width=\"142\">$descricao</td>";

            for($j=0; $j<$numero_colunas; $j++)
            {
                $data = $array_datas[$j];
                if(isset($receitas_variaveis[$descricao][$data]))
                {
                    $valor = $receitas_variaveis[$descricao][$data];
                    echo "<td align=\"center\" width=\"100\">$valor</td>";
                }
                else
                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
            }
            echo "</tr>";
        }
        ?>

        <tr>
        <td width="142" bgcolor="#D7FFFF"><b>Total Receitas:</b></td>

        <?php
            foreach($array_datas as $data)
            {
                if(isset($total_receitas[$data]))
                    $total = $total_receitas[$data];
                else
                    $total = 0;
                echo "<td align=\"center\" bgcolor=\"#D7FFFF\" width=\"100\"><b>$total</b></td>";
            }
        ?>

        </tr>

        <tr>
        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5"><b>DESPESAS FIXAS</b></td>
        </tr>

        <?php
        for($i=0; $i<sizeof($DF); $i++)
        {
            $descricao = $DF[$i];
            echo "<tr><td width=\"142\">$descricao</td>";

            for($j=0; $j<$numero_colunas; $j++)
            {
                $data = $array_datas[$j];
                if(isset($despesas_fixas[$descricao][$data]))
                {
                    $valor = $despesas_fixas[$descricao][$data];
                    echo "<td align=\"center\" width=\"100\">$valor</td>";
                }
                else
                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
            }
            echo "</tr>";
        }
        ?>

        <tr>
        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5"><b>DESPESAS VARIÁVEIS</b></td>
        </tr>

        <?php
        for($i=0; $i<sizeof($DV); $i++)
        {
            $descricao = $DV[$i];
            echo "<tr><td width=\"142\">$descricao</td>";

            for($j=0; $j<$numero_colunas; $j++)
            {
                $data = $array_datas[$j];
                if(isset($despesas_variaveis[$descricao][$data]))
                {
                    $valor = $despesas_variaveis[$descricao][$data];
                    echo "<td align=\"center\" width=\"100\">$valor</td>";
                }
                else
                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
            }
            echo "</tr>";
        }
        ?>


        <tr>
        <td width="142" bgcolor="#FFE1E1"><b>Total Despesas:</b></td>

        <?php
            foreach($array_datas as $data)
            {
                if(isset($total_despesas[$data]))
                    $total = $total_despesas[$data];
                else
                    $total = 0;
                echo "<td align=\"center\" bgcolor=\"#FFE1E1\" width=\"100\"><b>$total</b></td>";
            }
        ?>

        </tr>

        <tr>
        <td width="142"><b>GRÁFICO DESPESAS</b></td>
        <?php
            foreach($array_datas as $data)
            {
                if(isset($total_despesas[$data]))
                    echo "<td align=\"center\" width=\"100\"><a href=\"gera_grafico.php?data=$data\"><img src=\"fotos/grafico.gif\" border=\"0\"></a></td>";
                else
                    echo "<td align=\"center\" width=\"100\">-</td>";
            }
        ?>
        </tr>

        <tr>
        <td width="142"><b>E-MAIL DESPESAS</b></td>
        <?php
            foreach($array_datas as $data)
            {
                if(isset($total_despesas[$data]))
                    echo "<td align=\"center\" width=\"100\"><a href=\"gera_email.php?data=$data\"><img src=\"fotos/email.gif\" border=\"0\"></a></td>";
                else
                    echo "<td align=\"center\" width=\"100\">-</td>";
            }
        ?>
        </tr>


        <tr>
        <td width="142" bgcolor="#CCFFCC"><b>SALDO</b></td>

        <?php
            foreach($array_datas as $data)
            {
                $saldo=0;
                if(isset($total_receitas[$data]))
                    $saldo += $total_receitas[$data];
                if(isset($total_despesas[$data]))
                    $saldo -= $total_despesas[$data];

                if($saldo<0)
                    $cor = "#FF0000";
                else
                    $cor = "#0000FF";

                echo "<td align=\"center\" bgcolor=\"#CCFFCC\" width=\"100\"><font color=\"$cor\"><b>$saldo</b></font></td>";
            }
        ?>


        </tr>


    </table>
    </center>
    </div>
    <p align="center"><a href="principal.php">Voltar</a></p>
    
</body>
</html>