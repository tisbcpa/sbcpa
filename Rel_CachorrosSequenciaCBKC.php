<?
 $menu = "false";
 require("Estilo/Estilo.php");?>

<Title>Cachorros por Intervalo de N° CBKC</Title>
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
	require("Funcoes/Conexao.php");

	function FormatarDataTela($Data)
	{
		if ($Data != "")
		{
			list ($ano, $mes, $dia) = split ('[/.-]', $Data);
			return "$dia/$mes/$ano";
		}
	}

	if (isset($_POST["NuInicio"]))
	{
		$NuInicio = $_POST["NuInicio"];
		$NuFinal = $_POST["NuFinal"];
	}
	else
	{
		$NuInicio = "";
		$NuFinal = "";
	}
?>

<Form name="Formulario" Method="POST">
        <table align="center" class="SemBorda">
          <tr> 
            <td>N° Inicial:</td><td><input type="text" size="12" name="NuInicio" value="<?echo($NuInicio);?>"></td>
	<td>N° Final:</td><td> <input type="text" size="12" name="NuFinal" value="<?echo($NuFinal);?>"></td>
          </tr>
	<tr><td colspan=4 align=center><input type="submit" value="Pesquisar"</td></tr>
        </table>
  </Form>



<?
	//$NuInicio = 'SBCPA ' . $NuInicio;
	//$NuFinal = 'SBCPA ' . $NuFinal;

	$sql = "select a.NuCBKC, a.nocachorro, a.DaNascimento from tbcachorro as a where a.NuCBKC >= '$NuInicio' and a.NuCBKC <= '$NuFinal' Order By NuCBKC";
	//die($sql);

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Relação de Cachorros por Intervalo de N° CBKC</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=150>N° CBKC</td><td align=Center Width=300>Nome</td><td align=Center Width=100>Data de Nascimento</td></tr>");

	$SomaMachos = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$SomaMachos = $SomaMachos + 1;

		echo("<tr><td align=Left>$row[NuCBKC]</td><td>$row[nocachorro]</td><td align=Center>".  FormatarDataTela($row["DaNascimento"]) . "</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center Colspan=2>Total</td><td align=Center>$SomaMachos</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>