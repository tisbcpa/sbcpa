<? require("Estilo/Estilo.php");?>
<style>
	th{font-family: verdana; font-size: 12; background-color: #CCCCCC}
	tr.Ntit{font-family: verdana; font-size: 12;}	
	tr.tit{font-family: verdana; font-size: 12; font-weight: bold}	
	tr.txt{font-family: verdana; font-size: 12; background-color: #F4F4F4}	
</style>
<center>
<?
function FormatarTextoMaiusculo($Texto)
{
	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");
	$Retorno = ""; 
	
	for($i=0; $i<=$Tam; $i++)
	{
		$palavra = mb_strtolower($v[$i]);
	
		if (strlen($palavra) > 2)
		{
			$parte1 = mb_strtoupper(substr($palavra,0,1));
			$parte2 = mb_strtolower(substr($palavra,1));
			
			$palavra = $parte1 . $parte2;
		}
		
		$Retorno = $Retorno ." ". $palavra;
	}
	return trim($Retorno);
}

	function FormatarDataTela($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}

	$IdExposicoes = $_GET["Id"];
	
	require("Funcoes/Conexao.php");
	$sqlTit = "Select a.*,b.NoClube From TBExposicao as a Left Join TBClube as b on a.IdClube = b.IdClube Where a.IdExposicao = $IdExposicoes";
	$sqlTit_result = mysql_query($sqlTit,$Conn);
	
	while ($rowTit = mysql_fetch_array($sqlTit_result))
	{
		$Cine = $rowTit["InCINENacional"];
		$Cine = str_replace(1,"Sim",$Cine);
		$Cine = str_replace(0,"Não",$Cine);
		
		$Pontos = $rowTit["InPontosDobrado"];
		$Pontos = str_replace(1,"Sim",$Pontos);
		$Pontos = str_replace(0,"Não",$Pontos);
	
		echo("<table width='100%'>");
		echo("<tr class=tit><td align=center>$rowTit[NoExposicao]</td></tr>");	
		echo("<tr class=tit><td align=center>Pontos CINE: $Cine &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pontos Dobrados: $Pontos</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[NoClube]</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[EdExposicao]</td></tr>");	
		echo("<tr class=tit><td align=center>$rowTit[NoCidade] / $rowTit[SgUF]</td></tr>");	
		echo("<tr class=tit><td align=center>" . FormatarDataTela($rowTit["DTInicio"]) . " à " . FormatarDataTela($rowTit["DTTermino"]) . "</td></tr>");	
		echo("<tr class=tit><td align=center>Juíz(es):</td></tr>");			
		echo("<tr class=Ntit><td align=center>$rowTit[NoJuizes]</td></tr>");	
		echo("</table>");
	}
	
	echo("<br><br>");

	$sql = "Select Distinct a.InCategoria, b.Nocategoria From TBExposicaoResultado as a Left Join TBCategoria as b On a.InCategoria = b.IdCategoria Where a.IdExposicao = $IdExposicoes Order By b.Nocategoria ASC";
	$sql_result = mysql_query($sql,$Conn);

	echo("<table border=0>");
	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr class=Tit><td Colspan=2>$row[Nocategoria]</td></tr>");
		echo("<tr><td width=20>&nbsp;</td><td>");
		
		$sqlDet = "Select b.NoCachorro, c.NoQualificacaoCao, a.InClassificacao, a.NrPonto From (TBExposicaoResultado as a Inner Join TBCachorro as b On a.IdCachorro = b.IdCachorro) Left Join TBQualificacaoCao as c On a.InQualificacao =  c.IdQualificacaoCao Where a.IdExposicao = $IdExposicoes and a.InCategoria = $row[InCategoria] Order By InClassificacao";
		$sqlDet_result = mysql_query($sqlDet,$Conn);

		echo("<table border=0>");
		echo("<tr><th width=350>Cachorro</th><th width=100>Qualificação</th><th>Classificação</th><th>Pontos</th></tr>");
		while ($rowDet = mysql_fetch_array($sqlDet_result))
		{
			echo("<tr class=txt><td>". FormatarTextoMaiusculo($rowDet["NoCachorro"]) ."</td><td align=center>$rowDet[NoQualificacaoCao]</td><td align=center>$rowDet[InClassificacao]</td><td align=center>$rowDet[NrPonto]</td></tr>");
		}	
		echo("</table>");	
		
		echo("<br></td></tr>");
	}
	echo("</table>");
	mysql_close($Conn);

?>
</center>
