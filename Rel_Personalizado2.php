<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Sócios Por Filiada</Title>
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
				<select name=UF OnChange=document.Formulario.submit()>
				<?				
					$sql = "select * from tbclube order by Noclube";
					$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
					while ($row = mysql_fetch_array($sql_result)){
						echo "<option value='$row[IdClube]'>$row[NoClube]</option>";
					}
				?>								
				</select>
			</td>
		</tr>
	</table>
	<script>document.Formulario.UF.value = '<? echo($UF);?>';</script>
</Form>

<?

	require("Funcoes/Conexao.php");

	if ($UF != "")
		$sql = "select * from tbsocio where IdClube = '$UF' Order By NoSocio";
	else
		$sql = "select * from tbsocio Order By NoSocio";

	//$sql = "Select SgUFRegistro, Count(SgUFRegistro) as Total from TBCachorro Where Year(DaRegistro) = $Ano and SgUFRegistro is Not Null and SgUFRegistro <> '' Group By SgUFRegistro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<center><br><span class=Titulo>Sócios por UF</span><br><br></center>");

	echo("<table border=0 align=center>");
	echo("<tr class=Titulo>");
	echo("	<td>Sócio</td>");
	echo("	<td>Endereço</td>");
	echo("	<td>Bairro</td>");
	echo("	<td>Cidade</td>");
	echo("	<td>UF</td>");
	echo("	<td>Telefones</td>");
	echo("	<td>Email</td>");
	echo("</tr>");

	while ($row = mysql_fetch_array($sql_result))
	{

		echo("<tr class=texto>");
		echo("	<td>$row[NoSocio]</td>");
		echo("	<td>$row[EdSocio]</td>");
		echo("	<td>$row[NoBairro]</td>");
		echo("	<td>$row[NoCidade]</td>");
		echo("	<td>$row[SgUF]</td>");
		echo("	<td>$row[NrTelefones]</td>");
		echo("	<td>$row[NoEmail]</td>");
		echo("</tr>");
	}	

	echo("</table>");
	
	mysql_close($Conn);
?>