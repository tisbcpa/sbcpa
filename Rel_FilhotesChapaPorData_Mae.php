<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Consulta Mãe e Chapas dos Filhotes por Período</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
</Style>
<Script>
function AbrirPopUp(obj)
{
	window.open('ConsultarPreenchimento_Corpo.php?Obj='+obj,'Pesquisar','width=500, height=260');
}

function AtualizarPagina()
{

}
</Script>

<?



	function FormatarData($Data)
	{
		list ($dia,$mes,$ano) = split ('[/.-]', $Data);
		return "$ano-$mes-$dia";
	}

	if (isset($_POST["IDPai"]))
	{
		$IdPai = $_POST["IDPai"];
		$Nome = $_POST["NoPai"];

		$DTInicio = $_POST["DTInicio"];
		$DTTermino = $_POST["DTTermino"];

		$DTInicio2 = FormatarData($_POST["DTInicio"]);
		$DTTermino2 = FormatarData($_POST["DTTermino"]);
	}
	else
	{
		$AnoDefault = date("Y");
		$AnoDefault--;

		$IdPai = "0";
		$Nome = "";
		$DTInicio = "01/01/". $AnoDefault;
		$DTTermino = "01/01/". date("Y");
		
		$DTInicio2 = $AnoDefault . "-01-01";
		$DTTermino2 = date("Y") . "-01-01";
	}
?>

<Form name="Formulario" Method="POST">
        <table align="center" class="SemBorda">
          <tr> 
            <td>Mae&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <input type="hidden" name="IDPai" value="<?echo($IdPai);?>" OnChange="AtualizarPagina()">
            <td><input name="NoPai" type="text" size="50" maxlength="50" value="<?echo($Nome);?>" readonly title="Não digite, escolha o Pai clicando no Botão ao lado">
              <a href="javascript: AbrirPopUp('Pai')"><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
	<Tr>
	<td colspan=2>Data Início: <input type="text" size="12" Name="DTInicio" value="<?echo($DTInicio);?>">
	Data Término: <input type="text" size="12" Name="DTTermino" value="<?echo($DTTermino);?>"></td>
          </tr>
          <tr> 
            <td colspan="2" align="center"><input type="submit" value="Pesquisar"></td>
          </tr>
        </table>
  </Form>

<?
	require("Funcoes/Conexao.php");

	$sql = "Select DSRaioX, Count(NORaioX) as Total From  (TBCachorro as a Inner Join TBNinhada as b on a.IDNinhada = b.IDNinhada) Inner Join TBRaioX as c On a.IdRaioX = c.IdRaioX Where  b.IDCachorroMae = $IdPai and b.DaNascimento Between '$DTInicio2'  and '$DTTermino2' Group By NORaioX";
	$sql = "Select DSRaioX, Count(DSRaioX) as Total From TBCachorro as a Left Join TBRaioX as c On a.IdRaioX = c.IdRaioX Where a.IDCachorroPai = $IdPai and a.DaRaiox Between '$DTInicio2'  and '$DTTermino2' Group By DSRaioX";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	
	$c = 1;
	$Soma = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$UF[$c] = $row["DSRaioX"];
		$Valor[$c] = $row["Total"];
		$Soma = $Soma + $Valor[$c];
		$c = $c + 1;
	}	
	echo("<center><br><span class=Titulo>Consulta Mãe e Chapas dos Filhotes por Período</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=180> </td><td align=Center>Qtde</td><td align=Center>Percentual</td></tr>");
	for($i=1; $i<$c; $i++)
	{
		$Percentual = ($Valor[$i] / $Soma) * 100;
		$Percentual = number_format($Percentual, 2, ',', '.');
		echo("<tr><td align=Center>$UF[$i]</td><td align=Center>$Valor[$i]</td><td align=Center>$Percentual</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center>Total</td><td align=Center>$Soma</td><td align=Center>100</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>