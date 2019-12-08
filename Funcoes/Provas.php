<?

function PesquisarProvaIdProva($Id)
{
	require("Conexao.php");
	$sql = "select * from TBProva Where IdProva = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[IdClube];$row[NoProva];$row[EdProva];$row[NoCidade];$row[SgUF];$row[DTInicio];$row[DTTermino];$row[NoJuizes];$row[NoTiposProva]";
	}
	
	mysql_close($Conn);
	return $Texto;
}


function ExcluirProvaResultado($IdProva,$IdCachorro)
{
	require("Conexao.php");
	$sql = "Delete From TBProvaResultado Where IDCachorro = $IdCachorro and IdProva = $IdProva";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $IdProva;
	$NoTabelaLog = "TBProvaResultado";
	//$DsAcaoLog = "$IdProva,$IdCachorro";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	//echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarProva($Id,$IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF)
{
	require("Conexao.php");

	if ($DTInicio == ""){
		$DTInicio = "00/00/0000";
	}

	if ($DTTermino == ""){
		$DTTermino = "00/00/0000";
	}


	list($diaI, $mesI, $anoI) = split('[/]',$DTInicio);
	$DTInicioF = "$anoI-$mesI-$diaI";

	list($diaT, $mesT, $anoT) = split('[/]',$DTTermino);
	$DTTerminoF = "$anoT-$mesT-$diaT";

	$sql = "UpDate TBProva Set IdClube = $IdClube, NoProva = '$NoProva', EdProva = '$EdProva', DTInicio = '$DTInicioF', DTTermino = '$DTTerminoF', NoTiposProva = '$NoTiposProva', NoJuizes = '$NoJuizes', NoCidade = '$NoCidade', SgUF = '$SgUF' Where IdProva = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBProva";
	//$DsAcaoLog = "$Id,$IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarProvasRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdProva, NoProva, NoCidade, SgUF from TBProva Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdProva, NoProva, NoCidade, SgUF from TBProva Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a>Prova</a></strong></td><td width=200><strong><a>Nome da Cidade</a></strong></td><td width=20><strong><a>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>&nbsp;$row[NoProva]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td><td><a href=javascript:Editar($row[IdProva])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdProva])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=6><a href=Clube_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}



function CadastrarProva($IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF)
{
	require("Conexao.php");

	if ($DTInicio == ""){
		$DTInicio = "00/00/0000";
	}

	if ($DTTermino == ""){
		$DTTermino = "00/00/0000";
	}

	list($diaI, $mesI, $anoI) = split('[/]',$DTInicio);
	$DTInicioF = "$anoI-$mesI-$diaI";

	list($diaT, $mesT, $anoT) = split('[/]',$DTTermino);
	$DTTerminoF = "$anoT-$mesT-$diaT";

	$sql = "Insert Into TBProva (IdClube,NoProva,EdProva,DTInicio,DTTermino,NoTiposProva,NoJuizes,NoCidade,SgUF) values ($IdClube,'$NoProva','$EdProva','$DTInicioF','$DTTerminoF','$NoTiposProva','$NoJuizes','$NoCidade','$SgUF')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBProva (IdProva,IdClube,NoProva,EdProva,DTInicio,DTTermino,NoTiposProva,NoJuizes,NoCidade,SgUF) values ($IdRegistroLog,$IdClube,'$NoProva','$EdProva','$DTInicioF','$DTTerminoF','$NoTiposProva','$NoJuizes','$NoCidade','$SgUF')";
	$NoTabelaLog = "TBProva";
	//$DsAcaoLog = "$IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function CadastrarResultadoProva($IdProva,$IDCachorro,$InQualificacao,$NuA,$NuB,$NuC,$NuTotal)
{
	require("Conexao.php");
	$sql = "Insert Into TBProvaResultado (IdProva,IDCachorro,InQualificacao,NuA,NuB,NuC,NuTotal) values ($IdProva,$IDCachorro,$InQualificacao,$NuA,$NuB,$NuC,$NuTotal)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = $IdProva;
	$NoTabelaLog = "TBProvaResultado";
	//$DsAcaoLog = "$IdProva,$IDCachorro,$InQualificacao,$NuA,$NuB,$NuC,$NuTotal";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}





function ListarCachorrosProva($Id)
{
	require("Conexao.php");
	
	$sql = "select IdProva, NoQualificacaoCao, b.IDCachorro, NoCachorro from (TBProvaResultado as a inner join TBCachorro as b on a.IDCachorro = b.IDCachorro) inner join TBQualificacaoCao as c on a.InQualificacao = c.IdQualificacaoCao Where a.IdProva = $Id";
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=javascript:Novo()><img src='Imagens/Novo.gif' border=0></a></td><td width=200><strong><a>Cachorro</a></strong></td><td width=200><strong><a>Qualificação.</a></strong></td><td colspan=2></td></tr>");

	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>&nbsp;$row[NoCachorro]</td><td>&nbsp;$row[NoQualificacaoCao]</td><td></td><td><a href=javascript:Excluir($row[IdProva],$row[IDCachorro])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=6><a href=Clube_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}
?>