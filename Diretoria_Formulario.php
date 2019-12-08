<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Diretoria.php");?>
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
		$Valores = split(";",PesquisarDiretoriaIdDiretoria($Id));

		
		//die(PesquisarDiretoriaIdDiretoria($Id));
		
		
		$NoDiretoria = $Valores[0];
		$EdDiretoria = $Valores[1];
		$NoCidade = $Valores[2];
		$SgUF = $Valores[3];
		$NoBairro = $Valores[4];
		$NuCEP = $Valores[5];
		$NoEmail = $Valores[6];
		$NuTelefones = $Valores[7];
		$DsHomePage = $Valores[8];
		$Filiada = $Valores[9];
		$DsObservacao = $Valores[10];
		$Status = $Valores[11];		
		$SgUFMontarCombo = $SgUF;
	}
	else
	{
		if (isset($_POST["IdDiretoria"]))
		{
			$Action = $_POST["Action"];
			$Id = $_POST["IdDiretoria"];
			$NoDiretoria = $_POST["NoDiretoria"];
			$EdDiretoria = $_POST["EdDiretoria"];
			//$NoCidade = $_POST["NoCidade"];
			$SgUF = $_POST["SgUF"];
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];
			$NoEmail = $_POST["NoEmail"];
			$NuTelefones = $_POST["NuTelefones"];
			$DsHomePage = $_POST["DsHomePage"];
			$Filiada = $_POST["idClube"];
			$DsObservacao = $_POST["DsObservacao"];
			$Status = $_POST["StSocio"];			
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$NoDiretoria = "";
			$EdDiretoria = "";
			$NoCidade = "";
			$SgUF = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoEmail = "";
			$NuTelefones = "";
			$DsHomePage = "";
			$Filiada = "";
			$DsObservacao = "";
			$Status = "";			
		}
	}
	
	
	$Filiada = "103";
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.FormularioDiretoria.NoDiretoria;
	ArrayForm[1] = document.FormularioDiretoria.EdDiretoria;
	ArrayForm[2] = document.FormularioDiretoria.NoCidade;
	ArrayForm[3] = document.FormularioDiretoria.SgUF;
	ArrayForm[4] = document.FormularioDiretoria.NoBairro;
	ArrayForm[5] = document.FormularioDiretoria.NuCEP;
	
	ArrayMsg[0] = " - Preenchimento do Nome do Diretor\n";
	ArrayMsg[1] = " - Preenchimento do Endereço do Diretor\n";
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
<Form name="FormularioDiretoria" Action="Diretoria_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdDiretoria" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Diretoria da SBCPA</h3></td>
    </tr>
          <tr style="display:none"> 
            <td>Filiada</td>
            <td colspan=3><?=MontarComboClube()?></td>
          </tr>
    	<script>
    		document.getElementById('idClube').value = '<?=$Filiada;?>';
    	</script>
    
    <tr> 
      <td>Nome</td>
      <td colspan="3"><input name="NoDiretoria" type="text" id="NoDiretoria" size="60" maxlength="50" value="<? echo($NoDiretoria)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdDiretoria" type="text" value="<? echo($EdDiretoria)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td>
	  	<!--input name="NoCidade" type="text" value="<? echo($NoCidade)?>" size="40" maxlength="30"-->
	   <? echo(MontarComboMunicipio($SgUFMontarCombo));?>
		<script>document.FormularioDiretoria.NoCidade.value = '<? echo($NoCidade) ?>';</script>
		</td>
      <td>UF</td>
      <td>
	  	<!--input name="SgUF" type="text" value="<? echo($SgUF)?>" size="3" maxlength="2"-->
		 <? echo(MontarComboUFFormulario('Diretoria_Formulario.php','FormularioDiretoria'));?>
		 <script>document.FormularioDiretoria.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script>
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
      <td>Cargo:</td>
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
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</Form>


<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Diretoria">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
