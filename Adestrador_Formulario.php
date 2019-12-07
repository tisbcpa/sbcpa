<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Adestrador.php");?>
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
		$Valores = split(";",PesquisarAdestradorIdAdestrador($Id));

		
		//die(PesquisarAdestradorIdAdestrador($Id));
		
		
		$NoAdestrador = $Valores[0];
		$EdAdestrador = $Valores[1];
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
		$chCriacao = $Valores[12];
		$chTrabalho = $Valores[13];
		$chRegional = $Valores[14];
		$chEstadual = $Valores[15];
		$chNacional	= $Valores[16];
		$chLocal	= $Valores[17];
		$chInternacional	= $Valores[18];
		$SgUFMontarCombo = $SgUF;
	}
	else
	{
		if (isset($_POST["IdAdestrador"]))
		{
			$Action = $_POST["Action"];
			$Id = $_POST["IdAdestrador"];
			$NoAdestrador = $_POST["NoAdestrador"];
			$EdAdestrador = $_POST["EdAdestrador"];
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
			$chCriacao = str_replace("on","1",$_POST["chCriacao"]);
			$chTrabalho = str_replace("on","1",$_POST["chTrabalho"]);
			$chRegional = str_replace("on","1",$_POST["chRegional"]);
			$chEstadual = str_replace("on","1",$_POST["chEstadual"]);
			$chNacional	= str_replace("on","1",$_POST["chNacional"]);
			$chLocal	= str_replace("on","1",$_POST["chLocal"]);
			$chInternacional	= str_replace("on","1",$_POST["chInternacional"]);
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$NoAdestrador = "";
			$EdAdestrador = "";
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
			$chCriacao = "";
			$chTrabalho = "";
			$chRegional = "";
			$chEstadual = "";
			$chNacional	= "";
			$chLocal	= "";
			$chInternacional	= "";
		}
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos s�o obrigat�rios para este Formul�rio:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.FormularioAdestrador.NoAdestrador;
	ArrayForm[1] = document.FormularioAdestrador.EdAdestrador;
	ArrayForm[2] = document.FormularioAdestrador.NoCidade;
	ArrayForm[3] = document.FormularioAdestrador.SgUF;
	ArrayForm[4] = document.FormularioAdestrador.NoBairro;
	ArrayForm[5] = document.FormularioAdestrador.NuCEP;
	
	ArrayMsg[0] = " - Preenchimento do Nome do Figurante\n";
	ArrayMsg[1] = " - Preenchimento do Endere�o do Figurante\n";
	ArrayMsg[2] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[3] = " - Preenchimento da UF\n";
	ArrayMsg[4] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[5] = " - Preenchimento do N�mero do CEP\n";

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
<Form name="FormularioAdestrador" Action="Adestrador_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdAdestrador" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Figurantes da SBCPA</h3></td>
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
      <td colspan="3"><input name="NoAdestrador" type="text" id="NoAdestrador" size="60" maxlength="50" value="<? echo($NoAdestrador)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdAdestrador" type="text" value="<? echo($EdAdestrador)?>" size="60" maxlength="50"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td>
	  	<!--input name="NoCidade" type="text" value="<? echo($NoCidade)?>" size="40" maxlength="30"-->
	   <? echo(MontarComboMunicipio($SgUFMontarCombo));?>
		<script>document.FormularioAdestrador.NoCidade.value = '<? echo($NoCidade) ?>';</script>
		</td>
      <td>UF</td>
      <td>
	  	<!--input name="SgUF" type="text" value="<? echo($SgUF)?>" size="3" maxlength="2"-->
		 <? echo(MontarComboUFFormulario('Adestrador_Formulario.php','FormularioAdestrador'));?>
		 <script>document.FormularioAdestrador.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script>
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
      <td>Qualifica��o</td>
      <td colspan="3">
      	<input type="checkbox" name="chCriacao" id="chCriacao">Cria��o &nbsp;&nbsp;&nbsp;&nbsp;
      	<input type="checkbox" name="chTrabalho" id="chTrabalho">Trabalho
	</td>
    <tr> 
      <td>N�vel</td>
      <td colspan="3">
      	<input type="checkbox" name="chLocal" id="chLocal">Local &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="chRegional" id="chRegional">Regional &nbsp;&nbsp;&nbsp;
      	<input type="checkbox" name="chEstadual" id="chEstadual">Estadual &nbsp;&nbsp;&nbsp;
      	<input type="checkbox" name="chNacional" id="chNacional">Nacional &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="chInternacional" id="chInternacional">Internacional
	</td>
    </tr>
    <?
    	if ($chCriacao == "1")
    		echo("<script>document.getElementById('chCriacao').checked=true;</script>");
    	if ($chTrabalho == "1")
    		echo("<script>document.getElementById('chTrabalho').checked=true;</script>");
    	if ($chRegional == "1")
    		echo("<script>document.getElementById('chRegional').checked=true;</script>");
    	if ($chEstadual == "1")
    		echo("<script>document.getElementById('chEstadual').checked=true;</script>");
    	if ($chNacional == "1")
    		echo("<script>document.getElementById('chNacional').checked=true;</script>");
    	if ($chLocal == "1")
    		echo("<script>document.getElementById('chLocal').checked=true;</script>");
    	if ($chInternacional == "1")
    		echo("<script>document.getElementById('chInternacional').checked=true;</script>");
    ?>
    <tr> 
      <td>Observa��o</td>
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
	<input type="hidden" name="Tipo" value="Adestrador">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
