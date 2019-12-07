<? 
$menu = false;
require("Estilo/Estilo.php");?>
<? require("Funcoes/Ninhada.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
	if (isset($_POST["IdNinhada"]))
	{
		$NoNinhada = $_POST["IdNinhada"];
		$NoPai = $_POST["IdPai"];
		$NoMae = $_POST["IdMae"];
		$IDCanil = $_POST["IdCanil"];
		$DtNascimento = $_POST["DtNascimento"];
		$NuRegistroNacional = "SBCPA " . $_POST["NuRegistroNacional"];
		$NuCBKC = $_POST["NuCBKC"];
		$NoTatuagem = $_POST["NoTatuagem"];
		$NoCachorro = $_POST["NoCachorro"];
		$TPSexo = $_POST["TPSexo"];
		$IdCor = $_POST["IdCor"];
		
		$IDProprietario = "";
		$NuRegistroInternacional  = "";
		$NuRegistroRegional  = "";
		$SgUFRegistro  = "";
		$IdRaioX  = "";
		$DtRaioX  = "";
		$IdAdestramento  = "";
		$DtProvaAdestramento = ""; 
		$IdSelecao  = "";
		$DtSelecao  = "";
		$IdQualificacaoCao  = "";
		$InResistencia  = "";
		$DtResistencia  = "";
		$DsObservacao  = "";		
		
		
		CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao);

		?>
		<script>
		function Atualizar()
		{		
			opener.location.href = "Ninhada_ListarFilhotes.php?Id=<?echo($NoNinhada);?>";
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
<title>Cadastrar Filhotes</title></head>


<body>
<Form name="Formulario" method="post">
<input type="hidden" name="IdNinhada">
<input type="hidden" name="IdPai">
<input type="hidden" name="IdMae">
<input type="hidden" name="IdCanil">
<input type="hidden" name="DtNascimento">



  <table>
    <tr> 
      <td><h3>Cadastrar Filhote</h3></td>
    </tr>
    <tr> 
      <td>
	  <fieldset id="Dados" style="width: 495">
	  <legend>
	     <table>
        <tr>
            <td>Dados do Filhote</td>
        </tr>
      </table>
	  </legend>
        <table class="SemBorda">
          <tr> 
            <td width="104">N&ordm; do Registro</td>
            <td width="151"><input name="NuRegistroNacional" type="text" id="NuRegistroNacional" size="20" maxlength="15">
            </td>
          </tr>
        </table>
        <table class="SemBorda">
          <tr> 
            <td width="103">N&ordm; do CBKC</td>
            <td width="154"><input name="NuCBKC" type="text" id="NuCBKC" size="25" maxlength="20"> 
            </td>
          </tr>
        </table>
        <table class="SemBorda">
          <tr> 
            <td width="103">N&ordm; da Tatuagem</td>
            <td width="155"><input name="NoTatuagem" type="text" id="NoTatuagem" size="25" maxlength="20"> 
            </td>
          </tr>
        </table>
        <table class="SemBorda">
          <tr> 
            <td width="104">Nome do Animal</td>
            <td width="346"><input name="NoCachorro" type="text" id="NoCachorro" size="57" maxlength="50"> 
            </td>
          </tr>
        </table>
        <table width="383" class="SemBorda">
          <tr> 
            <td width="109">Sexo do Animal</td>
            <td width="135"><select name="TPSexo">
                <option></option>
                <option value="M">Macho</option>
                <option value="F">F&ecirc;mea</option>
              </select>
            </td>
            <td width="33">Cor</td>
            <td width="86"><? echo(MontarCombo("Cor",100))?> </td>
          </tr>
        </table>
        </fieldset>
        <br>
  </td>
    </tr>
    <tr> 
      <td> <div align="center"><br>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</Form>

<script>
	//document.Formulario.IdNinhada.value = opener.parent.Formulario.IdNinhada.value + opener.parent.Formulario.NrAnoNinhada.value;
	document.Formulario.IdNinhada.value = opener.parent.Formulario.Id.value; 
	document.Formulario.IdPai.value = opener.parent.Formulario.IDPai.value;
	document.Formulario.IdMae.value = opener.parent.Formulario.IDMae.value;
	document.Formulario.IdCanil.value = opener.parent.Formulario.IDCanil.value;
	document.Formulario.DtNascimento.value = opener.parent.Formulario.DaNascimento.value;

</script>


</body>
</html>
