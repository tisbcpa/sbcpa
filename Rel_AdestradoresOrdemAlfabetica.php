<?
 $menu = "false";
 require("Estilo/Estilo.php");?>

<Title>Relação de Adestradores por Ordem Alfabética</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC; text-align: center}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>


<Span class=Titulo>Relação de Adestradores em Ordem Alfabética</Span><br><br>

<?
	require("Funcoes/Conexao.php");

	$sql = "select * from TBAdestrador Order By NOAdestrador";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
?>	


		<?
		$c = 0;
		while ($row = mysql_fetch_array($sql_result))
		{
			echo("<table width=100%><tr>");
			echo("<td width=20%><B>Nome:</B></td><td>$row[NoAdestrador]</td>");
			echo("<tr>");
			echo("<td><B>Endereço:</B></td><td>$row[EdAdestrador]</td>");
			echo("<tr>");
			echo("<td><B>Cidade:</B></td><td>$row[NoCidade]</td>");
			echo("<tr>");
			echo("<td><B>UF:</B></td><td>$row[SgUF]</td>");
			echo("<tr>");
			echo("<td><B>CEP:</B></td><td>$row[NuCEP]</td>");
			echo("<tr>");
			echo("<td><B>WebSite:</B></td><td>$row[DsHomePage]</td>");
			echo("<tr>");
			echo("<td><B>e-mail:</B></td><td>$row[NoEmail]</td>");
			echo("<tr>");
			echo("<td><B>Telefones:</B></td><td>$row[NuTelefones]</td>");
			echo("</table><br><br>");
			$c++;
		}
		?>
	


<?
	echo("<table width=100%>");
	echo("<tr class=Titulo><td class=Titulo width=80%>Total</td><td width=20%>$c</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>