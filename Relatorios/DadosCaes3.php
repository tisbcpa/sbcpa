<?php 
//$IdCachorro = 268;
//$IdCachorro = 38658;
//$IdCachorro = 15546;

$NoCachorro = "";
$NoPai = "";
$NoAvoMPai = "";
$NoBisAvoM1Pai = "";
$NoTriAvoM1Pai = "";
$NoTriAvoF1Pai = "";
$NoBisAvoF1Pai = "";
$NoTriAvoM2Pai = "";
$NoTriAvoF2Pai = "";
$NoAvoFPai = "";
$NoBisAvoM2Pai = "";
$NoTriAvoM3Pai = "";
$NoTriAvoF3Pai = "";
$NoBisAvoF2Pai = "";
$NoTriAvoM4Pai = "";
$NoTriAvoF4Pai = "";
$NoMae = "";
$NoAvoMMae = "";
$NoBisAvoM1Mae = "";
$NoTriAvoM1Mae = "";
$NoTriAvoF1Mae = "";
$NoBisAvoF1Mae = "";
$NoTriAvoM2Mae = "";
$NoTriAvoF2Mae = "";
$NoAvoFMae = "";
$NoBisAvoM2Mae = "";
$NoTriAvoM3Mae = "";
$NoTriAvoF3Mae = "";
$NoBisAvoF2Mae = "";
$NoTriAvoM4Mae = "";
$NoTriAvoF4Mae = "";



function RetornarMesExtenso($num)
{
	switch($num)
	{
		case 1: return "Janeiro"; break;
		case 2:	return "Fevereiro";	break;
		case 3:	return "Março";	break;
		case 4:	return "Abril";	break;
		case 5:	return "Maio";	break;
		case 6:	return "Junho";	break;
		case 7:	return "Julho";	break;
		case 8:	return "Agosto"; break;
		case 9:	return "Setembro"; break;
		case 10: return "Outubro"; break;
		case 11: return "Novembro"; break;
		case 12: return "Dezembro"; break;
	}
}

function RetornarDadosCao($Id)
{
	require("../Funcoes/Conexao.php");
	$Retorno = ",,,";
	
	if ($Id != "")
	{
		$query = "Select a.NoCachorro,a.NuRegistroNacional,a.IdCachorroPai,a.IDCachorroMae,b.InSelecao From TBCachorro as a Left Join TBSelecao as b On a.IdSelecao = b.IdSelecao Where a.IDCachorro = " . $Id;
		$result = mysql_query($query) or die("Erro1: " . mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			if ($row["InSelecao"] == 1)
			{$Retorno = "+ $row[NoCachorro],$row[NuRegistroNacional],$row[IdCachorroPai],$row[IDCachorroMae]";}
			else
			{$Retorno = "$row[NoCachorro],$row[NuRegistroNacional],$row[IdCachorroPai],$row[IDCachorroMae]";}
		}
	}


	return $Retorno;
}


function DadosSumula($Id)
{
	require("../Funcoes/Conexao.php");
	$Retorno = ";";
	
	if ($Id != "")
	{
		$Ano = date("Y");
		$query = "select a.DSSumula, b.NoJuiz from (tbsumula as a left join tbjuiz as b on a.idjuiz = b.idjuiz) left join tbcachorro as c on a.idcachorro = c.idcachorro where (year(c.DaSelecao) >= ". $Ano ." or c.DaSelecao = '00/00/000' or c.DaSelecao is Null) and  a.idcachorro = " . $Id;
		//$query = "select a.DSSumula, b.NoJuiz from tbsumula as a left join tbjuiz as b on a.idjuiz = b.idjuiz where idcachorro = " . $Id;
		$result = mysql_query($query) or die("Erro2: " . mysql_error());
		while ($row = mysql_fetch_array($result))
		{$Retorno = trim($row["DSSumula"]) . ";$row[NoJuiz]";} //. trim($row["DSSumulaReselecao"]) . ";$row[NoJuizReselecao]";}
	}

	return $Retorno;
}
/*
function RetornarIrmaos($Id)
{
	require("../Funcoes/Conexao.php");
	$Retorno = "";
	
	if ($Id != "")
	{		
		$query = "Select * From TBCachorro Where IDCachorro = " . $Id;
		$result = mysql_query($query) or die("Erro3: " . mysql_error());
		while ($row = mysql_fetch_array($result)){
			$IDNinhadaZ = $row["IdNinhada"];
		}

		if ($IDNinhadaZ != ""){
			$query1 = "Select * From TBCachorro Where IDNinhada = " . $IDNinhadaZ;
			$result1 = mysql_query($query1) or die("Erro3: " . $query1);
			while ($row1 = mysql_fetch_array($result1)){
				if ($Retorno != "")
				{
					$Retorno = $Retorno . ", ";
				}
							
				$v = split(" ",$row1["NoCachorro"]);
				$Retorno = $Retorno . FormatarTextoMaiusculo($v[0]);		
			}
		}
	}

	$Retorno = str_replace("Sudameris_","",$Retorno);
	$Retorno = str_replace("_"," ",$Retorno);
	$Retorno = FormatarTextoMaiusculo($Retorno);
	return $Retorno;
}
*/


function RetornarIrmaos($Id)
{
	require("../Funcoes/Conexao.php");
	$Retorno = "";
	
	if ($Id != "")
	{		
		$query = "Select * From TBCachorro Where IDNinhada in (Select a.IDNinhada From TBCachorro as a inner join TBNinhada as b On a.IDNinhada = b.IDNinhada Where a.IDCachorro = " . $Id . ") and IDCachorro <> " . $Id;
		$result = mysql_query($query) or die("Erro3: " . mysql_error());
				
		while ($row = mysql_fetch_array($result)){
			if ($Retorno != ""){
				$Retorno = $Retorno . ", ";
			}
						
			//$v = split(" ",$row["NoCachorro"]);
			$v = split(" ",$row["NoCachorro"]);

			//$Retorno = $Retorno . PrimeiroNome($row["NoCachorro"]);
			$Retorno = $Retorno . " " . FormatarTextoMaiusculo($v[0]);
		}
	}

	/*
	$Retorno = str_replace("Sudameris_","",$Retorno);
	$Retorno = str_replace("_"," ",$Retorno);
	*/
	//$Retorno = FormatarTextoMaiusculo($Retorno);
	//$Retorno = $query;
	return $Retorno;
}

function PrimeiroNome($Nome){
	$v = split(" ",$Nome);
	return $v[0];
}


function RetornarTitularCargo($IdUsuario)
{
	require("../Funcoes/Conexao.php");
	$query = "Select DsUsuario From TBUsuario Where IdUsuario = $IdUsuario";
	$result = mysql_query($query) or die("Erro4: " . mysql_error());

	while ($row = mysql_fetch_array($result))
	{return "$row[DsUsuario]";}
}


function RetornarTaxaConsaguinidade($IdCachorro)
{
	require("../Funcoes/Conexao.php");
	$query = "Select TxConsaguinidade From TBNinhada Where IdNinhada in (Select IDNinhada From TBCachorro Where IdCachorro = $IdCachorro)";
	$result = mysql_query($query) or die("Erro5: " . mysql_error());

	while ($row = mysql_fetch_array($result))
	{
		//return FormatarTextoMaiusculo($row["TxConsaguinidade"]);
		return $row["TxConsaguinidade"];
	}
}

function RetornarTodasInformacoesCao($Id)
{
	require("../Funcoes/Conexao.php");
	$query = "Select a.NoCachorro,a.NuRegistroNacional,a.TPSexo,b.DsCor,a.DaNascimento,a.NoTatuagem,c.NoProprietarioCanil,c.EdCanil,c.NoCidade,d.NOUF,e.NuNinhada, a.NuCBKC, e.STNinhadaInternacional,a.NrMicrochip From (((TBCachorro as a left join TBCor as b on a.IdCor = b.IdCor) left join TBCanil as c on a.IdCanil = c.IdCanil) Left Join TBUF as d on c.SgUF = d.SGUF) Left Join TBNinhada as e On e.IdNinhada = a.IdNinhada Where a.IDCachorro = " . $Id;
	$result = mysql_query($query) or die("Erro6: " . mysql_error());
	while ($row = mysql_fetch_array($result))
	{$Retorno = "$row[NoCachorro];$row[NuRegistroNacional];$row[TPSexo];$row[DsCor];$row[DaNascimento];$row[NoTatuagem];$row[NoProprietarioCanil];$row[EdCanil];$row[NoCidade];$row[NOUF];$row[NuNinhada];$row[NuCBKC];$row[STNinhadaInternacional];$row[NrMicrochip]";}

	return $Retorno;
}

function RetornarInformacoesCao($Id)
{
	$Retorno = " ";

	if ($Id != "")
	{
	require("../Funcoes/Conexao.php");
	$query = "Select e.NoQualificacaoCao, a.NuRegistroNacional, b.NoSelecao, c.NoRaioX, d.NoAdestramento, a.NoTatuagem, a.DaSelecao, a.TPSexo From (((TBCachorro as a left join TBSelecao as b on a.IdSelecao = b.IdSelecao) Left Join TBRaioX as c on a.IdRaioX = c.IdRaioX) left join TBAdestramento as d on a.IDAdestramento = d.IDAdestramento) left join TBQualificacaoCao as e On a.IdQualificacaoCao = e.IdQualificacaoCao Where a.IDCachorro = $Id";

	$result = mysql_query($query) or die("Erro7: " . $query);
	while ($row = mysql_fetch_array($result))
	{
		$Retorno = "$row[NuRegistroNacional]    ";

		/*
		if (DadosSumula($Id) != ";")
		{$Retorno = $Retorno . "$row[NoSelecao]   ";}
		*/
		
		if ($row["NoSelecao"] != "")
		{
			$data = date("Y") ."-". date("m") ."-". date("d");

			if (($row["NoSelecao"] == "RESEL 1") || ($row["NoSelecao"] == "RESEL 2"))
			{
				$Retorno = $Retorno . "$row[NoSelecao]   ";
			}
			else
			{
				if ($data < $row["DaSelecao"]) 
				{$Retorno = $Retorno . "$row[NoSelecao]   ";}
				else
				{
					if ($row["TPSexo"] == 'F')
					{$Retorno = $Retorno . "$row[NoSelecao]   ";}
					else
					{
						if (($row["DaSelecao"] == "0001-01-01") || ($row["DaSelecao"] == ""))
						{$Retorno = $Retorno . "$row[NoSelecao]   ";}				
					}
				}
			}
		}
		
		$Retorno = $Retorno . "$row[NoAdestramento]";

		if ($row["NoQualificacaoCao"] != "")
		{
			$Retorno = $Retorno . "      $row[NoQualificacaoCao]";
		}

		if ($row["NoRaioX"] != "")
		{
			$Retorno = $Retorno . "      RX: $row[NoRaioX]"; 	//Tat.: $row[NoTatuagem]
		}
	}
	}
	return $Retorno;
}

function FormatarTextoMaiusculo($Texto)
{
	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");
	$Retorno = ""; 
	
	for($i=0; $i<=$Tam; $i++)
	{
		$palavra = strtolower($v[$i]);
	
		if (strlen($palavra) > 2)
		{
			$parte1 = strtoupper(substr($palavra,0,1));
			$parte2 = strtolower(substr($palavra,1));
			
			$palavra = $parte1 . $parte2;
		}
		
		$Retorno = $Retorno ." ". $palavra;
	}
	return trim($Retorno);
}

$Valores = split(";",RetornarTodasInformacoesCao($IdCachorro));
$Sexo = $Valores[2];
$Sexo = str_replace("M","MACHO",$Sexo);
$Sexo = str_replace("F","FÊMEA",$Sexo);
$DtNascimento = $Valores[4];
if ($DtNascimento != "")
{
	list ($ano, $mes, $dia) = split ('[/.-]', $DtNascimento);
	$DtNascimento = "$dia/$mes/$ano";
}

$RegistroNacional = 'Nº SBCPA: ' . str_replace("SBCPA","",strtoupper($Valores[1]));
//$RegistroNacional = '                  ' . str_replace("SBCPA","",strtoupper($Valores[1]));
$Nome = 'Nome:  ' . mb_strtoupper($Valores[0]);
//$RNome = str_replace("_"," ",$Valores[0]);
//$Nome = '           ' . strtoupper($RNome);
$Sexo = 'Sexo: ' . $Sexo;
//$Sexo = '        ' . $Sexo;
$DataNascimento = 'Data de Nascimento: ' . $DtNascimento;
//$DataNascimento = '                                   ' . $DtNascimento;
$Cor = 'Cor: ' . strtoupper($Valores[3]);
//$Cor = '         ' . strtoupper($Valores[3]);
$Tatuagem = 'Tatuagem: ' . strtoupper($Valores[5]);
//$Tatuagem = '                 ' . strtoupper($Valores[5]);
$Microchip = 'Microchip: ' . $Valores[13];
//$Microchip = '                  ' . $Valores[13];
//$Microchip = '  ' . $Valores[13];

$Criador = 'Criador:  ' . mb_strtoupper(utf8_encode($Valores[6]));
//$Criador = '             ' . strtoupper($Valores[6]);
$Endereco = 'Endereço:  '. mb_strtoupper(utf8_encode($Valores[7]));
//$Endereco = '                '. strtoupper($Valores[7]);
$Cidade = 'Cidade: ' . str_replace("'","´",mb_strtoupper(utf8_encode($Valores[8])));
//$Cidade = '             ' . str_replace("NÃO INFORMADO","",strtoupper($Valores[8]));
$Estado = 'Estado:  ' . mb_strtoupper(utf8_encode($Valores[9]));
//$Estado = '             ' . str_replace("ESTRANGEIRO","",strtoupper($Valores[9]));
//$Ninhada = 'Ninhada: ' . $Valores[10];

if ($Valores[12] == 0)
{
	//$Ninhada = '              ' . $Valores[10];
	$Ninhada = 'Ninhada: ' . $Valores[10];
}
else
{
	//$Ninhada = '                -' ;
	$Ninhada = 'Ninhada: -';
}

//$Data = 'Data de Registro: '; // . '12/08/2004';
$Data = '';
$NuCBKC = 'N° CBKC: ' . $Valores[11];

$Presidente = RetornarTitularCargo(3);//RetornarTitularCargo("PRESIDENTE");
$Diretor = RetornarTitularCargo(2);//RetornarTitularCargo("DIRETOR DE REGISTRO GENEALÓGICO");
$TaxaConsaguinidade = RetornarTaxaConsaguinidade($IdCachorro);
$TaxaConsaguinidade = str_replace("$",",",$TaxaConsaguinidade);
$TaxaConsaguinidade = str_replace(", ",",",$TaxaConsaguinidade);

list($NoCachorro,$SBCPACachorro,$IdPai,$IdMae) = split(",",RetornarDadosCao($IdCachorro));

list($NoPai,$SBCPAPai,$IdAvoMPai,$IdAvoFPai) = split(",",RetornarDadosCao($IdPai));
 list($NoAvoMPai,$SBCPAAvoMPai,$IdBisAvoM1Pai,$IdBisAvoF1Pai) = split(",",RetornarDadosCao($IdAvoMPai));
   list($NoBisAvoM1Pai,$SBCPABisAvoM1Pai,$IdTriAvoM1Pai,$IdTriAvoF1Pai) = split(",",RetornarDadosCao($IdBisAvoM1Pai));
     list($NoTriAvoM1Pai,$SBCPATriAvoM1Pai) = split(",",RetornarDadosCao($IdTriAvoM1Pai));
	 list($NoTriAvoF1Pai,$SBCPATriAvoF1Pai) = split(",",RetornarDadosCao($IdTriAvoF1Pai));
   list($NoBisAvoF1Pai,$SBCPABisAvoF1Pai,$IdTriAvoM2Pai,$IdTriAvoF2Pai) = split(",",RetornarDadosCao($IdBisAvoF1Pai));
     list($NoTriAvoM2Pai,$SBCPATriAvoM2Pai) = split(",",RetornarDadosCao($IdTriAvoM2Pai));
	 list($NoTriAvoF2Pai,$SBCPATriAvoF2Pai) = split(",",RetornarDadosCao($IdTriAvoF2Pai));
 list($NoAvoFPai,$SBCPAAvoFPai,$IdBisAvoM2Pai,$IdBisAvoF2Pai) = split(",",RetornarDadosCao($IdAvoFPai));
   list($NoBisAvoM2Pai,$SBCPABisAvoM2Pai,$IdTriAvoM3Pai,$IdTriAvoF3Pai) = split(",",RetornarDadosCao($IdBisAvoM2Pai));
     list($NoTriAvoM3Pai,$SBCPATriAvoM3Pai) = split(",",RetornarDadosCao($IdTriAvoM3Pai));
	 list($NoTriAvoF3Pai,$SBCPATriAvoF3Pai) = split(",",RetornarDadosCao($IdTriAvoF3Pai));
   list($NoBisAvoF2Pai,$SBCPABisAvoF2Pai,$IdTriAvoM4Pai,$IdTriAvoF4Pai) = split(",",RetornarDadosCao($IdBisAvoF2Pai));
     list($NoTriAvoM4Pai,$SBCPATriAvoM4Pai) = split(",",RetornarDadosCao($IdTriAvoM4Pai));
	 list($NoTriAvoF4Pai,$SBCPATriAvoF4Pai) = split(",",RetornarDadosCao($IdTriAvoF4Pai));

list($NoMae,$SBCPAMae,$IdAvoMMae,$IdAvoFMae) = split(",",RetornarDadosCao($IdMae));
 list($NoAvoMMae,$SBCPAAvoMMae,$IdBisAvoM1Mae,$IdBisAvoF1Mae) = split(",",RetornarDadosCao($IdAvoMMae));
   list($NoBisAvoM1Mae,$SBCPABisAvoM1Mae,$IdTriAvoM1Mae,$IdTriAvoF1Mae) = split(",",RetornarDadosCao($IdBisAvoM1Mae));
     list($NoTriAvoM1Mae,$SBCPATriAvoM1Mae) = split(",",RetornarDadosCao($IdTriAvoM1Mae));
	 list($NoTriAvoF1Mae,$SBCPATriAvoF1Mae) = split(",",RetornarDadosCao($IdTriAvoF1Mae));
   list($NoBisAvoF1Mae,$SBCPABisAvoF1Mae,$IdTriAvoM2Mae,$IdTriAvoF2Mae) = split(",",RetornarDadosCao($IdBisAvoF1Mae));
     list($NoTriAvoM2Mae,$SBCPATriAvoM2Mae) = split(",",RetornarDadosCao($IdTriAvoM2Mae));
	 list($NoTriAvoF2Mae,$SBCPATriAvoF2Mae) = split(",",RetornarDadosCao($IdTriAvoF2Mae));
 list($NoAvoFMae,$SBCPAAvoFMae,$IdBisAvoM2Mae,$IdBisAvoF2Mae) = split(",",RetornarDadosCao($IdAvoFMae));
   list($NoBisAvoM2Mae,$SBCPABisAvoM2Mae,$IdTriAvoM3Mae,$IdTriAvoF3Mae) = split(",",RetornarDadosCao($IdBisAvoM2Mae));
     list($NoTriAvoM3Mae,$SBCPATriAvoM3Mae) = split(",",RetornarDadosCao($IdTriAvoM3Mae));
	 list($NoTriAvoF3Mae,$SBCPATriAvoF3Mae) = split(",",RetornarDadosCao($IdTriAvoF3Mae));
   list($NoBisAvoF2Mae,$SBCPABisAvoF2Mae,$IdTriAvoM4Mae,$IdTriAvoF4Mae) = split(",",RetornarDadosCao($IdBisAvoF2Mae));
     list($NoTriAvoM4Mae,$SBCPATriAvoM4Mae) = split(",",RetornarDadosCao($IdTriAvoM4Mae));
	 list($NoTriAvoF4Mae,$SBCPATriAvoF4Mae) = split(",",RetornarDadosCao($IdTriAvoF4Mae));

/*
echo("<strong>Cachorro:</strong> $NoCachorro,$SBCPACachorro,$IdPai,$IdMae <br><br>");

echo("&nbsp;&nbsp;<strong>Pai:</strong> $NoPai,$SBCPAPai,$IdAvoMPai,$IdAvoFPai<br>");
	echo("&nbsp;&nbsp;&nbsp;&nbsp;<strong>Avô Paterno:</strong> $NoAvoMPai,$SBCPAAvoMPai,$IdBisAvoM1Pai,$IdBisAvoF1Pai<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvô Paterno:</strong> $NoBisAvoM1Pai,$SBCPABisAvoM1Pai,$IdTriAvoM1Pai,$IdTriAvoF1Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Paterno:</strong> $NoTriAvoM1Pai,$SBCPATriAvoM1Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Paterno:</strong> $NoTriAvoF1Pai,$SBCPATriAvoF1Pai<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvó Paterna:</strong> $NoBisAvoF1Pai,$SBCPABisAvoF1Pai,$IdTriAvoM2Pai,$IdTriAvoF2Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Paterno:</strong> $NoTriAvoM2Pai,$SBCPATriAvoM2Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Paterno:</strong> $NoTriAvoF2Pai,$SBCPATriAvoF2Pai<br>");
	echo("&nbsp;&nbsp;&nbsp;&nbsp;<strong>Avó Paterna:</strong> $NoAvoFPai,$SBCPAAvoFPai,$IdBisAvoM2Pai,$IdBisAvoF2Pai<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvô Paterno:</strong> $NoBisAvoM2Pai,$SBCPABisAvoM2Pai,$IdTriAvoM3Pai,$IdTriAvoF3Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Paterno:</strong> $NoTriAvoM3Pai,$SBCPATriAvoM3Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Paterno:</strong> $NoTriAvoF3Pai,$SBCPATriAvoF3Pai<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvó Paterna:</strong> $NoBisAvoF2Pai,$SBCPABisAvoF2Pai,$IdTriAvoM4Pai,$IdTriAvoF4Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Paterno:</strong> $NoTriAvoM4Pai,$SBCPATriAvoM4Pai<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Paterno:</strong> $NoTriAvoF4Pai,$SBCPATriAvoF4Pai<br>");

echo("<br>");

echo("&nbsp;&nbsp;<strong>Mae:</strong> $NoMae,$SBCPAMae,$IdAvoMMae,$IdAvoFMae <br>");
	echo("&nbsp;&nbsp;&nbsp;&nbsp;<strong>Avô Materno:</strong> $NoAvoMMae,$SBCPAAvoMMae,$IdBisAvoM1Mae,$IdBisAvoF1Mae<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvô Materno:</strong> $NoBisAvoM1Mae,$SBCPABisAvoM1Mae,$IdTriAvoM1Mae,$IdTriAvoF1Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Materno:</strong> $NoTriAvoM1Mae,$SBCPATriAvoM1Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Materna:</strong> $NoTriAvoF1Mae,$SBCPATriAvoF1Mae<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvó Materna:</strong> $NoBisAvoF1Mae,$SBCPABisAvoF1Mae,$IdTriAvoM2Mae,$IdTriAvoF2Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Materno:</strong> $NoTriAvoM2Mae,$SBCPATriAvoM2Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Materna:</strong> $NoTriAvoF2Mae,$SBCPATriAvoF2Mae<br>");
	echo("&nbsp;&nbsp;&nbsp;&nbsp;<strong>Avó Materna:</strong> $NoAvoFMae,$SBCPAAvoFMae,$IdBisAvoM2Mae,$IdBisAvoF2Mae<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvô Materno:</strong> $NoBisAvoM2Mae,$SBCPABisAvoM2Mae,$IdTriAvoM3Mae,$IdTriAvoF3Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Materno:</strong> $NoTriAvoM3Mae,$SBCPATriAvoM3Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Materna:</strong> $NoTriAvoF3Mae,$SBCPATriAvoF3Mae<br>");
		echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BisAvó Materna:</strong> $NoBisAvoF2Mae,$SBCPABisAvoF2Mae,$IdTriAvoM4Mae,$IdTriAvoF4Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvô Materno:</strong> $NoTriAvoM4Mae,$SBCPATriAvoM4Mae<br>");
			echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>TrisAvó Materna:</strong> $NoTriAvoF4Mae,$SBCPATriAvoF4Mae<br>");
*/
?>
