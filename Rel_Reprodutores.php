<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Reprodutores por Ano</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}

	a{color:blue; text-decoration: none}
	a:hover{color:blue; text-decoration: underline}
</Style>

<?
	require("Funcoes/Conexao.php");

	function FormatarDataTela($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
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
	$sql = "Select  b.NoCachorro, b.IdCachorro, sum(a.NrMachosVivos) as Machos, sum(a.NrFemeasVivas) as Femeas, count(b.NoCachorro) as Ninhada  From  TBNinhada as a, TBCachorro as b where a.IdCachorroPai = b.IdCachorro and Year(a.DaNascimento) = $Ano group by b.NoCachorro Order By b.NoCachorro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Reprodutores em $Ano</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=250>Nome do Cachorro</td><td align=Center Width=100>Machos</td><td align=Center Width=100>Fêmeas</td><td align=center width=100>Ninhadas</td></tr>");

	$SomaMachos = 0;
	$SomaFemeas = 0;
	$SomaNinhada = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$SomaMachos = $SomaMachos + $row["Machos"];
		$SomaFemeas = $SomaFemeas + $row["Femeas"];
		$SomaNinhada = $SomaNinhada + $row["Ninhada"];

		echo("<tr><td align=Left><a href='Cachorro_Formulario.php?Id=$row[IdCachorro]' Target='new'>$row[NoCachorro]</a></td><td align=Center>$row[Machos]</td><td align=Center>$row[Femeas]</td><td align=center>$row[Ninhada]</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$SomaMachos</td><td align=Center>$SomaFemeas</td><td align=Center>$SomaNinhada</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>