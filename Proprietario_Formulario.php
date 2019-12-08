<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Proprietario.php");?>
<? require("Funcoes/Municipio.php");?>
<?
	if (isset($_POST["SgUF"]))
	{$SgUFMontarCombo = $_POST["SgUF"];}
	else
	{$SgUFMontarCombo = "DF";}
	
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(";",PesquisarProprietarioIdProprietario($Id));

		$NoProprietario = $Valores[0];
		$EdProprietario = $Valores[1];
		$NoCidade = $Valores[2];
		$SgUF = $Valores[3];
		$SgUFMontarCombo = $SgUF;
		$NoBairro = $Valores[4];
		$NuCEP = $Valores[5];
		$NoEmail = $Valores[6];
		$NuTelefones = $Valores[7];
		$TPAssociado = $Valores[8];
		$DsHomePage = $Valores[9];
	}
	else
	{
		if(isset($_POST["IdProprietario"]))
		{
			$Id = $_POST["IdProprietario"];
			$Action = $_POST["Action"];
			$NoProprietario = $_POST["NoProprietario"];
			$EdProprietario = $_POST["EdProprietario"];
			
			if (isset($_POST["NoCidade"]))
			{	$NoCidade = $_POST["NoCidade"];}
			else
			{	$NoCidade = "";}
			
			$SgUF = $_POST["SgUF"];
			$SgUFMontarCombo = $SgUF;
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];
			$NoEmail = $_POST["NoEmail"];
			$NuTelefones = $_POST["NuTelefones"];
			$TPAssociado = $_POST["TPAssociado"];
			$DsHomePage = $_POST["DsHomePage"];
		}
		else
		{		
			$Action = "N";
			$Id = "0";
			$NoProprietario = "";
			$EdProprietario = "";
			$NoCidade = "";
			$SgUF = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoEmail = "";
			$NuTelefones = "";
			$TPAssociado = "1";
			$DsHomePage = "";		
		}
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;

	ArrayForm[0] = document.FormularioProprietario.NoProprietario;
	ArrayForm[1] = document.FormularioProprietario.EdProprietario;
	ArrayForm[2] = document.FormularioProprietario.NoCidade;
	ArrayForm[3] = document.FormularioProprietario.SgUF;
	ArrayForm[4] = document.FormularioProprietario.NoBairro;
	ArrayForm[5] = document.FormularioProprietario.NuCEP;
	
	ArrayMsg[0] = " - Preenchimento do Nome do Proprietario\n";
	ArrayMsg[1] = " - Preenchimento do Endereço do Proprietario\n";
	ArrayMsg[2] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[3] = " - Preenchimento da UF\n";
	ArrayMsg[4] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[5] = " - Preenchimento do Número do CEP\n";

	for (var i=0; i<=5; i++)
	{
		if (ArrayForm[i].value == '')
		{
			Texto = Texto + ArrayMsg[i];		
		}	
	}
	
	if (Conferir != Texto)	{alert(Texto); return false;}
	if (Conferir == Texto)	{return true;}
}
</Script>

<body>
<Form name="FormularioProprietario" Action="Proprietario_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdProprietario" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Proprietários de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome</td>
      <td colspan="3"><input name="NoProprietario" type="text" id="NoProprietario" size="60" maxlength="50" value="<? echo($NoProprietario)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdProprietario" type="text" value="<? echo($EdProprietario)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td>
	  	<!--input name="NoCidade" type="text" value="<? echo($NoCidade)?>" size="40" maxlength="30"-->
	   <? echo(MontarComboMunicipio($SgUFMontarCombo));?>
	   </td>
      <td>UF</td>
      <td>
	  	<!--input name="SgUF" type="text" value="<? echo($SgUF)?>" size="3" maxlength="2"-->
	 <? echo(MontarComboUFFormulario('Proprietario_Formulario.php','FormularioProprietario'));?>
	 <script>document.FormularioProprietario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script>
		<script>document.FormularioProprietario.NoCidade.value = '<? echo($NoCidade) ?>';</script>
	</td>
    </tr>
    <tr> 
      <td>Bairro</td>
      <td><input name="NoBairro" type="text" value="<? echo($NoBairro)?>" size="40" maxlength="30"></td>
      <td>CEP</td>
      <td><input name="NuCEP" type="text" value="<? echo($NuCEP)?>" size="12" maxlength="9"></td>
    </tr>
    <tr> 
      <td>e-mail</td>
      <td colspan="3"><input name="NoEmail" type="text" value="<? echo($NoEmail)?>" size="60" maxlength="50"></td>
    </tr>
    <tr>
      <td>Site</td>
      <td colspan="3"><input name="DsHomePage" type="text" value="<? echo($DsHomePage)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Telefones</td>
      <td colspan="3"><textarea name="NuTelefones" cols="59" rows="3" id="NuTelefones"><? echo($NuTelefones)?></textarea></td>
    </tr>
    <tr> 
      <td>Status</td>
      <td colspan="3"> <input name="TPAssociado" type="Radio" id="TPAssociado" value="0">
        N&atilde;o 
        <input name="TPAssociado" type="Radio" id="TPAssociado" value="1" checked>
        Sim </td>
      <Script>
	  	document.FormularioProprietario.TPAssociado[<? echo($TPAssociado)?>].checked = true;
	  </Script>
    </tr>
    <tr> 
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> 
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</Form>


<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Proprietario">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
