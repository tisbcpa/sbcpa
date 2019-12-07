<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<title>Relação de Súmulas por Juiz</title>
<Style>
	h3{font-family: verdana; font-size: 14;}
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{text-align:justify; font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{text-align:justify; font-family: verdana; font-size: 13;}
	Tr{text-align:justify; font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>
<? require("Funcoes/Conexao.php");?>
<?

	$AnoFinal = date("Y");
	
	if (isset($_POST["IdJuiz"]))
	{$IdJuiz = $_POST["IdJuiz"];}
	else
	{$IdJuiz = "";}
	
	if (isset($_POST["NrAno"]))
	{$Ano = $_POST["NrAno"];}
	else
	{$Ano = "";}	
?>
<Form name="Formulario" method="post">
	<table align="center">
		<tr>
			<td>Nome do Juiz:</td>
			<td>
			<Select name="IdJuiz" onChange="document.Formulario.submit()">
			<option value="">Selecione o Juiz</option>
			<?
				$Sql = "Select NoJuiz,IdJuiz From TBJuiz Order By NoJuiz ASC";
				$sql_result = mysql_query($Sql,$Conn);
				while ($row = mysql_fetch_array($sql_result))
				{
					echo("<option value='$row[IdJuiz]'>$row[NoJuiz]</option>");
				}
			?>
			</Select>
			</td>
		</tr>
		<tr>
			<td>Ano da Seleção:</td>
			<td>
			<Select name="NrAno" onChange="document.Formulario.submit()">
			<option value="">Selecione o Ano</option>
			<?
				for($i=$AnoFinal; $i>=1960; $i--)
				{
					echo("<option value=$i>$i</option>");
				}
			?>
			</Select>
			</td>
		</tr>
	</table>
</Form>	
	<script>document.Formulario.IdJuiz.value = '<?echo($IdJuiz);?>';</script>
	<script>document.Formulario.NrAno.value = '<?echo($Ano);?>';</script>
	
<?
	if (($Ano == "") && ($IdJuiz == ""))
	{die();}


?>	
	
	
	
	<h3>Súmulas por Juiz</h3>
<?
	function FormatarData($Data)
	{
		if ($Data != "")
		{	
			list ($ano, $mes, $dia) = split ('[/.-]', $Data);
			return "$dia/$mes/$ano";
		}
		else
		{
			return "";
		}
	}
	
	function NomeCachorro($IdCachorro)
	{
		require("Funcoes/Conexao.php");
		$Sql = "Select NoCachorro From TBCachorro Where IdCachorro = $IdCachorro";
		$sql_result = mysql_query($Sql,$Conn);
		while ($row = mysql_fetch_array($sql_result))
		{
			return $row["NoCachorro"];
		}
	}	
	
	function NomeJuiz($IdJuiz)
	{
		require("Funcoes/Conexao.php");
		$Sql = "Select NoJuiz From TBJuiz Where IdJuiz = $IdJuiz";
		$sql_result = mysql_query($Sql,$Conn);
		while ($row = mysql_fetch_array($sql_result))
		{
			return $row["NoJuiz"];
		}
	}	
	

	$Sql = "select a.* from tbsumula as a inner join tbjuiz as b on a.idjuiz = b.idjuiz ";

	$ind = false;
	if ($Ano != "")
	{$Sql = $Sql . "Where Year(a.DtSumula) = $Ano "; $ind = true;}
	
	if ($IdJuiz != "")
	{
			if ($ind == false)
			{$Sql = $Sql . "Where ";}
			else
			{$Sql = $Sql . "and ";}

		$Sql = $Sql . "b.idjuiz = $IdJuiz ";
	}
		
	$Sql = $Sql . " order by DtSumula DESC";

	//die($Sql);





	$sql_result = mysql_query($Sql,$Conn);
	$c = 0;
	echo("<table>");
		while ($row = mysql_fetch_array($sql_result))
		{
			echo("<tr><td>Cachorro:</td><td>". NomeCachorro($row["IDCachorro"]) ."</td></tr>");
			echo("<tr><td>Juiz:</td><td>". NomeJuiz($row["IDJuiz"]) ."</td></tr>");
			echo("<tr><td>Data:</td><td>". FormatarData($row["DTSumula"]) ."</td></tr>");
			echo("<tr><td>Altura:</td><td>$row[NRAltura]</td></tr>");
			echo("<tr><td>Pigmentação:</td><td>$row[NOPigmentacao]</td></tr>");
			echo("<tr><td>Pelagem:</td><td>$row[NOPelagem]</td></tr>");
			echo("<tr><td>Vencida?</td><td>$row[InVencida]</td></tr>");
			echo("<tr><td valign=top>Súmula:</td><td>$row[DSSumula]</td></tr>");
			echo("<tr><td colspan=2><hr></td></tr>");
			$c++;
		}
	echo("</table>");
?>
	<table><tr><td><strong>Quntidade de Súmulas</strong>:</td><td><strong><? echo($c);?></strong></td></tr></table>