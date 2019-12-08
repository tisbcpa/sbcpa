<?
function ListarDiretoriaRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{$sql = "select IdDiretoria,NoDiretoria,NoCidade,SgUF from TBDiretoria Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
	else
	{$sql = "select IdDiretoria,NoDiretoria,NoCidade,SgUF from TBDiretoria Order By $Ordem  LIMIT 50";}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoDiretoria>Nome do Diretor</a></strong></td><td width=100><strong><a href=?Tipo=NoCidade>Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>$row[NoDiretoria]</td><td>$row[NoCidade]</td><td>$row[SgUF]</td><td><a href=javascript:Editar($row[IdDiretoria])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdDiretoria])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	echo("<tr><td colspan=5><a href=Diretoria_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

function PesquisarDiretoriaIdDiretoria($Id)
{
	require("Conexao.php");
	$sql = "select * from TBDiretoria Where IdDiretoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoDiretoria];$row[EdDiretoria];$row[NoCidade];$row[SgUF];$row[NoBairro];$row[NuCEP];$row[NoEmail];$row[NuTelefones];$row[DsHomePage];$row[IdClube];$row[DsCargo];$row[StDiretoria]";
	}
	
	//die($Texto);
	
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirDiretoriaIdDiretoria($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBDiretoria Where IdDiretoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBDiretoria";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	
	mysql_close($Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}

function CadastrarDiretoria($NoDiretoria,$EdDiretoria,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StFigurante)
{
	require("Conexao.php");
	// Insere Dados do Diretoria
	$sql = "insert into TBDiretoria (NoDiretoria, EdDiretoria, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage, StDiretoria, DsCargo, IdClube) values ('$NoDiretoria', '$EdDiretoria', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage', '$StFigurante', '$DsObservacao', '$IdClube')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Diretoria!<br> Erros: " . mysql_error() . "<br><br>Sql: ". $sql ."</p>");


	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "insert into TBDiretoria (IdDiretoria,NoDiretoria, EdDiretoria, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage) values ($IdRegistroLog, '$NoDiretoria', '$EdDiretoria', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage')";
	$NoTabelaLog = "TBDiretoria";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);

}


function AlterarDiretoria($Id,$NoDiretoria,$EdDiretoria,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StFigurante)
{
	require("Conexao.php");

	// Alterar Dados do Diretoria
	$sql = "UpDate TBDiretoria Set NoDiretoria = '$NoDiretoria', EdDiretoria = '$EdDiretoria', NoCidade = '$NoCidade', SgUF = '$SgUF', NoBairro = '$NoBairro', NuCEP = $NuCEP, NoEmail = '$NoEmail', NuTelefones = '$NuTelefones', DsHomePage = '$DsHomePage', StDiretoria = '$StFigurante', DsCargo = '$DsObservacao', IdClube = '$IdClube' Where IdDiretoria = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Diretoria!<br> Erro: " . mysql_error() . "</p>");
		
	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBDiretoria";
	//$DsAcaoLog = "$Id,$NoDiretoria,$EdDiretoria,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>