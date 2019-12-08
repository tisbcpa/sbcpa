<?
function PesquisarAdestramentoIdAdestramento($Id)
{
	require("Conexao.php");
	$sql = "select * from TBAdestramento Where IdAdestramento = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoAdestramento],$row[DsAdestramento],$row[InAlemanha]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirAdestramentoIdAdestramento($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBAdestramento Where IdAdestramento = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBAdestramento";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarAdestramento($Id,$NoAdestramento,$DsAdestramento,$InAdestramento)
{
	require("Conexao.php");
	$sql = "Update TBAdestramento Set NoAdestramento = '$NoAdestramento', DsAdestramento = '$DsAdestramento', InAlemanha = '$InAdestramento' Where IdAdestramento = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBAdestramento";
	//$DsAcaoLog = "$Id,$NoAdestramento,$DsAdestramento,$InAdestramento";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarAdestramento($NoAdestramento,$DsAdestramento,$InAdestramento)
{
	require("Conexao.php");
	$sql = "Insert Into TBAdestramento (NoAdestramento,DsAdestramento,InAlemanha) values ('$NoAdestramento','$DsAdestramento','$InAdestramento')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBAdestramento (IdAdestramento, NoAdestramento,DsAdestramento,InAlemanha) values ($IdRegistroLog, '$NoAdestramento','$DsAdestramento','$InAdestramento')";
	$NoTabelaLog = "TBAdestramento";
	//$DsAcaoLog = "$NoAdestramento,$DsAdestramento,$InAdestramento";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbAdestramentoRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdAdestramento, NoAdestramento from TBAdestramento Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdAdestramento, NoAdestramento from TBAdestramento Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbAdestramento_Formulario.php><img src='Imagens/Novo.gif' border=0 Title='Novo Tipo de Adestramento'></a></td><td width=20><strong><a href=?Tipo=IdAdestramento>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoAdestramento>Nome do Adestramento</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdAdestramento]</td><td>$row[NoAdestramento]</td><td><a href=javascript:Editar($row[IdAdestramento])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdAdestramento])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbAdestramento_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>