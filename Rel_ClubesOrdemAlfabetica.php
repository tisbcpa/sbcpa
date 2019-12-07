<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Relação de Clubes por Ordem Alfabética</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC; text-align: center}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>


<Span class=Titulo>Relação de Clubes em Ordem Alfabética</Span><br><br>

<?
	require("Funcoes/Conexao.php");

	$sql = "select * from tbclube Order By NOClube";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
?>	


		<?
		$c = 0;
		while ($row = mysql_fetch_array($sql_result))
		{
			$Dir = str_replace("\n","<br>",$row["NoDiretoria"]);
			$Cont = str_replace("\n","<br>",$row["NoContatos"]);
			$Tel = str_replace("\n","<br>",$row["NuTelefones"]);

			echo("<table width=100%><tr>");
			echo("<td width=100><B>Sigla:</B></td><td>$row[SgClube]</td>");
			echo("<tr>");
			echo("<td><B>Clube:</B></td><td>$row[NoClube]</td>");
			echo("<tr>");
			echo("<td><B>Endereço:</B></td><td>$row[EdClube]</td>");
			echo("<tr>");
			echo("<td><B>Bairro:</B></td><td>$row[NoBairro]</td>");
			echo("<tr>");
			echo("<td><B>CEP:</B></td><td>$row[NuCEP]</td>");
			echo("<tr>");
			echo("<td><B>Cidade / UF:</B></td><td>$row[NoCidade] / $row[SgUF]</td>");
			echo("<tr>");
			echo("<td><B>País:</B></td><td>$row[NoPais]</td>");
			echo("<tr>");
			echo("<td><B>E-Mail:</B></td><td>$row[NoEmail]</td>");
			echo("<tr>");
			echo("<td><B>Presidente:</B></td><td>$row[NoPresidente]</td>");
			echo("<tr>");
			echo("<td><B>Website:</B></td><td>$row[DsHomeSite]</td>");
			echo("<tr>");
			echo("<td><B>Telefones:</B></td><td>". $Tel ."</td>");
			echo("<tr>");
			echo("<td><B>Contatos:</B></td><td>". $Cont ."</td>");
			echo("<tr>");
			echo("<td><B>Diretoria:</B></td><td>". $Dir ."</td>");
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