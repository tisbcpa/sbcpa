<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Canil.php");?>
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
		$Valores = split(";",PesquisarCanilIdCanil($Id));

		$NoCriador = $Valores[0];
		$NoCanil = $Valores[1];
		$EdCanil = $Valores[2];
		$NoBairro = $Valores[3];
		$NuCEP = $Valores[4];
		$NoCidade = $Valores[5];
		$SgUF = $Valores[6];
		$SgUFMontarCombo = $SgUF;		
		$TPCanil = $Valores[7];
		$NrTelefones = $Valores[8];
		$EdInternet = $Valores[9];
		$InDebito = $Valores[10];
		$DSEmail = $Valores[11];
		$DTFiliacao = $Valores[12];
		$DSObservacao = $Valores[13];
		$DTFiliacao = str_replace("00/00/0000","",$DTFiliacao);
	}
	else
	{
		if (isset($_POST["IdCanil"]))
		{
			$Action = $_POST["Action"];
			$Id = $_POST["IdCanil"];
			$NoCriador = $_POST["NoProprietarioCanil"];
			$NoCanil = $_POST["NoCanil"];
			$EdCanil = $_POST["EdCanil"];
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];

			if (isset($_POST["NoCidade"]))
			{$NoCidade = $_POST["NoCidade"];}
			else
			{$NoCidade = "";}
			
			$SgUF = $_POST["SgUF"];
			$TPCanil = $_POST["TPCanil"];
			$NrTelefones = $_POST["NrTelefones"];
			$EdInternet = $_POST["EdInternet"];
			$InDebito = $_POST["InDebito"];
			$DSEmail = $_POST["DSEmail"];
			$DTFiliacao = $_POST["DTFiliacao"];
			$DSObservacao = $_POST["DSObservacao"];
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$NoCriador = "";
			$NoCanil = "";
			$NoCriadorOutro = "";
			$EdCanil = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoCidade = "";
			$SgUF = "";
			$TPCanil = "";
			$NrTelefones = "";
			$EdInternet = "";
			$InDebito = "";
			$DSEmail = "";
			$DTFiliacao = "";
			$DSObservacao = "";
		}
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(7);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoProprietarioCanil;
	ArrayForm[1] = document.Formulario.NoCanil;
	ArrayForm[2] = document.Formulario.EdCanil;
	ArrayForm[3] = document.Formulario.NoBairro;
	ArrayForm[4] = document.Formulario.NoCidade;
	ArrayForm[5] = document.Formulario.SgUF;
	ArrayForm[6] = document.Formulario.TPCanil;
	
	ArrayMsg[0] = " - Preenchimento do Nome dos Proprietários\n";
	ArrayMsg[1] = " - Preenchimento do Nome do Canil\n";
	ArrayMsg[2] = " - Preenchimento do Endereço do Canil\n";
	ArrayMsg[3] = " - Preenchimento do Bairro\n";
	ArrayMsg[4] = " - Preenchimento da Cidade\n";
	ArrayMsg[5] = " - Preenchimento da UF\n";
	ArrayMsg[6] = " - Preenchimento do Tipo do Canil\n";

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
<Form name="Formulario" Action="Canil_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdCanil" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Canil de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td width="73">Nome Canil</td>
      <td colspan="3"><input name="NoCanil" type="text" id="NoCanil" size="60" maxlength="30" value="<? echo($NoCanil)?>"></td>
    </tr>
    <tr> 
      <td> Propriet&aacute;rios</td>
      <td colspan="3"><textarea name="NoProprietarioCanil" type="text" cols="59" rows="3" id="NoProprietarioCanil"><? echo($NoCriador)?></textarea></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdCanil" type="text" id="EdCanil" size="60" maxlength="50" value="<? echo($EdCanil)?>"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td width="262">
	  	<!--input name="NoCidade" type="text" id="NoCidade" size="40" maxlength="30" value="<? echo($NoCidade)?>"-->
	  	<? echo(MontarComboMunicipio($SgUFMontarCombo));?>
		<script>document.Formulario.NoCidade.value = '<? echo($NoCidade) ?>';</script>
		</td>
      <td width="29">UF</td>
      <td width="82">
	  	<!--input name="SgUF" type="text" id="SgUF4" size="4" maxlength="2" value="<? echo($SgUF)?>"-->
	 <? echo(MontarComboUF('Canil_Formulario.php'));?>
	 <script>document.Formulario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script>
	   </td>
    </tr>
    <tr> 
      <td>Bairro</td>
      <td><input name="NoBairro" type="text" id="NoBairro" size="40" maxlength="30" value="<? echo($NoBairro)?>"></td>
      <td>CEP</td>
      <td><input name="NuCEP" type="text" id="NuCEP2" size="10" maxlength="9" value="<? echo($NuCEP)?>"></td>
    </tr>
    <tr> 
      <td>Telefones</td>
      <td colspan="3"><textarea name="NrTelefones" cols="59" rows="3" id="NrTelefones"><? echo($NrTelefones)?></textarea></td>
    </tr>
    <tr> 
      <td>Site</td>
      <td colspan="3"><input name="EdInternet" type="text" id="EdInternet" size="60" maxlength="50" value="<? echo($EdInternet)?>"></td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td colspan="3"><input name="DSEmail" type="text" id="DSEmail" size="60" maxlength="50" value="<? echo($DSEmail)?>"></td>
    </tr>

    <tr>
      <td>Data de Filiação</td>
      <td colspan="3"><input name="DTFiliacao" type="text" id="DTFiliacao" size="12" maxlength="10" value="<? echo($DTFiliacao)?>"  onKeyUp="FormatarData(this)"></td>
    </tr>

    <tr> 
      <td>Tipo</td>
      <td colspan="3">
        <input type="radio" name="TPCanil" value="0">
        Vital&iacute;cio
	  <input name="TPCanil" type="radio" value="1" checked>
        Contribuinte </td>
		<Script>document.Formulario.TPCanil[<? echo($TPCanil)?>].checked = true;</Script>
    </tr>
    <tr> 
      <td>D&eacute;bito? </td>
      <td colspan="3">
        <input name="InDebito" type="radio" value="0" checked>
        N&atilde;o
	  <input type="radio" name="InDebito" value="1">
        Sim </td>
		<Script>document.Formulario.InDebito[<? echo($InDebito)?>].checked = true;</Script>
    </tr>
    <tr> 
      <td>Observação</td>
      <td colspan="3"><textarea name="DSObservacao" type="text" cols="59" rows="3" id="DSObservacao"><? echo($DSObservacao)?></textarea></td>
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

</body>
</html>

<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Canil">
	<? echo($ScriptRodape);?>
</form>