<?
function ListarSocioRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{$sql = "select IdSocio,NoSocio,NoCidade,SgUF from TBSocio Where $Campo Like '$Parametro%' Order By $Ordem  LIMIT 50";}
	else
	{$sql = "select IdSocio,NoSocio,NoCidade,SgUF from TBSocio Order By $Ordem  LIMIT 50";}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoSocio>Nome do Sócio</a></strong></td><td width=100><strong><a href=?Tipo=NoCidade>Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>$row[NoSocio]</td><td>$row[NoCidade]</td><td>$row[SgUF]</td><td><a href=javascript:Editar($row[IdSocio])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdSocio])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	echo("<tr><td colspan=5><a href=Socio_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

function PesquisarSocioIdSocio($Id)
{
	require("Conexao.php");
	$sql = "select * from TBSocio Where IdSocio = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoSocio];$row[EdSocio];$row[NoCidade];$row[SgUF];$row[NoBairro];$row[NuCEP];$row[NoEmail];$row[NuTelefones];$row[DsHomePage];$row[DsObservacao];$row[IdClube];$row[StSocio];";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function ExcluirSocioIdSocio($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBSocio Where IdSocio = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSocio";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	
	mysql_close($Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}

function CadastrarSocio($NoSocio,$EdSocio,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$DsObservacao,$IdClube,$StSocio)
{
	require("Conexao.php");
	// Insere Dados do Socio
	$sql = "insert into TBSocio (NoSocio, EdSocio, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage, DsObservacao, IdClube, StSocio) values ('$NoSocio', '$EdSocio', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage', '$DsObservacao', '$IdClube', '$StSocio')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Socio!<br> Erros: " . mysql_error() . "<br><br>Sql: ". $sql ."</p>");


	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "insert into TBSocio (IdSocio,NoSocio, EdSocio, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, DsHomePage) values ($IdRegistroLog, '$NoSocio', '$EdSocio', '$NoCidade', '$SgUF', '$NoBairro', '$NuCEP', '$NoEmail', '$NuTelefones', '$DsHomePage')";
	$NoTabelaLog = "TBSocio";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);

}


function AlterarSocio($Id,$NoSocio,$EdSocio,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$DsObservacao,$IdClube,$StSocio)
{
	require("Conexao.php");

	// Alterar Dados do Socio
	$sql = "UpDate TBSocio Set NoSocio = '$NoSocio', EdSocio = '$EdSocio', NoCidade = '$NoCidade', SgUF = '$SgUF', NoBairro = '$NoBairro', NuCEP = '$NuCEP', NoEmail = '$NoEmail', NuTelefones = '$NuTelefones', DsHomePage = '$DsHomePage', DsObservacao = '$DsObservacao', IdClube = '$IdClube', StSocio = '$StSocio' Where IdSocio = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Socio!<br> Erro: " . mysql_error() . "</p>");
		
	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSocio";
	//$DsAcaoLog = "$Id,$NoSocio,$EdSocio,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>