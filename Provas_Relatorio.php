<? require("Estilo/Estilo.php");?>
<style>
	th{font-family: verdana; font-size: 12; background-color: #CCCCCC}
	tr.Ntit{font-family: verdana; font-size: 12;}	
	tr.tit{font-family: verdana; font-size: 12; font-weight: bold}	
	tr.txt{font-family: verdana; font-size: 12; background-color: #F4F4F4}	
</style>
<center>
<?
	function FormatarDataTela($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}

	$IdProvas = $_GET["Id"];

	require("Funcoes/Conexao.php");
	$sqlTit = "Select a.*,b.NoClube From TBProva as a Left Join TBClube as b on a.IdClube = b.IdClube Where a.IdProva = $IdProvas";
	$sqlTit_result = mysql_query($sqlTit,$Conn);
	
	while ($rowTit = mysql_fetch_array($sqlTit_result))
	{
		echo("<table width='100%'>");
		echo("<tr class=tit><td align=center>$rowTit[NoProva]</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[NoClube]</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[EdProva]</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[NoCidade] / $rowTit[SgUF]</td></tr>");	
		echo("<tr class=tit><td align=center>" . FormatarDataTela($rowTit["DTInicio"]) . " à " . FormatarDataTela($rowTit["DTTermino"]) . "</td></tr>");	
		echo("<tr class=tit><td align=center>Juíz(es):</td></tr>");			
		echo("<tr class=Ntit><td align=center>" . str_replace(chr(13),"<br>",$rowTit["NoJuizes"]) . "</td></tr>");
		
		if ($rowTit["NoTiposProva"] != "")	
		{
		echo("<tr class=tit><td align=center>Provas:</td></tr>");			
		echo("<tr class=Ntit><td align=center>" . str_replace(chr(13),"<br>",$rowTit["NoTiposProva"]) . "</td></tr>");	
		}

		echo("</table>");
	}
	
	echo("<br><br>");

		$sqlDet = "Select b.NoCachorro, c.NoQualificacaoCao, a.NuA, a.NuB, a.NuC, a.NuTotal From (TBProvaResultado as a Inner Join TBCachorro as b On a.IdCachorro = b.IdCachorro) Left Join TBQualificacaoCao as c On a.InQualificacao =  c.IdQualificacaoCao Where a.IdProva = $IdProvas";
		$sqlDet_result = mysql_query($sqlDet,$Conn);

		echo("<table border=0>");
		echo("<tr><th width=350>Cachorro</th><th width=100>Qualificação</th><th>Pontos A</th><th>Pontos B</th><th>Pontos C</th><th> Total Pontos</th></tr>");
		while ($rowDet = mysql_fetch_array($sqlDet_result))
		{
			echo("<tr class=txt><td>$rowDet[NoCachorro]</td><td align=center>$rowDet[NoQualificacaoCao]</td><td align=center>$rowDet[NuA]</td><td align=center>$rowDet[NuB]</td><td align=center>$rowDet[NuC]</td><td align=center>$rowDet[NuTotal]</td></tr>");
		}	
		echo("</table>");	

	mysql_close($Conn);

?>
</center>
