<?
 $menu = "false";
 require("Estilo/Estilo.php");?>

<Title>Relação de Cachorros por Ordem Alfabética</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC; text-align: center}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>


<Span class=Titulo>Relação de Cachorros em Ordem Alfabética</Span><br><br>

<?
	require("Funcoes/Conexao.php");

	$sql = "Select NuRegistroNacional, NoCachorro, TPSexo, DSCor From TBCachorro as a Left Join TBCor as b On a.IDCor = b.IDCor Order By NOCachorro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table>");
	echo("<tr class=Titulo><td width=140>N° de Registro</td><td width=400>Nome do Cachorro</td><td>Sexo</td><td>Cor</td></tr>");
	$c = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr><td>$row[NuRegistroNacional]</td><td>$row[NoCachorro]</td><td>$row[TPSexo]</td><td>$row[DSCor]</td></tr>");
		$c = $c + 1;
	}	
	echo("<tr class=Titulo><td class=Titulo Colspan=3>Total</td><td>$c</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>