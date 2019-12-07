<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Telefones</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>

<?
	if (isset($_GET["NrTelefone"]))
	{$Tel = $_GET["NrTelefone"];}
	else
	{$Tel = "";}
?>

<Form name="Formulario">
	<table align="center">
		<tr class="Normal">
			<td>Informe o Telefone:</td>
			<td>
			<input type="text" name="NrTelefone" size="30" OnChange="document.Formulario.submit()">
			</td>
		</tr>
	</table>
</Form>


<?
	if ($Tel == ''){die();}

	require("Funcoes/Conexao.php");

	$sql = "select 'Adestrador' as Tipo, NoAdestrador, NoCidade, SgUF, NuTelefones From tbadestrador Where NuTelefones like '%$Tel%' union select 'Canil' as Tipo, NoCanil, NoCidade, SgUF, NrTelefones From tbcanil Where NrTelefones like '%$Tel%' union select 'Clube' as Tipo, NoClube, NoCidade, SgUF,NuTelefones From tbclube Where NuTelefones like '%$Tel%' union select 'Juiz' as Tipo, NoJuiz, NoCidade, SgUF,NuTelefones From tbjuiz Where NuTelefones like '%$Tel%' union select 'Proprietario' as Tipo, NoProprietario, NoCidade, SgUF,NuTelefones From tbproprietario Where NuTelefones like '%$Tel%'";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center>Tipo</td><td align=Center>Nome</td><td align=Center>Cidade</td><td align=Center>UF</td><td align=Center>Telefone</td></tr>");
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Telefone = str_replace("\n","<br>",$row[4]);
		echo("<tr><td align=Center>$row[0]</td><td align=Center>$row[1]</td><td align=Center>$row[2]</td><td align=Center>$row[3]</td><td align=Center>". $Telefone ."</td></tr>");
	}	


	echo("</table>");
	
	mysql_close($Conn);
?>