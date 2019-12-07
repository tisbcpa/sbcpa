<?
function PesquisarQualificacaoJuizIdQualificacaoJuiz($Id)
{
	require("Conexao.php");
	$sql = "select * from TBQualificacaoJuiz Where IdQualificacaoJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoQualificacaoJuiz],$row[DsQualificacaoJuiz]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirQualificacaoJuizIdQualificacaoJuiz($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBQualificacaoJuiz Where IdQualificacaoJuiz = $Id";
	$sql2 = "Delete From TBJuizQualificacaoJuiz Where IdQualificacaoJuiz = $Id";
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$sql_result2 = mysql_query($sql2,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarQualificacaoJuiz($Id,$NoQualificacaoJuiz,$DsQualificacaoJuiz)
{
	require("Conexao.php");
	$sql = "Update TBQualificacaoJuiz Set NoQualificacaoJuiz = '$NoQualificacaoJuiz', DsQualificacaoJuiz = '$DsQualificacaoJuiz' Where IdQualificacaoJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBQualificacaoJuiz";
	//$DsAcaoLog = "$Id,$NoQualificacaoJuiz,$DsQualificacaoJuiz";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarQualificacaoJuiz($NoQualificacaoJuiz,$DsQualificacaoJuiz)
{
	require("Conexao.php");
	$sql = "Insert Into TBQualificacaoJuiz (NoQualificacaoJuiz,DsQualificacaoJuiz) values ('$NoQualificacaoJuiz','$DsQualificacaoJuiz')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBQualificacaoJuiz (IdQualificacaoJuiz,NoQualificacaoJuiz,DsQualificacaoJuiz) values ($IdRegistroLog,'$NoQualificacaoJuiz','$DsQualificacaoJuiz')";

	$NoTabelaLog = "TBQualificacaoJuiz";
	//$DsAcaoLog = "$NoQualificacaoJuiz,$DsQualificacaoJuiz";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbQualificacaoJuizRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdQualificacaoJuiz, NoQualificacaoJuiz from TBQualificacaoJuiz Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdQualificacaoJuiz, NoQualificacaoJuiz from TBQualificacaoJuiz Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 align=center cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbQualificacaoJuiz_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Nova Qualificação para Juiz'></a></td><td width=20><strong><a href=?Tipo=IdQualificacaoJuiz>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoQualificacaoJuiz>Nome da Qualificacao do Juiz</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdQualificacaoJuiz]</td><td>$row[NoQualificacaoJuiz]</td><td><a href=javascript:Editar($row[IdQualificacaoJuiz])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdQualificacaoJuiz])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbQualificacaoJuiz_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>