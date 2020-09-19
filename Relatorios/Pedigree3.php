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
$pdf->ezImage('/var/www/SIPA/Imagens/Frente_branca.jpg',0,1000,'width');

//-------------- LADO ESQUERDO DA PRIMEIRA PÁGINA -------------------------------------
/*
$pdf -> rectangle(25,645,560,180);
$pdf -> addText(250,810,12,'TRANSFERÊNCIAS','full');
$pdf -> addText(220,780,12,'PARA','full');
$pdf -> addText(390,780,12,'ASSINATURAS','full');
$pdf -> addText(30,763,12,'1ª - Em __/__/____     _______________________________     _______________________________','full');
$pdf -> addText(30,743,12,'2ª - Em __/__/____     _______________________________     _______________________________','full');
$pdf -> addText(30,723,12,'3ª - Em __/__/____     _______________________________     _______________________________','full');
$pdf -> addText(30,703,12,'4ª - Em __/__/____     _______________________________     _______________________________','full');
$pdf -> addText(30,683,12,'5ª - Em __/__/____     _______________________________     _______________________________','full');
$pdf -> addText(30,663,12,'6ª - Em __/__/____     _______________________________     _______________________________','full');


$pdf -> rectangle(25,15,560,620);
$pdf -> addText(199,620,12,'TÍTULOS - PROVAS - ANOTAÇÕES','full');
$pdf -> addText(234,605,10,'(Uso Exclusivo da SBCPA)','full');
$pdf -> addText(234,295,10,'(Uso Exclusivo das Filiadas)','full');
$pdf -> line(25,310,585,310);


//-------------- LADO DIREITO DA PRIMEIRA PÁGINA -------------------------------------
$pdf -> rectangle(620,15,560,810);

$pdf -> addText(760,800,20,'SOCIEDADE BRASILEIRA CÃES','full');
$pdf -> addText(805,777,20,'PASTORES ALEMÃES','full');
$pdf -> addText(870,756,20,'SBCPA','full');
$pdf -> addText(790,740,12,'CERTIFICADO DE REGISTRO DE ORIGEM','full');
$pdf -> addText(878,725,12,'(PEDIGREE)','full');



$pdf -> addJpegFromFile('../Imagens/SBCPA.jpg',765,480,272,227);

$pdf -> addJpegFromFile('../Imagens/FCI.jpg',660,470,90,89);
$pdf -> addJpegFromFile('../Imagens/CBKC.jpg',655,580,100,103);
$pdf -> addJpegFromFile('../Imagens/COAPA.jpg',1060,580,100,101);
$pdf -> addJpegFromFile('../Imagens/WUSV.jpg',1060,470,110,72);
*/

if (isset($_GET["Via"])) {
	$NuCBKC = "                                2ª VIA";
	$pdf -> addText(918,421,10,$NuCBKC,'full');
}

$PosLinhaInicialPagina1 = -9;
$PosLinhaInicialPagina2 = 280;

$LinhaAgora = 420 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$RegistroNacional,'full');
$pdf -> addText(898,$LinhaAgora,12,$NuCBKC,'full');
//$pdf -> addText(961,421,10,'_______________','full');

$LinhaAgora = 380 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$Nome,'full');
$LinhaAgora = 366 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$Sexo,'full');
$pdf -> addText(775,$LinhaAgora,12,$Cor,'full');

$LinhaAgora = 353 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$DataNascimento,'full');
$LinhaAgora = 341 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$Tatuagem,'full');
$LinhaAgora = 328 + $PosLinhaInicialPagina1;
$pdf -> addText(660,$LinhaAgora,12,$Microchip,'full');

$LinhaAgora = 380 + $PosLinhaInicialPagina1;
$pdf -> addText(910,$LinhaAgora,12,$Criador,'full');
$LinhaAgora = 366 + $PosLinhaInicialPagina1;
$pdf -> addText(910,$LinhaAgora,12,$Endereco,'full');
$LinhaAgora = 353 + $PosLinhaInicialPagina1;
$pdf -> addText(910,$LinhaAgora,12,$Cidade,'full');
$LinhaAgora = 341 + $PosLinhaInicialPagina1;
$pdf -> addText(910,$LinhaAgora,12,$Estado,'full');
$LinhaAgora = 328 + $PosLinhaInicialPagina1;
$pdf -> addText(910,$LinhaAgora,12,$Ninhada,'full');

/*
$pdf -> addText(700,420,10,'_______________','full');
$pdf -> addText(680,385,10,'______________________________________________','full');
$pdf -> addText(674,370,10,'____________________','full');
$pdf -> addText(800,370,10,'______________________','full');
$pdf -> addText(735,355,10,'___________________________________','full');
$pdf -> addText(695,340,10,'___________________________________________','full');
$pdf -> addText(695,325,10,'___________________________________________','full');
$pdf -> addText(958,385,10,'_________________________________________','full');
$pdf -> addText(963,370,10,'________________________________________','full');
$pdf -> addText(953,355,10,'__________________________________________','full');
$pdf -> addText(953,340,10,'__________________________________________','full');
$pdf -> addText(958,325,10,'_________________________________________','full');

$pdf -> addText(750,300,10,'Consangüinidade','full');
$pdf -> addText(650,282,10,'____________________________________________________','full');
$pdf -> addText(650,267,10,'____________________________________________________','full');
$pdf -> addText(650,252,10,'____________________________________________________','full');
$pdf -> addText(650,237,10,'____________________________________________________','full');
$pdf -> addText(650,222,10,'____________________________________________________','full');

$pdf -> addText(1020,300,10,'Irmãos','full');
$pdf -> addText(918,282,10,'_________________________________________________','full');
$pdf -> addText(918,267,10,'_________________________________________________','full');
$pdf -> addText(918,252,10,'_________________________________________________','full');
$pdf -> addText(918,237,10,'_________________________________________________','full');
$pdf -> addText(918,222,10,'_________________________________________________','full');
*/

//$pdf -> line(920,220,1160,220);

//$pdf -> addText(740,180,12,'Certificamos que os dados aqui constantes estão conforme os registros','full');
//$pdf -> addText(740,160,12,'do livro de origem da Sociedade Brasileira Cães Pastores Alemães','full');

$pdf -> addText(820,120,12,$DataImpressao,'full');

//$pdf -> addText(650,62,10,'____________________________________________________','full');
$LinhaAgora = 70 + $PosLinhaInicialPagina1;
$pdf -> addText(650,$LinhaAgora,12,$Presidente,'full');
//$pdf -> addText(750,38,10,'PRESIDENTE','full');

//$pdf -> addText(920,62,10,'________________________________________________','full');
$LinhaAgora = 70 + $PosLinhaInicialPagina1;
$pdf -> addText(900,$LinhaAgora,12,$Diretor,'full');
//$pdf -> addText(950,38,10,'DIRETOR DE REGISTRO GENEALÓGICO','full');

$PosLinhaInicial = $PosLinhaInicialPagina2;

$PosLinha = $PosLinhaInicial + $PosLinhaInicialPagina1 + 12;
$LarguraCao = 43;
$TexoRet = $TaxaConsaguinidade;
$Tam = substr_count($TexoRet,";");
$Valores = split(";",$TexoRet);
$Frase = "";
for ($i=0; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 15;
	$Frase = $Valores[$i];
	$pdf -> addText(685,$PosLinha,11,$Frase,'full');
}





$PosLinha = $PosLinhaInicial + $PosLinhaInicialPagina1 + 12;
$LarguraCao = 30;
$TexoRet = QuebraLinhaTexto($Irmaos,$LarguraCao);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 15;
	$Frase = $Valores[$i];
	$pdf -> addText(930,$PosLinha,11,$Frase,'full');
}

$pdf -> ezNewPage();

/*
//Linhas Verticais
$pdf -> line(25,810,25,40);
$pdf -> line(270,810,270,40);
$pdf -> line(593,810,593,40);
$pdf -> line(830,810,830,40);
$pdf -> line(1038,810,1038,40);


//Linhas Horizontais
$pdf -> line(25,810,1038,810);
$pdf -> line(25,425,1038,425);


$pdf -> line(270,617,1038,617);
$pdf -> line(270,233,1038,233);

$pdf -> line(593,714,1038,714);
$pdf -> line(593,520,1038,520);
$pdf -> line(593,330,1038,330);
$pdf -> line(593,136,1038,136);

$pdf -> line(830,761,1038,761);
$pdf -> line(830,666,1038,666);
$pdf -> line(830,569,1038,569);
$pdf -> line(830,471,1038,471);
$pdf -> line(830,379,1038,379);
$pdf -> line(830,281,1038,281);
$pdf -> line(830,185,1038,185);
$pdf -> line(830,87,1038,87);

$pdf -> line(25,40,1038,40);



$pdf -> addText(100,820,14,'I Grau - PAIS','full');
$pdf -> addText(400,820,14,'II Grau - AVÓS','full');
$pdf -> addText(650,820,14,'III Grau - BISAVÓS','full');
$pdf -> addText(860,820,14,'IV Grau - TRISAVÓS','full');
$pdf -> addText(435,13,18,'PASTOR ALEMÃO - AMIZADE E PROTEÇÃO','full');

$pdf -> addText(1075,798,12,'CONVENÇÕES','full');
$pdf -> addText(1090,505,12,'SELEÇÃO','full');
$pdf -> addText(1095,362,12,'DNA','full');
$pdf -> addText(1044,220,11,'CONTROLE DE DISPLASIA','full');


$pdf -> rectangle($LinhaConvencoes,523,137,287);
$pdf -> rectangle($LinhaConvencoes,379,137,140);
$pdf -> rectangle($LinhaConvencoes,235,137,140);
$pdf -> rectangle($LinhaConvencoes,40,137,190);

$pdf -> addText($ColunaConvencoes,785,8,'CP - Capa Preta','full');
$pdf -> addText($ColunaConvencoes,775,8,'C - Cinza','full');
$pdf -> addText($ColunaConvencoes,765,8,'P - Preto','full');
$pdf -> addText($ColunaConvencoes,755,8,'PLN - Pelagem Normal','full');
$pdf -> addText($ColunaConvencoes,745,8,'PLL - Pelagem Longa','full');
$pdf -> addText($ColunaConvencoes,735,8,'"A" - Isento de Displasia','full');
$pdf -> addText($ColunaConvencoes,725,8,'+ - Selecionado','full');
$pdf -> addText($ColunaConvencoes,715,8,'CL - Classe','full');
$pdf -> addText($ColunaConvencoes,705,8,'CTA - Cão de Trabalho Nível A','full');
$pdf -> addText($ColunaConvencoes,695,8,'CT1 - Cão de Trabalho Nível 1 (SCH I)','full');
$pdf -> addText($ColunaConvencoes,685,8,'CT2 - Cão de Trabalho Nível 2 (SCH II)','full');
$pdf -> addText($ColunaConvencoes,675,8,'CT3 - Cão de Trabalho Nível 3 (SCH III)','full');
$pdf -> addText($ColunaConvencoes,665,8,'CF1 - Cão de Faro Nível 1 (FH 1)','full');
$pdf -> addText($ColunaConvencoes,655,8,'CF2 - Cão de Faro Nível 2 (FH 2)','full');
$pdf -> addText($ColunaConvencoes,645,8,'CF3 - Cão de Faro Nível 3 (FH 3)','full');
$pdf -> addText($ColunaConvencoes,635,8,'VA - Super Excelente','full');
$pdf -> addText($ColunaConvencoes,625,8,'V - Excelente','full');
$pdf -> addText($ColunaConvencoes,615,8,'SG - Muito Bom','full');
$pdf -> addText($ColunaConvencoes,605,8,'G - Bom','full');

$pdf -> addText($ColunaConvencoes-5,595,8,'Rosa - Pais selecionados','full');
$pdf -> addText($ColunaConvencoes-5,585,8,'Azul - Pai ou Mãe selecionado','full');
$pdf -> addText($ColunaConvencoes-5,575,8,'Branco - Pais Não selecionados','full');
*/
//--------------- Pai -------------------------------------
//$Tam = strlen($SumulaPai)/$LarguraPais;
//$Tam++;
$TexoRet = QuebraLinhaTexto($SumulaPai,$LarguraPais);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = 505 + $PosLinhaInicial;
$pdf -> addText($ColunaPais,$PosLinha,8,"$NomePai",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaPais,$PosLinha,8,RetornarInformacoesCao($IdPai),'full');
if ($SumulaPai != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaPais,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaPais,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 10;
$pdf -> addText($ColunaPais,$PosLinha,8,"$JuizPai",'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaPais,$PosLinha,8,"IRMÃOS:",'full');
$LarguraPais = $LarguraPais + 5;
$TexoRet = QuebraLinhaTexto($IrmaosPai,$LarguraPais);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaPais,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}

//--------------- Mae -------------------------------------
$TexoRet = QuebraLinhaTexto($SumulaMae,$LarguraMaes);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = 115 + $PosLinhaInicial;
$pdf -> addText($ColunaMaes,$PosLinha,8,"$NomeMae",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaMaes,$PosLinha,8,RetornarInformacoesCao($IdMae),'full');
if ($SumulaMae != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaMaes,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaMaes,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaMaes,$PosLinha,8,"$JuizMae",'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaMaes,$PosLinha,8,"IRMÃOS:",'full');
$LarguraMaes = $LarguraMaes + 5;
$TexoRet = QuebraLinhaTexto($IrmaosMae,$LarguraMaes);
$Tam = substr_count($TexoRet,"]");

$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaMaes,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}


//--------------- Avo 1 -------------------------------------
$TexoRet = QuebraLinhaTexto($SumulaAvo1,$LarguraAvo1);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = 505 + $PosLinhaInicial;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"$NomeAvo1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo1,$PosLinha,8,RetornarInformacoesCao($IdAvoMPai),'full');
if ($SumulaAvo1 != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaAvo1,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 12;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"$JuizAvo1",'full');
$PosLinha = $PosLinha;
//$pdf -> addText($ColunaAvo1,$PosLinha,8,"IRMÃOS:",'full');
$LarguraAvo1 = $LarguraAvo1;
$TexoRet = QuebraLinhaTexto($IrmaosAvo1,$LarguraAvo1);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}

//--------------- Avo 2 -------------------------------------
$TexoRet = QuebraLinhaTexto($SumulaAvo2,$LarguraAvo2);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = 310 + $PosLinhaInicial;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"$NomeAvo2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo2,$PosLinha,8,RetornarInformacoesCao($IdAvoFPai),'full');

if ($SumulaAvo2 != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaAvo2,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 12;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"$JuizAvo2",'full');
$PosLinha = $PosLinha;
//$pdf -> addText($ColunaAvo2,$PosLinha,8,"IRMÃOS:",'full');
$LarguraAvo2 = $LarguraAvo2;
$TexoRet = QuebraLinhaTexto($IrmaosAvo2,$LarguraAvo2);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}

//--------------- Avo 3 -------------------------------------
$TexoRet = QuebraLinhaTexto($SumulaAvo3,$LarguraAvo3);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = 118 + $PosLinhaInicial;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"$NomeAvo3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo3,$PosLinha,8,RetornarInformacoesCao($IdAvoMMae),'full');
if ($SumulaAvo3 != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaAvo3,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 12;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"$JuizAvo3",'full');
$PosLinha = $PosLinha;
//$pdf -> addText($ColunaAvo3,$PosLinha,8,"IRMÃOS:",'full');
$LarguraAvo3 = $LarguraAvo3;
$TexoRet = QuebraLinhaTexto($IrmaosAvo3,$LarguraAvo3);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}


//--------------- Avo 4 -------------------------------------
$TexoRet = QuebraLinhaTexto($SumulaAvo4,$LarguraAvo4);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$PosLinha = $PosLinhaInicial - 75;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"$NomeAvo4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo4,$PosLinha,8,RetornarInformacoesCao($IdAvoFMae),'full');
if ($SumulaAvo4 != "")
{
	$PosLinha = $PosLinha - 20;
	$pdf -> addText($ColunaAvo4,$PosLinha,8,"SÚMULA:",'full');
}
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 12;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"$JuizAvo4",'full');
$PosLinha = $PosLinha;
//$pdf -> addText($ColunaAvo4,$PosLinha,8,"IRMÃOS:",'full');
$LarguraAvo4 = $LarguraAvo4;
$TexoRet = QuebraLinhaTexto($IrmaosAvo4,$LarguraAvo4);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}


//--------------- BisAvo 1 -------------------------------------
$PosLinha = $PosLinhaInicial + 505;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,"$NomeBisAvo1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,RetornarInformacoesCao($IdBisAvoM1Pai),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo1,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo1 = $LarguraBisAvo1 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo1,$LarguraBisAvo1);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 2 -------------------------------------
$PosLinha = $PosLinhaInicial + 410;
$pdf -> addText($ColunaBisAvo2,$PosLinha,8,"$NomeBisAvo2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo2,$PosLinha,8,RetornarInformacoesCao($IdBisAvoF1Pai),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo2,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo2 = $LarguraBisAvo2 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo2,$LarguraBisAvo2);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 3 -------------------------------------
$PosLinha = 313 + $PosLinhaInicial;
$pdf -> addText($ColunaBisAvo3,$PosLinha,8,"$NomeBisAvo3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo3,$PosLinha,8,RetornarInformacoesCao($IdBisAvoM2Pai),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo3,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo3 = $LarguraBisAvo3 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo3,$LarguraBisAvo3);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/

//--------------- BisAvo 4 -------------------------------------
$PosLinha = 217 + $PosLinhaInicial;
$pdf -> addText($ColunaBisAvo4,$PosLinha,8,"$NomeBisAvo4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,RetornarInformacoesCao($IdBisAvoF2Pai),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo4,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo4 = $LarguraBisAvo4 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo4,$LarguraBisAvo4);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 5 -------------------------------------
$PosLinha = 121 + $PosLinhaInicial;
$pdf -> addText($ColunaBisAvo5,$PosLinha,8,"$NomeBisAvo5",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo5,$PosLinha,8,RetornarInformacoesCao($IdBisAvoM1Mae),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo5,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo5 = $LarguraBisAvo5 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo5,$LarguraBisAvo5);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo5,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 6 -------------------------------------
$PosLinha = $PosLinhaInicial + 25;
$pdf -> addText($ColunaBisAvo6,$PosLinha,8,"$NomeBisAvo6",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo6,$PosLinha,8,RetornarInformacoesCao($IdBisAvoF1Mae),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo6,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo6 = $LarguraBisAvo6 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo6,$LarguraBisAvo6);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo6,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 7 -------------------------------------
$PosLinha = $PosLinhaInicial - 73;
$pdf -> addText($ColunaBisAvo7,$PosLinha,8,"$NomeBisAvo7",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo7,$PosLinha,8,RetornarInformacoesCao($IdBisAvoM2Mae),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo7,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo7 = $LarguraBisAvo7 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo7,$LarguraBisAvo7);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo7,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/
//--------------- BisAvo 8 -------------------------------------
$PosLinha = $PosLinhaInicial - 167;
$pdf -> addText($ColunaBisAvo8,$PosLinha,8,"$NomeBisAvo8",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,RetornarInformacoesCao($IdBisAvoF2Mae),'full');
$PosLinha = $PosLinha - 20;
//$pdf -> addText($ColunaBisAvo8,$PosLinha,8,"IRMÃOS:",'full');
/*
$LarguraBisAvo8 = $LarguraBisAvo8 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo8,$LarguraBisAvo8);
$Tam = substr_count($TexoRet,"]");
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo8,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
	$PosLinha = $PosLinha - 12;
}
*/

//--------------- TrisAvo 1 -------------------------------------
$PosLinha = $PosLinhaInicial + 505;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM1Pai),'full');

//--------------- TrisAvo 2 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF1Pai),'full');

//--------------- TrisAvo 3 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM2Pai),'full');

//--------------- TrisAvo 4 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF2Pai),'full');

//--------------- TrisAvo 5 -------------------------------------
$PosLinha = $PosLinha - 30;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM3Pai),'full');

//--------------- TrisAvo 6 -------------------------------------
$PosLinha = $PosLinha - 29;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF3Pai),'full');

//--------------- TrisAvo 7 -------------------------------------
$PosLinha = $PosLinha - 30;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM4Pai),'full');

//--------------- TrisAvo 8 -------------------------------------
$PosLinha = $PosLinha - 31;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF4Pai),'full');

//--------------- TrisAvo 9 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM5",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM1Mae),'full');

//--------------- TrisAvo 10 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF5",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF1Mae),'full');

//--------------- TrisAvo 11 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM6",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM2Mae),'full');

//--------------- TrisAvo 12 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF6",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF2Mae),'full');

//--------------- TrisAvo 13 -------------------------------------
$PosLinha = $PosLinha - 27;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM7",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM3Mae),'full');

//--------------- TrisAvo 14 -------------------------------------
$PosLinha = $PosLinha - 28;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF7",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF3Mae),'full');

//--------------- TrisAvo 15 -------------------------------------
$PosLinha = $PosLinha - 30;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoM8",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoM4Mae),'full');

//--------------- TrisAvo 16 -------------------------------------
$PosLinha = $PosLinha - 30;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,"$NomeTriAvoF8",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaTriAvoM1,$PosLinha,8,RetornarInformacoesCao($IdTriAvoF4Mae),'full');

function zQuebraLinhaTexto($Texto,$Largura)
{
	$RetornarTexto = "";
	$Linha = "";

	$Texto = trim($Texto);


	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");

	for($i=0; $i<=$Tam; $i++)
	{
		if ($i != 0)
		{
			if (substr($v[$i-1],strlen($v[$i-1])-1) == ".")
			{$v[$i] = FormatarTextoMaiusculo($v[$i]);}
		}

		$Linha = $Linha . $v[$i] . " ";

		if (strlen($Linha) > $Largura)
		{
			$RetornarTexto = $RetornarTexto . $Linha . "<br>";
			$Linha = "";
		}
	}
	if (strlen($Linha) < $Largura)
	{
			$RetornarTexto = $RetornarTexto . $Linha . "<br>";
			$Linha = "";
	}


	return trim($RetornarTexto);
}


function zzQuebraLinhaTexto($Texto,$Largura)
{
	$RetornarTexto = "";
	$tam = strlen($Texto) / $Largura;
	$tam++;

	$i=1;
	$Inicio = 0;
	$Fim = $Largura;

	do
	{
		$RealValor = $Largura;

		for ($j=1; $j<=30; $j++)
		{
			$TextoPrevia = substr($Texto,$Inicio+$Largura+$j,1);
			if ($TextoPrevia == " ")
			{
				$RealValor = $Largura + $j;
				$Diferenca = $j;
				$j = 30;
			}
		}

		$RetornarTexto = $RetornarTexto ."]". substr($Texto,$Inicio,$RealValor);
		$Inicio = $Inicio + $RealValor + 1;
		$Fim = $Fim + $RealValor;

		$i++;
	}while($i<=$tam);

	/*if (substr($RetornarTexto,strlen($RetornarTexto)-1) == "]")
	{
		$RetornarTexto = substr($RetornarTexto,0,strlen($RetornarTexto)-1);
	}
	*/
	return $RetornarTexto;
}



function QuebraLinhaTexto($Texto,$Largura)
{
	$RetornarTexto = "";
	$Linha = "";

	$Texto = trim($Texto);
	$Texto = str_replace("M.b","Mb",$Texto);
	$Texto = str_replace("M.B","Mb",$Texto);
	$Texto = str_replace("Mb.","Mb",$Texto);
	$Texto = str_replace("MB.","Mb",$Texto);
	$Texto = str_replace("M.b.","Mb",$Texto);
	$Texto = str_replace("M.B.","Mb",$Texto);
	$Texto = str_replace("m.b","Mb",$Texto);
	$Texto = str_replace("m.b","Mb",$Texto);
	$Texto = str_replace("mb.","Mb",$Texto);
	$Texto = str_replace("mb.","Mb",$Texto);
	$Texto = str_replace("m.b.","Mb",$Texto);
	$Texto = str_replace("m.b.","Mb",$Texto);

	$Texto = str_replace(", ",",",$Texto);
	$Texto = str_replace(",",", ",$Texto);
	$Texto = str_replace(". ",".",$Texto);
	$Texto = str_replace(".",". ",$Texto);
	$Texto = str_replace("- ","",$Texto);

	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");

	for($i=0; $i<=$Tam; $i++)
	{
		if ($i != 0)
		{
			if (substr($v[$i-1],strlen($v[$i-1])-1) == ".")
			{$v[$i] = RelFormatarTextoMaiusculo($v[$i]);}
		}

		$Linha = $Linha . $v[$i] . " ";

		if (strlen($Linha) > $Largura)
		{
			$RetornarTexto = $RetornarTexto . $Linha . "]";
			$Linha = "";
		}
	}
	if (strlen($Linha) < $Largura)
	{
			$RetornarTexto = $RetornarTexto . $Linha . "]";
			$Linha = "";
	}

	$RetornarTexto = "]" . $RetornarTexto;
	return trim($RetornarTexto);
}

function RelFormatarTextoMaiusculo($Texto)
{
	$v = split(" ",$Texto);
	$Tam = substr_count($Texto," ");
	$Retorno = "";

	for($i=0; $i<=$Tam; $i++)
	{
		$palavra = strtolower($v[$i]);

		if (strlen($palavra) > 2)
		{
			$parte1 = mb_strtoupper(substr($palavra,0,1));
			$parte2 = strtolower(substr($palavra,1));

			$palavra = $parte1 . $parte2;
		}

		$Retorno = $Retorno ." ". $palavra;
	}
	return trim($Retorno);
}


//$pdf->setEncryption('','$Senha',array('print'));

$pdf -> ezStream();
