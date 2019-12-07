<?
function PesquisarQualificacaoCaoIdQualificacaoCao($Id)
{
	require("Conexao.php");
	$sql = "select * from TBQualificacaoCao Where IdQualificacaoCao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoQualificacaoCao],$row[DsQualificacaoCao],$row[NrPontos]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirQualificacaoCaoIdQualificacaoCao($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBQualificacaoCao Where IdQualificacaoCao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBQualificacaoCao";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarQualificacaoCao($Id,$NoQualificacaoCao,$DsQualificacaoCao,$NrPontos)
{
	require("Conexao.php");
	if ($NrPontos == "") {$NrPontos = 0;}
	$sql = "Update TBQualificacaoCao Set NoQualificacaoCao = '$NoQualificacaoCao', DsQualificacaoCao = '$DsQualificacaoCao', NrPontos = $NrPontos Where IdQualificacaoCao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBQualificacaoCao";
	//$DsAcaoLog = "$Id,$NoQualificacaoCao,$DsQualificacaoCao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarQualificacaoCao($NoQualificacaoCao,$DsQualificacaoCao,$NrPontos)
{
	require("Conexao.php");
	$sql = "Insert Into TBQualificacaoCao (NoQualificacaoCao,DsQualificacaoCao,NrPontos) values ('$NoQualificacaoCao','$DsQualificacaoCao',$NrPontos)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
		
	$sql = "Insert Into TBQualificacaoCao (IdQualificacaoCao,NoQualificacaoCao,DsQualificacaoCao,NrPontos) values ($IdRegistroLog,'$NoQualificacaoCao','$DsQualificacaoCao',$NrPontos)";

	
	$NoTabelaLog = "TBQualificacaoCao";
	//$DsAcaoLog = "$NoQualificacaoCao,$DsQualificacaoCao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbQualificacaoCaoRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdQualificacaoCao, NoQualificacaoCao from TBQualificacaoCao Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdQualificacaoCao, NoQualificacaoCao from TBQualificacaoCao Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbQualificacaoCao_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Nova Qualificação para Cão'></a></td><td width=20><strong><a href=?Tipo=IdQualificacaoCao>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoQualificacaoCao>Nome da QualificacaoCao</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdQualificacaoCao]</td><td>$row[NoQualificacaoCao]</td><td><a href=javascript:Editar($row[IdQualificacaoCao])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdQualificacaoCao])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbQualificacaoCao_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>