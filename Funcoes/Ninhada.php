<?
require("Cachorro.php");

function FormatarDataTelaNinhada($Data)
{
	if ($Data != "")
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}
	else
	{
		return "&nbsp;";
	}
}



function PesquisarNinhadaIdNinhada($Id)
{
	require("Conexao.php");
	$sql = "Select a.NuNinhada, a.DaNascimento, a.IdCanil, a.NrMachos, a.NrMachosVivos, a.NrFemeas, a.NrFemeasVivas, a.TxConsaguinidade, a.IdCachorroPai, a.IdCachorroMae, b.NoCanil, c.NoCachorro as NoPai, d.NoCachorro as NoMae, a.idClube, b.SgUF, b.NoCidade From (((TBNinhada as a left join TBCanil as b on a.IdCanil = b.IdCanil) left join TBCachorro as c on c.IdCachorro = a.IdCachorroPai) left join TBCachorro as d on d.IdCachorro = a.IdCachorroMae) Left Join TBCanil as e On a.IdCanil = e.IdCanil Where a.IdNinhada = $Id";

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result))
	{
		$DaNascimento = FormatarDataTelaNinhada($row["DaNascimento"]);
		
		return "$row[NuNinhada],$DaNascimento,$row[IdCanil],$row[NrMachos],$row[NrMachosVivos],$row[NrFemeas],$row[NrFemeasVivas],". str_replace(",","|",$row["TxConsaguinidade"]) .",$row[IdCachorroPai],$row[IdCachorroMae],$row[NoCanil] - $row[NoCidade] / $row[SgUF],$row[NoPai],$row[NoMae],$row[idClube]";
	}
	
	mysql_close($Conn);
	//return $Texto;
}



function ListarNinhada($Ordem,$Parametro,$Campo)
{
	require("Conexao.php");

	if (isset($Parametro) && isset($Campo))
	{
		if (($Parametro != '') && ($Campo != ''))
		{$sql = "select IDNinhada, NuNinhada, DaNascimento, STNinhadaInternacional from TBNinhada Where $Campo Like '%$Parametro%' Order By IDNinhada DESC";}
		else
		{$sql = "select IDNinhada, NuNinhada, DaNascimento, STNinhadaInternacional from TBNinhada Order By $Ordem  LIMIT 50";}
	}
	
	//$sql = "Select * From TBNinhada Order By NuNinhada Limit 50";

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	echo("<table border=1 cellpadding=2 align=center cellspacing=0>");
	echo("<tr><td><a href='javascript:Novo()' title='Nova Ninhada'><img src='Imagens/Novo.gif' border=0></a></td><td><a><strong>Número da Ninhada</strong></a></td><td><a><strong>Data da Ninhada</strong></a></td><td></td></tr>");
	
	while ($row = mysql_fetch_array($sql_result))
	{	
		$Data = $row["DaNascimento"];
		$St = $row["STNinhadaInternacional"];

		if ($Data == '0000-00-00')
		{$Data = '';}
		else
		{$Data = FormatarDataTelaNinhada($Data);}
		
		
		echo("<tr>");

		if ($St == 0)
		{echo("<td></Td><td>$row[NuNinhada]</td><td>". $Data ."</td><td><a href=javascript:Editar1($row[IDNinhada])><img src='Imagens/Editar.gif' border=0></a></td>");}
		else
		{echo("<td></Td><td>$row[NuNinhada]</td><td>". $Data ."</td><td><a href=javascript:Editar2($row[IDNinhada])><img src='Imagens/Editar.gif' border=0></a></td>");}


		echo("<td><a href=javascript:Excluir($row[IDNinhada])><img src='Imagens/Excluir.gif' border=0></a></td>");

	
		
	}
	
	echo("</table>");
}



function EscreverFilhotesDaNinhada($IdNinhada)
{
	require("Conexao.php");
	$sql = "Select * From TBCachorro Where IdNinhada = " . $IdNinhada . " order by NuregistroNacional";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Form = "<table border=0 class=SemBorda>";
	$Form = $Form . "<tr>";
	$Form = $Form . "	<td>N&ordm; SBCPA</td>";
	$Form = $Form . "	<td>Nome</td>";
	$Form = $Form . "	<td>Sexo</td>";
	$Form = $Form . "	<td>CBKC</td>";
	$Form = $Form . "	<td>Tatuagem</td>";
	$Form = $Form . "	<td>Cor</td><td></td>";
	$Form = $Form . "</tr>";

	$Qtde = 1;
	$Elemento = 19;
	while ($row = mysql_fetch_array($sql_result))
	{	
		$Form = $Form . "  <tr>";
		$Form = $Form . "  <td><input type=hidden name=Id". $Qtde ." value='$row[IDCachorro]' disabled><input type=text name=NrSBCPA". $Qtde ." size=8 value='". str_replace("SBCPA ","",$row["NuRegistroNacional"]) ."' disabled></td>";
		$Form = $Form . "  <td><input type=text name=NoCachorro". $Qtde ." size=49 value='$row[NoCachorro]' disabled onKeyUp='PesquisarCachorroNome(this)'></td>";
		$Form = $Form . "  <td><select name=TPSexo". $Qtde ." disabled>";
		$Form = $Form . "		<option></option>";
		$Form = $Form . "		<option value=M>M</option>";
		$Form = $Form . "		<option value=F>F</option>";
		$Form = $Form . "	   </select></td>";
		$Form = $Form . "  <td><input type=text name=NrCBKC". $Qtde ." size=8 Value='$row[NuCBKC]' disabled></td>";
		$Form = $Form . "  <td><input type=text name=NoTatuagem". $Qtde ." size=8 Value='$row[NoTatuagem]' disabled></td>";
		$Form = $Form . "  <td>" . str_replace("<select","<select disabled",str_replace("IdCor","IdCor" . $Qtde,MontarCombo("Cor",55))) . "</td>";
		$Form = $Form . "  <td>";
		$Form = $Form . "<img id='Img". $Qtde ."' src=Imagens/Excluir.gif border=0 style='cursor: hand' OnClick='RetirarFilhoteCadastrado(". $Qtde .")'  alt='Retirar Filhote da Ninhada'>";
		$Form = $Form . "<img id='ImgImp". $Qtde ."' src=Imagens/Relatorio.gif border=0 style='cursor: hand' OnClick='ImprimirPedigree($row[IDCachorro])'  alt='Imprimir Pedigree'>";
		$Form = $Form . "</td>";
		$Form = $Form . "</tr>";
		$Form = $Form . "<script>";
		//17,23,29,35
		$Form = $Form . "	AtribuirObj(". $Qtde .",". $Elemento .");";
		//$Form = $Form . "	alert(document.Formulario.elements[". $Elemento ."].name);";
		$Form = $Form . "	document.Formulario.TPSexo". $Qtde .".value = '$row[TPSexo]';";
		$Form = $Form . "	document.Formulario.IdCor". $Qtde .".value = '$row[IdCor]';";
		$Form = $Form . "</script>";

		$Qtde = $Qtde + 1;
		$Elemento = $Elemento + 7;
	}
	
	$Form = $Form . "</table>";
	
	return $Form;
}



function ExcluirCachorrosNinhadaIdNinhada($Id)
{
	require("Conexao.php");

	$sql = "Delete From TBCachorro Where IDNinhada = $Id";
	$sql_result = mysql_query($sql,$Conn);

	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBNinhada";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);
}



function ExcluirNinhadaIdNinhada($Id)
{
	require("Conexao.php");

	$sql = "Delete From TBNinhada Where IdNinhada = $Id";
	$sql_result = mysql_query($sql,$Conn);

	$TpAcaoLog = "E";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBNinhada";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	ExcluirCachorrosNinhadaIdNinhada($Id);

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	echo("<script>window.location.href = 'Ninhada_Listar.php';</script>");
}

function AlterarNinhada($Id, $DaNascimento, $IDCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $NrAnoNinhada, $IDClube)
{
	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "0000-00-00";
	}

	$DtNascimentoOriginal = $DaNascimento;
	if ($DaNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DaNascimento);
		$DaNascimento = "$ano-$mes-$dia";
	}
	
	if ($IDClube == ""){
		$IDClube = "0";
	}

	$TxConsaguinidade = str_replace("|","$",$TxConsaguinidade);

	$sql = "UpDate TBNinhada Set DaNascimento = '$DaNascimento', IdCanil = $IDCanil, NrMachos = $NrMachos, NrMachosVivos = $NrMachosVivos, NrFemeas = $NrFemeas, NrFemeasVivas = $NrFemeasVivas, TxConsaguinidade = '$TxConsaguinidade', IdCachorroPai = $IDPai, IdCachorroMae = $IDMae, IDClube = $IDClube Where IdNinhada = $Id";
	//die($sql);
	$sql_result = mysql_query($sql,$Conn);

	$TpAcaoLog = "A";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBNinhada";
	//$DsAcaoLog = "$Id, $IdNinhada, $NrAnoNinhada, $DaNascimento, $IDCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	$Tam = substr_count($Filhotes,";");
	$v = split(";",$Filhotes);
	
		
	for($i=1; $i<=$Tam; $i++)
	{
		$DadosFilhote = str_replace("|",",",$v[$i]);
		$vCampos = split(",",$DadosFilhote);

		$NoNinhada = $Id;
		$NoPai = $IDPai;
		$NoMae = $IDMae;
		$DtNascimento = $DaNascimento;
		$NuRegistroNacional = $vCampos[0];
		$NuRegistroNacional = str_replace("SBCPA ","",$NuRegistroNacional);
		$NuRegistroNacional = "SBCPA " . $NuRegistroNacional;
		$NuCBKC = $vCampos[3];
		$NoTatuagem = $vCampos[4];
		$NoCachorro = $vCampos[1];
		$TPSexo = $vCampos[2];
		$IdCor = $vCampos[5];
		$IdCachorroNinhada = $vCampos[6];

		$IDProprietario = "";
		$NuRegistroInternacional  = "";
		$NuRegistroRegional  = "";
		$SgUFRegistro  = "";
		$IdRaioX  = "";
		$DtRaioX  = "";
		$IdAdestramento  = "";
		$DtProvaAdestramento = ""; 
		$IdSelecao  = "";
		$DtSelecao  = "";
		$IdQualificacaoCao  = "";
		$InResistencia  = "";
		$DtResistencia  = "";
		$DsObservacao  = "";

		if ($IdCachorroNinhada != '')
		{AlterarDadosCachorroNinhada($IdCachorroNinhada,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC);}
		else
		{
			if ($NoCachorro != ""){
				$DtNascimento = $DtNascimentoOriginal;
				CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao);
			}
		}
	}

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	//mysql_close($Conn);
	echo("<script>window.location.href = 'Ninhada_Formulario.php?Id=$IdRegistroLog';</script>");
}

function RecuperarUltimaNinhada($NrAnoNinhada)
{
	require("Conexao.php");
	//$Ano = date("Y");
	$Ano = $NrAnoNinhada;
	$Numero = 0;
	$NumeroNinhada = 0;

	$sql = "select Max(Left(NuNinhada,4)) + 1 as Maximo from tbninhada where right(nuninhada,4) = '$Ano' and STNinhadaInternacional = 0 Order By NuNinhada DESC";
	$sql_result = mysql_query($sql,$Conn);
	
	while ($row = mysql_fetch_array($sql_result))
	{	
		$Numero = $row["Maximo"];
	}


	$Dif = 4 - strlen($Numero);

	if ($Dif == 1) {$NumeroNinhada = '0' . $Numero;}
	if ($Dif == 2) {$NumeroNinhada = '00' . $Numero;}
	if ($Dif == 3) {$NumeroNinhada = '000' . $Numero;}

	if ($NumeroNinhada == 0){$NumeroNinhada = '0001';}

	$NumeroNinhada = $NumeroNinhada . $Ano;

	return $NumeroNinhada;
}



function RecuperarUltimaNinhadaEstrangeira()
{
	require("Conexao.php");
	$Ano = date("Y");
	$Numero = 0;
	$NumeroNinhada = 0;
	$NumeroNovo = 0;

	//$sql = "select Max(Left(NuNinhada,4)) + 1 as Maximo from tbninhada where right(nuninhada,4) = '$Ano' AND STNinhadaInternacional = 1 Order By NuNinhada DESC";
	$sql = "select NuNinhada from tbninhada where right(nuninhada,4) = '$Ano' AND STNinhadaInternacional = 1 Order By IdNinhada DESC LIMIT 1";
	$sql_result = mysql_query($sql,$Conn);
	
	while ($row = mysql_fetch_array($sql_result))
	{	
		$NumeroNovo = $row["NuNinhada"];
	}

	$NumeroNovo = str_replace("E","",$NumeroNovo);
	$NumeroNovo = str_replace($Ano,"",$NumeroNovo);
	$Numero = $NumeroNovo + 1;

	$Dif = 4 - strlen($Numero);

	if ($Dif == 1) {$NumeroNinhada = 'E' . $Numero;}
	if ($Dif == 2) {$NumeroNinhada = 'E0' . $Numero;}
	if ($Dif == 3) {$NumeroNinhada = 'E00' . $Numero;}

	if ($NumeroNinhada == ""){$NumeroNinhada = 'E001';}

	$NumeroNinhada = $NumeroNinhada . date("Y");

	return $NumeroNinhada;
	//return $Numero;
}


function CadastrarNinhada($DaNascimento, $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $NrAnoNinhada, $IDClube)
{
	//die($Filhotes);

	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "0000-00-00";
	}

	$DtNascimentoOriginal = $DaNascimento;

	$TxConsaguinidade = str_replace("|","$",$TxConsaguinidade);
	if ($DaNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DaNascimento);
		$DaNascimentoNovo = "$ano-$mes-$dia";
	}
	
	//die($DaNascimento);
	
	$NumeroNinhada = RecuperarUltimaNinhada($NrAnoNinhada);

	$sql = "Insert Into TBNinhada (NuNinhada, DaNascimento, IdCanil, NrMachos, NrMachosVivos, NrFemeas, NrFemeasVivas, TxConsaguinidade, IdCachorroPai, IdCachorroMae, IDClube) values ('$NumeroNinhada', '$DaNascimentoNovo', $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, '$TxConsaguinidade', $IDPai, $IDMae, $IDClube)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p><br>$sql");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBNinhada (IdNinhada, NuNinhada, DaNascimento, IdCanil, NrMachos, NrMachosVivos, NrFemeas, NrFemeasVivas, TxConsaguinidade, IdCachorroPai, IdCachorroMae) values ($IdRegistroLog, '$NumeroNinhada', '$DaNascimentoNovo', $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, '$TxConsaguinidade', $IDPai, $IDMae)";
	$NoTabelaLog = "TBNinhada";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	$Tam = substr_count($Filhotes,";");
	$v = split(";",$Filhotes);
	
		
	for($i=1; $i<=$Tam; $i++)
	{
		$DadosFilhote = str_replace("|",",",$v[$i]);
		$vCampos = split(",",$DadosFilhote);

		$NoNinhada = $IdRegistroLog;
		$NoPai = $IDPai;
		$NoMae = $IDMae;
		$IDCanil = $IdCanil;
		$DtNascimento = $DaNascimento;
		$NuRegistroNacional = $vCampos[0];
		$NuRegistroNacional = str_replace("SBCPA ","",$NuRegistroNacional);
		$NuRegistroNacional = "SBCPA " . $NuRegistroNacional;
		$NuCBKC = $vCampos[3];
		$NoTatuagem = $vCampos[4];
		$NoCachorro = $vCampos[1];
		$TPSexo = $vCampos[2];
		$IdCor = $vCampos[5];
		$IdCachorroNinhada = $vCampos[6];

		$IDProprietario = "";
		$NuRegistroInternacional  = "";
		$NuRegistroRegional  = "";
		$SgUFRegistro  = "";
		$IdRaioX  = "";
		$DtRaioX  = "";
		$IdAdestramento  = "";
		$DtProvaAdestramento = ""; 
		$IdSelecao  = "";
		$DtSelecao  = "";
		$IdQualificacaoCao  = "";
		$InResistencia  = "";
		$DtResistencia  = "";
		$DsObservacao  = "";
		
		if ($IdCachorroNinhada != '')
		{AlterarDadosCachorroNinhada($IdCachorroNinhada,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC);}
		else
		{
			$DtNascimento = $DtNascimentoOriginal;
			CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao);
		}
				
	}
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	//mysql_close($Conn);
	echo("<script>window.location.href = 'Ninhada_Formulario.php?Id=$IdRegistroLog';</script>");
}


function CadastrarNinhadaEstrangeira($DaNascimento, $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $IDClube)
{
	//die($Filhotes);

	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "0000-00-00";
	}

	$DtNascimentoOriginal = $DaNascimento;

	if ($DaNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DaNascimento);
		$DaNascimentoNovo = "$ano-$mes-$dia";
	}
	
	//die($DaNascimento);
	
	$NumeroNinhada = RecuperarUltimaNinhadaEstrangeira();

	$TxConsaguinidade = str_replace("|","$",$TxConsaguinidade);
	$sql = "Insert Into TBNinhada (NuNinhada, DaNascimento, IdCanil, NrMachos, NrMachosVivos, NrFemeas, NrFemeasVivas, TxConsaguinidade, IdCachorroPai, IdCachorroMae,STNinhadaInternacional, IDClube) values ('$NumeroNinhada', '$DaNascimentoNovo', $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, '$TxConsaguinidade', $IDPai, $IDMae,1, $IDClube)";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p><br>$sql");

	$TpAcaoLog = "I";
	$IdRegistroLog = mysql_insert_id();
	$sql = "Insert Into TBNinhada (IdNinhada, NuNinhada, DaNascimento, IdCanil, NrMachos, NrMachosVivos, NrFemeas, NrFemeasVivas, TxConsaguinidade, IdCachorroPai, IdCachorroMae,STNinhadaInternacional, IDClube) values ($IdRegistroLog,'$NumeroNinhada', '$DaNascimentoNovo', $IdCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, '$TxConsaguinidade', $IDPai, $IDMae,1, $IDClube)";
	$NoTabelaLog = "TBNinhada";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);


	$Tam = substr_count($Filhotes,";");
	$v = split(";",$Filhotes);
	
		
	for($i=1; $i<=$Tam; $i++)
	{
		$DadosFilhote = str_replace("|",",",$v[$i]);
		$vCampos = split(",",$DadosFilhote);

		$NoNinhada = $IdRegistroLog;
		$NoPai = $IDPai;
		$NoMae = $IDMae;
		$IDCanil = $IdCanil;
		$DtNascimento = $DaNascimento;
		$NuRegistroNacional = $vCampos[0];
		$NuRegistroNacional = str_replace("","",$NuRegistroNacional);
		$NuRegistroNacional = "" . $NuRegistroNacional;
		$NuCBKC = $vCampos[3];
		$NoTatuagem = $vCampos[4];
		$NoCachorro = $vCampos[1];
		$TPSexo = $vCampos[2];
		$IdCor = $vCampos[5];
		$IdCachorroNinhada = $vCampos[6];

		$IDProprietario = "";
		$NuRegistroInternacional  = "";
		$NuRegistroRegional  = "";
		$SgUFRegistro  = "";
		$IdRaioX  = "";
		$DtRaioX  = "";
		$IdAdestramento  = "";
		$DtProvaAdestramento = ""; 
		$IdSelecao  = "";
		$DtSelecao  = "";
		$IdQualificacaoCao  = "";
		$InResistencia  = "";
		$DtResistencia  = "";
		$DsObservacao  = "";
		
		if ($IdCachorroNinhada != '')
		{AlterarDadosCachorroNinhada($IdCachorroNinhada,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC);}
		else
		{
			$DtNascimento = $DtNascimentoOriginal;
			CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao);
		}
				
	}
	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	//mysql_close($Conn);
	die("<script>window.location.href = 'NinhadaEstrangeira_Formulario.php?Id=$IdRegistroLog';</script>");
}

function AlterarNinhadaEstrangeira($Id, $DaNascimento, $IDCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae, $Filhotes, $IDClube)
{
	require("Conexao.php");

	if ($DaNascimento == ""){
		$DaNascimento = "0000-00-00";
	}

	$DtNascimentoOriginal = $DaNascimento;

	if ($DaNascimento != ""){
		list ($dia, $mes, $ano) = split ('[/.-]', $DaNascimento);
		$DaNascimento = "$ano-$mes-$dia";
	}

	$TxConsaguinidade = str_replace("|","$",$TxConsaguinidade);
	$sql = "UpDate TBNinhada Set DaNascimento = '$DaNascimento', IdCanil = $IDCanil, NrMachos = $NrMachos, NrMachosVivos = $NrMachosVivos, NrFemeas = $NrFemeas, NrFemeasVivas = $NrFemeasVivas, TxConsaguinidade = '$TxConsaguinidade', IdCachorroPai = $IDPai, IdCachorroMae = $IDMae, IDClube = $IDClube Where IdNinhada = $Id";
	$sql_result = mysql_query($sql,$Conn);

	$TpAcaoLog = "A";
	$IdRegistroLog = "$Id";
	$NoTabelaLog = "TBNinhada";
	//$DsAcaoLog = "$Id, $IdNinhada, $NrAnoNinhada, $DaNascimento, $IDCanil, $NrMachos, $NrMachosVivos, $NrFemeas, $NrFemeasVivas, $TxConsaguinidade, $IDPai, $IDMae";
	$DsAcaoLog = str_replace("'","|",$sql);
	$DsAcaoLog = str_replace('"','',$DsAcaoLog);
	$SqlAcaoLog = "Insert into TBAcao (TpAcao,IdUsuario,IdRegistro,NoTabela,DsAcao,HrAcao,DtAcao) values ('$TpAcaoLog',$Usuario,$IdRegistroLog,'$NoTabelaLog','$DsAcaoLog','$Hora','$Data')";
	mysql_query($SqlAcaoLog,$Conn);

	$Tam = substr_count($Filhotes,";");
	$v = split(";",$Filhotes);
	
		
	for($i=1; $i<=$Tam; $i++)
	{
		$DadosFilhote = str_replace("|",",",$v[$i]);
		$vCampos = split(",",$DadosFilhote);

		$NoNinhada = $Id;
		$NoPai = $IDPai;
		$NoMae = $IDMae;
		$DtNascimento = $DaNascimento;
		$NuRegistroNacional = $vCampos[0];
		$NuRegistroNacional = str_replace("SBCPA ","",$NuRegistroNacional);
		$NuRegistroNacional = "" . $NuRegistroNacional;
		$NuCBKC = $vCampos[3];
		$NoTatuagem = $vCampos[4];
		$NoCachorro = $vCampos[1];
		$TPSexo = $vCampos[2];
		$IdCor = $vCampos[5];
		$IdCachorroNinhada = $vCampos[6];

		$IDProprietario = "";
		$NuRegistroInternacional  = "";
		$NuRegistroRegional  = "";
		$SgUFRegistro  = "";
		$IdRaioX  = "";
		$DtRaioX  = "";
		$IdAdestramento  = "";
		$DtProvaAdestramento = ""; 
		$IdSelecao  = "";
		$DtSelecao  = "";
		$IdQualificacaoCao  = "";
		$InResistencia  = "";
		$DtResistencia  = "";
		$DsObservacao  = "";
		
		if ($IdCachorroNinhada != '')
		{AlterarDadosCachorroNinhada($IdCachorroNinhada,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC);}
		else
		{
			$DtNascimento = $DtNascimentoOriginal;
			CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao);
		}
	}

	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	//mysql_close($Conn);
	die("<script>window.location.href = 'NinhadaEstrangeira_Formulario.php?Id=$IdRegistroLog';</script>");
}
?>