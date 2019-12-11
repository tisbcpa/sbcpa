<?
require("Funcoes/Funcoes.php");

function Limpar($nome)
{
	$nome = strtolower($nome);
	$result = str_replace("á","a",$nome);
	$result = str_replace("é","e",$result);
	$result = str_replace("í","i",$result);
	$result = str_replace("ó","o",$result);
	$result = str_replace("ú","u",$result);
	$result = str_replace("ã","a",$result);
	$result = str_replace("à","a",$result);
	$result = str_replace("'","",$result);
	$result = str_replace("ë","e",$result);
	$result = str_replace("ü","u",$result);
	$result = str_replace("õ","o",$result);
	$result = str_replace("ç","c",$result);
	return strtoupper($nome);
}

function FormatarDataTelaCachorro($Data)
{
	list ($ano, $mes, $dia) = split ('[/.-]', $Data);
	return "$dia/$mes/$ano";
}

function PesquisarNuSBCPAXML($NuSBCPA)
{
	require("Conexao.php");
	$sql = "select * From TBCachorro Where NuRegistroNacional = '$NuSBCPA'";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Xml = "<ROOT>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Xml = $Xml . "<row Nome=". chr(34) . $row["NoCachorro"] . chr(34) ." />";
	}
	$Xml = $Xml . "</ROOT>";
	mysql_close($Conn);
	return $Xml;
}

function PesquisarNoCachorroXML($Nome)
{
	require("Conexao.php");
	$sql = "select * From TBCachorro Where NoCachorro Like '$Nome%' and (IdNinhada is Null or IdNinhada = 0) Order By NoCachorro LIMIT 50";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Xml = "<ROOT>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Xml = $Xml . "<row Id=". chr(34) . Limpar($row["IDCachorro"]) . chr(34) ." Nome=". chr(34) . Limpar($row["NoCachorro"]) . chr(34) ." NuSBCPA=". chr(34) . $row["NuRegistroNacional"] . chr(34) ." />";
	}
	$Xml = $Xml . "</ROOT>";
	mysql_close($Conn);
	return $Xml;
}

function AlterarDadosCachorroNinhada($Id,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC)
{
	require("Conexao.php");
	if ($TPSexo == ""){
		$TPSexo = 0;
	}

	if ($IdCor == ""){
		$IdCor = 0;
	}

	$sql = "UpDate TBCachorro Set NoCachorro = '$NoCachorro', TPSexo = '$TPSexo', IdCor = $IdCor, DaNascimento = '$DtNascimento', IdCachorroPai = $NoPai, IdCachorroMae = $NoMae, IdCanil = $IDCanil, IdNinhada = $NoNinhada, NuRegistroNacional = '$NuRegistroNacional', NoTatuagem = '$NoTatuagem', NuCBKC = '$NuCBKC' Where IdCachorro = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . $sql . "<br><br>" . mysql_error() . "</p>");
	
	$TpAcaoLog = "A";
	$IdRegistroLog = mysql_insert_id();
	$NoTabelaLog = "TBCachorro";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	return "Alterado com êxito!";
	mysql_close($Conn);
}

function PesquisarIdCachorroXML($Id)
{
	require("Conexao.php");
	$sql = "select * From TBCachorro Where IdCachorro = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Xml = "<ROOT>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Xml = $Xml . "<row Nome=". chr(34) . Limpar($row["NoCachorro"]) . chr(34) ." Sexo=". chr(34) . Limpar($row["TPSexo"]) . chr(34) ." NuSBCPA=". chr(34) . $row["NuRegistroNacional"] . chr(34) . " NuCBKC=". chr(34) . $row["NuCBKC"] . chr(34) ." NoTatuagem=". chr(34) . $row["NoTatuagem"] . chr(34) ." IdCor=". chr(34) . $row["IdCor"] . chr(34) ." />";
	}
	$Xml = $Xml . "</ROOT>";
	mysql_close($Conn);
	return $Xml;
}



function MontarCombo($Tabela,$Tamanho)
{
	require("Conexao.php");
	$ClausulaWhere = "";
	$Nome = "";
	

	if ($Tabela == "RaioX1"){
		$Nome = "IdRaioX1";
		$Tabela = "RaioX";
	}
	if ($Tabela == "RaioX2"){
		$Nome = "IdRaioX2";
		$Tabela = "RaioX";
	}
	if ($Tabela == "RaioX3"){
		$Nome = "IdRaioX3";
		$Tabela = "RaioX";
	}
	if ($Tabela == "RaioX4"){
		$Nome = "IdRaioX4";
		$Tabela = "RaioX";
	}

	
	if ($Tabela == "JuizReselecao")
	{
		$Nome = "IdJuizReselecao";
		$Tabela = "Juiz";
	}
	
	if ($Tabela == "AdestramentoAlemanha")
	{
		$Nome = "Id" . $Tabela;
		$Tabela = "Adestramento";
		$ClausulaWhere = " and InAlemanha = '1'";
	}

	$Campo1 = "Id" . $Tabela;
	$Campo2 = "No" . $Tabela;
	if ($Nome == "") {$Nome = $Campo1;}

	$sql = "select * from TB" . $Tabela . " Where $Campo2 <> '' " . $ClausulaWhere . " Order By $Campo2";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "<select name=". chr(34) ."$Nome". chr(34) ." style='width: $Tamanho'>";
	$Texto = $Texto . "<option value=''></option>";

	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = $Texto . "<option value='". $row["$Campo1"] ."'>" . $row["$Campo2"] . "</option>";
	}
	
	$Texto = $Texto . "</select>";
	
	mysql_close($Conn);
	return $Texto;
}





function SelecionarPai($Id)
{
	require("Conexao.php");

	$sql = "select * From TBCachorro Where IdCachorro = $Id";

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	//$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$DaNascimento = FormatarDataTelaCachorro($row["DaNascimento"]);
	//	$DaRaioX = FormatarDataTelaCachorro($row["DaRaioX"]);
	//	$DaProvaAdestramento = FormatarDataTelaCachorro($row["DaProvaAdestramento"]);
	//	$DaSelecao = FormatarDataTelaCachorro($row["DaSelecao"]);
	//	$DaProvaResistencia = FormatarDataTelaCachorro($row["DaProvaResistencia"]);
	//	$DaRegistro = FormatarDataTelaCachorro($row["DaRegistro"]);
		
		return "$row[NoCachorro];$row[TPSexo];$DaNascimento;$row[IdCachorroPai];$row[IdCachorroMae];$row[NuRegistroNacional];$row[NoTatuagem];$row[IdQualificacaoMaxima];$row[InResistencia];$row[DsObservacao];$row[NuNinhada]";
	}
	
	mysql_close($Conn);
	//return $Texto;
}


function PesquisarCachorroNOCachorro($Nome)
{
	require("Conexao.php");
	$sql = "select * From TBCachorro Where NOCachorro = '$Nome'";


	$sql_result = mysql_query($sql,$Conn);

	while ($row = mysql_fetch_array($sql_result))
	{
		$Id = $row["IDCachorro"];
	}

	mysql_close($Conn);
	echo("<script>window.location.href = 'Cachorro_Formulario.php?Id=$Id';</script>");
}


function PesquisarCachorroIdCachorro($Id)
{
	require("Conexao.php");
	$sql = "select a.*, e.NuRegistroNacional as NuRegistroMae, d.NuRegistroNacional as NuRegistroPai, e.NoCachorro as NoMae, d.NoCachorro as NoPai, b.NoProprietario, b.NoCidade as CidadeP, b.SgUF as UFP, c.NoCanil, c.NoCidade as CidadeC, c.SgUF as UFC, f.NuNinhada, g.IDSumula from (((((TBCachorro as a Left join TBProprietario as b On a.IdProprietario = b.IdProprietario) Left join TBCanil as c On a.IdCanil = c.IdCanil) Left join TBCachorro as d On a.IdCachorroPai = d.IdCachorro) Left join TbCachorro as e On a.IdCachorroMae = e.IdCachorro) left join TBNinhada as f on a.IdNinhada = f.IdNinhada) left join TBSumula as g on a.IDCachorro = g.IDCachorro Where a.IdCachorro = $Id";

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$DaNascimento = "";
		$DaRaioX = "";
		$DaProvaAdestramento = "";
		$DaSelecao = "";
		$DaProvaResistencia = "";
		$DaRegistro = "";
		
		if ($row["DaNascimento"] != '') {$DaNascimento = FormatarDataTelaCachorro($row["DaNascimento"]);}
		if ($row["DaRaioX"] != '') {$DaRaioX = FormatarDataTelaCachorro($row["DaRaioX"]);}
		if ($row["DaProvaAdestramento"] != '') {$DaProvaAdestramento = FormatarDataTelaCachorro($row["DaProvaAdestramento"]);}
		if ($row["DaSelecao"] != '') {$DaSelecao = FormatarDataTelaCachorro($row["DaSelecao"]);}
		if ($row["DaProvaResistencia"] != '') {$DaProvaResistencia = FormatarDataTelaCachorro($row["DaProvaResistencia"]);}
		if ($row["DaRegistro"] != '') {$DaRegistro = FormatarDataTelaCachorro($row["DaRegistro"]);}
		
		// return str_replace("00/00/0000","","$row[NoCachorro],$row[TPSexo],$row[IdCor],$DaNascimento,$row[IdCachorroPai],$row[IdCachorroMae],$row[IdProprietario],$row[IdCanil],$row[IdNinhada],$row[NuRegistroNacional],$row[NoTatuagem],$row[NuRegistroInternacional],$row[NuCBKC],$row[NuRegistroRegional],$row[SgUFRegistro],$row[IdRaioX],$DaRaioX,$row[IdAdestramento],$DaProvaAdestramento,$row[IdSelecao],$DaSelecao,$row[IdQualificacaoCao],$row[InResistencia],$DaProvaResistencia,$row[DsObservacao],$DaRegistro,$row[NoProprietario]  -  $row[CidadeP]/$row[UFP],$row[NoCanil]  -  $row[CidadeC]/$row[UFC],$row[NoPai],$row[NoMae],$row[NuNinhada],$row[IDSumula],$row[NuRegistroPai],$row[NuRegistroMae]");

	return str_replace("00/00/0000","","$row[NoCachorro];$row[TPSexo];$row[IdCor];$DaNascimento;$row[IdCachorroPai];$row[IdCachorroMae];$row[IdProprietario];$row[IdCanil];$row[IdNinhada];$row[NuRegistroNacional];$row[NoTatuagem];$row[NuRegistroInternacional];$row[NuCBKC];$row[NuRegistroRegional];$row[SgUFRegistro];$row[IdRaioX];$DaRaioX;$row[IdAdestramento];$DaProvaAdestramento;$row[IdSelecao];$DaSelecao;$row[IdQualificacaoCao];$row[InResistencia];$DaProvaResistencia;$row[DsObservacao];$DaRegistro;$row[NoProprietario]  -  $row[CidadeP]/$row[UFP];$row[NoCanil]  -  $row[CidadeC]/$row[UFC];$row[NoPai];$row[NoMae];$row[NuNinhada];$row[IDSumula];$row[NuRegistroPai];$row[NuRegistroMae];$row[NrMicrochip];$row[DsAdestramento];$row[IdRaioX1];$row[IdRaioX2];$row[IdRaioX3];$row[IdRaioX4]");
	}
	
	mysql_close($Conn);
	//return $Texto;
}

function excluircachorroidcachorro($Id)
{
	require("Conexao.php");
	$sql = "Delete From TBCachorro Where IdCachorro = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");


	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCachorro";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
	echo("<script>window.location.href = 'Cachorro_Listar.php';</script>");
}


function AlterarCachorro($Id,$NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao,$NrMicrochip,$DsAdestramento,$IdRaioX1,$IdRaioX2,$IdRaioX3,$IdRaioX4)
{
	require("Conexao.php");

	if ($TPSexo == ""){
		$TPSexo = 0;
	}

	if ($IdCor == ""){
		$IdCor = 0;
	}

	if ($DtNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtNascimento);
		$dateNasc = "$ano-$mes-$dia";

		if(validateDate($dateNasc)){
			$DtNascimento = ", DaNascimento = '$dateNasc'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtNascimento." é inválida! Campo Data de Nascimento.</p>");
			exit;
		}
		
	}
	else
	{$DtNascimento = null;}
	
	if ($DtRaioX != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtRaioX);
		$dateRaioX = "$ano-$mes-$dia";

		if(validateDate($dateRaioX)){
			$DtRaioX = ", DaRaioX = '$dateRaioX'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtRaioX." é inválida! Campo Data do RaioX.</p>");
			exit;
		}
	}
	else
	{$DtRaioX = null;}
	
	if ($DtProvaAdestramento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtProvaAdestramento);
		$dateProvaAdestramento = "$ano-$mes-$dia";

		if(validateDate($dateProvaAdestramento)){
			$DtProvaAdestramento = ", DaProvaAdestramento = '$dateProvaAdestramento'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtProvaAdestramento." é inválida! Campo Prova Adestramento!</p>");
			exit;
		}
	}
	else
	{$DtProvaAdestramento = null;}
		
	if ($DtSelecao != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtSelecao);	
		$dateSelecao = "$ano-$mes-$dia";

		if(validateDate($dateSelecao)){
			$DtSelecao = ", DaSelecao = '$dateSelecao'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtSelecao." é inválida! Campo Data Seleção!</p>");
			exit;
		}
	}
	else
	{$DtSelecao = null;}
	
	if ($DtResistencia != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtResistencia);
		$dateResistencia = "$ano-$mes-$dia";

		if(validateDate($dateResistencia)){
			$DtResistencia = ", DaProvaResistencia = '$dateResistencia'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtResistencia." é inválida! Campo Data Prova Resistência!</p>");
			exit;
		}
	}
	else
	{$DtResistencia = null;}

	if ($NoPai == "") {$NoPai = 0;}
	if ($NoMae == "") {$NoMae = 0;} 
	if ($NoNinhada == "") {$NoNinhada = 0;}
	if ($IdRaioX == "") {$IdRaioX = 0;}
	if ($IdAdestramento == "") {$IdAdestramento = 0;}
	if ($IDProprietario == "") {$IDProprietario = 0;}
	
	//if ($IdAdestramentoAlemanha == "") {$IdAdestramentoAlemanha = 0;}
	if ($IdCor== "") {$IdCor = 0;}
	if ($IDCanil== "") {$IDCanil = 0;}
	if ($IdSelecao == "") {$IdSelecao = 0;}
	if ($IdQualificacaoCao == "") {$IdQualificacaoCao = 0;}
	if ($InResistencia == "") {$InResistencia = 0;}
	
	$sql = "UpDate TBCachorro Set NoCachorro = '$NoCachorro', TPSexo = '$TPSexo', IdCor = $IdCor".$DtNascimento.", IdCachorroPai = $NoPai, IdCachorroMae = $NoMae, IdProprietario = $IDProprietario,  IdCanil = $IDCanil, IdNinhada = $NoNinhada, NuRegistroNacional = '$NuRegistroNacional', NoTatuagem = '$NoTatuagem', NuRegistroInternacional = '$NuRegistroInternacional', NuCBKC = '$NuCBKC', NuRegistroRegional = '$NuRegistroRegional', SgUFRegistro = '$SgUFRegistro', IdRaioX = $IdRaioX".$DtRaioX.", IdAdestramento = $IdAdestramento".$DtProvaAdestramento.", IdSelecao = $IdSelecao".$DtSelecao.", IdQualificacaoCao = $IdQualificacaoCao, InResistencia = '$InResistencia'".$DtResistencia.", DsObservacao = '$DsObservacao', NrMicrochip = '$NrMicrochip', DsAdestramento = '$DsAdestramento', IdRaioX1 = '$IdRaioX1', IdRaioX2 = '$IdRaioX2', IdRaioX3 = '$IdRaioX3', IdRaioX4 = '$IdRaioX4' Where IdCachorro = $Id";	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . $sql . "<br><br>" . mysql_error() . "</p>");

	$TpAcaoLog = "A";
	$IdRegistroLog = $Id;
	$NoTabelaLog = "TBCachorro";
	//$DsAcaoLog = "$Id,$NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}




function CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao,$NrMicrochip,$DsAdestramento,$IdRaioX1,$IdRaioX2,$IdRaioX3,$IdRaioX4)
{
	require("Conexao.php");
	$Hoje = date("y/m/d");

	if ($TPSexo == ""){
		$TPSexo = 0;
	}

	if ($IdCor == ""){
		$IdCor = 0;
	}

	if ($DtNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtNascimento);
		$dateNasc = "$ano-$mes-$dia";

		if(validateDate($dateNasc)){
			$columnNascimento = ", DaNascimento";
			$DtNascimento = ", '$dateNasc'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtNascimento." é inválida! Campo Data de Nascimento.</p>");
			exit;
		}	
	}else{
		$columnNascimento = null;
		$DtNascimento = null;
	}

	if ($DtRaioX != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtRaioX);
		$dateRaioX = "$ano-$mes-$dia";

		if(validateDate($dateRaioX)){
			$columnRaioX = ", DaRaioX";
			$DtRaioX = ", '$dateRaioX'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtRaioX." é inválida! Campo Data da RaioX.</p>");
			exit;
		}
	}else{
		$columnRaioX = null;
		$DtRaioX = null;
	}

	if ($DtProvaAdestramento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtProvaAdestramento);
		$dateProvaAdestramento = "$ano-$mes-$dia";

		if(validateDate($dateProvaAdestramento)){
			$columnProvaAdestramento = ", DaProvaAdestramento";
			$DtProvaAdestramento = ", '$dateProvaAdestramento'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtProvaAdestramento." é inválida! Campo Prova Adestramento!</p>");
			exit;
		}
	}else{
		$columnProvaAdestramento = null;
		$DtProvaAdestramento = null;
	}

	if ($DtSelecao != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtSelecao);	
		$dateSelecao = "$ano-$mes-$dia";

		if(validateDate($dateSelecao)){
			$columnSelecao = ", DaSelecao";
			$DtSelecao = ", '$dateSelecao'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtSelecao." é inválida! Campo Data Seleção!</p>");
			exit;
		}
	}else{
		$columnSelecao = null;
		$DtSelecao = null;
	}

	if ($DtResistencia != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DtResistencia);
		$dateResistencia = "$ano-$mes-$dia";

		if(validateDate($dateResistencia)){
			$columnResistencia = ", DaProvaResistencia";
			$DtResistencia = ", '$dateResistencia'";
		}else{
			echo("<p class='MsgErro'>A Data ".$DtResistencia." é inválida! Campo Data Prova Resistência!</p>");
			exit;
		}
	}else{
		$columnResistencia = null;
		$DtResistencia = null;
	}

	if ($NoPai == "") {$NoPai = 0;}
	if ($NoMae == "") {$NoMae = 0;} 
	if ($NoNinhada == "") {$NoNinhada = 0;}
	if ($IDProprietario == "") {$IDProprietario = 0;}
	if ($IDCanil == "") {$IDCanil = 0;}
	if ($IdRaioX == "") {$IdRaioX = 0;}
	if ($IdAdestramento == "") {$IdAdestramento = 0;}
	//if ($IdAdestramentoAlemanha == "") {$IdAdestramentoAlemanha = 0;}
	if ($IdSelecao == "") {$IdSelecao = 0;}
	if ($IdQualificacaoCao == "") {$IdQualificacaoCao = 0;}
	if ($InResistencia == "") {$InResistencia = 0;}
		

	$sql = "Insert Into TBCachorro (NoCachorro, TPSexo, IdCor".$columnNascimento.", IdCachorroPai, IdCachorroMae, IdProprietario, IdCanil, IdNinhada, NuRegistroNacional, NoTatuagem, NuRegistroInternacional, NuCBKC, NuRegistroRegional, SgUFRegistro, IdRaioX".$columnRaioX.", IdAdestramento".$columnProvaAdestramento.", IdSelecao".$columnSelecao.", IdQualificacaoCao, InResistencia".$columnResistencia.", DsObservacao,DaRegistro,NrMicrochip,DsAdestramento,IdRaioX1,IdRaioX2,IdRaioX3,IdRaioX4) values ('$NoCachorro', '$TPSexo', $IdCor".$DtNascimento.", $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, '$NuRegistroNacional', '$NoTatuagem', '$NuRegistroInternacional', '$NuCBKC', '$NuRegistroRegional', '$SgUFRegistro', $IdRaioX".$DtRaioX.", $IdAdestramento".$DtProvaAdestramento.", $IdSelecao".$DtSelecao.", $IdQualificacaoCao, '$InResistencia'".$DtResistencia.", '$DsObservacao', '$Hoje','$NrMicrochip','$DsAdestramento','$IdRaioX1','$IdRaioX2','$IdRaioX3','$IdRaioX4')";
	$sql_result = mysql_query($sql,$Conn);

	if (mysql_error() != "")
	{
		if (mysql_error() == "Duplicate entry '". $NuRegistroNacional ."' for key 2")
		{die("<p class='MsgErro'>Esse Nº de registro já existe em outro Cachorro!</p>");}
		else
		{die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>" . $sql);}	
	}

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBCachorro (IdCachorro, NoCachorro, TPSexo, IdCor, DaNascimento, IdCachorroPai, IdCachorroMae, IdProprietario, IdCanil, IdNinhada, NuRegistroNacional, NoTatuagem, NuRegistroInternacional, NuCBKC, NuRegistroRegional, SgUFRegistro, IdRaioX".$columnRaioX.", IdAdestramento".$columnProvaAdestramento.", IdSelecao".$columnSelecao.", IdQualificacaoCao, InResistencia".$columnResistencia", DsObservacao,DaRegistro,NrMicrochip) values ($IdRegistroLog, '$NoCachorro', '$TPSexo', $IdCor".$DtNascimento.", $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, '$NuRegistroNacional', '$NoTatuagem', '$NuRegistroInternacional', '$NuCBKC', '$NuRegistroRegional', '$SgUFRegistro', $IdRaioX".$DtRaioX.", $IdAdestramento".$DtProvaAdestramento.", $IdSelecao".$DtSelecao.", $IdQualificacaoCao, '$InResistencia'".$DtResistencia.", '$DsObservacao', '$Hoje','$NrMicrochip')";	
	$NoTabelaLog = "TBCachorro";
	//$DsAcaoLog = "$NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
	exit;
}


function ListarTbCachorroRelacaoCompleta($Ordem,$Parametro,$Campo,$Perfil)
{
	require("Conexao.php");
	
	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "Select IdCachorro, NuRegistroNacional, NoCachorro, NoProprietario, NoTatuagem From TbCachorro as a left join TbProprietario as b On a.IdProprietario = b.IdProprietario Where $Campo Like '%$Parametro%' Order By NoCachorro";}
		else
		{
			//$sql = "Select * From (Select IdCachorro, NuRegistroNacional, NoCachorro, NoProprietario, NoTatuagem From (TbCachorro as a left join TbProprietario as b On a.IdProprietario = b.IdProprietario) Limit 100) as A Order By a.IdCachorro DESC";
			$sql = "Select IdCachorro, NuRegistroNacional, NoCachorro, NoProprietario, NoTatuagem From TbCachorro as a left join TbProprietario as b On a.IdProprietario = b.IdProprietario Order By a.IdCachorro DESC LIMIT 100";
		}
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table align=center border=1 cellpadding=2 cellspacing=0>");
	echo("<tr><td width=200><strong><a href=?Tipo=NoCachorro>Nome do Cachorro</a></strong></td><td width=200><strong><a href=?Tipo=NoProprietario>Proprietario</a></strong></td><td width=70><strong><a href=?Tipo=NuRegistroNacional>Nº SBCPA</a></strong></td><td><a href=?Tipo=NoTatuagem><strong>Tatuagem</strong></a></td><td colspan=2></td></tr>");

	while ($row = mysql_fetch_array($sql_result))
	{
		echo("<tr><td>$row[NoCachorro]</td><td>&nbsp;$row[NoProprietario]</td><td>$row[NuRegistroNacional]</td><td>&nbsp;$row[NoTatuagem]</td>");
		
		if ($Perfil != "Preenchimento")
		{
			echo("<td><a href=javascript:Editar($row[IdCachorro])><img src='Imagens/Editar.gif' border=0></a></td>");
			echo("<td><a href=javascript:Excluir($row[IdCachorro])><img src='Imagens/Excluir.gif' border=0></a></td>");
		}
		else
		{
			echo("<td><a href=". chr(34) ."javascript:Selecionar($row[IdCachorro],'" . str_replace("'","´",$row["NoCachorro"]) . "')". chr(34) ."><img src='Imagens/Escolher.gif' border=0></a></td>");
		}
	}
	
	if ($Perfil != "Preenchimento")
	{//echo("<tr><td colspan=5><a href=Cachorro_Formulario.php><img src='Imagens/Novo.gif' border=0> Novo</a></td></tr>");
	}
	
	echo("</table>");
		
	mysql_close($Conn);
}

?>