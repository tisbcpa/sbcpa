<Title>Estatístico de Ninhadas</Title>
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
	<script>document.Formulario.NrAno.value = '<? echo($Ano);?>';</script>
</Form>


<?
	require("../Funcoes/Conexao.php");


	$sql = "select b.IdCanil, b.NoCanil, COUNT(b.IdCanil) Ninhadas, SUM(a.NrMachosVivos) Machos, SUM(a.NrFemeasVivas) Femeas from tbninhada as a, tbcanil as b where a.IdCanil = b.IdCanil and right(NuNinhada,4) = '$Ano' Group By b.IdCanil, b.NoCanil Order By b.NoCanil";

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	


	echo("<center><br><span class=Titulo>Estatístico de Ninhadas em $Ano</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td Width=280 align=Center>Canil</td><td align=Center>Ninhadas</td><td align=Center>Machos</td><td align=Center>Fêmeas</td></tr>");

	$SomaNinhada = 0;
	$SomaMacho = 0;
	$SomaFemea = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$SomaNinhada = $SomaNinhada + $row["Ninhadas"];
		$SomaMacho = $SomaMacho + $row["Machos"];
		$SomaFemea = $SomaFemea + $row["Femeas"];

		//$Percentual = number_format($Percentual, 2, ',', '.');
		echo("<tr><td>$row[NoCanil]</td><td align=Center>$row[Ninhadas]</td><td align=Center>$row[Machos]</td><td align=Center>$row[Femeas]</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$SomaNinhada</td><td align=Center>$SomaMacho</td><td align=Center>$SomaFemea</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>