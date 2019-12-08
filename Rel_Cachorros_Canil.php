<?
 $menu = "false";
 require("Estilo/Estilo.php");?>

<Title>Cachorros por Canil</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
	a{color:blue; text-decoration: none}
	a:hover{color:blue; text-decoration: under
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
		list ($ano, $mes, $dia) = split ('[/.-]', $Data);
		return "$dia/$mes/$ano";
	}

	if (isset($_POST["IDPai"]))
	{
		$IdPai = $_POST["IDPai"];
		$NrAno = $_POST["NrAno"];
	}
	else
	{
		$IdPai = "0";
		$NrAno = "0";
	}

	$sqlCanil = "Select IdCanil, NoCanil From TbCanil Order By NoCanil";
	$sql_resultCanil = mysql_query($sqlCanil,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

?>

<Form name="Formulario" Method="POST">
        <table align="center" class="SemBorda">
          <tr> 
            <td>Canil&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
			<select name="IDPai" onChange="document.Formulario.submit()">
			<?
				while ($row = mysql_fetch_array($sql_resultCanil))
				{
					echo("<option value=$row[IdCanil]>$row[NoCanil]</option>");
				}			?>
			</select>
            </td>
          </tr>
          <tr> 
            <td>Ano&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
	<input type=text name=NrAno size=10  onChange="document.Formulario.submit()">
            </td>
          </tr>
        </table>
  </Form>
<script>document.Formulario.IDPai.value = '<?echo($IdPai);?>';</script>
<script>document.Formulario.NrAno.value = '<?echo($NrAno);?>';</script>

<?
	if ($NrAno == 0)
	{
		$sql = "select a.nuregistronacional, a.IdCachorro, a.nocachorro, b.dsselecao, c.dsraiox from ((tbcachorro as a left join tbselecao as b on a.idselecao = b.idselecao) left join tbraiox as c on a.idraiox = c.idraiox) where a.idninhada in (select idninhada from tbninhada where idcanil = $IdPai)";
	}
	else
	{
		$sql = "select a.nuregistronacional, a.IdCachorro, a.nocachorro, b.dsselecao, c.dsraiox from ((tbcachorro as a left join tbselecao as b on a.idselecao = b.idselecao) left join tbraiox as c on a.idraiox = c.idraiox) where a.idninhada in (select idninhada from tbninhada where Right(NuNInhada,4) = '$NrAno' and idcanil = $IdPai)";
	}

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Relação de Cachorros por Canil</span><br><br></center>");
	echo("<table border=0 align=center>");
	echo("<tr class=Titulo><td align=Center Width=150>N° SBCPA</td><td align=Center Width=300>Nome</td><td align=Center Width=100>Seleção</td><td align=center width=100>Raio X</td></tr>");

	$SomaMachos = 0;
	while ($row = mysql_fetch_array($sql_result))
	{
		$SomaMachos = $SomaMachos + 1;

		echo("<tr><td align=Left>$row[nuregistronacional]</td><td><a href='Cachorro_Formulario.php?Id=$row[IdCachorro]' Target='new'>$row[nocachorro]</a></td><td align=Center>$row[dsselecao]</td><td align=center>$row[dsraiox]</td></tr>");
	}
	echo("<tr class=Titulo><td align=Center Colspan=3>Total</td><td align=Center>$SomaMachos</td></tr>");
	echo("</table>");
	
	mysql_close($Conn);
?>