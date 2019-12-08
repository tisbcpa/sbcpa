<?
function PesquisarRaioXIdRaioX($Id)
{
	require("Conexao.php");
	$sql = "select * from TBRaioX Where IdRaioX = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoRaioX],$row[DsRaioX]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirRaioXIdRaioX($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBRaioX Where IdRaioX = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBRaioX";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ok</p>");
	mysql_close($Conn);
}

function AlterarRaioX($Id,$NoRaioX,$DsRaioX)
{
	require("Conexao.php");
	$sql = "Update TBRaioX Set NoRaioX = '$NoRaioX', DsRaioX = '$DsRaioX' Where IdRaioX = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBRaioX";
	//$DsAcaoLog = "$Id,$NoRaioX,$DsRaioX";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ok</p>");
	mysql_close($Conn);
}

function CadastrarRaioX($NoRaioX,$DsRaioX)
{
	require("Conexao.php");
	$sql = "Insert Into TBRaioX (NoRaioX,DsRaioX) values ('$NoRaioX','$DsRaioX')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBRaioX (IdRaioX,NoRaioX,DsRaioX) values ($IdRegistroLog,'$NoRaioX','$DsRaioX')";
	$NoTabelaLog = "TBRaioX";
	//$DsAcaoLog = "$NoRaioX,$DsRaioX";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ok</p>");
	mysql_close($Conn);
}

function ListarTbRaioXRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdRaioX, NoRaioX from TBRaioX Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdRaioX, NoRaioX from TBRaioX Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbRaioX_Formulario.php title='Novo Tipo de Raio X'><img src='Imagens/Novo.gif' border=0></a></td><td width=20><strong><a href=?Tipo=IdRaioX>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoRaioX>Nome da RaioX</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdRaioX]</td><td>$row[NoRaioX]</td><td><a href=javascript:Editar($row[IdRaioX])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdRaioX])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbRaioX_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>