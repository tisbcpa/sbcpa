<?
 $menu = "false";
 require("Estilo/Estilo.php");
 require("Funcoes/Clube.php");
 ?>
<Title>Registros Por UF</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>

<?
	$AnoFinal = date("Y");
	 
	if (isset($_GET["NrAno"]))
	{
		$Ano = $_GET["NrAno"];
	}
	else
	{
		$Ano =  $AnoFinal;
	}
?>

<Form name="Formulario">
	<table align="center">
		<tr class="Normal">
			<td>Selecione o Ano:</td>
			<td>
			<select name="NrAno" onChange="document.Formulario.submit()">
			<?
				for($i=$AnoFinal; $i>=1960; $i--)
				{
					echo("<option value=$i>$i</option>");
				}
			?>
			</select>
			</td>
		</tr>
	</table>
	<script>
		document.Formulario.NrAno.value = '<? echo($Ano);?>';
    </script>
</Form>


<?
	require("Funcoes/Conexao.php");





	$sql = "select
				c.IdClube, 
				c.NoClube,
				sum(a.NrMachosVivos) + sum(a.NrFemeasVivas) as Total
			from
				tbninhada as a,
				tbcanil as b,
				tbclube as c
			
			where
				a.IdCanil = b.IdCanil and
				a.idClube = c.idClube and
				right(NuNinhada,4) = '$Ano'
			
			Group By
				c.IdClube, c.NoClube
			
			Order by
			  Total DESC";

	//$sql = "Select SgUFRegistro, Count(SgUFRegistro) as Total from TBCachorro Where Year(DaRegistro) = $Ano and SgUFRegistro is Not Null and SgUFRegistro <> '' Group By SgUFRegistro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$c = 1;
	$Soma = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$UF[$c] = $row["NoClube"];
		$Valor[$c] = $row["Total"];
		$Soma = $Soma + $Valor[$c];
		$c = $c + 1;
	}	

	echo("<center><br><span class=Titulo>Registros por Filiada em $Ano</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=80>Filiada</td><td align=Center>Nº de Registros</td><td align=Center>Percentual</td></tr>");
	for($i=1; $i<$c; $i++)
	{
		$Percentual = ($Valor[$i] / $Soma) * 100;
		$Percentual = number_format($Percentual, 2, ',', '.');
		echo("<tr><td align=Center>$UF[$i]</td><td align=Center>$Valor[$i]</td><td align=Center>$Percentual % </td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$Soma</td><td align=Center>100</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>