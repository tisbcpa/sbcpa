<?
function PesquisarCategoriaIdCategoria($Id)
{
	require("Conexao.php");
	$sql = "select * from TBCategoria Where IdCategoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoCategoria],$row[DsCategoria]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirCategoriaIdCategoria($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBCategoria Where IdCategoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCategoria";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarCategoria($Id,$NoCategoria,$DsCategoria)
{
	require("Conexao.php");
	$sql = "Update TBCategoria Set NoCategoria = '$NoCategoria', DsCategoria = '$DsCategoria' Where IdCategoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCategoria";
	//$DsAcaoLog = "$Id,$NoCategoria,$DsCategoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarCategoria($NoCategoria,$DsCategoria)
{
	require("Conexao.php");
	$sql = "Insert Into TBCategoria (NoCategoria,DsCategoria) values ('$NoCategoria','$DsCategoria')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBCategoria (IdCategoria, NoCategoria,DsCategoria) values ($IdRegistroLog, '$NoCategoria','$DsCategoria')";
	$NoTabelaLog = "TBCategoria";
	//$DsAcaoLog = "$NoCategoria,$DsCategoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbCategoriaRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdCategoria, NoCategoria from TBCategoria Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdCategoria, NoCategoria from TBCategoria Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbCategoria_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Nova Categoria'></a></td><td width=20><strong><a href=?Tipo=IdCategoria>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoCategoria>Nome da Categoria</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdCategoria]</td><td>$row[NoCategoria]</td><td><a href=javascript:Editar($row[IdCategoria])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdCategoria])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbCategoria_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>