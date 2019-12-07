<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Juiz.php");?>
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
		$Valores = split(";",PesquisarJuizIdJuiz($Id));
		$NoJuiz = $Valores[0];
		
		$DaNascimento = $Valores[1];
		if ($DaNascimento != '')
		{
			list($ano, $mes, $dia) = split('[-]',$DaNascimento);
			$DaNascimento = "$dia/$mes/$ano";
			$DaNascimento = str_replace("00/00/0000","",$DaNascimento);
		}
		
		$EdJuiz = $Valores[2];
		$NoCidade = $Valores[3];
		$SgUF = $Valores[4];
		$SgUFMontarCombo = $SgUF;
		$NoBairro = $Valores[5];
		$NuCEP = $Valores[6];
		$NoEmail = $Valores[7];
		$NrTelefones = $Valores[8];
		$TPNivel = $Valores[9];
		$TPStatus = $Valores[10];
		$DSObservacao = $Valores[11];
	}
	else
	{
		if (isset($_POST["IdJuiz"]))
		{
			$Id = $_POST["IdJuiz"];
			$NoJuiz = $_POST["NoJuiz"];
			$DaNascimento = $_POST["DaNascimento"];
			$EdJuiz = $_POST["EdJuiz"];
			$SgUF = $_POST["SgUF"];
			$NoBairro = $_POST["NoBairro"];
			$NuCEP = $_POST["NuCEP"];
			$NoEmail = $_POST["NoEmail"];
			$NrTelefones = $_POST["NuTelefones"];
			$Qualificacoes = $_POST["Qualificacoes"];
			$TPNivel = $_POST["TPNivel"];
			$TPStatus = $_POST["TPStatus"];
			$NoCidade = "";
			$DSObservacao = $_POST["DSObservacao"];
		}
		else
		{
			$Action = "N";
			$Id = "0";
			$NoJuiz = "";
			$DaNascimento = "";
			$EdJuiz = "";
			$NoCidade = "";
			$SgUF = "";
			$NoBairro = "";
			$NuCEP = "";
			$NoEmail = "";
			$NrTelefones = "";
			$TPNivel = "1";
			$TPStatus = "1";
			$DSObservacao = "";
		}
	}
?>
<Script>
function ValidarCampo()
{
/*	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	var c = parseInt(document.Formulario.IdQualificacaoJuiz.length);
	var CheckQualificacao = false;
	
	ArrayForm[0] = document.Formulario.NoJuiz;
	ArrayForm[1] = document.Formulario.EdJuiz;
	ArrayForm[2] = document.Formulario.NoCidade;
	ArrayForm[3] = document.Formulario.SgUF;
	ArrayForm[4] = document.Formulario.NoBairro;
	ArrayForm[5] = document.Formulario.NuCEP;
	
	ArrayMsg[0] = " - Preenchimento do Nome do Juiz\n";
	ArrayMsg[1] = " - Preenchimento do Endereço do Juiz\n";
	ArrayMsg[2] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[3] = " - Preenchimento da UF\n";
	ArrayMsg[4] = " - Preenchimento do Nome da Cidade\n";
	ArrayMsg[5] = " - Preenchimento do Número do CEP\n";
	ArrayMsg[6] = " - Preenchimento da Qualificação do Juiz\n";

	for (var i=0; i<=5; i++)
	{
		if (ArrayForm[i].value == '')
		{
			Texto = Texto + ArrayMsg[i];		
		}	
	}

	document.Formulario.Qualificacoes.value = '';
	for (var i=0; i<c; i++){
		if (document.Formulario.IdQualificacaoJuiz[i].checked == true){
			CheckQualificacao = true;
			document.Formulario.Qualificacoes.value = document.Formulario.Qualificacoes.value +';'+ document.Formulario.IdQualificacaoJuiz[i].value;
		}
	}

	if (!CheckQualificacao) {Texto = Texto + ArrayMsg[6];}
	
	if (Conferir != Texto)	{alert(Texto); return false;}
	if (Conferir == Texto)	{return true;}
*/
return true;
}
</Script>

<body>
<Form name="Formulario" Action="Juiz_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdJuiz" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
<table border="0">
  <tr> 
    <td colspan="4"><h3>Juizes de C&atilde;es Pastores Alemães</h3></td>
  </tr>
  <tr> 
    <td>Nome</td>
    <td colspan="3"><input name="NoJuiz" type="text" id="NoJuiz" size="60" maxlength="50" value="<? echo($NoJuiz)?>"></td>
  </tr>
  <tr> 
    <td> Nascimento</td>
    <td colspan="3"><input name="DaNascimento" type="text" value="<? echo($DaNascimento)?>" size="12" maxlength="10"></td>
  </tr>
  <tr> 
    <td>Endere&ccedil;o</td>
    <td colspan="3"><input name="EdJuiz" type="text" value="<? echo($EdJuiz)?>" size="60" maxlength="50"></td>
  </tr>
  <tr> 
    <td>Cidade</td>
    <td>
	  	<? echo(MontarComboMunicipio($SgUFMontarCombo));?>
		<script>document.Formulario.NoCidade.value = '<? echo($NoCidade) ?>';</script>
	</td>
    <td>UF</td>
    <td>	 <? echo(MontarComboUF('Juiz_Formulario.php'));?>
	 <script>document.Formulario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script></td>
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
    <td>Telefones</td>
    <td colspan="3"><textarea name="NuTelefones" cols="59" rows="3" id="NuTelefones"><? echo($NrTelefones)?></textarea></td>
  </tr>
  <tr> 
    <td>Qualifica&ccedil;&atilde;o</td>
    <td colspan="3"> 
	  <input type="hidden" name="Qualificacoes">
      <? MontarCheckQualificacoesJuiz($Id)?>
	  
  	<script>
	function EscreverCheck()
	{
		document.Formulario.Qualificacoes.value = "";
		var tam = document.Formulario.IdQualificacaoJuiz.length;
		for (var i=1; i<=tam; i++)
		{
			if (document.Formulario.IdQualificacaoJuiz[i-1].checked)
			{document.Formulario.Qualificacoes.value = document.Formulario.Qualificacoes.value + document.Formulario.IdQualificacaoJuiz[i-1].value + ',';}
		}
	}
	EscreverCheck()
	</script>

    </td>
  </tr>
  <tr> 
    <td>N&iacute;vel</td>
    <td colspan="3">
	  <input name="TPNivel" type="radio" value="R" checked>
      Regional 
	  <input name="TPNivel" type="radio" value="E" checked>
      Estadual
      <input type="radio" name="TPNivel" value="N">
      Nacional 
      <input type="radio" name="TPNivel" value="I">
      Internacional</td>

	<?
		if ($TPNivel == 'R'){ $op = 0;}
		if ($TPNivel == 'E'){ $op = 1;}
		if ($TPNivel == 'N'){ $op = 2;}
		if ($TPNivel == 'I'){ $op = 3;}	
	?>
	  <Script>
	  	document.Formulario.TPNivel[<? echo($op)?>].checked = true;
	  </Script>
  </tr>
  <tr> 
    <td>Juiz Ativo</td>
    <td colspan="3">
      <input name="TPStatus" type="Radio" id="TPStatus" value="0">
      N&atilde;o
  	  <input name="TPStatus" type="Radio" id="TPStatus" value="1" checked>
      Sim 
	</td>
	  <Script>
	  	document.Formulario.TPStatus[<? echo($TPStatus)?>].checked = true;
	  </Script>
  </tr>
  <tr> 
    <td>Observação:</td>
    <td colspan="3">
		<textarea name="DSObservacao" cols="59" rows="3" id="DSObservacao"><? echo($DSObservacao)?></textarea>
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
	<input type="hidden" name="Tipo" value="Juiz">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
