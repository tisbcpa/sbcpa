<? 
$menu = false;
require("Estilo/Estilo.php");?>
<? require("Funcoes/Provas.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
	if (isset($_POST["IdProva"]))
	{
		$IdProva = $_POST["IdProva"];
		$IDCachorro = $_POST["IDCachorro"];
		$InQualificacao = $_POST["IdQualificacaoCao"];
		$NuA = $_POST["NuA"];
		$NuB = $_POST["NuB"];
		$NuC = $_POST["NuC"];
		$NuTotal = $_POST["NuTotal"];
		
		CadastrarResultadoProva($IdProva,$IDCachorro,$InQualificacao,$NuA,$NuB,$NuC,$NuTotal);

		?>
		<script>
		function Atualizar()
		{		
			opener.location.href = "Provas_ListarCachorros.php?Id=<?echo($IdProva);?>";
		}

		function Fechar()
		{
			window.close();
		}
		setTimeout(Atualizar,100);
		setTimeout(Fechar,200);
		</script>

		<?
		die();
	}
?>

<head>
<script>
function AbrirPopUp(obj)
{
	window.open('ConsultarPreenchimento_Corpo.php?Obj='+obj,'Pesquisar','width=500, height=260');
}

</script>
<title>Cadastrar Cachorros - Prova</title></head>


<body>
<Form name="Formulario" method="post">
<input type="hidden" name="IdProva">


  <table>
    <tr> 
      <td><h3>Resultado Individual na Prova</h3></td>
    </tr>
    <tr> 
      <td>

	  </legend>
        <table class="SemBorda">
          <tr> 
            <td width="80">Cachorro</td>
			<input type="hidden" name="IDCachorro">
            <td width="384"><input name="NoCachorro" type="text" id="NuRegistroNacional" size="55"> <a href="javascript: AbrirPopUp('Cachorro')"><img src="Imagens/Escolher.gif" border="0"></a>
            </td>
          </tr>
        </table>
        <table class="SemBorda">
          <tr> 
            <td width="80">Qualifica&ccedil;&atilde;o</td>
            <td width="178"><? echo(MontarCombo("QualificacaoCao",250))?> </td>
          </tr>
        </table>
		<br>
        <table align="center" class="SemBorda">
          <tr> 
            <td> <div align="center">A</div></td>
            <td> <div align="center">B </div></td>
            <td> <div align="center">C</div></td>
            <td> <div align="center">Total </div></td>
          </tr>
          <tr>
            <td>
				<select name="NuA" onChange="TotalizarPontos()">
				<? for ($i=0; $i<=100; $i++)	{echo("<option value='". $i ."'>". $i ."</option>");} ?>
				</select>
			</td>
            <td>
				<select name="NuB" onChange="TotalizarPontos()">
				<? for ($i=0; $i<=100; $i++)	{echo("<option value='". $i ."'>". $i ."</option>");} ?>
				</select>
			</td>
            <td>
				<select name="NuC" onChange="TotalizarPontos()">
				<? for ($i=0; $i<=100; $i++)	{echo("<option value='". $i ."'>". $i ."</option>");} ?>
				</select>
			</td>
            <td><input type="text" name="NuTotal" size="8" readonly=""></td>
          </tr>
        </table>

        <br>
  </td>
    </tr>
    <tr> 
      <td> <div align="center"><br>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div><br></td>
    </tr>
  </table>
</Form>

<script>
function TotalizarPontos()
{
	var JNuA = parseInt(document.Formulario.NuA.value);
	var JNuB = parseInt(document.Formulario.NuB.value);
	var JNuC = parseInt(document.Formulario.NuC.value);
	var JNuTotal = JNuA + JNuB + JNuC;
	document.Formulario.NuTotal.value = JNuTotal;			
}

	document.Formulario.IdProva.value = opener.parent.Formulario.IdProva.value;
	TotalizarPontos();
</script>


</body>
</html>
