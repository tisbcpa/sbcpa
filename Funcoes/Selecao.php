<?
function PesquisarSelecaoIdSelecao($Id)
{
	require("Conexao.php");
	$sql = "select * from TBSelecao Where IdSelecao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoSelecao],$row[DsSelecao]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirSelecaoIdSelecao($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBSelecao Where IdSelecao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSelecao";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarSelecao($Id,$NoSelecao,$DsSelecao)
{
	require("Conexao.php");
	$sql = "Update TBSelecao Set NoSelecao = '$NoSelecao', DsSelecao = '$DsSelecao' Where IdSelecao = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSelecao";
	//$DsAcaoLog = "$Id,$NoSelecao,$DsSelecao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarSelecao($NoSelecao,$DsSelecao)
{
	require("Conexao.php");
	$sql = "Insert Into TBSelecao (NoSelecao,DsSelecao) values ('$NoSelecao','$DsSelecao')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBSelecao (IdSelecao, NoSelecao,DsSelecao) values ($IdRegistroLog, '$NoSelecao','$DsSelecao')";
	$NoTabelaLog = "TBSelecao";
	//$DsAcaoLog = "$NoSelecao,$DsSelecao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbSelecaoRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdSelecao, NoSelecao from TBSelecao Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdSelecao, NoSelecao from TBSelecao Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbSelecao_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Novo tipo de Seleção'></a></td><td width=20><strong><a href=?Tipo=IdSelecao>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoSelecao>Nome da Selecao</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdSelecao]</td><td>$row[NoSelecao]</td><td><a href=javascript:Editar($row[IdSelecao])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdSelecao])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbSelecao_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>