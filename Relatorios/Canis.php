<?php
include ('../Funcoes/Relatorios/class.ezpdf.php');
$pdf =& new Cezpdf();
$pdf -> selectFont('../Funcoes/Relatorios/fonts/Helvetica.afm');
$link = mysql_connect("localhost","root","")	or die("Não foi possível conectar: " . mysql_error());

mysql_select_db("sbcpa") or die("Não foi possível selecionar o banco.");
$query = "select IdCanil, NoCanil, NoCidade, SgUF from TBCanil Order By SgUF limit 800";
$result = mysql_query($query) or die("Erro: " . mysql_error());

$UF = "";
$textopdf = "";

while ($row = mysql_fetch_array($result))
{
	$IdCanil = $row["IdCanil"];
	$NoCanil = $row["NoCanil"];
	$NoCidade = $row["NoCidade"];
	$SgUF = $row["SgUF"];
	
	$data[] = array('IdCanil'=>$IdCanil, 
			'Nome'=>$NoCanil, 
			'NoCidade'=>$NoCidade,
			'SgUF'=>$SgUF
			);
		
	/*	
	if ($UF != $SgUF)
	{
		$textopdf = $textopdf . "<br><strong>$SgUF</strong><br>";
		$UF = $SgUF;
	}
	
	$textopdf = $textopdf . "- $NoCanil, $NoCidade, $SgUF <br>";
	*/
}


$pdf -> addJpegFromFile('../Imagens/Logo.jpg',25,720,100,100);
//$pdf->setEncryption('','2039087',array('print'));

$pdf -> ezSetY(790);
$pdf -> ezText('                                       SBCPA - Sociedade Brasileira de Cães Pastores Alemães');
//$pdf -> ezText($textopdf);

$pdf -> ezSetY(700);
$pdf -> ezTable($data,4,'Relação de Canis');
$pdf -> ezStream();
?>