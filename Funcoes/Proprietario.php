<?
function PesquisarProprietarioIdProprietario($Id)
{
	require("Conexao.php");
	$sql = "select * from TBProprietario Where IdProprietario = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoProprietario];$row[EdProprietario];$row[NoCidade];$row[SgUF];$row[NoBairro];$row[NuCEP];$row[NoEmail];$row[NuTelefones];$row[TPAssociado];$row[DSHomePage]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirProprietarioIdProprietario($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBProprietario Where IdProprietario = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBProprietario";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarProprietario($Id,$NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DsHomePage)
{
	require("Conexao.php");
	$sql = "Update TBProprietario Set NoProprietario = '$NoProprietario', EdProprietario = '$EdProprietario', NoCidade = '$NoCidade', SgUF = '$SgUF',NoBairro = '$NoBairro', NuCEP = '$NuCEP', NoEmail = '$NoEmail', NuTelefones = '$NuTelefones', TPAssociado = '$TPAssociado', DSHomePage = '$DsHomePage' Where IdProprietario = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBProprietario";
	//$DsAcaoLog = "$Id,$NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarProprietario($NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DsHomePage)
{
	require("Conexao.php");
	$sql = "insert into TBProprietario (NoProprietario,EdProprietario,NoCidade,SgUF,NoBairro,NuCEP,NoEmail,NuTelefones,TPAssociado,DSHomePage) values ('$NoProprietario','$EdProprietario','$NoCidade','$SgUF','$NoBairro','$NuCEP','$NoEmail','$NuTelefones','$TPAssociado','$DsHomePage')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "<br><br>" . $sql  . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "insert into TBProprietario (IdProprietario,NoProprietario,EdProprietario,NoCidade,SgUF,NoBairro,NuCEP,NoEmail,NuTelefones,TPAssociado,DSHomePage) values ($IdRegistroLog,'$NoProprietario','$EdProprietario','$NoCidade','$SgUF','$NoBairro','$NuCEP','$NoEmail','$NuTelefones','$TPAssociado','$DsHomePage')";
	$NoTabelaLog = "TBProprietario";
	//$DsAcaoLog = "$NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarProprietarioRelacaoCompleta($Ordem,$Parametro,$Campo,$Perfil)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select * from TBProprietario Where $Campo Like '$Parametro%' Order By $Ordem LIMIT 50";}
		else
		{$sql = "select * from TBProprietario Order By $Ordem LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoProprietario>Nome do Proprietario</a></strong></td><td width=120><strong><a href=?Tipo=NoCidade>Nome da Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	
	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr><td>&nbsp;$row[NoProprietario]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td>");

		if ($Perfil == "Preenchimento")
		{echo("<td><a href=". chr(34) ."javascript:Selecionar($row[IdProprietario],'$row[NoProprietario]  -  $row[NoCidade]/$row[SgUF]')". chr(34) ."><img src='Imagens/Escolher.gif' border=0></a></td>");}
		
		if ($Perfil != "Preenchimento")
		{echo("<td><a href=javascript:Editar($row[IdProprietario])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdProprietario])><img src='Imagens/Excluir.gif' border=0></a></td>");}
	}
	
	//if($Perfil != 'Preenchimento')
	//{echo("<tr><td colspan=5><a href=Proprietario_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");}
	
	echo("</table>");
		
	mysql_close($Conn);
}

?>