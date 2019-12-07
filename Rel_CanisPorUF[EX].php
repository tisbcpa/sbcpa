<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Canis Por UF</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>


<?
	require("Funcoes/Conexao.php");


	$sql = "select SgUF, Count(SgUF) Total from tbcanil where SgUF Is Not NULL group By SgUF";

	//$sql = "Select SgUFRegistro, Count(SgUFRegistro) as Total from TBCachorro Where Year(DaRegistro) = $Ano and SgUFRegistro is Not Null and SgUFRegistro <> '' Group By SgUFRegistro";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$c = 1;
	$Soma = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		//if ($row["SgUF"] != 'EX')
		//{
			$UF[$c] = $row["SgUF"];
			$Valor[$c] = $row["Total"];
			$Soma = $Soma + $Valor[$c];
			$c = $c + 1;
		//}
	}	

	echo("<center><br><span class=Titulo>Canis por UF</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=80>UF</td><td align=Center Width=80>Qtde</td><td align=Center>Percentual</td></tr>");
	for($i=1; $i<$c; $i++)
	{
		$Percentual = ($Valor[$i] / $Soma) * 100;
		$Percentual = number_format($Percentual, 2, ',', '.');
		echo("<tr><td align=Center>$UF[$i]</td><td align=Center>$Valor[$i]</td><td align=Center>$Percentual</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$Soma</td><td align=Center>100</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>