<?
function excluirexposicaoidexposicao($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBExposicao Where IdExposicao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$IdExposicao,$IdCachorro,$InCategoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	$sql = "Delete from tbexposicaoresultado Where IdExposicao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$IdExposicao,$IdCachorro,$InCategoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}


function PesquisarExposicaoIdExposicao($Id)
{
	require("Conexao.php");
	$sql = "select * from TBExposicao Where IdExposicao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[IdClube];$row[NoExposicao];$row[EdExposicao];$row[NoCidade];$row[SgUF];$row[DTInicio];$row[DTTermino];$row[NoJuizes];$row[InCINENacional];$row[InPontosDobrado]";
	}
	
	mysql_close($Conn);
	return $Texto;
}


function ExcluirExposicaoResultado($IdExposicao,$IdCachorro,$InCategoria)
{
	require("Conexao.php");
	$sql = "Delete From TBExposicaoResultado Where IDCachorro = $IdCachorro and IdExposicao = $IdExposicao and InCategoria = $InCategoria";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = "$IdExposicao";
	$NoTabelaLog = "TBExposicaoRes";
	//$DsAcaoLog = "$IdExposicao,$IdCachorro,$InCategoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	//echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function AlterarExposicao($Id,$IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF)
{
	require("Conexao.php");
	
	if ($DTInicio != ""){
		list($diaI, $mesI, $anoI) = split('[/]',$DTInicio);
		$DTInicioF = "$anoI-$mesI-$diaI";
	}
	else{
		$DTInicioF = "0000-00-00";
	}

	if ($DTTermino != ""){
		list($diaT, $mesT, $anoT) = split('[/]',$DTTermino);
		$DTTerminoF = "$anoT-$mesT-$diaT";
	}
	else{
		$DTTerminoF = "0000-00-00";
	}
	
	$sql = "UpDate TBExposicao Set IdClube = '$IdClube', NoExposicao = '$NoExposicao', EdExposicao = '$EdExposicao', DTInicio = '$DTInicioF', DTTermino = '$DTTerminoF', InCINENacional = '$InCINENacional', InPontosDobrado = '$InPontosDobrado', NoJuizes = '$NoJuizes', NoCidade = '$NoCidade', SgUF = '$SgUF' Where IdExposicao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$Id,$IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	

	if ($InCINENacional == 0){
		$SqlUpDate = "UpDate TBExposicaoResultado Set NrPonto = 0 Where IdExposicao = $Id";
		$sql_resultUpDate = mysql_query($SqlUpDate,$Conn);
		$TpAcaoLog = "A";
		$IdRegistroLog = $Id;
		$NoTabelaLog = "TBExposicaoRes";
		$DsAcaoLog = str_replace("'","|",$SqlUpDate);
		$DsAcaoLog = str_replace('"','',$DsAcaoLog);
		$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',1,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
		mysql_query($SqlAcaoLog,$Conn);
		//die($SqlAcaoLog);
	}
	else
	{
		echo("<script>alert('Não esqueça de clicar no botão [Atualizar/Ver Pontuação] para pontuar os cachorros da exposição');</script>");
	}

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function ListarExposicoesRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{
			if ($Campo == 'DTInicio')
			{
				//$v = split("/",$Parametro);
				$sql = "select IdExposicao, InCINENacional, NoExposicao, NoCidade, SgUF from TBExposicao Where Year($Campo)=$Parametro Order By $Ordem";
			}
			else
			{$sql = "select IdExposicao, InCINENacional, NoExposicao, NoCidade, SgUF from TBExposicao Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		}
		else
		{$sql = "select IdExposicao, NoExposicao, InCINENacional, NoCidade, SgUF from TBExposicao Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=20><strong><a>CINE?</a></strong></td><td width=200><strong><a>Exposicao</a></strong></td><td width=200><strong><a>Nome da Cidade</a></strong></td><td width=20><strong><a>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>&nbsp;" . str_replace("0","",str_replace("1","Sim",$row["InCINENacional"])) . "</td><td>&nbsp;$row[NoExposicao]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td><td><a href=javascript:Editar($row[IdExposicao])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdExposicao])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=6><a href=Clube_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}



function CadastrarExposicao($IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF)
{
	require("Conexao.php");

	if ($DTInicio != ""){
		list($diaI, $mesI, $anoI) = split('[/]',$DTInicio);
		$DTInicioF = "$anoI-$mesI-$diaI";
	}
	else{
		$DTInicioF = "0000-00-00";
	}

	if ($DTTermino != ""){
		list($diaT, $mesT, $anoT) = split('[/]',$DTTermino);
		$DTTerminoF = "$anoT-$mesT-$diaT";
	}
	else{
		$DTTerminoF = "0000-00-00";
	}

	$sql = "Insert Into TBExposicao (IdClube,NoExposicao,EdExposicao,DTInicio,DTTermino,InCINENacional,InPontosDobrado,NoJuizes,NoCidade,SgUF) values ($IdClube,'$NoExposicao','$EdExposicao','$DTInicioF','$DTTerminoF',$InCINENacional,$InPontosDobrado,'$NoJuizes','$NoCidade','$SgUF')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBExposicao (IdExposicao,IdClube,NoExposicao,EdExposicao,DTInicio,DTTermino,InCINENacional,InPontosDobrado,NoJuizes,NoCidade,SgUF) values ($IdRegistroLog,$IdClube,'$NoExposicao','$EdExposicao','$DTInicioF','$DTTerminoF',$InCINENacional,$InPontosDobrado,'$NoJuizes','$NoCidade','$SgUF')";	
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function CadastrarResultadoExposicao($IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto)
{
	require("Conexao.php");
	$sql = "Insert Into TBExposicaoResultado (IdExposicao,IDCachorro,InCategoria,InClassificacao,InQualificacao,NrPonto) values ($IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = "$IdExposicao";
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function AlterarResultadoExposicao($IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto,$IDCategoriaPK)
{
	require("Conexao.php");
	$sql = "UpDate TBExposicaoResultado Set InClassificacao = $InClassificacao, InQualificacao = $InQualificacao, InCategoria = $InCategoria where IdExposicao = $IdExposicao and IDCachorro = $IDCachorro and InCategoria = $IDCategoriaPK";
	
	//die($sql);
		
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = "$IdExposicao";
	$NoTabelaLog = "TBExposicao";
	//$DsAcaoLog = "$IdExposicao,$IDCachorro,$InCategoria,$InClassificacao,$InQualificacao,$NrPonto";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function ListarCachorrosExposicao($Id)
{
	require("Conexao.php");
	
	$sql = "select IdExposicao, InClassificacao, InCategoria, NoCategoria, c.IdCachorro, NoCachorro, c.TPSexo from (TBExposicaoResultado as a inner join TBCategoria as b on a.InCategoria = b.IdCategoria) inner join TBCachorro as c on a.IDCachorro = c.IDCachorro Where IdExposicao = $Id Order By InCategoria DESC, TPSexo, NoCachorro ASC";
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=javascript:Novo()><img src='Imagens/Novo.gif' border=0></a></td><td width=200><strong><a>Categoria</a></strong></td><td width=200><strong><a>Cachorro</a></strong></td><td width=20><strong><a>Classif.</a></strong></td><td colspan=2></td></tr>");

	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>&nbsp;$row[NoCategoria]</td><td>&nbsp;<a href='javascript:AbrirAlteracao($row[IdExposicao],$row[IdCachorro],$row[InCategoria])'>$row[NoCachorro]</a></td><td>&nbsp;$row[InClassificacao]</td><td></td><td><a href=javascript:Excluir($row[IdExposicao],$row[IdCachorro],$row[InCategoria])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=6><a href=Clube_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}
?>
