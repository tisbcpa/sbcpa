<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Sintético de Chapas</Title>
<Style>
	span.Titulo{font-family: verdana; font-size: 14; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	span{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
	a{color:blue; text-decoration: none}
	a:hover{color:blue; text-decoration: underline}
</Style>
<?
	require("Funcoes/Conexao.php");

	function FormatarData($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}

	$Ordem = "DaSelecao DESC";
	if (isset($_GET["Ordem"]))
	{$Ordem = $_GET["Ordem"];}
	
	if ($Ordem == "DaSelecao")
	{$Ordem = "DaSelecao DESC";}

	$Hoje = date("Y") ."-". date("m") ."-". date("d");
	$sql = "Select * From TBCachorro Where TPSexo = 'M' and DaSelecao > '0001-01-01' and  DaSelecao < '$Hoje' Order By $Ordem";
	$sql_result = mysql_query($sql,$Conn);

	echo("<center><span class=Titulo>Relatório de Cães com Seleção Vencida</span><br><br>");
	echo("<span>* Seleção vencida antes de ". FormatarData($Hoje) . "</span><br><br>");
	echo("<table border=0>");
	echo("<tr class=Titulo>");
	echo("<td width=130><a href=javascript:Ordenar('NuRegistroNacional')>SBCPA</a></td>");
	echo("<td width=330><a href=javascript:Ordenar('NoCachorro')>Animal</a></td>");
	echo("<td width=40><a href=javascript:Ordenar('DaSelecao')>Vencimento Seleção</a></td>");
	echo("</tr>");

	$c = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr>");
		echo("<td><a href='Cachorro_Formulario.php?Nome=$row[NoCachorro]'  Target='new'>$row[NuRegistroNacional]</a></td>");
		echo("<td><a href='Cachorro_Formulario.php?Nome=$row[NoCachorro]'  Target='new'>$row[NoCachorro]</a></td>");
		echo("<td align=center>". FormatarData($row["DaSelecao"]) . "</td>");
		echo("</tr>");
		$c++;
	}		

	echo("<tr class=Titulo>");
	echo("<td colspan=2 align=center><strong>Total</strong></td>");
	echo("<td align=center><strong>". $c . "</strong></td>");
	echo("</tr>");

	echo("</table>");	
?>
<Script>
function Ordenar(campo)
{
	window.location.href = '?Ordem='+campo;
}
</Script>