<?
function MontarComboClube()
{
	require("Conexao.php");
	$sql = " SELECT idClube, sgClube, noClube FROM tbclube where STClubeInativo = 0 Order By sgClube";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Texto = "<select name=idClube id=idClube>";
	$Texto = $Texto .  "<option value='0'></option>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = $Texto .  "<option value='$row[idClube]'>$row[sgClube] - $row[noClube]</option>";
	}
	$Texto = $Texto . "</select>";
	
	mysql_close($Conn);
	return $Texto;
}

function PesquisarClubeIdClube($Id)
{
	require("Conexao.php");
	$sql = "select * from TBClube Where IdClube = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[SgClube];$row[NoClube];$row[NoPais];$row[EdClube];$row[NoBairro];$row[NuCEP];$row[NoCidade];$row[SgUF];$row[NuTelefones];$row[NoEmail];$row[NoPresidente];$row[NoDiretoria];$row[NoContatos];$row[DsHomeSite];$row[DSUsuario];$row[DSSenha];$row[STClubeInativo]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirClubeIdClube($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBClube Where IdClube = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBClube";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarClube($Id,$SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage,$DsUsuario,$DsSenha,$STClubeInativo)
{
	require("Conexao.php");
	$sql = "UpDate TBClube Set SgClube = '$SgClube', NoClube = '$NoClube', NoPais = '$NoPais', EdClube = '$EdClube', NoBairro = '$NoBairro', NuCEP = '$NuCEP', NoCidade = '$NoCidade', SgUF = '$SgUF', NuTelefones = '$NuTelefones', NoEmail = '$NoEmail', NoPresidente = '$NoPresidente', NoDiretoria = '$NoDiretoria', NoContatos = '$NoContatos', DsHomeSite = '$DsHomePage', DsUsuario = '$DsUsuario', DsSenha = '$DsSenha', STClubeInativo = $STClubeInativo Where IdClube = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBClube";
	//$DsAcaoLog = "$Id,$SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarClube($SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage,$DsUsuario,$DsSenha,$STClubeInativo)
{
	require("Conexao.php");
	$sql = "Insert Into TBClube (SgClube,NoClube,NoPais,EdClube,NoBairro,NuCEP,NoCidade,SgUF,NuTelefones,NoEmail,NoPresidente,NoDiretoria,NoContatos,DsHomeSite,DsUsuario,DsSenha,STClubeInativo) values ('$SgClube','$NoClube','$NoPais','$EdClube','$NoBairro','$NuCEP','$NoCidade','$SgUF','$NuTelefones','$NoEmail','$NoPresidente','$NoDiretoria','$NoContatos','$DsHomePage','$DsUsuario','$DsSenha',$STClubeInativo)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBClube (IdClube, SgClube,NoClube,NoPais,EdClube,NoBairro,NuCEP,NoCidade,SgUF,NuTelefones,NoEmail,NoPresidente,NoDiretoria,NoContatos,DsHomeSite) values ($IdRegistroLog, '$SgClube','$NoClube','$NoPais','$EdClube','$NoBairro','$NuCEP','$NoCidade','$SgUF','$NuTelefones','$NoEmail','$NoPresidente','$NoDiretoria','$NoContatos','$DsHomePage')";
	$NoTabelaLog = "TBClube";
	//$DsAcaoLog = "$SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);	
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbClubeRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdClube, SgClube, NoClube, NoCidade, SgUF from TBClube Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
		else
		{$sql = "select IdClube, SgClube, NoClube, NoCidade, SgUF from TBClube Order By $Ordem  LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=70><strong><a href=?Tipo=SgClube>Sigla</a></strong></td><td width=200><strong><a href=?Tipo=NoClube>Nome do Clube</a></strong></td><td width=200><strong><a href=?Tipo=NoCidade>Nome da Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>&nbsp;$row[SgClube]</td><td>&nbsp;$row[NoClube]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td><td><a href=javascript:Editar($row[IdClube])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdClube])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=6><a href=Clube_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

?>