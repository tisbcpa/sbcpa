<? require("Estilo/Estilo.php");?>
<style>
	th{font-family: verdana; font-size: 12; background-color: #CCCCCC}
	tr.Ntit{font-family: verdana; font-size: 12;}	
	tr.tit{font-family: verdana; font-size: 12; font-weight: bold}	
	tr.txt{font-family: verdana; font-size: 12; background-color: #F4F4F4}	
</style>
<center>
<?
function QtdeCachorrosCategoria($IdExposicao,$IdCategoria)
{
	require("Funcoes/Conexao.php");

	$sqlA = "select  count(*) as Total from tbexposicaoresultado where idexposicao = $IdExposicao and InCategoria = $IdCategoria";
	$sql_resultA = mysql_query($sqlA,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	while ($row = mysql_fetch_array($sql_resultA))
	{
		return $row["Total"];
	}	
	mysql_close($Conn);
}


function PontosQualificacao($Id)
{
	require("Funcoes/Conexao.php");

	if ($Id == ""){$Id = 0;}
	$PontoCat = 0;
	$sqlA = "select  NrPontos from TbQualificacaoCao where IdQualificacaoCao = $Id";
	$sql_resultA = mysql_query($sqlA,$Conn) or die("<p class='MsgErro'>Query invalida: " . $sqlA . "</p>"); //mysql_error() . "</p>");

	while ($row = mysql_fetch_array($sql_resultA))
	{
		$PontoCat = $row["NrPontos"];
	}	

	return $PontoCat;
	mysql_close($Conn);
}


function PontosParaTras($Pontos)
{

	if ($Pontos > 0)
	{
		$fim = false;
		$total = 0;
		$ci = 1;
		$cf = 5;

		do
		{
			if ($Pontos >= $ci && $Pontos  <= $cf) 
			{$fim = true;}

			$total++;
			$ci = $ci + 5;
			$cf = $cf + 5;
		}
		while ($fim != true);
	}
	else
	{
		$total = 0;
	}

	return $total;
}


function PontuarCachorro($IdCachorro,$IdExposicao,$IdClassificacao,$IdCategoria,$IdQualificacao)
{
	require("Funcoes/Conexao.php");

	$sqlA = "select InCINENacional, InPontosDobrado from tbexposicao where idexposicao = $IdExposicao";
	$sql_resultA = mysql_query($sqlA,$Conn) or die("<p class='MsgErro'>Query invalida1: " . mysql_error() . "</p>");
	while ($row = mysql_fetch_array($sql_resultA))
	{
		$InCINENacional = $row["InCINENacional"];
		$InPontosDobrado = $row["InPontosDobrado"];
	}	

	$Pontos = 0;
	$PontuacaoDaQualif = PontosQualificacao($IdQualificacao);
	if ($InCINENacional <> 0)
	{
		if ($IdClassificacao == 1){$Pontos = 10;}
		if ($IdClassificacao == 2){$Pontos = 8;}
		if ($IdClassificacao == 3){$Pontos = 6;}
		if ($IdClassificacao == 4){$Pontos = 4;}
		if ($IdClassificacao == 5){$Pontos = 2;}
		if ($IdClassificacao == 6){$Pontos = 1;}

		$PontosAdicionaisPAtras = QtdeCachorrosCategoria($IdExposicao,$IdCategoria) - $IdClassificacao;
		$Pontos = $Pontos + $PontuacaoDaQualif;
	
		if ($Pontos > 0) {$Pontos = $Pontos + PontosParaTras($PontosAdicionaisPAtras);}
		if ($InPontosDobrado <> 0){$Pontos = $Pontos * 2;}

	
		$sqlB = "select NrPonto from tbexposicaoresultado Where IdExposicao = $IdExposicao and IDCachorro = $IdCachorro and InCategoria = $IdCategoria";
		$sql_resultB = mysql_query($sqlB,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
		while ($row = mysql_fetch_array($sql_resultB))
		{$NrPontoSql = $row["NrPonto"];}	

		if ($PontuacaoDaQualif == 0)
		{$Pontos = 0;}

		if ($NrPontoSql <> $Pontos)
		{
			$SqlUpDate = "UpDate tbexposicaoresultado Set NrPonto = $Pontos Where IdExposicao = $IdExposicao and IDCachorro = $IdCachorro and InCategoria = $IdCategoria";
			$sql_resultUpDate = mysql_query($SqlUpDate,$Conn);

			$TpAcaoLog = "A";
			$IdRegistroLog = $IdExposicao;
			$NoTabelaLog = "TBExposicaoRes";
			$DsAcaoLog = str_replace("'","|",$SqlUpDate);
			$DsAcaoLog = str_replace('"','',$DsAcaoLog);
			$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
			mysql_query($SqlAcaoLog,$Conn);
		}
	}

	//mysql_close($Conn);
	return $Pontos;
}


function FormatarTextoMaiusculo($Texto)
{
	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");
	$Retorno = ""; 
	
	for($i=0; $i<=$Tam; $i++)
	{
		$palavra = strtolower($v[$i]);
	
		if (strlen($palavra) > 2)
		{
			$parte1 = mb_strtoupper(substr($palavra,0,1));
			$parte2 = strtolower(substr($palavra,1));
			
			$palavra = $parte1 . $parte2;
		}
		
		$Retorno = $Retorno ." ". $palavra;
	}
	$Retorno = str_replace(" i "," I ",$Retorno);
	$Retorno = str_replace(" ii "," II ",$Retorno);
	$Retorno = str_replace(" iii "," III ",$Retorno);
	$Retorno = str_replace(" iv "," IV ",$Retorno);
	$Retorno = str_replace(" v "," V ",$Retorno);	
	
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
		echo("<tr class=Ntit><td align=center><b>Juíz(es):</b>$rowTit[NoJuizes]</td></tr>");	
		echo("</table>");
	}
	
	echo("<br><br>");

	$sql = "Select Distinct a.InCategoria, b.Nocategoria From TBExposicaoResultado as a Left Join TBCategoria as b On a.InCategoria = b.IdCategoria Where a.IdExposicao = $IdExposicoes Order By b.Nocategoria DESC";
	$sql_result = mysql_query($sql,$Conn);

	echo("<table border=0>");
	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr class=Tit><td Colspan=2>$row[Nocategoria]</td></tr>");
		echo("<tr><td width=20>&nbsp;</td><td>");
		
		$sqlDet = "Select b.NoCachorro, c.NoQualificacaoCao, a.InClassificacao, a.NrPonto, a.InCategoria, a.IdExposicao, c.IdQualificacaoCao, a.IdCachorro, b.NuRegistroNacional From (TBExposicaoResultado as a Inner Join TBCachorro as b On a.IdCachorro = b.IdCachorro) Left Join TBQualificacaoCao as c On a.InQualificacao =  c.IdQualificacaoCao Where a.IdExposicao = $IdExposicoes and a.InCategoria = $row[InCategoria] Order By InClassificacao";
		$sqlDet_result = mysql_query($sqlDet,$Conn);

		echo("<table border=0>");
		echo("<tr><th>Classificação</th><th>N° SBCPA</th><th width=350>Nome do Animal</th><th width=100>Qualificação</th><th>Pontos</th></tr>");
		while ($rowDet = mysql_fetch_array($sqlDet_result))
		{
			echo("<tr class=txt><td align=center>$rowDet[InClassificacao]</td><td align=center>$rowDet[NuRegistroNacional]</td><td>". FormatarTextoMaiusculo($rowDet["NoCachorro"]) ."</td><td align=center>$rowDet[NoQualificacaoCao]</td><td align=center>".  PontuarCachorro($rowDet["IdCachorro"],$rowDet["IdExposicao"],$rowDet["InClassificacao"],$rowDet["InCategoria"],$rowDet["IdQualificacaoCao"])  ."</td></tr>");
		}	
		echo("</table>");	
		
		echo("<br></td></tr>");

		//".  PontuarCachorro($rowDet["$IdCachorro"],$rowDet["$IdExposicao"],$rowDet["$InClassificacao"],$rowDet["$InCategoria"],$rowDet["$IdQualificacao"])  ."	

	}
	echo("</table>");
	mysql_close($Conn);

?>
</center>
