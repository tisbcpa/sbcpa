<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Cachorros por Raio X no Ano</Title>
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

	$AnoFinal = date("Y");
	 
	if (isset($_GET["NrAno"]))
	{$Ano = $_GET["NrAno"];}
	else
	{$Ano =  $AnoFinal;}

	if (isset($_GET["IdRaioX"]))
	{$RaioX = $_GET["IdRaioX"];}
	else
	{$RaioX =  5;}





	$sql = "Select IdRaioX, DsRaioX as NoRaioX From TbRaioX Order By NoRaioX";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");


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
		<tr>
			<td>Selecione o Raio X:</td>
			<td>
			<?
			echo("<select name=IdRaioX onChange=document.Formulario.submit()>");
			while ($row = mysql_fetch_array($sql_result))
			{
				echo("<option value=$row[IdRaioX]>$row[NoRaioX]</option>");
			}
			echo("</select>");

			?>
			</td>
		</tr>
	</table>
	<script>document.Formulario.NrAno.value = '<? echo($Ano);?>';</script>
	<script>document.Formulario.IdRaioX.value = '<? echo($RaioX);?>';</script>
</Form>


<?
	$sql = "Select a.NuRegistroNacional, a.IdCachorro, a.NoCachorro from TBCachorro as a Where Year(a.DaRaioX) = $Ano and a.IdRaioX = $RaioX Order by a.NuRegistroNacional";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	//echo $sql;
	
	echo("<center><br><span class=Titulo>Cachorros por Raio X em $Ano</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=80>Registro Nacional</td><td align=Center Width=380>Nome do Cachorro</td></tr>");
	$Soma = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$Soma = $Soma + 1;
		echo("<tr><td align=Center>$row[NuRegistroNacional]</td><td align=Center><a href='Cachorro_Formulario.php?Id=$row[IdCachorro]' Target='new'>$row[NoCachorro]</a></td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$Soma</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>