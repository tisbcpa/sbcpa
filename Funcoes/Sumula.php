<?
function ListarSumulaRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{$sql = "select IdSumula, NuRegistroNacional, NoJuiz from (TBSumula as a inner join TBCachorro as b on a.IDCachorro = b.IDCachorro) left join TBJuiz as c on a.IDJuiz = c.IDJuiz Where $Campo Like '$Parametro%' Order By $Ordem DESC LIMIT 50";}
	else
	{$sql = "select IdSumula, NuRegistroNacional, NoJuiz from (TBSumula as a inner join TBCachorro as b on a.IDCachorro = b.IDCachorro) left join TBJuiz as c on a.IDJuiz = c.IDJuiz  Order By $Ordem DESC LIMIT 50";}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td><a href=Sumula_Formulario.php><img src='Imagens/Novo.gif' border=0 alt='Nova Súmula'></a></td><td width=20><strong><a>Súmula</a></strong></td><td width=100><strong><a>Nº SBCPA</a></strong></td><td width=200><strong><a>Juiz</a></strong></td><td colspan=2></td></tr>");
	
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td></td><td>$row[IdSumula]</td><td>&nbsp;$row[NuRegistroNacional]</td><td>&nbsp;$row[NoJuiz]</td><td><a href=javascript:Editar($row[IdSumula])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdSumula])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	echo("</table>");
		
	mysql_close($Conn);
}

function PesquisarSumulaIDSumula($Id)
{
	require("Conexao.php");
	$sql = "select * from TBSumula as a inner join TBCachorro as b on a.IDCachorro = b.IDCachorro Where IDSumula = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[IDSumula];$row[IDCachorro];$row[IDJuiz];$row[DTSumula];$row[NRAltura];$row[NOPigmentacao];$row[NOPelagem];$row[InVencida];$row[DSSumula];$row[NoCachorro];$row[IDJuizReselecao];$row[DTSumulaReselecao];$row[DSSumulaReselecao]";
	}
	
	mysql_close($Conn);
	return $Texto;
}


function ExcluirSumulaIdSumula($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBSumula Where IDSumula = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$TpAcaoLog = "E";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSumula";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	mysql_close($Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}



function AlterarSumula($Id,$IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida,$IDJuizReselecao,$DTSumulaReselecao,$DSSumulaReselecao)
{
	require("Conexao.php");

	if ($DTSumula != ""){
		list($dia, $mes, $ano) = split('[/]',$DTSumula);
		$DTSumulaF = "$ano-$mes-$dia";
	}
	else{
		$DTSumulaF = "0000-00-00";
	}

	if ($DTSumulaReselecao != ""){
		list($dia, $mes, $ano) = split('[/]',$DTSumulaReselecao);
		$DTSumulaReselecaoF = "$ano-$mes-$dia";
	}
	else{
		$DTSumulaReselecaoF = "0000-00-00";
	}

	if ($IdJuiz == "")
	{$IdJuiz = 0;}

	if ($IDJuizReselecao == "")
	{$IDJuizReselecao = 0;}

	$DSSumula = str_replace(";",",",$DSSumula);
	$DSSumulaReselecao = str_replace(";",",",$DSSumulaReselecao);

	// Alterar Dados do Adestrador
	$sql = "UpDate TBSumula Set IDCachorro = $IdCachorro, IDJuiz = $IdJuiz, DTSumula = '$DTSumulaF', NRAltura = '$NRAltura', NOPigmentacao = '$NOPigmentacao', NOPelagem = '$NOPelagem', DSSumula = '$DSSumula', InVencida = $InVencida, IDJuizReselecao=$IDJuizReselecao, DTSumulaReselecao='$DTSumulaReselecaoF', DSSumulaReselecao='$DSSumulaReselecao' Where IDSumula = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Adestrador!<br> Erro: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBSumula";
	//$DsAcaoLog = "$Id,$IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}



function CadastrarSumula($IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida,$IDJuizReselecao,$DTSumulaReselecao,$DSSumulaReselecao)
{
	require("Conexao.php");
	// Insere Dados da Súmula

	if ($DTSumula != "")
	{
		list($dia, $mes, $ano) = split('[/]',$DTSumula);
		$DTSumulaF = "$ano-$mes-$dia";
	}
	else
	{
		$DTSumulaF = "0000-00-00";
	}


	if ($DTSumulaReselecao != ""){
		list($dia, $mes, $ano) = split('[/]',$DTSumulaReselecao);
		$DTSumulaReselecaoF = "$ano-$mes-$dia";
	}
	else{
		$DTSumulaReselecaoF = "0000-00-00";
	}
	
	
	if ($IdJuiz == "")
	{$IdJuiz = 0;}

	if ($IdJuizReselecao == "")
	{$IDJuizReselecao = 0;}

	$DSSumula = str_replace(";",",",$DSSumula);
		
	$sql = "Insert Into TBSumula (IDCachorro,IDJuiz,DTSumula,NRAltura,NOPigmentacao,NOPelagem,DSSumula,InVencida,IDJuizReselecao, DTSumulaReselecao, DSSumulaReselecao) values ($IdCachorro,$IdJuiz,'$DTSumulaF','$NRAltura','$NOPigmentacao','$NOPelagem','$DSSumula',$InVencida, $IDJuizReselecao, '$DTSumulaReselecaoF', '$DSSumulaReselecao')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados da Súmula!<br> Erros: " . mysql_error() . "<br><br>Sql: ". $sql ."</p>");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBSumula (IDSumula,IDCachorro,IDJuiz,DTSumula,NRAltura,NOPigmentacao,NOPelagem,DSSumula,InVencida) values ($IdRegistroLog,$IdCachorro,$IdJuiz,'$DTSumulaF','$NRAltura','$NOPigmentacao','$NOPelagem','$DSSumula',$InVencida)";
	$NoTabelaLog = "TBSumula";
	//$DsAcaoLog = "$IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	
	

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>