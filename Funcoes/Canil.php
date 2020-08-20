<?
function FormatarDataTela($Data)
{
	if ($Data != "")
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}
}

function PesquisarCanilIdCanil($Id)
{
	require("Conexao.php");
	$sql = "select * from TBCanil Where IdCanil = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoProprietarioCanil];$row[NoCanil];$row[EdCanil];$row[NoBairro];$row[NuCEP];$row[NoCidade];$row[SgUF];$row[TPCanil];$row[NrTelefones];$row[EdInternet];$row[InDebito];$row[DSEmail];" . FormatarDataTela($row["DTFiliacao"]) . ";$row[DSObservacao]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirCanilIdCanil($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBCanil Where IdCanil = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCanil";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function AlterarCanil($IdCanil,$NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail,$DTFiliacao,$DSObservacao)
{
	require("Conexao.php");

	if ($DTFiliacao != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DTFiliacao);
		$DTFiliacao = "$ano-$mes-$dia";
	}
	else{
		$DTFiliacao = "0000-00-00";
	}

	$sql = "Update TBCanil Set NoCanil = '$NoCanil', NoProprietarioCanil = '$NoProprietarioCanil', EdCanil = '$EdCanil', NoBairro = '$NoBairro', NuCEP = '$NuCEP', NoCidade = '$NoCidade', SgUF = '$SgUF', TPCanil = $TPCanil, NrTelefones = '$NrTelefones', EdInternet = '$EdInternet', InDebito = '$InDebito', DSEmail = '$DSEmail', DTFiliacao = '$DTFiliacao', DsObservacao = '$DSObservacao' Where IdCanil = $IdCanil";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $IdCanil;
	$NoTabelaLog = "TBCanil";
	//$DsAcaoLog = "$IdCanil,$NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function CadastrarCanil($NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail,$DTFiliacao,$DSObservacao)
{
	require("Conexao.php");

	if ($DTFiliacao != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DTFiliacao);
		$DTFiliacao = "$ano-$mes-$dia";
	}
	else{
		$DTFiliacao = "0000-00-00";
	}

	$sql = "Insert Into TBCanil (NoProprietarioCanil, NoCanil, EdCanil, NoBairro, NuCEP, NoCidade, SgUF, TPCanil, NrTelefones, EdInternet, InDebito, DSEmail, DTFiliacao, DsObservacao) values ('$NoProprietarioCanil', '$NoCanil', '$EdCanil', '$NoBairro', '$NuCEP', '$NoCidade', '$SgUF', $TPCanil, '$NrTelefones', '$EdInternet', '$InDebito','$DSEmail','$DTFiliacao','$DSObservacao')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBCanil (IdCanil, NoProprietarioCanil, NoCanil, EdCanil, NoBairro, NuCEP, NoCidade, SgUF, TPCanil, NrTelefones, EdInternet, InDebito, DSEmail, DTFiliacao) values ($IdRegistroLog, '$NoProprietarioCanil', '$NoCanil', '$EdCanil', '$NoBairro', '$NuCEP', '$NoCidade', '$SgUF', $TPCanil, '$NrTelefones', '$EdInternet', '$InDebito','$DSEmail','$DTFiliacao')";
	$NoTabelaLog = "TBCanil";
	//$DsAcaoLog = "$NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}

function ListarTbCanilRelacaoCompleta($Ordem,$Parametro,$Campo,$Perfil)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IdCanil, NoCanil, NoProprietarioCanil, NoCidade, SgUF from TBCanil Where $Campo Like '$Parametro%' Order By $Ordem";}
		else
		{$sql = "select IdCanil, NoCanil, NoProprietarioCanil, NoCidade, SgUF from TBCanil Order By $Ordem LIMIT 50";}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoCanil>Nome do Canil</a></strong></td><td><a href=?Tipo=NoProprietarioCanil><b>Proprietário</b></a></td><td width=200><strong><a href=?Tipo=NoCidade>Nome da Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");

	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr><td>&nbsp;".$row['NoCanil']."</td><td>&nbsp;$row[NoProprietarioCanil]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td>");

		if ($Perfil == "Preenchimento")
		{
			echo("<td><a href=". chr(34) ."javascript:Selecionar($row[IdCanil],'$row[NoCanil]  -  $row[NoCidade]/$row[SgUF]')". chr(34) ."><img src='Imagens/Escolher.gif' border=0></a></td>");
		}

		if ($Perfil != "Preenchimento")
		{
			echo("<td><a href=javascript:Editar($row[IdCanil])><img src='Imagens/Editar.gif' border=0></a></td>");
			echo("<td><a href=javascript:Excluir($row[IdCanil])><img src='Imagens/Excluir.gif' border=0></a></td>");
		}
	}

	if ($Perfil != "Preenchimento")
	{
		//echo("<tr><td colspan=5><a href=Canil_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	}
	echo("</table>");
		
	mysql_close($Conn);
}

?>