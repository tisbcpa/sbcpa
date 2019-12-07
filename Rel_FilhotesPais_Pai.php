<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
<Title>Pais e seus Filhotes</Title>
<Style>
	Span.Titulo{font-family: verdana; font-size: 13; font-weight: bold}
	Tr.Titulo{font-family: verdana; color: black; font-size: 13; font-weight: bold; background-color: #CCCCCC}
	Tr.Normal{font-family: verdana; font-size: 13;}
	Tr{font-family: verdana; font-size: 13; background-color: #F4F4F4}
	a{color:blue; text-decoration: none}
	a:hover{color:blue; text-decoration: underline}
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
		$Nome = $_POST["NoPai"];
	}
	else
	{
		$IdPai = "0";
		$Nome = "";
	}
?>

<Form name="Formulario" Method="POST">
        <table align="center" class="SemBorda">
          <tr> 
            <td>Pai&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <input type="hidden" name="IDPai" value="<?echo($IdPai);?>" OnChange="AtualizarPagina()">
            <td><input name="NoPai" type="text" size="50" maxlength="50" value="<?echo($Nome);?>" readonly title="Não digite, escolha o Pai clicando no Botão ao lado">
              <a href="javascript: AbrirPopUp('Pai')"><img src="Imagens/Escolher.gif" border="0"></a> 
            </td>
          </tr>
          <tr> 
            <td colspan="2" align="center"><input type="submit" value="Pesquisar"></td>
          </tr>
        </table>
  </Form>


<?
	if ($IdPai == 0){
		$sql = "select a.nuregistronacional, a.nocachorro, a.IdCachorro, b.dsselecao, c.dsraiox from ((tbcachorro as a left join tbselecao as b on a.idselecao = b.idselecao) left join tbraiox as c on a.idraiox = c.idraiox) where a.idninhada in (select idninhada from tbninhada where idcachorropai = '" . $IdPai . "')";}
	else{
	$sql = "select a.nuregistronacional, a.nocachorro, a.IdCachorro, b.dsselecao, c.dsraiox from ((tbcachorro as a left join tbselecao as b on a.idselecao = b.idselecao) left join tbraiox as c on a.idraiox = c.idraiox) where a.idcachorropai = $IdPai";}

	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	

	echo("<center><br><span class=Titulo>Filhotes</span><br><br></center>");
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