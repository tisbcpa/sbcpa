<?
function ListarAdestradorRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{$sql = "select IdAdestrador,NoAdestrador,NoCidade,SgUF from TBAdestrador Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
	else
	{$sql = "select IdAdestrador,NoAdestrador,NoCidade,SgUF from TBAdestrador Order By $Ordem  LIMIT 50";}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoAdestrador>Nome do Figurante</a></strong></td><td width=100><strong><a href=?Tipo=NoCidade>Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>$row[NoAdestrador]</td><td>$row[NoCidade]</td><td>$row[SgUF]</td><td><a href=javascript:Editar($row[IdAdestrador])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdAdestrador])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	echo("<tr><td colspan=5><a href=Adestrador_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

function PesquisarAdestradorIdAdestrador($Id)
{
	require("Conexao.php");
	$sql = "select * from TBAdestrador Where IdAdestrador = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoAdestrador];$row[EdAdestrador];$row[NoCidade];$row[SgUF];$row[NoBairro];$row[NuCEP];$row[NoEmail];$row[NuTelefones];$row[DsHomePage];$row[IdClube];$row[DsObservacao];$row[StFigurante];$row[chCriacao];$row[chTrabalho];$row[chRegional];$row[chEstadual];$row[chNacional];$row[chLocal];$row[chInternacional]";
	}
	
	//die($Texto);
	
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirAdestradorIdAdestrador($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBAdestrador Where IdAdestrador = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBAdestrador";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	
	mysql_close($Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}

function CadastrarAdestrador($NoAdestrador,$EdAdestrador,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StFigurante,$chCriacao,$chTrabalho,$chRegional,$chEstadual,$chNacional,$chLocal,$chInternacional)
{
	require("Conexao.php");
	// Insere Dados do Adestrador
	$sql = "insert into TBAdestrador (NoAdestrador, EdAdestrador, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage, StFigurante, DsObservacao, IdClube, chCriacao, chTrabalho, chRegional, chEstadual, chNacional, chLocal, chInternacional) values ('$NoAdestrador', '$EdAdestrador', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage', '$StFigurante', '$DsObservacao', '$IdClube', '$chCriacao', '$chTrabalho', '$chRegional', '$chEstadual', '$chNacional', '$chLocal', '$chInternacional')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Adestrador!<br> Erros: " . mysql_error() . "<br><br>Sql: ". $sql ."</p>");


	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "insert into TBAdestrador (IdAdestrador,NoAdestrador, EdAdestrador, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage) values ($IdRegistroLog, '$NoAdestrador', '$EdAdestrador', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage')";
	$NoTabelaLog = "TBAdestrador";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);

}


function AlterarAdestrador($Id,$NoAdestrador,$EdAdestrador,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StFigurante,$chCriacao,$chTrabalho,$chRegional,$chEstadual,$chNacional,$chLocal,$chInternacional)
{
	require("Conexao.php");

	// Alterar Dados do Adestrador
	$sql = "UpDate TBAdestrador Set NoAdestrador = '$NoAdestrador', EdAdestrador = '$EdAdestrador', NoCidade = '$NoCidade', SgUF = '$SgUF', NoBairro = '$NoBairro', NuCEP = $NuCEP, NoEmail = '$NoEmail', NuTelefones = '$NuTelefones', DsHomePage = '$DsHomePage', StFigurante = '$StFigurante', DsObservacao = '$DsObservacao', IdClube = '$IdClube', chCriacao = '$chCriacao', chTrabalho = '$chTrabalho', chRegional = '$chRegional', chEstadual = '$chEstadual', chNacional = '$chNacional', chLocal = '$chLocal', chInternacional = '$chInternacional' Where IdAdestrador = $Id";
	
	//echo $sql;
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Adestrador!<br> Erro: " . mysql_error() . "</p>");
		
	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBAdestrador";
	//$DsAcaoLog = "$Id,$NoAdestrador,$EdAdestrador,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>