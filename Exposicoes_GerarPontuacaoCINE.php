<? require("Estilo/Estilo.php");?>
<?
	require("Funcoes/Conexao.php");
	
	$AnoFinal = date("Y");
	
	if(isset($_GET["NrAno"]))
	{$Ano = $_GET["NrAno"];}
	else
	{$Ano = $AnoFinal;}
	
		
	$SqlAB = "select DtInicio from tbexposicao where year(DTInicio) = $Ano and InCINENacional = 1 Order By idexposicao limit 7";
	$sql_resultAB = mysql_query($SqlAB,$Conn);
	while ($rowAB = mysql_fetch_array($sql_resultAB))
	{$DtInicio = $rowAB["DtInicio"];	}

	list ($ano, $mes, $dia) = split ('[/.-]', $DtInicio);
	
	$Data1 = $ano - 1 ."-". $mes ."-". $dia;
	$Data2 = $ano - 2 ."-". $mes ."-". $dia;	

	$SqlDel = "Delete From tbresultadocineTEMP Where NrAno = $Ano";
	$sql_resultD = mysql_query($SqlDel,$Conn);

	function RecuperarPontuacao($IdCachorro,$IdExposicao)
	{
		require("Funcoes/Conexao.php");
		$Pontos = 0;
		$SqlA = "select sum(NrPonto) as Pontos from tbexposicaoresultado where idcachorro = $IdCachorro and idexposicao = $IdExposicao group by  idcachorro,idexposicao";
		$sql_resultA = mysql_query($SqlA,$Conn);
		while ($rowA = mysql_fetch_array($sql_resultA))
		{
			$Pontos = $rowA["Pontos"];
		}
		return $Pontos;
	}

	$Sql = "Select  'Novíssimos Macho' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'M' and Year(b.DTInicio) = $Ano and DaNascimento >= '$Data1' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Union";
	$Sql = $Sql . " Select  'Jovem Macho' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'M' and Year(b.DTInicio) = $Ano and DaNascimento < '$Data1' and DaNascimento > '$Data2' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Union ";
	$Sql = $Sql . " Select  'Senior Macho' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'M' and Year(b.DTInicio) = $Ano and DaNascimento <= '$Data2' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Union";
	$Sql = $Sql . " Select  'Novíssimos Fêmea' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'F' and Year(b.DTInicio) = $Ano and DaNascimento >= '$Data1' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Union ";
	$Sql = $Sql . " Select  'Jovem Fêmea' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'F' and Year(b.DTInicio) = $Ano and DaNascimento < '$Data1' and DaNascimento > '$Data2' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Union ";
	$Sql = $Sql . " Select  'Senior Fêmea' as Categoria, c.NuRegistroNacional, c.IdCachorro, c.IdCachorroPai, c.IdCachorroMae, NoCachorro, DaNascimento, Sum(NrPonto) as Pontos From (TBExposicaoResultado as a Inner Join TBExposicao as b on a.IdExposicao = b.IdExposicao) inner join TBCachorro as c on a.IdCachorro = c.IdCachorro Where TPSexo = 'F' and Year(b.DTInicio) = $Ano and DaNascimento <= '$Data2' Group By NoCachorro, DaNascimento";
	$Sql = $Sql . " Order By Categoria, Pontos DESC";
	
	$sql_result = mysql_query($Sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	while ($row = mysql_fetch_array($sql_result))
	{
		$NrPontoCine[1] = 0;
		$NrPontoCine[2] = 0;
		$NrPontoCine[3] = 0;
		$NrPontoCine[4] = 0;
		$NrPontoCine[5] = 0;
		$NrPontoCine[6] = 0;
		$NrPontoCine[7] = 0;

		$SqlA = "select IdExposicao from tbexposicao where year(DTInicio) = $Ano and InCINENacional = 1 Order By idexposicao";
		$sql_resultA = mysql_query($SqlA,$Conn);
		$c = 1;
		while ($rowA = mysql_fetch_array($sql_resultA))
		{
			$NrPontoCine[$c] = RecuperarPontuacao($row["IdCachorro"],$rowA["IdExposicao"]);
			$c++;
		}

		$NrAno = $Ano;
		$IdCachorro = $row["IdCachorro"];
		$NuRegistroNacional = $row["NuRegistroNacional"];
		$IdCachorroPai = $row["IdCachorroPai"];
		$IdCachorroMae = $row["IdCachorroMae"];
		$DaNascimento = $row["DaNascimento"];  
		$NoCategoria = $row["Categoria"];

		$SqlInsert = "Insert into tbcinepontuacaotemp (NrAno,IdCachorro,NuRegistroNacional,IdCachorroPai,IdCachorroMae,DaNascimento,NoCategoria,NrPontoCine1,NrPontoCine2,NrPontoCine3,NrPontoCine4,NrPontoCine5,NrPontoCine6,NrPontoCine7) values ($NrAno,$IdCachorro,'$NuRegistroNacional',$IdCachorroPai,$IdCachorroMae,'$DaNascimento','$NoCategoria',$NrPontoCine[1],$NrPontoCine[2],$NrPontoCine[3],$NrPontoCine[4],$NrPontoCine[5],$NrPontoCine[6],$NrPontoCine[7])";
		$sql_resultB = mysql_query($SqlInsert,$Conn);
	}	

mysql_close($Conn);
?>