<?
function ListarJuizRelacaoCompleta($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{$sql = "select IdJuiz,NoJuiz,NoCidade,SgUF from TBJuiz Where $Campo Like '$Parametro%' Order By $Ordem";}
	else
	{$sql = "select IdJuiz,NoJuiz,NoCidade,SgUF from TBJuiz Order By $Ordem";}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoJuiz>Nome do Juiz</a></strong></td><td width=100><strong><a href=?Tipo=NoCidade>Cidade</a></strong></td><td width=20><strong><a href=?Tipo=SgUF>UF</a></strong></td><td colspan=2></td></tr>");
	while ($row = mysql_fetch_array($sql_result))
	{echo("<tr><td>&nbsp;$row[NoJuiz]</td><td>&nbsp;$row[NoCidade]</td><td>&nbsp;$row[SgUF]</td><td><a href=javascript:Editar($row[IdJuiz])><img src='Imagens/Editar.gif' border=0></a></td><td><a href=javascript:Excluir($row[IdJuiz])><img src='Imagens/Excluir.gif' border=0></a></td></tr>");}
	
	//echo("<tr><td colspan=5><a href=Juiz_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	echo("</table>");
		
	mysql_close($Conn);
}

function PesquisarJuizIdJuiz($Id)
{
	require("Conexao.php");
	$sql = "select * from TBJuiz Where IdJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = "$row[NoJuiz];$row[DaNascimento];$row[EdJuiz];$row[NoCidade];$row[SgUF];$row[NoBairro];$row[NuCEP];$row[NoEMail];$row[NuTelefones];$row[TPNivel];$row[TPStatus];$row[DSObservacao]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function MontarCheckQualificacoesJuiz($IdJuiz)
{
	require("Conexao.php");
	$sql = "select * from TBQualificacaoJuiz";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	while ($row = mysql_fetch_array($sql_result))
	{
		//echo("$IdJuiz,$row[IdQualificacaoJuiz]<br><br>");
		
		if (VerificarQualificacaoJuiz($IdJuiz,$row["IdQualificacaoJuiz"]))
		{echo("<input type=Checkbox Name='IdQualificacaoJuiz' value='$row[IdQualificacaoJuiz]' OnClick='EscreverCheck()'; checked>$row[NoQualificacaoJuiz] <br>");	}
		else
		{echo("<input type=Checkbox Name='IdQualificacaoJuiz' value='$row[IdQualificacaoJuiz]' OnClick='EscreverCheck()';>$row[NoQualificacaoJuiz] <br>");	}
	}

	//die();
	mysql_close($Conn);
}


function VerificarQualificacaoJuiz($IdJuiz,$IdQualificacao)
{
	require("Conexao.php");
	$sql = "select * from TBJuizQualificacaoJuiz Where IdJuiz = $IdJuiz and IdQualificacaoJuiz = '$IdQualificacao'";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$ret = false;
	
	while ($row = mysql_fetch_array($sql_result))
	{
		if (isset($row["IdQualificacaoJuiz"]))
		{
			$ret = true;
		}
	}
	return $ret;
	mysql_close($Conn);
}

function ExcluirJuizQualificacaoJuiz($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBJuizQualificacaoJuiz Where IdJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn);

	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBJuizQua";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	mysql_close($Conn);
}

function ExcluirJuizIdJuiz($Id)
{
	require("Conexao.php");
	$sql = "Delete from TBJuiz Where IdJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBJuiz";
	//$DsAcaoLog = "$Id";
	$DsAcaoLog = str_replace("'","|",$sql);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	//die($SqlAcaoLog);

	mysql_query($SqlAcaoLog,$Conn);
	mysql_close($Conn);
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
}

function CadastrarJuiz($NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus,$IdQualificacaoJuiz,$DSObservacao)
{
	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "00/00/0000";
	}

	list($dia, $mes, $ano) = split('[/]',$DaNascimento);
	$vIdQualificacaoJuiz = split(";",$IdQualificacaoJuiz);
	$rep = strlen($IdQualificacaoJuiz)/2;

	$DaNascimentoF = "$ano-$mes-$dia";

	// Insere Dados do Juiz
	$sql = "insert into TBJuiz (NoJuiz, DaNascimento, EdJuiz, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, TPNivel, TPStatus, DSObservacao) values ('$NoJuiz', '$DaNascimentoF', '$EdJuiz', '$NoCidade', '$SgUF', '$NoBairro', $NuCEP, '$NoEmail', '$NuTelefones', '$TPNivel', '$TPStatus', '$DSObservacao')";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Juiz!<br> Erros: " . mysql_error() . "<br><br>Sql: ". $sql ."</p>");
	
	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "insert into TBJuiz (IdJuiz, NoJuiz, DaNascimento, EdJuiz, NoCidade, SgUF, NoBairro, NuCEP, NoEmail, NuTelefones, TPNivel, TPStatus, DSObservacao) values ($IdRegistroLog, '$NoJuiz', '$DaNascimentoF', '$EdJuiz', '$NoCidade', '$SgUF', '$NoBairro', $NuCEP, '$NoEmail', '$NuTelefones', '$TPNivel', '$TPStatus', '$DSObservacao')";
	$NoTabelaLog = "TBJuiz";
	//$DsAcaoLog = "$NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus,$IdQualificacaoJuiz";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
	$IdJuizNovo = $IdRegistroLog;
	
	// Resgata o ID do Juiz, está simples assim por não ser uma aplicação com demanda transacional muito grande.
	//$sql2 = "Select Max(IdJuiz) as IdJuiz From TBJuiz";
	//$sql_result2 = mysql_query($sql2,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	//while ($row = mysql_fetch_array($sql_result2))
	//{
		// Insere o Código do juiz junto com a Qualificação na tabela TBJuizQualificacaoJuiz.
		for ($i=1; $i<=$rep; $i++)
		{
			$sql3 = "insert into TBJuizQualificacaoJuiz (IdJuiz, IdQualificacaoJuiz) values ($IdJuizNovo, '$vIdQualificacaoJuiz[$i]')";
			$sql_result3 = mysql_query($sql3,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Juiz!<br> Erro: " . mysql_error() . "</p>");


			$TpAcaoLog = "I";
			$IdRegistroLog = "$IdJuizNovo";
			$NoTabelaLog = "TBJuizQu";
			$DsAcaoLog = "$IdJuizNovo, $vIdQualificacaoJuiz[$i]";
			$SqlAcaoLog = "Insert into TBAcao (TpAcaoLog,IdUsuario,IdRegistroLog,NoTabelaLog,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
			mysql_query($SqlAcaoLog,$Conn);	
		}
	//}

	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}


function AlterarJuiz($Id,$NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus,$IdQualificacaoJuiz,$DSObservacao)
{
	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "00/00/0000";
	}

	list($dia, $mes, $ano) = split('[/]',$DaNascimento);
	$vIdQualificacaoJuiz = split(",",$IdQualificacaoJuiz);
	$rep = strlen($IdQualificacaoJuiz) /2;

	$DaNascimentoF = "$ano-$mes-$dia";
	//die($IdQualificacaoJuiz);
	// Alterar Dados do Juiz
	$sql = "UpDate TBJuiz Set NoJuiz = '$NoJuiz', DaNascimento = '$DaNascimentoF', EdJuiz = '$EdJuiz', NoCidade = '$NoCidade', SgUF = '$SgUF', NoBairro = '$NoBairro', NuCEP = $NuCEP, NoEmail = '$NoEmail', NuTelefones = '$NuTelefones', TPNivel = '$TPNivel', TPStatus = '$TPStatus', DSObservacao = '$DSObservacao' Where IdJuiz = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Juiz!<br> Erro: " . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBJuiz";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	
	ExcluirJuizQualificacaoJuiz($Id);
	
	//echo($IdQualificacaoJuiz);
	// Insere o Código do juiz junto com a Qualificação na tabela TBJuizQualificacooJuiz.
	for ($i=0; $i<$rep; $i++)
	{
		$sql3 = "insert into TBJuizQualificacaoJuiz (IdJuiz, IdQualificacaoJuiz) values ($Id, '$vIdQualificacaoJuiz[$i]')";
		//die($sql3);
		$sql_result3 = mysql_query($sql3,$Conn) or die("<p class='MsgErro'>Falha ao Salvar os dados do Juiz!<br> Erro: " . mysql_error() . "</p>");
	
		$TpAcaoLog = "I";
		$IdRegistroLog = "$Id";
		$NoTabelaLog = "TBJuizQu";
		//$DsAcaoLog = "$Id, $vIdQualificacaoJuiz[$i]";
		$DsAcaoLog = str_replace("'","|",$sql3);
		$DsAcaoLog = str_replace('"','',$DsAcaoLog);
		$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
		mysql_query($SqlAcaoLog,$Conn);	
	}

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>