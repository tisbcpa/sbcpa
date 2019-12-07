<?php 
//$IdCachorro = 268;
//$IdCachorro = 33626;
//$IdCachorro = 28530;

$IdPai = $_GET["IdPai"];
$IdMae = $_GET["IdMae"];

//$IdPai = 9587;
//$IdMae = 24964;


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


function RetornarDadosCao($Id)
{
	require("Funcoes/Conexao.php");
	$Retorno = ",,,";
	
	if ($Id != "")
	{
		$query = "Select a.NoCachorro,a.NuRegistroNacional,a.IdCachorroPai,a.IDCachorroMae,b.InSelecao From TBCachorro as a Left Join TBSelecao as b On a.IdSelecao = b.IdSelecao Where a.IDCachorro = " . $Id;
		$result = mysql_query($query) or die("Erro: " . mysql_error());
		while ($row = mysql_fetch_array($result))
		{
			$Retorno = "$row[NoCachorro],$row[NuRegistroNacional],$row[IdCachorroPai],$row[IDCachorroMae]";
		}
	}

	return $Retorno;
}


//list($NoCachorro,$SBCPACachorro,$IdPai,$IdMae) = split(",",RetornarDadosCao($IdCachorro));

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

$t = "<ROOT>";
//	$t = $t . '<row Id="1" Nome="'. str_replace("´","*",$NoCachorro) .'" Tipo="P" Grau=""/>';
	$t = $t . '<row Id="2" Nome="'. $NoPai .'" Tipo="P" Grau="I" />';
	$t = $t . '<row Id="3" Nome="'. $NoMae .'" Tipo="M" Grau="I" />';
	$t = $t . '<row Id="4" Nome="'. $NoAvoMPai .'" Tipo="P" Grau="II" />';
	$t = $t . '<row Id="5" Nome="'. $NoAvoFPai .'" Tipo="P" Grau="II" />';
	$t = $t . '<row Id="6" Nome="'. $NoAvoMMae .'" Tipo="M" Grau="II" />';
	$t = $t . '<row Id="7" Nome="'. $NoAvoFMae .'" Tipo="M" Grau="II" />';	
	$t = $t . '<row Id="8" Nome="'. $NoBisAvoM1Pai .'" Tipo="P" Grau="III" />';
	$t = $t . '<row Id="9" Nome="'. $NoBisAvoF1Pai .'" Tipo="P" Grau="III" />';
	$t = $t . '<row Id="10" Nome="'. $NoBisAvoM2Pai .'" Tipo="P" Grau="III" />';
	$t = $t . '<row Id="11" Nome="'. $NoBisAvoF2Pai .'" Tipo="P" Grau="III" />';
	$t = $t . '<row Id="12" Nome="'. $NoBisAvoM1Mae .'" Tipo="M" Grau="III" />';
	$t = $t . '<row Id="13" Nome="'. $NoBisAvoF1Mae .'" Tipo="M" Grau="III" />';
	$t = $t . '<row Id="14" Nome="'. $NoBisAvoM2Mae .'" Tipo="M" Grau="III" />';
	$t = $t . '<row Id="15" Nome="'. $NoBisAvoF2Mae .'" Tipo="M" Grau="III" />';
	$t = $t . '<row Id="16" Nome="'. $NoTriAvoM1Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="17" Nome="'. $NoTriAvoF1Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="18" Nome="'. $NoTriAvoM2Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="19" Nome="'. $NoTriAvoF2Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="20" Nome="'. $NoTriAvoM3Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="21" Nome="'. $NoTriAvoF3Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="22" Nome="'. $NoTriAvoM4Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="23" Nome="'. $NoTriAvoF4Pai .'" Tipo="P" Grau="IV" />';
	$t = $t . '<row Id="24" Nome="'. $NoTriAvoM1Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="25" Nome="'. $NoTriAvoF1Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="26" Nome="'. $NoTriAvoM2Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="27" Nome="'. $NoTriAvoF2Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="28" Nome="'. $NoTriAvoM3Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="29" Nome="'. $NoTriAvoF3Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="30" Nome="'. $NoTriAvoM4Mae .'" Tipo="M" Grau="IV" />';
	$t = $t . '<row Id="31" Nome="'. $NoTriAvoF4Mae .'" Tipo="M" Grau="IV" />';
$t = $t . "</ROOT>";

	echo(utf8_encode(str_replace("'","´",$t)));

?>