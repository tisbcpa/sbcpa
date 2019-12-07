<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Socio.php");?>
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
		
		
		//die(PesquisarSocioIdSocio($Id));
		
		$Valores = split(";",PesquisarSocioIdSocio($Id));

		$NoSocio = $Valores[0];
		$EdSocio = $Valores[1];
		$NoCidade = $Valores[2];
		$SgUF = $Valores[3];
		$NoBairro = $Valores[4];
		$NuCEP = $Valores[5];
		$NoEmail = $Valores[6];
		$NuTelefones = $Valores[7];
		$DsHomePage = $Valores[8];
		$DsObservacao = $Valores[9];
		$Filiada = $Valores[10];
		$Status = $Valores[11];
		$SgUFMontarCombo = $SgUF;
	}
	else
	{
		if (isset($_POST["IdSocio"]))
		{
			$Action = $_POST["Action"];
			$Id = $_POST["IdSocio"];
			$NoSocio = $_POST["NoSocio"];
			$EdSocio = $_POST["EdSocio"];
			//$NoCidade = $_POST["NoCidade"];
			$SgUF = $_POST["SgUF"];
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];
			$NoEmail = $_POST["NoEmail"];
			$NuTelefones = $_POST["NuTelefones"];
			$DsHomePage = $_POST["DsHomePage"];
			$DsObservacao = $_POST["DsObservacao"];
			$Filiada = $_POST["idClube"];
			$Status = $_POST["StSocio"];
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$NoSocio = "";
			$EdSocio = "";
			$NoCidade = "";
			$SgUF = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoEmail = "";
			$NuTelefones = "";
			$DsHomePage = "";
			$DsObservacao = "";
			$Filiada = "";
			$Status = "";
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
	
	ArrayForm[0] = document.FormularioSocio.NoSocio;
	ArrayForm[1] = document.FormularioSocio.EdSocio;
	ArrayForm[2] = document.FormularioSocio.NoCidade;
	ArrayForm[3] = document.FormularioSocio.SgUF;
	ArrayForm[4] = document.FormularioSocio.NoBairro;
	ArrayForm[5] = document.FormularioSocio.NuCEP;
	
	ArrayMsg[0] = " - Preenchimento do Nome do Sócio\n";
	ArrayMsg[1] = " - Preenchimento do Endereço do Sócio\n";
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
<Form name="FormularioSocio" Action="Socio_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdSocio" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0" width=600>
    <tr> 
      <td colspan="4"><h3>Sócio da SBCPA</h3></td>
    </tr>
          <tr> 
            <td>Filiada</td>
            <td colspan=3><?=MontarComboClube()?></td>
          </tr>
    	<script>
    		document.getElementById('idClube').value = '<?=$Filiada;?>';
    	</script>
    <tr> 
      <td>Nome</td>
      <td colspan="3"><input name="NoSocio" type="text" id="NoSocio" size="60" maxlength="50" value="<? echo($NoSocio)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdSocio" type="text" value="<? echo($EdSocio)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td>
	  	<!--input name="NoCidade" type="text" value="<? echo($NoCidade)?>" size="40" maxlength="30"-->
	   <? echo(MontarComboMunicipio($SgUFMontarCombo));?>
		<script>document.FormularioSocio.NoCidade.value = '<? echo($NoCidade) ?>';</script>
		</td>
      <td>UF</td>
      <td>
	  	<!--input name="SgUF" type="text" value="<? echo($SgUF)?>" size="3" maxlength="2"-->
		 <? echo(MontarComboUFFormulario('Socio_Formulario.php','FormularioSocio'));?>
		 <script>document.FormularioSocio.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script>
		</td>
    </tr>
    <tr> 
      <td>Bairro</td>
      <td><input name="NoBairro" type="text" value="<? echo($NoBairro)?>" size="40" maxlength="30"></td>
      <td>CEP</td>
      <td><input name="NuCEP" type="text" value="<? echo($NuCEP)?>" size="12" maxlength="9"></td>
    </tr>
    <tr>
      <td>Site</td>
      <td colspan="3"><input name="DsHomePage" type="text" value="<? echo($DsHomePage)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>e-mail</td>
      <td colspan="3"><input name="NoEmail" type="text" value="<? echo($NoEmail)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Telefones</td>
      <td colspan="3"><textarea name="NuTelefones" cols="59" rows="3" id="NuTelefones"><? echo($NuTelefones)?></textarea></td>
    </tr>
    <tr> 
      <td>Observações</td>
      <td colspan="3"><textarea name="DsObservacao" cols="59" rows="3" id="DsObservacao"><? echo($DsObservacao)?></textarea></td>
    </tr>
    <tr> 
      <td>Status</td>
      <td colspan="3">
      
      	<select name="StSocio" id="StSocio">
      		<option value="1">Ativo</option>
      		<option value="0">Inativo</option>
      	</select>

    	<script>
    		document.getElementById('StSocio').value = '<?=$Status;?>';
    	</script>
      
      
		</td>
    </tr>    
    <tr> 
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> 
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="button" value="Limpar Dados" onClick="window.location.href='?';">
        </div></td>
    </tr>
  </table>
</Form>


<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Socio">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
