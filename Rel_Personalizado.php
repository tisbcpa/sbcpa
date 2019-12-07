<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Sócios Por UF</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>

<?
 
	function FormatarDataTela($Data)
	{
		if ($Data != 0)
		{
			list ($ano, $mes, $dia) = split ('[/.-]', $Data);
			return "$dia/$mes/$ano";
		}
	}

	if (isset($_GET["UF"]))
	{
		$UF = $_GET["UF"];
	}
	else
	{
		$UF =  "DF";
	}
?>
<Form name="Formulario">
	<table align="center">
		<tr class="Normal">
			<td>Selecione a UF:</td>
			<td>
				<select name=UF OnChange=document.Formulario.submit()><option value='AC'>AC</option><option value='AL'>AL</option><option value='AM'>AM</option><option value='AP'>AP</option><option value='BA'>BA</option><option value='CE'>CE</option><option value='DF'>DF</option><option value='ES'>ES</option><option value='EX'>EX</option><option value='GO'>GO</option><option value='MA'>MA</option><option value='MG'>MG</option><option value='MS'>MS</option><option value='MT'>MT</option><option value='PA'>PA</option><option value='PB'>PB</option><option value='PE'>PE</option><option value='PI'>PI</option><option value='PR'>PR</option><option value='RJ'>RJ</option><option value='RN'>RN</option><option value='RO'>RO</option><option value='RR'>RR</option><option value='RS'>RS</option><option value='SC'>SC</option><option value='SE'>SE</option><option value='SP'>SP</option><option value='TO'>TO</option></select>
			</td>
		</tr>
	</table>
	<script>document.Formulario.UF.value = '<? echo($UF);?>';</script>
</Form>

<?

	require("Funcoes/Conexao.php");


	$sql = "select * from tbcanil where SgUF = '$UF' Order By Nocanil";

	//$sql = "Select SgUFRegistro, Count(SgUFRegistro) as Total from TBCachorro Where Year(DaRegistro) = $Ano and SgUFRegistro is Not Null and SgUFRegistro <> '' Group By SgUFRegistro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<center><br><span class=Titulo>Sócios por UF</span><br><br></center>");

	echo("<table border=0 align=center>");
	echo("<tr class=Titulo>");
	echo("	<td>Canil</td>");
	echo("	<td>Sócio</td>");
	echo("	<td>Endereço</td>");
	echo("	<td>Bairro</td>");
	echo("	<td>Cidade</td>");
	echo("	<td>UF</td>");
	echo("	<td>Telefones</td>");
	echo("	<td>Filiação</td>");
	echo("</tr>");

	while ($row = mysql_fetch_array($sql_result))
	{

		echo("<tr class=texto>");
		echo("	<td>$row[NoCanil]</td>");
		echo("	<td>$row[NoProprietarioCanil]</td>");
		echo("	<td>$row[EdCanil]</td>");
		echo("	<td>$row[NoBairro]</td>");
		echo("	<td>$row[NoCidade]</td>");
		echo("	<td>$row[SgUF]</td>");
		echo("	<td>$row[NrTelefones]</td>");
		echo("	<td>" . FormatarDataTela($row["DTFiliacao"]) . "</td>");
		echo("</tr>");
	}	

	echo("</table>");
	
	mysql_close($Conn);
?>