<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Sintético de Chapas</Title>
<Style>
	span.Titulo{font-family: verdana; font-size: 14; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	span{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}



	a{color:blue; text-decoration: none}
	a:hover{color:blue; text-decoration: underline}
</Style>
<?


	require("Funcoes/Conexao.php");

	function FormatarData($Data)
	{
		list ($dia, $mes, $ano) = split ('[/.-]', $Data);
		return "$ano-$mes-$dia";
	}


	function FormatarDataTelaCachorro($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}


	if (isset($_POST["DTInicio"]))
	{
		$DTInicio = $_POST["DTInicio"];
		$DTTermino = $_POST["DTTermino"];

		$DTInicio2 = FormatarData($_POST["DTInicio"]);
		$DTTermino2 = FormatarData($_POST["DTTermino"]);
	}
	else
	{
		$AnoDefault = date("Y");
		$AnoDefault--;

		$DTInicio = "01/01/". $AnoDefault;
		$DTTermino = "01/01/". date("Y");
	
		$DTInicio2 = $AnoDefault . "-01-01";
		$DTTermino2 = date("Y") . "-01-01";
	}	
?>

<Form name="Formulario" Method="POST">
        <table align="center" class="SemBorda">
	<td colspan=2>Data Início Chapa: <input type="text" size="12" Name="DTInicio" value="<?echo($DTInicio);?>">
	Data Término  Chapa: <input type="text" size="12" Name="DTTermino" value="<?echo($DTTermino);?>"></td>
          </tr>
          <tr> 
            <td colspan="2" align="center"><input type="submit" value="Pesquisar"></td>
          </tr>
        </table>
  </Form>

<?
	$DaNascimentoInicio = date("Y") - 1 ."-". date("m") ."-". date("d");
	//Data que serve como parâmetro para a pesquisa dos cães com mais de 12 meses sem chapa

	$sql = "select * from TBRaioX Order By NORaioX";
	$sql_result = mysql_query($sql,$Conn);
	$i = 1;
	while ($row = mysql_fetch_array($sql_result))
	{
		$Linha[$i] = $row["NoRaioX"];
		$i++;
	}	

//	$sql2 = "Select c.IdCachorro, c.NoCachorro, b.NoRaioX, Count(a.IdRaioX) as Total from (TBCachorro as a inner Join TBRaioX as b On a.IdRaioX = b.IdRaioX) inner join TBCachorro as c On a.IDCachorroPai = c.IDCachorro Where a.DaRaioX Is Not Null Group By a.IDCachorroPai, a.IdRaioX Order By c.NoCachorro, b.NoRaioX Asc";


	$sql2 = "Select c.IdCachorro, c.NoCachorro, b.NoRaioX, Count(a.IdRaioX) as Total from (TBCachorro as a inner Join TBRaioX as b On a.IdRaioX = b.IdRaioX) inner join TBCachorro as c On a.IDCachorroPai = c.IDCachorro Where (a.DaRaioX Between '$DTInicio2' and '$DTTermino2') and a.DaRaioX Is Not Null Group By a.IDCachorroPai, a.IdRaioX union select a.idcachorropai, b.nocachorro, 'ZZ' as NoRaioX, Count(a.idcachorropai) as Total from tbcachorro as a inner join tbcachorro as b on a.IdCachorroPai = b.IdCachorro where (a.nuregistronacional like 'e/%') or (a.nuregistronacional like 'sbcpa%') and (a.idraiox is null or a.idraiox = 0) and a.danascimento < '$DaNascimentoInicio' group by b.nocachorro, a.idcachorropai Order By NoCachorro, NoRaioX Asc";
	//die($sql2);

	$sql_result2 = mysql_query($sql2,$Conn);
	$L = 0;
	$LL = 0;
	while ($row2 = mysql_fetch_array($sql_result2))
	{
		$Tabela[0][$L] = $row2["NoCachorro"];
		$Tabela[1][$L] = $row2["NoRaioX"];
		$Tabela[2][$L] = $row2["Total"];
		
			$cont = $L - 1;
			if ($cont >= 0)
			{
				if ($Tabela[0][$cont] != $Tabela[0][$L])
				{$LL++;}
			}
		$Tabela[3][$L] = $LL;

		$Coluna = "";
		for($d=1; $d<$i; $d++)
		{
			if ($Linha[$d] == $row2["NoRaioX"])
			{
				$Coluna = $d;
			}
		}
				
		$Table[0][$LL] = $row2["NoCachorro"];
		
		if (!isset($Table[1][$LL])){$Table[1][$LL] = "0";}
		if (!isset($Table[2][$LL])){$Table[2][$LL] = "0";}
		if (!isset($Table[3][$LL])){$Table[3][$LL] = "0";}
		if (!isset($Table[4][$LL])){$Table[4][$LL] = "0";}
		if (!isset($Table[5][$LL])){$Table[5][$LL] = "0";}
		if (!isset($Table[6][$LL])){$Table[6][$LL] = "0";}
				
		//if ($row2["NoRaioX"] == "A"){$Coluna = 1;}
		
		if ($row2["NoRaioX"] == "NO"){$Coluna = 1;}
		if ($row2["NoRaioX"] == "QN"){$Coluna = 2;}
		if ($row2["NoRaioX"] == "AP"){$Coluna = 3;}
		if ($row2["NoRaioX"] == "DM"){$Coluna = 4;}
		if ($row2["NoRaioX"] == "DG"){$Coluna = 5;}
		if ($row2["NoRaioX"] == "ZZ"){$Coluna = 6;}

		$Table[$Coluna][$LL] = $row2["Total"];
		
		$L++;
	}		
	
	$sqldel = "Delete From tbraioxtemp";
	$sqldel_result = mysql_query($sqldel,$Conn);

	for($ii=0; $ii<$LL; $ii++)
	{
		$sqlins = "insert into tbraioxtemp (NOAnimal,QTRaioX1,QTRaioX2,QTRaioX3,QTRaioX4,QTRaioX5,QTSemRaioX) values ('". $Table[0][$ii] ."',". $Table[1][$ii] .",". $Table[2][$ii] .",". $Table[3][$ii] .",". $Table[4][$ii] .",". $Table[5][$ii] .",". $Table[6][$ii] .")";
		$sqlins_result = mysql_query($sqlins,$Conn);
		/*		
		echo("<tr>");
		echo("<td>". $Table[0][$ii] ."</td>");
		echo("<td>". $Table[1][$ii] ."</td>");
		echo("<td>". $Table[2][$ii] ."</td>");
		echo("<td>". $Table[3][$ii] ."</td>");
		echo("<td>". $Table[4][$ii] ."</td>");
		echo("<td>". $Table[5][$ii] ."</td>");
		echo("<td>". $Table[6][$ii] ."</td>");		
		echo("</tr>");
		*/
	}
	
	$Ordem = "QTSemRaioX";
	if (isset($_GET["Ordem"]))
	{$Ordem = $_GET["Ordem"];}
	
	
	$sql = "select NOAnimal, QTRaioX1, QTRaioX2, QTRaioX3, QTRaioX4, QTRaioX5, QTRaioX6, (QTRaioX1 + QTRaioX2 + QTRaioX3 + QTRaioX4 + QTRaioX5 + QTRaioX6) as Total, QTSemRaioX  from tbraioxtemp Order By $Ordem DESC";
	$sql_result = mysql_query($sql,$Conn);
	
	echo("<center><span class=Titulo>Relatório sintético de chapas </span><br><br>");
	echo("<span>* Cachorros com mais de 12 meses, nascidos antes de ". FormatarDataTelaCachorro($DaNascimentoInicio) . "</span><br><br>");
	echo("<table border=0>");
	echo("<tr class=Titulo>");
	echo("<td><a href=javascript:Ordenar('NoAnimal')>Animal</a></td>");
	echo("<td width=40 align=center><a href=javascript:Ordenar('QTRaioX1')>N</a></td>");
	echo("<td width=40 align=center><a href=javascript:Ordenar('QTRaioX2')>QN</a></td>");
	echo("<td width=40 align=center><a href=javascript:Ordenar('QTRaioX3')>AP</a></td>");
	echo("<td width=40 align=center><a href=javascript:Ordenar('QTRaioX4')>DM</a></td>");
	echo("<td width=40 align=center><a href=javascript:Ordenar('QTRaioX5')>DG</a></td>");
	echo("<td width=40><a href=javascript:Ordenar('Total')>Total</a></td>");
	echo("<td><a href=javascript:Ordenar('QTSemRaioX')>Sem Chapa</a>*</td>");
	echo("</tr>");

	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr>");
		echo("<td><a href='Cachorro_Formulario.php?Nome=$row[NOAnimal]'  Target='new'>$row[NOAnimal]</a></td>");
		echo("<td align=center>$row[QTRaioX1]</td>");
		echo("<td align=center>$row[QTRaioX2]</td>");
		echo("<td align=center>$row[QTRaioX3]</td>");
		echo("<td align=center>$row[QTRaioX4]</td>");
		echo("<td align=center>$row[QTRaioX5]</td>");
		echo("<td align=center>$row[Total]</td>");		
		echo("<td align=center>$row[QTSemRaioX]</td>");
		echo("</tr>");
	}		
	echo("</table>");	
?>
<Script>
function Ordenar(campo)
{
	document.Formulario.action = '?Ordem='+campo;
	document.Formulario.submit();
}
</Script>