<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Situa��o Financeira de Canis</Title>
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
			<td>Selecione a Op��o:</td>
			<td>
			<select name="NrAno" onChange="document.Formulario.submit()">
			<?
				echo("<option value=1>Canis com D�bitos</option>");
				echo("<option value=0>Canis sem D�bitos</option>");
			?>
			</select>
			</td>
		</tr>
	</table>
	<script>document.Formulario.NrAno.value = '<? echo($Ano);?>';</script>
</Form>


<?
	$Situacao = str_replace("1","Com D�bitos",$Ano);
	$Situacao = str_replace("0","Sem D�bitos",$Situacao);

	$sql = "select NoCanil, NoProprietarioCanil, SgUF, DtFiliacao from TBCanil Where InDebito = $Ano";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Canis <?echo($Situacao);?></span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=250>Nome do Canil</td><td align=Center Width=300>Propriet�rio</td><td align=Center Width=40>UF</td><td align=center width=100>Filia��o</td></tr>");
	$Soma = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$Soma = $Soma + 1;
		echo("<tr><td align=Left>$row[NoCanil]</td><td align=Center>$row[NoProprietarioCanil]</td><td align=Center>$row[SgUF]</td><td align=center>" . FormatarDataTela($row["DtFiliacao"]) . "</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center colspan=3>Total</td><td align=Center>$Soma</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>