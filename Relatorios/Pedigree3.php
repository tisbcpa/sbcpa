<?php
include('../Funcoes/Relatorios/class.ezpdf.php');
//$IdCachorro = 38658;

$IdCachorro = $_GET["Id"];

require("DadosCaes3.php");


if (isset($_GET["Data"]))
{
	$d = $_GET["Data"];
	list ($dia, $mes, $ano) = split ('[/.-]', $d);
	$t = $mes + 0;
	//die("Total: " .  $t);
	$DataImpressao = "Brasília-DF, " . $dia ." de ". RetornarMesExtenso($t) ." de ". $ano;	 //'Brasília-DF, 10 de Setembro de 2004';
}
else
{
	$DataImpressao = "Brasília-DF, " . date("d") ." de ". RetornarMesExtenso(date("m")) ." de ". date("Y"); //'Brasília-DF, 10 de Setembro de 2004';
}


	$TamanhoLetraSumula = 6;
	$Irmaos = RetornarIrmaos($IdCachorro);
	
	//echo($Irmaos);
	//die();
	
	//----------------------------------------------------------------------------------------
	$LarguraPais = 50;
	$ColunaPais = 30;
	$NomePai = mb_strtoupper("$NoPai");
	list($SumulaPai,$JuizPai) = split(";",DadosSumula($IdPai));
	if ($SumulaPai == ""){ $SumulaPai = "";}
	if ($JuizPai != ""){ $JuizPai = "JUIZ: " . $JuizPai;}
	$IrmaosPai = RetornarIrmaos($IdPai);
	if ($IrmaosPai != ''){$IrmaosPai = "IRMÃOS: ". $IrmaosPai;}

	$LarguraMaes = $LarguraPais;
	$ColunaMaes = $ColunaPais;
	$NomeMae = mb_strtoupper("$NoMae");
	list($SumulaMae,$JuizMae) = split(";",DadosSumula($IdMae));
	if ($SumulaMae == ""){ $SumulaMae = "";}
	if ($JuizMae != ""){ $JuizMae = "JUIZ: " . $JuizMae;}
	$IrmaosMae = RetornarIrmaos($IdMae);
	if ($IrmaosMae != ''){$IrmaosMae = "IRMÃOS: ". $IrmaosMae;}
	
	
	$LarguraAvo1 = 78;
	$ColunaAvo1 = 268;
	$NomeAvo1 = mb_strtoupper("$NoAvoMPai");
	list($SumulaAvo1,$JuizAvo1) = split(";",DadosSumula($IdAvoMPai));
	if ($SumulaAvo1 == ""){ $SumulaAvo1 = "";}
	if ($JuizAvo1 != ""){ $JuizAvo1 = "JUIZ: " . $JuizAvo1;}
	$IrmaosAvo1 = RetornarIrmaos($IdAvoMPai);
	if ($IrmaosAvo1 != ''){$IrmaosAvo1 = "IRMÃOS: ". $IrmaosAvo1;}
		
	$LarguraAvo2 = $LarguraAvo1;
	$ColunaAvo2 = $ColunaAvo1;
	$NomeAvo2 = mb_strtoupper("$NoAvoFPai");
	list($SumulaAvo2,$JuizAvo2) = split(";",DadosSumula($IdAvoFPai));
	if ($SumulaAvo2 == ""){ $SumulaAvo2 = "";}
	if ($JuizAvo2 != ""){ $JuizAvo2 = "JUIZ: " . $JuizAvo2;}
	$IrmaosAvo2 = RetornarIrmaos($IdAvoFPai);
	if ($IrmaosAvo2 != ''){$IrmaosAvo2 = "IRMÃOS: ". $IrmaosAvo2;}	
	
	$LarguraAvo3 = $LarguraAvo1;
	$ColunaAvo3 = $ColunaAvo1;
	$NomeAvo3 = mb_strtoupper("$NoAvoMMae");
	list($SumulaAvo3,$JuizAvo3) = split(";",DadosSumula($IdAvoMMae));
	if ($SumulaAvo3 == ""){ $SumulaAvo3 = "";}
	if ($JuizAvo3 != ""){ $JuizAvo3 = "JUIZ: " . $JuizAvo3;}
	$IrmaosAvo3 = RetornarIrmaos($IdAvoMMae);
	if ($IrmaosAvo3 != ''){$IrmaosAvo3 = "IRMÃOS: ". $IrmaosAvo3;}

	$LarguraAvo4 = $LarguraAvo1;
	$ColunaAvo4 = $ColunaAvo1;
	$NomeAvo4 = mb_strtoupper("$NoAvoFMae");
	list($SumulaAvo4,$JuizAvo4) = split(";",DadosSumula($IdAvoFMae));
	if ($SumulaAvo4 == ""){ $SumulaAvo4 = "";}
	if ($JuizAvo4 != ""){ $JuizAvo4 = "JUIZ: " . $JuizAvo4;}
	$IrmaosAvo4 = RetornarIrmaos($IdAvoFMae);
	if ($IrmaosAvo4 != ''){$IrmaosAvo4 = "IRMÃOS: ". $IrmaosAvo4;}

	$LarguraBisAvo1 = 55;
	$ColunaBisAvo1 = 605;
	$NomeBisAvo1 = mb_strtoupper("$NoBisAvoM1Pai");
	$IrmaosBisAvo1 = RetornarIrmaos($IdBisAvoM1Pai);
	if ($IrmaosBisAvo1 != ''){$IrmaosBisAvo1 = "IRMÃOS: ". $IrmaosBisAvo1;}

	$LarguraBisAvo2 = $LarguraBisAvo1;
	$ColunaBisAvo2 = $ColunaBisAvo1;
	$NomeBisAvo2 = mb_strtoupper("$NoBisAvoF1Pai");
	$IrmaosBisAvo2 = RetornarIrmaos($IdBisAvoF1Pai);
	if ($IrmaosBisAvo2 != ''){$IrmaosBisAvo2 = "IRMÃOS: ". $IrmaosBisAvo2;}

	$LarguraBisAvo3 = $LarguraBisAvo1;
	$ColunaBisAvo3 = $ColunaBisAvo1;
	$NomeBisAvo3 = mb_strtoupper("$NoBisAvoM2Pai");
	$IrmaosBisAvo3 = RetornarIrmaos($IdBisAvoM2Pai);
	if ($IrmaosBisAvo3 != ''){$IrmaosBisAvo3 = "IRMÃOS: ". $IrmaosBisAvo3;}

	$LarguraBisAvo4 = $LarguraBisAvo1;
	$ColunaBisAvo4 = $ColunaBisAvo1;
	$NomeBisAvo4 = mb_strtoupper("$NoBisAvoF2Pai");
	$IrmaosBisAvo4 = RetornarIrmaos($IdBisAvoF2Pai);
	if ($IrmaosBisAvo4 != ''){$IrmaosBisAvo4 = "IRMÃOS: ". $IrmaosBisAvo4;}

	$LarguraBisAvo5 = $LarguraBisAvo1;
	$ColunaBisAvo5 = $ColunaBisAvo1;
	$NomeBisAvo5 = mb_strtoupper("$NoBisAvoM1Mae");
	$IrmaosBisAvo5 = RetornarIrmaos($IdBisAvoM1Mae);
	if ($IrmaosBisAvo5 != ''){$IrmaosBisAvo5 = "IRMÃOS: ". $IrmaosBisAvo5;}

	$LarguraBisAvo6 = $LarguraBisAvo1;
	$ColunaBisAvo6 = $ColunaBisAvo1;
	$NomeBisAvo6 = mb_strtoupper("$NoBisAvoF1Mae");
	$IrmaosBisAvo6 = RetornarIrmaos($IdBisAvoF1Mae);
	if ($IrmaosBisAvo6 != ''){$IrmaosBisAvo6 = "IRMÃOS: ". $IrmaosBisAvo6;}
	
	$LarguraBisAvo7 = $LarguraBisAvo1;
	$ColunaBisAvo7 = $ColunaBisAvo1;
	$NomeBisAvo7 = mb_strtoupper("$NoBisAvoM2Mae");
	$IrmaosBisAvo7 = RetornarIrmaos($IdBisAvoM2Mae);
	if ($IrmaosBisAvo7 != ''){$IrmaosBisAvo7 = "IRMÃOS: ". $IrmaosBisAvo7;}

	$LarguraBisAvo8 = $LarguraBisAvo1;
	$ColunaBisAvo8 = $ColunaBisAvo1;
	$NomeBisAvo8 = mb_strtoupper("$NoBisAvoF2Mae");
	$IrmaosBisAvo8 = RetornarIrmaos($IdBisAvoF2Mae);
	if ($IrmaosBisAvo8 != ''){$IrmaosBisAvo8 = "IRMÃOS: ". $IrmaosBisAvo8;}

	$ColunaTriAvoM1 = 833;
	$NomeTriAvoM1 = mb_strtoupper("$NoTriAvoM1Pai");
	$NomeTriAvoF1 = mb_strtoupper("$NoTriAvoF1Pai");
	$NomeTriAvoM2 = mb_strtoupper("$NoTriAvoM2Pai");
	$NomeTriAvoF2 = mb_strtoupper("$NoTriAvoF2Pai");
	$NomeTriAvoM3 = mb_strtoupper("$NoTriAvoM3Pai");
	$NomeTriAvoF3 = mb_strtoupper("$NoTriAvoF3Pai");
	$NomeTriAvoM4 = mb_strtoupper("$NoTriAvoM4Pai");
	$NomeTriAvoF4 = mb_strtoupper("$NoTriAvoF4Pai");

	$NomeTriAvoM5 = mb_strtoupper("$NoTriAvoM1Mae");
	$NomeTriAvoF5 = mb_strtoupper("$NoTriAvoF1Mae");
	$NomeTriAvoM6 = mb_strtoupper("$NoTriAvoM2Mae");
	$NomeTriAvoF6 = mb_strtoupper("$NoTriAvoF2Mae");
	$NomeTriAvoM7 = mb_strtoupper("$NoTriAvoM3Mae");
	$NomeTriAvoF7 = mb_strtoupper("$NoTriAvoF3Mae");
	$NomeTriAvoM8 = mb_strtoupper("$NoTriAvoM4Mae");
	$NomeTriAvoF8 = mb_strtoupper("$NoTriAvoF4Mae");

$ColunaConvencoes = 1045;
$LinhaConvencoes = 1043;
//$options['img']= array(
//	'../Imagens/frente_pedigree.png' => array('obj'=>1)
//);

$pdf =& new Cezpdf('a3','landscape');
$pdf -> selectFont('../Funcoes/Relatorios/fonts/Times-Roman.afm');
$pdf->ezImage('/var/www/SIPA/Imagens/frente_pedigree.png');


$pdf -> ezStream();
