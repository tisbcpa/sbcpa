<? 
	$menu = false;
	require("Estilo/Estilo.php");
?>
<? 
	require("Exposicoes_GerarResultadoCINE.php");
	require("Funcoes/Conexao.php");

	$SqlAB = "select NoExposicao from tbexposicao where year(DTInicio) = $Ano and InCINENacional = 1 Order By DtInicio limit 7";
	$sql_resultAB = mysql_query($SqlAB,$Conn);
	
	$Texto = "<table width=100%>";
		$c = 1;
		while ($rowAB = mysql_fetch_array($sql_resultAB))
		{
			if (($c == 4) || ($c == 7)){$Texto = $Texto . "<tr>";}
			$Texto = $Texto . "<td style='font-family: verdana; font-size:9'><strong>$c ª - $rowAB[NoExposicao]</strong></td>";	
			$c++;
		}
	$Texto = $Texto . "</table>";
?>



<title>Resultado do CINE em <?echo($Ano);?></title>
<style>
	th{font-family: verdana; font-size: 12; background-color: #CCCCCC;}
	th.Tit{font-family: verdana; font-size: 12; background-color: #ffffff;}	
	th.Categoria{font-family: verdana; font-size: 12; background-color: #CCCCCC; text-align:left}
	tr.Ntit{font-family: verdana; font-size: 12;}	
	tr.tit{font-family: verdana; font-size: 12; font-weight: bold}	
	tr.txt{font-family: verdana; font-size: 12; background-color: #F4F4F4}	
</style>
<form name="Formulario">
<table width="100%"><tr><th class="Tit">Resultado do CINE em 
						<select name="NrAno" onChange="Processar.style.display=''; document.Formulario.submit()">
						<?
							for($i=$AnoFinal; $i>=1960; $i--)
							{
								echo("<option value=$i>$i</option>");
							}
						?>
						</select>
						
						<br><span id="Processar" class="Tit" style="display:none; color:red">Aguarde... O Sistema está Processando...</span>
						
						<script>document.Formulario.NrAno.value = '<?echo($Ano);?>';</script>
</th></tr></table>
</form>
<?
	function RetornarNomeCachorro($Id)
	{
		$Retorno = "-";
			
			if ($Id != ""){
				//require("Funcoes/Conexao.php");
				$query = "Select NoCachorro From TBCachorro Where IDCachorro = " . $Id;
				$result = mysql_query($query) or die("Erro: " . $query);
				while ($row = mysql_fetch_array($result))
				{$Retorno = "$row[NoCachorro]";	}
			}
		return $Retorno;
	}

	function FormatarData($Data)
	{
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}

	$Sql = "select NoCategoria, idCachorro, NuRegistroNacional, DaNascimento, idCachorroPai, idCachorroMae, NrPontoCineExibir1, NrPontoCineExibir2, NrPontoCineExibir3, NrPontoCineExibir4, NrPontoCineExibir5, NrPontoCineExibir6, NrPontoCineExibir7, NrPontoCine1, NrPontoCine2, NrPontoCine3, NrPontoCine4, NrPontoCine5, (NrPontoCine1+NrPontoCine2+NrPontoCine3+NrPontoCine4+NrPontoCine5) as Pontuacao from tbcineresultadotemp Where NrAno = $Ano and (NrPontoCine1+NrPontoCine2+NrPontoCine3+NrPontoCine4+NrPontoCine5) > 0 Order By NoCategoria, Pontuacao DESC";

	$sql_result = mysql_query($Sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Categoria = "";
	while ($row = mysql_fetch_array($sql_result))
	{
		if ($Categoria != $row["NoCategoria"])
		{
			echo("</table>");
			echo("<br>");
			echo($Texto);
			echo("<table width='100%' height='25' border='1' cellpadding='0' cellspacing='0'><tr><th class=Categoria><strong>&nbsp;&nbsp;Categoria: $row[NoCategoria]</strong></th></tr></table>");
			echo("<table border=1 width='100%' cellpadding='0' cellspacing='0'>");
			echo("<tr align=center><th align=center width=400>Animal</th><th width=40>1ª</th><th width=40>2ª</th><th width=40>3ª</th><th width=40>4ª</th><th width=40>5ª</th><th width=40>6ª</th><th width=40>7ª</th><th width=50>Total</th></tr>");
		}
		
		echo("<tr class=txt><td><table><tr class=txt>");
		echo("<td align=right valign=top width=130>");
		echo("<strong>$row[NuRegistroNacional]</strong><br>" . FormatarData($row["DaNascimento"]));
		echo("</td>");
		echo("<td align=left>");
		echo(RetornarNomeCachorro($row["idCachorro"]) ."<br>Pai: ". RetornarNomeCachorro($row["idCachorroPai"]) . "<br>Mãe: ". RetornarNomeCachorro($row["idCachorroMae"]));
		echo("</td>");
		echo("</tr></table>");
		echo("<td align=center valign=top>&nbsp; $row[NrPontoCineExibir1]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir2]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir3]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir4]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir5]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir6]</td><td align=center valign=top>&nbsp; $row[NrPontoCineExibir7]</td><td align=center valign=top>$row[Pontuacao]</td></tr>");
		$Categoria = $row["NoCategoria"];
	}
	
	if ($Categoria == ""){
		echo("<p align='center' class='MsgErro'>Nenhuma exposição do CINE cadastrada para o ano selecionado.</p>");
	}
		
//mysql_close($Conn);
?>