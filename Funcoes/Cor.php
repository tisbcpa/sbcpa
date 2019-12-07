<?
function PesquisarCorIdCor($Id)
{
	require("Conexao.php");
	$sql = "select * from TBCor Where IdCor = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoCor],$row[DsCor]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirCorIdCor($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBCor Where IdCor = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCor";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

		
	mysql_close($Conn);
}

function AlterarCor($Id,$NoCor,$DsCor)
{
	require("Conexao.php");
	$sql = "Update TBCor Set NoCor = '$NoCor', DsCor = '$DsCor' Where IdCor = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCor";
	//$DsAcaoLog = "$Id,$NoCor,$DsCor";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	
	mysql_close($Conn);
}

function CadastrarCor($NoCor,$DsCor)
{
	require("Conexao.php");
	$sql = "Insert Into TBCor (NoCor,DsCor) values ('$NoCor','$DsCor')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBCor (IdCor,NoCor,DsCor) values ($IdRegistroLog, '$NoCor','$DsCor')";
	$NoTabelaLog = "TBCor";
	//$DsAcaoLog = "$NoCor,$DsCor";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	mysql_close($Conn);
}

function ListarTbCorRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdCor, NoCor from TBCor Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdCor, NoCor from TBCor Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=TbCor_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Nova Cor'></a></td><td width=20><strong><a href=?Tipo=IdCor>Código</a></strong></td><td width=200><strong><a href=?Tipo=NoCor>Nome da Cor</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdCor]</td><td>$row[NoCor]</td><td><a href=javascript:Editar($row[IdCor])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdCor])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=TbCor_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a> &nbsp;&nbsp;<a href=Default.php target=_top><img src='Imagens/Menu.gif' border=0> Menu</a>&nbsp;&nbsp;<a href=Relatorios.php target=_top><img src='Imagens/Relatorio.gif' border=0> Relatório</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>