<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Clube.php");?>
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
		$Valores = split(";",PesquisarClubeIdClube($Id));

		$SgClube = $Valores[0];
		$NoClube = $Valores[1];
		$NoPais = $Valores[2];
		$EdClube = $Valores[3];
		$NoBairro = $Valores[4];
		$NuCEP = $Valores[5];
		$NoCidade = $Valores[6];
		$SgUF = $Valores[7];
		$SgUFMontarCombo = $SgUF;
		$NuTelefones = $Valores[8];
		$NoEmail = $Valores[9];
		$NoPresidente = $Valores[10];
		$NoDiretoria = $Valores[11];
		$NoContatos = $Valores[12];
		$DsHomePage = $Valores[13];
		$DsUsuario = $Valores[14];
		$DsSenha = $Valores[15];
		$STClubeInativo = $Valores[16];
		if ($STClubeInativo == ""){
			$STClubeInativo = 0;
		}
		//$DsObservacao = $Valores[16];
	}
	else
	{

		if (isset($_POST["IdClube"]))
		{
			$Id = $_POST["IdClube"];
			$Action = $_POST["Action"];
			$SgClube = $_POST["SgClube"];
			$NoClube = $_POST["NoClube"];
			$NoPais = $_POST["NoPais"];
			$EdClube = $_POST["EdClube"];
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];
		
			if (isset($_POST["NoCidade"]))
			{$NoCidade = $_POST["NoCidade"];}
			else
			{$NoCidade = "";}		
		
			$SgUF = $_POST["SgUF"];
			$NuTelefones = $_POST["NuTelefones"];
			$NoEmail = $_POST["NoEmail"];
			$NoPresidente = $_POST["NoPresidente"];
			$NoDiretoria = $_POST["NoDiretoria"];
			$NoContatos = $_POST["NoContatos"];
			$DsHomePage = $_POST["DsHomePage"];
			$DsUsuario = $_POST["DsUsuario"];
			$DsSenha = $_POST["DsSenha"];
			$STClubeInativo = $_POST["STClubeInativo"];
			//$DsObservacao = $_POST["DsObservacao"];
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$SgClube = "";
			$NoClube = "";
			$NoPais = "";
			$EdClube = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoCidade = "";
			$SgUF = "";
			$NuTelefones = "";
			$NoEmail = "";
			$NoPresidente = "";
			$NoDiretoria = "";
			$NoContatos = "";
			$DsHomePage = "";
			$DsUsuario = "";
			$DsSenha = "";
			$STClubeInativo = "";
			//$DsObservacao = "";
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
	
	ArrayForm[0] = document.Formulario.SgClube;
	ArrayForm[1] = document.Formulario.NoClube;
	ArrayForm[2] = document.Formulario.EdClube;
	ArrayForm[3] = document.Formulario.NoBairro;
	ArrayForm[4] = document.Formulario.NoCidade;
	ArrayForm[5] = document.Formulario.SgUF;
	ArrayForm[6] = document.Formulario.NoPresidente;
	
	ArrayMsg[0] = " - Preenchimento da Sigla do Clube\n";
	ArrayMsg[1] = " - Preenchimento do Nome do Clube\n";
	ArrayMsg[2] = " - Preenchimento do Endereço do Clube\n";
	ArrayMsg[3] = " - Preenchimento do Bairro\n";
	ArrayMsg[4] = " - Preenchimento da Cidade\n";
	ArrayMsg[5] = " - Preenchimento da UF\n";
	ArrayMsg[6] = " - Preenchimento do Nome do Presidente\n";

	for (var i=0; i<=6; i++)
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
<Form name="Formulario" Action="Clube_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdClube" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Clube de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Sigla Clube</td>
      <td colspan="3"><input name="SgClube" type="text" id="SgClube" size="12" maxlength="10" value="<? echo($SgClube)?>"></td>
    </tr>
    <tr> 
      <td width="78">Nome Clube</td>
      <td colspan="3"><input name="NoClube" type="text" id="NoClube" size="60" maxlength="100" value="<? echo($NoClube)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdClube" type="text" id="EdClube" size="60" maxlength="50" value="<? echo($EdClube)?>"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td width="269">
        <!--input name="NoCidade" type="text" id="NoCidade" size="40" maxlength="30" value="<? echo($NoCidade)?>"-->
        <? echo(MontarComboMunicipio($SgUFMontarCombo));?> <script>document.Formulario.NoCidade.value = '<? echo($NoCidade) ?>';</script> 
      </td>
      <td width="29">UF</td>
      <td width="86"> <? echo(MontarComboUF('Clube_Formulario.php'));?> <script>document.Formulario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script> 
        <!--input name="SgUF" type="text" id="SgUF4" size="4" maxlength="2" value="<? echo($SgUF)?>"-->
      </td>
    </tr>
    <tr> 
      <td>Bairro</td>
      <td><input name="NoBairro" type="text" id="NoBairro" size="40" maxlength="30" value="<? echo($NoBairro)?>"></td>
      <td>CEP</td>
      <td><input name="NuCEP" type="text" id="NuCEP2" size="10" maxlength="9" value="<? echo($NuCEP)?>"></td>
    </tr>
    <tr> 
      <td>Pais</td>
      <td colspan="3"><input name="NoPais" type="text" id="NoPais" size="40" maxlength="30" value="<? echo($NoPais)?>"></td>
    </tr>
    <tr> 
      <td>Telefones</td>
      <td colspan="3"><textarea name="NuTelefones" cols="59" rows="2" id="NuTelefones"><? echo($NuTelefones)?></textarea></td>
    </tr>
    <tr> 
      <td>E-mail</td>
      <td colspan="3"><input name="NoEmail" type="text" id="NoEmail" size="60" maxlength="50" value="<? echo($NoEmail)?>"></td>
    </tr>
    <tr>
      <td>Site</td>
      <td colspan="3"><input name="DsHomePage" type="text" id="DsHomePage" size="60" maxlength="50" value="<? echo($DsHomePage)?>"></td>
    </tr>
    <tr> 
      <td>Presidente</td>
      <td colspan="3"><input name="NoPresidente" type="text" id="NoPresidente" size="60" maxlength="50" value="<? echo($NoPresidente)?>"></td>
    </tr>
    <tr> 
      <td>Diretoria</td>
      <td colspan="3"><textarea name="NoDiretoria" cols="59" rows="3" id="NoDiretoria"><? echo($NoDiretoria)?></textarea></td>
    </tr>
    <tr> 
      <td>Contatos</td>
      <td colspan="3"><textarea name="NoContatos" cols="59" rows="2" id="NoContatos"><? echo($NoContatos)?></textarea></td>
    </tr>
    <tr>
      <td>Usuário Extranet</td>
      <td colspan="3"><input name="DsUsuario" type="text" size="30" maxlength="30" value="<? echo($DsUsuario)?>"></td>
   </tr>
    <tr>
      <td>Senha Extranet</td>
      <td colspan="3"><input name="DsSenha" type="text" size="30" maxlength="30" value="<? echo($DsSenha)?>"></td>
    </tr>
    <tr>
      <td>Filiada Inativa?</td>
      <td colspan="3"><input name="STClubeInativo" type="radio" value="0" checked>Não &nbsp;&nbsp;<input name="STClubeInativo" type="radio" value="1">Sim</td>
	  <script>document.Formulario.STClubeInativo[<? echo($STClubeInativo);?>].checked = true;</script>
    </tr>	
    <!--tr>
      <td>Observa&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsObservacao" cols="59" rows="2" id="DsObservacao"><? //echo($DsObservacao)?></textarea></td>
    </tr-->
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
	<input type="hidden" name="Tipo" value="Clube">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
