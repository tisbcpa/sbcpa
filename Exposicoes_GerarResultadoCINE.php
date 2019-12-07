<? require("Estilo/Estilo.php");?>
<?
function A_PontuacaoExposicao($Ano){
	require("Funcoes/Conexao.php");	
	$sql = "Delete From tbcineresultadopontostemp;";
	mysql_query($sql,$Conn);
	
	$sql = "Delete From tbcineresultadotemp;";
	mysql_query($sql,$Conn);
	
	$sql = "Delete From tbcineresultadotemp2;";
	mysql_query($sql,$Conn);

	$sql = "Insert Into tbcineresultadopontostemp
	(SELECT
		IdExposicao,
		IDCachorro,
		Sum(NrPonto)
	FROM
		tbexposicaoresultado
	Where
		IdExposicao In (Select IDExposicao From tbexposicao Where InCineNacional = 1 and Year(DTInicio) = $Ano)
	Group By
		IdExposicao,
		IDCachorro);";
	mysql_query($sql,$Conn);
}


function B_NovissimosMacho($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");	
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Novissimos Macho' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Novissimos Macho' as Categoria
	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'M'
		and Year(b.DTInicio) = $Ano
		and DaNascimento >= '$DataInicial'
	Group By
		NoCachorro, DaNascimento);";
	mysql_query($sql,$Conn);	
} 


function C_JovemMacho($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");	
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Jovem Macho' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Jovem Macho' as Categoria
	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'M'
		and Year(b.DTInicio) = $Ano
		and DaNascimento < '$DataInicial'
		and DaNascimento > '$DataFinal'
	Group By
		NoCachorro, DaNascimento);";
	mysql_query($sql,$Conn);
}

function D_SeniorMacho($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");	
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Senior Macho' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Senior Macho' as Categoria
	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'M'
		and Year(b.DTInicio) = $Ano
		and DaNascimento <= '$DataFinal'
	Group By
		NoCachorro, DaNascimento);";
		
	mysql_query($sql,$Conn);	
}

function E_NovissimosFemeas($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Novissimos Femeas' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Novissimos Femeas' as Categoria

	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'F'
		and Year(b.DTInicio) = $Ano
		and DaNascimento >= '$DataInicial'
	Group By
		NoCachorro, DaNascimento);";
	mysql_query($sql,$Conn);
}

function F_JovemFemea($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Jovem Femea' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Jovem Femea' as Categoria
	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'F'
		and Year(b.DTInicio) = $Ano
		and DaNascimento < '$DataInicial'
		and DaNascimento > '$DataFinal'
	Group By
		NoCachorro, DaNascimento);";
	mysql_query($sql,$Conn);
}

function G_SeniorFemea($Ano,$DataInicial,$DataFinal){
	require("Funcoes/Conexao.php");
	$sql = "Delete From tbcineresultadotemp2 Where NoCategoria = 'Senior Femea' and NrAno = $Ano;";
	mysql_query($sql,$Conn);
	
	$sql = "Insert Into tbcineresultadotemp2
	(Select
		$Ano as NrAno
		,c.IdCachorro
		,c.NuRegistroNacional
		,c.IdCachorroPai
		,c.IdCachorroMae
		,DaNascimento
		,'Senior Femea' as Categoria
	From
		(TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao)
		inner join TBCachorro as c on a.IdCachorro = c.IdCachorro
	Where
		TPSexo = 'F'
		and Year(b.DTInicio) = '$Ano'
		and DaNascimento <= '$DataFinal'
	Group By
		NoCachorro, DaNascimento);";
	mysql_query($sql,$Conn);
}

function H_GravarPontuacao($Ano,$Exposicao1,$Exposicao2,$Exposicao3,$Exposicao4,$Exposicao5,$Exposicao6,$Exposicao7){
	require("Funcoes/Conexao.php");

	$sql = "Delete From tbcineresultadotemp Where NrAno = $Ano;";
	mysql_query($sql,$Conn);

	$sql = "Insert Into tbcineresultadotemp
	(SELECT
		`A`.`NrAno`,
		`A`.`IdCachorro`,
		`A`.`NuRegistroNacional`,
		`A`.`IdCachorroPai`,
		`A`.`IdCachorroMae`,
		`A`.`DaNascimento`,
		`A`.`NoCategoria`,
		0 AS NrPontoCine1,
		0 AS NrPontoCine2,
		0 AS NrPontoCine3,
		0 AS NrPontoCine4,
		0 AS NrPontoCine5,
		`B`.`NrPontos` AS NrPontoCineExibir1,
		`C`.`NrPontos` AS NrPontoCineExibir2,
		`D`.`NrPontos` AS NrPontoCineExibir3,
		`E`.`NrPontos` AS NrPontoCineExibir4,
		`F`.`NrPontos` AS NrPontoCineExibir5,
		`G`.`NrPontos` AS NrPontoCineExibir6,
		`H`.`NrPontos` AS NrPontoCineExibir7
	From
		(((((((tbcineresultadotemp2 as A
		Left Join tbcineresultadopontostemp as B On A.IdCachorro = B.IdCachorro and B.IdExposicao = $Exposicao1)
		Left Join tbcineresultadopontostemp as C On A.IdCachorro = C.IdCachorro and C.IdExposicao = $Exposicao2)
		Left Join tbcineresultadopontostemp as D On A.IdCachorro = D.IdCachorro and D.IdExposicao = $Exposicao3)
		Left Join tbcineresultadopontostemp as E On A.IdCachorro = E.IdCachorro and E.IdExposicao = $Exposicao4)
		Left Join tbcineresultadopontostemp as F On A.IdCachorro = F.IdCachorro and F.IdExposicao = $Exposicao5)
		Left Join tbcineresultadopontostemp as G On A.IdCachorro = G.IdCachorro and G.IdExposicao = $Exposicao6)
		Left Join tbcineresultadopontostemp as H On A.IdCachorro = H.IdCachorro and H.IdExposicao = $Exposicao7));";
	mysql_query($sql,$Conn);
}

function fncGerarPontuacaoCINE($Ano,$DataInicial,$DataFinal,$Exposicao1,$Exposicao2,$Exposicao3,$Exposicao4,$Exposicao5,$Exposicao6,$Exposicao7){
	A_PontuacaoExposicao($Ano);
	B_NovissimosMacho($Ano,$DataInicial,$DataFinal);
	C_JovemMacho($Ano,$DataInicial,$DataFinal);
	D_SeniorMacho($Ano,$DataInicial,$DataFinal);
	E_NovissimosFemeas($Ano,$DataInicial,$DataFinal);
	F_JovemFemea($Ano,$DataInicial,$DataFinal);
	G_SeniorFemea($Ano,$DataInicial,$DataFinal);
	H_GravarPontuacao($Ano,$Exposicao1,$Exposicao2,$Exposicao3,$Exposicao4,$Exposicao5,$Exposicao6,$Exposicao7);
}

////////////////////////////////////////////////////////////////////////////////////////




function SelecionarMelhores($Numero)
{
	$Vetor = split(",",$Numero);
	$Valor[0] = $Vetor[0];
	$Valor[1] = $Vetor[1];
	$Valor[2] = $Vetor[2];
	$Valor[3] = $Vetor[3];
	$Valor[4] = $Vetor[4];
	$Valor[5] = $Vetor[5];
	$Valor[6] = $Vetor[6];
	 
	for ($i=0; $i<=6; $i++)
	{
			for ($j=0; $j<=6; $j++)
			{
				if ($Valor[$i] < $Valor[$j])
				{
					$Aux = $Valor[$i];
					$Valor[$i] = $Valor[$j];
					$Valor[$j] = $Aux;
				}
			}
	}
	
	$String = "";
	return "$Valor[6],$Valor[5],$Valor[4],$Valor[3],$Valor[2]";
}


	require("Funcoes/Conexao.php");
	$AnoFinal = date("Y");

	if(isset($_GET["NrAno"]))
	{$Ano = $_GET["NrAno"];}
	else
	{$Ano = $AnoFinal;}
	
	$SqlAB = "select * from tbexposicao where year(DTInicio) = $Ano and InCINENacional = 1 Order By DtInicio limit 7";
	$sql_resultAB = mysql_query($SqlAB,$Conn);
	$i = 1;
	while ($rowAB = mysql_fetch_array($sql_resultAB))
	{
		$IDExposicao[$i] = $rowAB["IdExposicao"];
		$DtInicio = $rowAB["DTInicio"];
		$i++;
	}

	list ($ano, $mes, $dia) = split ('[/.-]', $DtInicio);
	$Data1 = $ano - 1 ."-". $mes ."-". $dia;
	$Data2 = $ano - 2 ."-". $mes ."-". $dia;	
	//echo("$Data1	--- 	$Data2");

/*
	$SqlAB = "CALL spGerarPontuacaoCINE(2007,'2006-10-14','2005-10-14',373,380,384,388,390,0);";
	$SqlAB = "CALL spGerarPontuacaoCINE($Ano,'$Data1','$Data2',$IDExposicao[1],$IDExposicao[2],$IDExposicao[3],$IDExposicao[4],$IDExposicao[5],$IDExposicao[6]);";
	$SqlAB = str_replace(",,",",0,",$SqlAB);
	$SqlAB = str_replace(",,",",0,",$SqlAB);
	$SqlAB = str_replace(",,",",0,",$SqlAB);
	$SqlAB = str_replace(",,",",0,",$SqlAB);
	$SqlAB = str_replace(",)",",0)",$SqlAB);
	$SqlAB = str_replace("-1--","0000-00-00",$SqlAB);
	$SqlAB = str_replace("-2--","0000-00-00",$SqlAB);
	mysql_query($SqlAB,$Conn);
	//die($SqlAB);
*/
	
	//require("Exposicoes_GerarPontuacaoCINECalculo.php");
	
	if ($IDExposicao[1] == "")
		$IDExposicao[1] = 0;
	if ($IDExposicao[2] == "")
		$IDExposicao[2] = 0;
	if ($IDExposicao[3] == "")
		$IDExposicao[3] = 0;
	if ($IDExposicao[4] == "")
		$IDExposicao[4] = 0;
	if ($IDExposicao[5] == "")
		$IDExposicao[5] = 0;
	if ($IDExposicao[6] == "")
		$IDExposicao[6] = 0;
	if ($IDExposicao[7] == "")
		$IDExposicao[7] = 0;
	
	//die("$Ano,'$Data1','$Data2',$IDExposicao[1],$IDExposicao[2],$IDExposicao[3],$IDExposicao[4],$IDExposicao[5],$IDExposicao[6]");
	fncGerarPontuacaoCINE($Ano,$Data1,$Data2,$IDExposicao[1],$IDExposicao[2],$IDExposicao[3],$IDExposicao[4],$IDExposicao[5],$IDExposicao[6],$IDExposicao[7]);	
	

	$Sql = "Select NrAno, IdCachorro, NrPontoCineExibir1, NrPontoCineExibir2, NrPontoCineExibir3, NrPontoCineExibir4, NrPontoCineExibir5, NrPontoCineExibir6, NrPontoCineExibir7 From tbcineresultadotemp Where NrPontoCineExibir1 Is Not Null Or NrPontoCineExibir2 Is Not Null Or NrPontoCineExibir3 Is Not Null Or NrPontoCineExibir4 Is Not Null Or NrPontoCineExibir5 Is Not Null Or NrPontoCineExibir6 Is Not Null Or NrPontoCineExibir7 Is Not Null";
	$sql_result = mysql_query($Sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	while ($row = mysql_fetch_array($sql_result))
	{
		$NrPontoCine[1] = $row["NrPontoCineExibir1"];
		$NrPontoCine[2] = $row["NrPontoCineExibir2"];
		$NrPontoCine[3] = $row["NrPontoCineExibir3"];
		$NrPontoCine[4] = $row["NrPontoCineExibir4"];
		$NrPontoCine[5] = $row["NrPontoCineExibir5"];
		$NrPontoCine[6] = $row["NrPontoCineExibir6"];
		$NrPontoCine[7] = $row["NrPontoCineExibir7"];

		$MaioresPontos = SelecionarMelhores("$NrPontoCine[1],$NrPontoCine[2],$NrPontoCine[3],$NrPontoCine[4],$NrPontoCine[5],$NrPontoCine[6],$NrPontoCine[7]");

		// se o ano for < 2011 então pegar apenas os 4 últimos, senão pega os 5 últimos
		$VetorPontosA = split(",",$MaioresPontos);
		$ValorPontosA[1] = $VetorPontosA[0];
		$ValorPontosA[2] = $VetorPontosA[1];
		$ValorPontosA[3] = $VetorPontosA[2];
		$ValorPontosA[4] = $VetorPontosA[3];
		$ValorPontosA[5] = $VetorPontosA[4];

		$SqlUpdate = "Update tbcineresultadotemp Set NrPontoCine1 = $ValorPontosA[1], NrPontoCine2 = $ValorPontosA[2], NrPontoCine3 = $ValorPontosA[3], NrPontoCine4 = $ValorPontosA[4], NrPontoCine5 = $ValorPontosA[5] Where NrAno = $row[NrAno] and IdCachorro = $row[IdCachorro]";
		$SqlUpdate = str_replace("= ,","=0,",$SqlUpdate);
		$SqlUpdate = str_replace("= ,","=0,",$SqlUpdate);
		$SqlUpdate = str_replace("= ,","=0,",$SqlUpdate);
		$SqlUpdate = str_replace("=  W","=0 W",$SqlUpdate);

		//echo("$SqlUpdate <br>");
		mysql_query($SqlUpdate,$Conn);
	}	

	//die("Ok");

//mysql_close($Conn);
?>