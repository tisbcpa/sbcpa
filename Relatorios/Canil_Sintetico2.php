<?php
include ('../Funcoes/Relatorios/class.ezpdf.php');


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

	$DataImpressao = 'Brasília-DF, 10 de Setembro de 2004';
	$RegistroNacional = 'Registro Nacional: ' . "SBCPA 1234";
	$Nome = 'Nome: ' . "GIZE DO BARÃO DE ARARIBE";
	$Sexo = 'Sexo: ' . "FÊMEA";
	$DataNascimento = 'DataNascimento: ' . "25/04/1996";
	$Cor = 'Cor: ' . "CAPA PRETA";
	$Tatuagem = 'Tatuagem: ' . "UPE 0496";

	$Criador = 'Criador: ' . "PILATOS FERREIRA DA SILVA";
	$Endereco = 'Endereço: ' . "AV. BELMIRO CORREIA Nº 412";
	$Cidade = 'Cidade: ' . "CAMARAGIBE";
	$Estado = 'Estado: ' . "PERNAMBUCO";
	$Ninhada = 'Ninhada: ' . "094";
	$Data = 'Data de Registro: ' . '12/08/2004';
	$Presidente = "Francisco Sampaio de Carvalho";
	$Diretor = "Celso Roberto Machado Pinto";
	$TamanhoLetraSumula = 8;
	
	//----------------------------------------------------------------------------------------
	$LarguraPais = 65;
	$ColunaPais = 18;
	$NomePai = strtoupper("Odin de Isla Bonita");
	$SumulaPai = "Macho, medianamente forte. Boa cabeza. Muito boa pigmentação. Ligeiramente alargado. Cernelha alta Dorso firme. Boa posição de garupa, algo curta. Boas angulações dianteiras, muito boa a posterior. Frente correta. Caminha correto visto de tras e de frente. Bon alcance. Boa linha inferior. Carater firme, dureza, corajem e espírito de luta pronunciados. Não larga sob comando.";
	$JuizPai = "Celso Roberto Machado Pinto";
	$IrmaosPai = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";
	//$SumulaPai = strtoupper($SumulaPai);

	$LarguraAvo1 = 78;
	$ColunaAvo1 = 275;
	$NomeAvo1 = strtoupper("Odin de Isla Bonita");
	$SumulaAvo1 = "Macho, medianamente forte. Boa cabeza. Muito boa pigmentação. Ligeiramente alargado. Cernelha alta Dorso firme. Boa posição de garupa, algo curta. Boas angulações dianteiras, muito boa a posterior. Frente correta. Caminha correto visto de tras e de frente. Bon alcance. Boa linha inferior. Carater firme, dureza, corajem e espírito de luta pronunciados. Não larga sob comando.";
	$JuizAvo1 = "Celso Roberto Machado Pinto";
	$IrmaosAvo1 = "Uras von Steinwald, India v. d. Tefor, Leady v. Anker, Tea v. d. Tefor, Dummpy v. Wester, Xidy v. d. Tefor";





$pdf =& new Cezpdf('a3','landscape');
$pdf -> selectFont('../Funcoes/Relatorios/fonts/Times-Roman.afm');

/*
//-------------- LADO ESQUERDO DA PRIMEIRA PÁGINA -------------------------------------
$pdf -> rectangle(25,645,560,180);
$pdf -> addText(230,810,12,'TRANSFERÊNCIAS','full');
$pdf -> addText(270,780,12,'PARA','full');
$pdf -> addText(440,780,12,'ASSINATURAS','full');
$pdf -> addText(30,763,12,'1ª - Em __/__/____','full');
$pdf -> line(180,760,380,760);
$pdf -> line(390,760,550,760);
$pdf -> addText(30,743,12,'2ª - Em  __/__/____','full');
$pdf -> line(180,740,380,740);
$pdf -> line(390,740,550,740);
$pdf -> addText(30,723,12,'3ª - Em  __/__/____','full');
$pdf -> line(180,720,380,720);
$pdf -> line(390,720,550,720);
$pdf -> addText(30,703,12,'4ª - Em  __/__/____','full');
$pdf -> line(180,700,380,700);
$pdf -> line(390,700,550,700);
$pdf -> addText(30,683,12,'5ª - Em  __/__/____','full');
$pdf -> line(180,680,380,680);
$pdf -> line(390,680,550,680);
$pdf -> addText(30,663,12,'6ª - Em  __/__/____','full');
$pdf -> line(180,660,380,660);
$pdf -> line(390,660,550,660);


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

$pdf -> addJpegFromFile('../Imagens/LogoRelatorio.jpg',765,480,272,227);
$pdf -> addJpegFromFile('../Imagens/fcilogo01.jpg',660,470,85,87);
$pdf -> addJpegFromFile('../Imagens/CBKC.jpg',660,580,90,89);

$pdf -> addJpegFromFile('../Imagens/COAPA.jpg',1060,580,90,89);
$pdf -> addJpegFromFile('../Imagens/WUSV.jpg',1060,470,99,65);


$pdf -> addText(650,420,10,$RegistroNacional,'full');
$pdf -> line(725,418,810,418);

$pdf -> addText(650,385,10,$Nome,'full');
$pdf -> line(676,383,910,383);
$pdf -> addText(650,370,10,$Sexo,'full');
$pdf -> line(670,368,910,368);
$pdf -> addText(650,355,10,$DataNascimento,'full');
$pdf -> line(716,353,910,353);
$pdf -> addText(650,340,10,$Cor,'full');
$pdf -> line(666,338,910,338);
$pdf -> addText(650,325,10,$Tatuagem,'full');
$pdf -> line(690,323,910,323);

$pdf -> addText(920,385,10,$Criador,'full');
$pdf -> line(951,383,1160,383);

$pdf -> addText(920,370,10,$Endereco,'full');
$pdf -> line(957,368,1160,368);
$pdf -> addText(920,355,10,$Cidade,'full');
$pdf -> line(949,353,1160,353);
$pdf -> addText(920,340,10,$Estado,'full');
$pdf -> line(948,338,1160,338);
$pdf -> addText(920,325,10,$Ninhada,'full');
$pdf -> line(954,323,1160,323);


$pdf -> addText(750,300,10,'Consangüinidade','full');
$pdf -> line(650,280,910,280);
$pdf -> line(650,265,910,265);
$pdf -> line(650,250,910,250);
$pdf -> line(650,235,910,235);
$pdf -> line(650,220,910,220);
$pdf -> addText(1020,300,10,'Irmãos','full');
$pdf -> line(920,280,1160,280);
$pdf -> line(920,265,1160,265);
$pdf -> line(920,250,1160,250);
$pdf -> line(920,235,1160,235);
$pdf -> line(920,220,1160,220);

$pdf -> addText(740,180,12,'Certificamos que os dados aqui constantes estão conforme os registros','full');
$pdf -> addText(740,160,12,'do livro de origem da Sociedade Brasileira Cães Pastores Alemães','full');

$pdf -> addText(830,120,12,$DataImpressao,'full');

$pdf -> line(650,60,910,60);
$pdf -> addText(710,50,12,$Presidente,'full');
$pdf -> addText(750,38,10,'PRESIDENTE','full');
$pdf -> line(920,60,1160,60);
$pdf -> addText(975,50,12,$Diretor,'full');
$pdf -> addText(950,38,10,'DIRETOR DE REGISTRO GENEALÓGICO','full');

$pdf -> ezNewPage();*/

//Linhas Verticais
$pdf -> line(10,810,10,40);
$pdf -> line(270,810,270,40);
$pdf -> line(593,810,593,40);
$pdf -> line(830,810,830,40);
$pdf -> line(1038,810,1038,40);


//Linhas Horizontais
$pdf -> line(10,810,1038,810);
$pdf -> line(10,425,1038,425);


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

$pdf -> line(10,40,1038,40);

$pdf -> rectangle(1048,570,137,240);
$pdf -> rectangle(1048,410,137,150);
$pdf -> rectangle(1048,250,137,150);
$pdf -> rectangle(1048,40,137,200);

$pdf -> addText(100,820,14,'I Grau - PAIS','full');
$pdf -> addText(400,820,14,'II Grau - AVÓS','full');
$pdf -> addText(650,820,14,'III Grau - BISAVÓS','full');
$pdf -> addText(860,820,14,'IV Grau - TRISAVÓS','full');
$pdf -> addText(435,13,18,'PASTOR ALEMÃO - AMIZADE E PROTEÇÃO','full');

$pdf -> addText(1075,798,12,'CONVENÇÕES','full');
$pdf -> addText(1090,547,12,'SELEÇÃO','full');
$pdf -> addText(1100,387,12,'DNA','full');
$pdf -> addText(1049,228,11,'CONTROLE DE DISPLASIA','full');

$pdf -> addText(1050,785,8,'CP - Capa Preta','full');
$pdf -> addText(1050,775,8,'C - Cinza','full');
$pdf -> addText(1050,765,8,'P - Preto','full');
$pdf -> addText(1050,755,8,'PLN - Pelagem Normal','full');
$pdf -> addText(1050,745,8,'PLL - Pelagem Longa','full');
$pdf -> addText(1050,735,8,'"A" - Isento de Displasia','full');
$pdf -> addText(1050,725,8,'+ - Selecionado','full');
$pdf -> addText(1050,715,8,'CL - Classe','full');
$pdf -> addText(1050,705,8,'CTA - Cão de Trabalho Nível A','full');
$pdf -> addText(1050,695,8,'CT1 - Cão de Trabalho Nível 1 (SCH I)','full');
$pdf -> addText(1050,685,8,'CT2 - Cão de Trabalho Nível 2 (SCH II)','full');
$pdf -> addText(1050,675,8,'CT3 - Cão de Trabalho Nível 3 (SCH III)','full');
$pdf -> addText(1050,665,8,'CF - Cão de Faro (FH)','full');
$pdf -> addText(1050,655,8,'VA - Super Excelente','full');
$pdf -> addText(1050,645,8,'V - Excelente','full');
$pdf -> addText(1050,635,8,'SG - Muito Bom','full');
$pdf -> addText(1050,625,8,'G - Bom','full');





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
$pdf -> addText($ColunaPais,$PosLinha,8,"JUIZ: $JuizPai",'full');
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
$pdf -> addText($ColunaAvo1,$PosLinha,8,"JUIZ: $JuizAvo1",'full');
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
		
		if ($RealValor == $Largura)
		{$RetornarTexto = $RetornarTexto ."]". substr($Texto,$Inicio,$Largura);}
		else
		{$RetornarTexto = $RetornarTexto ."]". substr($Texto,$Inicio,$Largura) . "-";}
		
		$Inicio = $Inicio + $Largura;
		$Fim = $Fim + $Largura;
		
		$i++;
	}while($i<=$tam);
	
	return $RetornarTexto;
}



//$pdf->setEncryption('','2039087',array('print'));
$pdf -> ezStream();
?>