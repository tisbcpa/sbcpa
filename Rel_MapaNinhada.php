<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Mapa de Ninhada no Ano</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>

<?
	require("Funcoes/Conexao.php");

	function FormatarDataTela($Data)
	{
		if ($Data != 0)
		{
			list ($ano, $mes, $dia) = split ('[/.-]', $Data);
			return "$dia/$mes/$ano";
		}
	}

	$AnoFinal = date("Y");
	 
	if (isset($_GET["NrAno"]))
	{$Ano = $_GET["NrAno"];}
	else
	{$Ano =  $AnoFinal;}
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
	<script>document.Formulario.NrAno.value = '<? echo($Ano);?>';</script>
</Form>


<?
	$sql = "select Left(NuNinhada,4) Ninhada, Right(NuNinhada,4) Ano, DaNascimento, NrMachosVivos, NrFemeasVivas from TBNinhada where Right(NuNinhada,4) = '$Ano'";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Mapa de Ninhada em $Ano</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=120>N° da Ninhada</td><td align=Center Width=120>Data da Ninhada</td><td align=Center Width=120>N° de Machos</td><td align=center Width=120>N° de Fêmeas</td></tr>");

	$Soma = 0;
	$Macho = 0;
	$Femea = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$Soma = $Soma + 1;
		$Macho = $Macho + $row["NrMachosVivos"];
		$Femea = $Femea + $row["NrFemeasVivas"];

		echo("<tr><td align=Left>$row[Ninhada]/$row[Ano]</td><td align=Center>" . FormatarDataTela($row["DaNascimento"]) . "</td><td align=Center>$row[NrMachosVivos]</td><td align=center>$row[NrFemeasVivas]</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$Soma</td><td align=Center>$Macho</td><td align=Center>$Femea</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>