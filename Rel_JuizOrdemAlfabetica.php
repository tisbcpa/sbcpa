<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Relação de Juízes por Ordem Alfabética</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC; text-align: center}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>


<Span class=Titulo>Relação de Juízes em Ordem Alfabética</Span><br><br>

<?

	require("Funcoes/Conexao.php");

	function Qualificacoes($Id)
	{
		if (($Id == 1) || ($Id == 'T')){return "Trabalho";}
		if (($Id == 2) || ($Id == 'C')){return "Criação";}
		if (($Id == 3) || ($Id == 'S')){return "Seleção";}
	}

	if(isset($_GET["Ativo"])){
		$sql = "select * from tbjuiz where TPStatus=1 Order By NOJuiz";
	}
	else{
		$sql = "select * from tbjuiz Order By NOJuiz";
	}
	
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
?>	


		<?
		$c = 0;
		while ($row = mysql_fetch_array($sql_result))
		{
			echo("<table width=100%><tr>");
			echo("<td width=20%><B>Nome:</B></td><td>$row[NoJuiz]</td>");
			echo("<tr>");
			echo("<td><B>Endereço:</B></td><td>$row[EdJuiz]</td>");
			echo("<tr>");
			echo("<td><B>Cidade:</B></td><td>$row[NoCidade]</td>");
			echo("<tr>");
			echo("<td><B>UF:</B></td><td>$row[SgUF]</td>");
			echo("<tr>");
			echo("<td><B>CEP:</B></td><td>$row[NuCEP]</td>");
			echo("<tr>");
			echo("<td><B>e-mail:</B></td><td>$row[NoEMail]</td>");
			echo("<tr>");
			echo("<td><B>Telefones:</B></td><td>$row[NuTelefones]</td>");
			echo("<tr>");
			
			if ($row["TPStatus"] == 1) {$status = "Sim";}
			if ($row["TPStatus"] == 0) {$status = "Não";}
			
			echo("<tr>");
			echo("<td><B>Juiz Ativo?</B></td><td>". $status ."</td>");
			echo("<tr>");

			$Nivel = str_replace("I","Internacional",$row["TPNivel"]);
			$Nivel = str_replace("N","Nacional",$Nivel);
			$Nivel = str_replace("E","Estadual",$Nivel);
			$Nivel = str_replace("R","Regional",$Nivel);

			echo("<td><B>Nível:</B></td><td>$Nivel</td>");
			

			echo("<tr>");
			echo("<td><B>Qualificações:</B></td><td>");

			$sql1 = "Select * From tbjuizqualificacaojuiz Where IdJuiz = $row[IdJuiz]";
			$sql_result1 = mysql_query($sql1,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
			while ($row1 = mysql_fetch_array($sql_result1))
			{
				echo(Qualificacoes($row1["IdQualificacaoJuiz"]) . "<br>");
			}
	
			echo("</td></tr></table><br><br>");
			$c++;
		}
		?>
	


<?
	echo("<table width=100%>");
	echo("<tr class=Titulo><td class=Titulo width=80%>Total</td><td width=20%>$c</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>