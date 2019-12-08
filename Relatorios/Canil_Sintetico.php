<?php
include('../Funcoes/Relatorios/class.ezpdf.php');

require("DadosCaes.php");
/*
$link = mysql_connect("localhost","root","")	or die("Não foi possível conectar: " . mysql_error());
mysql_select_db("sbcpa") or die("Não foi possível selecionar o banco.");

$query = "Select * From TBCachorro Group By SgUF;";
$result = mysql_query($query) or die("Erro: " . mysql_error());
$Soma = 0;
while ($row = mysql_fetch_array($result))
{
	$Nome = $row["NoCachorro"];
	$Total = $row["Total"];
	$Soma = $Soma + $Total;


}
*/

	$DataImpressao = ''; //'Brasília-DF, 10 de Setembro de 2004';
	$RegistroNacional = 'Nº SBCPA: '; //. "SBCPA 1234";
	$Nome = 'Nome:  '; //. "GIZE DO BARÃO DE ARARIBE";
	$Sexo = 'Sexo: '; //. "FÊMEA";
	$DataNascimento = 'Data de Nascimento: ';// . "25/04/1996";
	$Cor = 'Cor: '; // . "CAPA PRETA";
	$Tatuagem = 'Tatuagem: '; // . "UPE 0496";
	$Microchip = 'Microchip: ';

	$Criador = 'Criador:  '; // . "PILATOS FERREIRA DA SILVA";
	$Endereco = 'Endereço:  '; // . "AV. BELMIRO CORREIA Nº 412";
	$Cidade = 'Cidade: '; // . "CAMARAGIBE";
	$Estado = 'Estado:  '; // . "PERNAMBUCO";
	$Ninhada = 'Ninhada: '; // . "094";
	$Data = 'Data de Registro: '; // . '12/08/2004';
	$Presidente = ""; //"                   Francisco Sampaio de Carvalho";
	$Diretor = ""; //"                 Celso Roberto Machado Pinto";
	$TamanhoLetraSumula = 8;
	
	//----------------------------------------------------------------------------------------
	$LarguraPais = 55;
	$ColunaPais = 30;
	$NomePai = strtoupper("$NoPai");
	list($SumulaPai,$JuizPai) = split(";",DadosSumula($IdPai));
	if ($JuizPai != ""){ $JuizPai = "JUIZ: " . $JuizPai;}
	$IrmaosPai = RetornarIrmaos($IdPai);

	$LarguraMaes = $LarguraPais;
	$ColunaMaes = $ColunaPais;
	$NomeMae = strtoupper("$NoMae");
	list($SumulaMae,$JuizMae) = split(";",DadosSumula($IdMae));
	if ($JuizMae != ""){ $JuizMae = "JUIZ: " . $JuizMae;}
	$IrmaosMae = RetornarIrmaos($IdMae);	
	
	$LarguraAvo1 = 80;
	$ColunaAvo1 = 275;
	$NomeAvo1 = strtoupper("$NoAvoMPai");
	list($SumulaAvo1,$JuizAvo1) = split(";",DadosSumula($IdAvoMPai));
	if ($JuizAvo1 != ""){ $JuizAvo1 = "JUIZ: " . $JuizAvo1;}
	$IrmaosAvo1 = RetornarIrmaos($IdAvoMPai);
	
	$LarguraAvo2 = $LarguraAvo1;
	$ColunaAvo2 = $ColunaAvo1;
	$NomeAvo2 = strtoupper("$NoAvoFPai");
	list($SumulaAvo2,$JuizAvo2) = split(";",DadosSumula($IdAvoFPai));
	if ($JuizAvo2 != ""){ $JuizAvo2 = "JUIZ: " . $JuizAvo2;}
	$IrmaosAvo2 = RetornarIrmaos($IdAvoFPai);
	
	$LarguraAvo3 = $LarguraAvo1;
	$ColunaAvo3 = $ColunaAvo1;
	$NomeAvo3 = strtoupper("Odin de Isla Bonita");
	$SumulaAvo3 = "Macho, medianamente forte. Boa cabeza. Muito boa pigmentação. Ligeiramente alargado. Cernelha alta Dorso firme. Boa posição de garupa, algo curta. Boas angulações dianteiras, muito boa a posterior. Frente correta. Caminha correto visto de tras e de frente. Bon alcance. Boa linha inferior. Carater firme, dureza, corajem e espírito de luta pronunciados. Não larga sob comando.";
	$JuizAvo3 = "Celso Roberto Machado Pinto";
	$IrmaosAvo3 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraAvo4 = $LarguraAvo1;
	$ColunaAvo4 = $ColunaAvo1;
	$NomeAvo4 = strtoupper("Odin de Isla Bonita");
	$SumulaAvo4 = "Macho, medianamente forte. Boa cabeza. Muito boa pigmentação. Ligeiramente alargado. Cernelha alta Dorso firme. Boa posição de garupa, algo curta. Boas angulações dianteiras, muito boa a posterior. Frente correta. Caminha correto visto de tras e de frente. Bon alcance. Boa linha inferior. Carater firme, dureza, corajem e espírito de luta pronunciados. Não larga sob comando.";
	$JuizAvo4 = "Celso Roberto Machado Pinto";
	$IrmaosAvo4 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";



	$LarguraBisAvo1 = 60;
	$ColunaBisAvo1 = 595;
	$NomeBisAvo1 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo1 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo2 = 60;
	$ColunaBisAvo2 = 595;
	$NomeBisAvo2 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo2 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo3 = 60;
	$ColunaBisAvo3 = 595;
	$NomeBisAvo3 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo3 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo4 = 60;
	$ColunaBisAvo4 = 595;
	$NomeBisAvo4 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo4 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo5 = 60;
	$ColunaBisAvo5 = 595;
	$NomeBisAvo5 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo5 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo6 = 60;
	$ColunaBisAvo6 = 595;
	$NomeBisAvo6 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo6 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo7 = 60;
	$ColunaBisAvo7 = 595;
	$NomeBisAvo7 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo7 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";

	$LarguraBisAvo8 = 60;
	$ColunaBisAvo8 = 595;
	$NomeBisAvo8 = strtoupper("Odin de Isla Bonita");
	$IrmaosBisAvo8 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";


$pdf =& new Cezpdf('a3','landscape');
$pdf -> selectFont('../Funcoes/Relatorios/fonts/Times-Roman.afm');


//-------------- LADO ESQUERDO DA PRIMEIRA PÁGINA -------------------------------------
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




$pdf -> addText(650,420,10,$RegistroNacional,'full');
$pdf -> addText(700,420,10,'_______________','full');

$pdf -> addText(650,385,10,$Nome,'full');
$pdf -> addText(680,385,10,'______________________________________________','full');
$pdf -> addText(650,370,10,$Sexo,'full');
$pdf -> addText(674,370,10,'____________________','full');
$pdf -> addText(780,370,10,$Cor,'full');
$pdf -> addText(800,370,10,'______________________','full');
$pdf -> addText(650,355,10,$DataNascimento,'full');
$pdf -> addText(735,355,10,'___________________________________','full');
$pdf -> addText(650,340,10,$Tatuagem,'full');
$pdf -> addText(695,340,10,'___________________________________________','full');
$pdf -> addText(650,325,10,$Microchip,'full');
$pdf -> addText(695,325,10,'___________________________________________','full');


$pdf -> addText(920,385,10,$Criador,'full');
$pdf -> addText(958,385,10,'_________________________________________','full');
$pdf -> addText(920,370,10,$Endereco,'full');
$pdf -> addText(963,370,10,'________________________________________','full');
$pdf -> addText(920,355,10,$Cidade,'full');
$pdf -> addText(953,355,10,'__________________________________________','full');
$pdf -> addText(920,340,10,$Estado,'full');
$pdf -> addText(953,340,10,'__________________________________________','full');
$pdf -> addText(920,325,10,$Ninhada,'full');
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

//$pdf -> line(920,220,1160,220);

$pdf -> addText(740,180,12,'Certificamos que os dados aqui constantes estão conforme os registros','full');
$pdf -> addText(740,160,12,'do livro de origem da Sociedade Brasileira Cães Pastores Alemães','full');

$pdf -> addText(830,120,12,$DataImpressao,'full');

$pdf -> addText(650,62,10,'____________________________________________________','full');
$pdf -> addText(650,50,12,$Presidente,'full');
$pdf -> addText(750,38,10,'PRESIDENTE','full');

$pdf -> addText(920,62,10,'________________________________________________','full');
$pdf -> addText(920,50,12,$Diretor,'full');
$pdf -> addText(950,38,10,'DIRETOR DE REGISTRO GENEALÓGICO','full');

$pdf -> ezNewPage();

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

$ColunaConvencoes = 1045;
$LinhaConvencoes = 1043;
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



//--------------- Pai -------------------------------------
$Tam = strlen($SumulaPai)/$LarguraPais;
$Tam++;
$TexoRet = QuebraLinhaTexto($SumulaPai,$LarguraPais);
$Valores = split("]",$TexoRet);
$PosLinha = 800;
$pdf -> addText($ColunaPais,$PosLinha,8,"$NomePai",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaPais,$PosLinha,8,"SÚMULA:",'full');
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaPais,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaPais,$PosLinha,8,"$JuizPai",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaPais,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosPai)/$LarguraPais;
$Tam++;
$LarguraPais = $LarguraPais + 5;
$TexoRet = QuebraLinhaTexto($IrmaosPai,$LarguraPais);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaPais,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- Mae -------------------------------------
$Tam = strlen($SumulaMae)/$LarguraMaes;
$Tam++;
$TexoRet = QuebraLinhaTexto($SumulaMae,$LarguraMaes);
$Valores = split("]",$TexoRet);
$PosLinha = 410;
$pdf -> addText($ColunaMaes,$PosLinha,8,"$NomeMae",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaMaes,$PosLinha,8,"SÚMULA:",'full');
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
$pdf -> addText($ColunaMaes,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosMae)/$LarguraMaes;
$Tam++;
$LarguraMaes = $LarguraMaes + 5;
$TexoRet = QuebraLinhaTexto($IrmaosMae,$LarguraMaes);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaMaes,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}



//--------------- Avo 1 -------------------------------------
$Tam = strlen($SumulaAvo1)/$LarguraAvo1;
$TexoRet = QuebraLinhaTexto($SumulaAvo1,$LarguraAvo1);
$Valores = split("]",$TexoRet);
$PosLinha = 800;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"$NomeAvo1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"SÚMULA:",'full');
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"$JuizAvo1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo1,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosAvo1)/$LarguraAvo1;
$Tam++;
$LarguraAvo1 = $LarguraAvo1 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosAvo1,$LarguraAvo1);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- Avo 2 -------------------------------------
$Tam = strlen($SumulaAvo2)/$LarguraAvo2;
$TexoRet = QuebraLinhaTexto($SumulaAvo2,$LarguraAvo2);
$Valores = split("]",$TexoRet);
$PosLinha = 600;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"$NomeAvo2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"SÚMULA:",'full');
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"$JuizAvo2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo2,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosAvo2)/$LarguraAvo2;
$Tam++;
$LarguraAvo2 = $LarguraAvo2 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosAvo2,$LarguraAvo2);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
/*
//--------------- Avo 3 -------------------------------------
$Tam = strlen($SumulaAvo3)/$LarguraAvo3;
$TexoRet = QuebraLinhaTexto($SumulaAvo3,$LarguraAvo3);
$Valores = split("]",$TexoRet);
$PosLinha = 410;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"$NomeAvo3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"SÚMULA:",'full');
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"JUIZ: $JuizAvo3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo3,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosAvo3)/$LarguraAvo3;
$Tam++;
$LarguraAvo3 = $LarguraAvo3 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosAvo3,$LarguraAvo3);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- Avo 4 -------------------------------------
$Tam = strlen($SumulaAvo4)/$LarguraAvo4;
$TexoRet = QuebraLinhaTexto($SumulaAvo4,$LarguraAvo4);
$Valores = split("]",$TexoRet);
$PosLinha = 220;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"$NomeAvo4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"SÚMULA:",'full');
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"JUIZ: $JuizAvo4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaAvo4,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosAvo4)/$LarguraAvo4;
$Tam++;
$LarguraAvo4 = $LarguraAvo4 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosAvo4,$LarguraAvo4);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}



//--------------- BisAvo 1 -------------------------------------
$PosLinha = 800;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,"$NomeBisAvo1",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo1,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo1)/$LarguraBisAvo1;
$Tam++;
$LarguraBisAvo1 = $LarguraBisAvo1 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo1,$LarguraBisAvo1);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo1,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 2 -------------------------------------
$PosLinha = 700;
$pdf -> addText($ColunaBisAvo2,$PosLinha,8,"$NomeBisAvo2",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo2,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo2)/$LarguraBisAvo2;
$Tam++;
$LarguraBisAvo2 = $LarguraBisAvo2 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo2,$LarguraBisAvo2);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo2,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 3 -------------------------------------
$PosLinha = 630;
$pdf -> addText($ColunaBisAvo3,$PosLinha,8,"$NomeBisAvo3",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo3,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo3)/$LarguraBisAvo3;
$Tam++;
$LarguraBisAvo3 = $LarguraBisAvo3 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo3,$LarguraBisAvo3);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo3,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}


//--------------- BisAvo 4 -------------------------------------
$PosLinha = 500;
$pdf -> addText($ColunaBisAvo4,$PosLinha,8,"$NomeBisAvo4",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo4,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo4)/$LarguraBisAvo4;
$Tam++;
$LarguraBisAvo4 = $LarguraBisAvo4 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo4,$LarguraBisAvo4);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo4,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 5 -------------------------------------
$PosLinha = 400;
$pdf -> addText($ColunaBisAvo5,$PosLinha,8,"$NomeBisAvo5",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo5,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo5)/$LarguraBisAvo5;
$Tam++;
$LarguraBisAvo5 = $LarguraBisAvo5 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo5,$LarguraBisAvo5);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo5,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 6 -------------------------------------
$PosLinha = 300;
$pdf -> addText($ColunaBisAvo6,$PosLinha,8,"$NomeBisAvo6",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo6,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo6)/$LarguraBisAvo6;
$Tam++;
$LarguraBisAvo6 = $LarguraBisAvo6 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo6,$LarguraBisAvo6);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo6,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 7 -------------------------------------
$PosLinha = 200;
$pdf -> addText($ColunaBisAvo7,$PosLinha,8,"$NomeBisAvo7",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo7,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo7)/$LarguraBisAvo7;
$Tam++;
$LarguraBisAvo7 = $LarguraBisAvo7 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo7,$LarguraBisAvo7);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo7,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

//--------------- BisAvo 8 -------------------------------------
$PosLinha = 100;
$pdf -> addText($ColunaBisAvo8,$PosLinha,8,"$NomeBisAvo8",'full');
$PosLinha = $PosLinha - 20;
$pdf -> addText($ColunaBisAvo8,$PosLinha,8,"IRMÃOS:",'full');
$Tam = strlen($IrmaosBisAvo8)/$LarguraBisAvo8;
$Tam++;
$LarguraBisAvo8 = $LarguraBisAvo8 + 5;
$TexoRet = QuebraLinhaTexto($IrmaosBisAvo8,$LarguraBisAvo8);
$Valores = split("]",$TexoRet);
$Frase = "";
for ($i=1; $i<=$Tam; $i++)
{
	$PosLinha = $PosLinha - 12;
	$Frase = $Valores[$i];
	$pdf -> addText($ColunaBisAvo8,$PosLinha,$TamanhoLetraSumula,$Frase,'full');
}

*/





function QuebraLinhaTexto($Texto,$Largura)
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
	
	return $RetornarTexto;
}



//$pdf->setEncryption('','2039087',array('print'));
$pdf -> ezStream();
?>