<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cachorro.php");?>
<? require("Funcoes/Provas.php");?>
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
		$Valores = split(";",PesquisarProvaIdProva($Id));

		$IdClube = $Valores[0];
		$NoProva = $Valores[1];
		$EdProva = $Valores[2];
		$NoCidade = $Valores[3];
		$SgUF = $Valores[4];
		$SgUFMontarCombo = $SgUF;
		
		list($ano, $mes, $dia) = split('[-]',$Valores[5]);
		$DTInicio = "$dia/$mes/$ano";
		$DTInicio = str_replace("00/00/0000","",$DTInicio);
		
		list($ano, $mes, $dia) = split('[-]',$Valores[6]);
		$DTTermino = "$dia/$mes/$ano";
		$DTTermino = str_replace("00/00/0000","",$DTTermino);

		$NoJuizes = $Valores[7];
		$NoTiposProva = $Valores[8];
	}
	else
	{
		if (isset($_POST["IdProva"]))
		{
			$Id = $_POST["IdProva"];
			$Action = $_POST["Action"];
			$IdClube = $_POST["IdClube"];
			$NoProva = $_POST["NoProva"];
			$EdProva = $_POST["EdProva"];
			$DTInicio = $_POST["DTInicio"];
			$DTTermino = $_POST["DTTermino"];
			$NoTiposProva = $_POST["NoTiposProva"];
			$NoJuizes = $_POST["NoJuizes"];
			
			if (isset($_POST["NoCidade"]))
			{$NoCidade = $_POST["NoCidade"];}
			else
			{$NoCidade = "";}		
		
			$SgUF = $_POST["SgUF"];
			$SgUFMontarCombo = $SgUF;
		}
		else
		{
			$Id = "";
			$Action = "N";
			$IdProva = "";
			$IdClube = "";
			$NoProva = "";
			$EdProva = "";
			$NoCidade = "";
			$SgUF = "";
			$DTInicio = "";
			$DTTermino = "";
			$NoJuizes = "";
			$NoTiposProva = "";
			$SgUFMontarCombo = "";
		}
	}
?>
<Script>
function ValidarCampo()
{
/*
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
	
	ArrayMsg[0] = " - Preenchimento do Nome da Criador\n";
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
	*/
	return true;
}

function Relatorio(Id)
{
	window.open('Provas_Relatorio.php?Id='+Id,'Provas','width=780, height=520, scrollbars=yes, menubar=yes');
}
</Script>

<body>
<Form name="Formulario" Action="Provas_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdProva" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Cadastro de Provas</h3></td>
    </tr>
    <tr> 
      <td width="78">Sigla Clube</td>
      <td colspan="3"><? echo(MontarCombo("Clube",377))?></td>
    </tr>
    <script>document.Formulario.IdClube.value = '<? echo($IdClube);?>';</script>
    <tr> 
      <td>Nome</td>
      <td colspan="3"><input name="NoProva" type="text" size="60" maxlength="50" value="<? echo($NoProva)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdProva" type="text" size="60" maxlength="50" value="<? echo($EdProva)?>"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td width="269"> 
        <!--input name="NoCidade" type="text" id="NoCidade" size="40" maxlength="30" value="<? echo($NoCidade)?>"-->
        <? echo(MontarComboMunicipio($SgUFMontarCombo));?>  
      </td>
      <td width="29">UF</td>
      <td width="86"> <? echo(MontarComboUF('Provas_Formulario.php'));?> 
	  <script>document.Formulario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script> 
	<script>document.Formulario.NoCidade.value = '<? echo($NoCidade) ?>';</script>	  
        <!--input name="SgUF" type="text" id="SgUF4" size="4" maxlength="2" value="<? echo($SgUF)?>"-->
      </td>
    </tr>
    <tr> 
      <td colspan="4"><table class="SemBorda" width="100%" border="0">
          <tr> 
            <td>Data In&iacute;cio</td>
            <td><input name="DTInicio" type="text" value="<? echo($DTInicio);?>"></td>
            <td>Data T&eacute;rmino</td>
            <td><input name="DTTermino" type="text" value="<? echo($DTTermino);?>"></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>Ju&iacute;zes</td>
      <td colspan="3"><textarea name="NoJuizes" cols="59" rows="2"><? echo($NoJuizes)?></textarea></td>
    </tr>
    <tr> 
      <td>Tipos </td>
      <td colspan="3"><textarea name="NoTiposProva" cols="59" rows="2"><? echo($NoTiposProva)?></textarea></td>
    </tr>
    <tr> 
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> 
	<? if ($Id != ""){?>
	<input type="button" value="Imprimir Dados" OnClick="Relatorio(<? echo($Id)?>)">
	<? }?>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
	<? if ($Id != ""){?>
    <tr> 
      <td colspan="4"> <br> <iframe name="IframeProvas" src="" width="480" height="100" scrolling="auto" frameborder="0"></iframe> 
      </td>
    </tr>
		<script>
		function ListarFilhotes()
		{
			IframeProvas.location.href = 'Provas_ListarCachorros.php?Id=<? echo($Id);?>';
		}
		
		setTimeout(ListarFilhotes,100);
		</script>
	<? }?>
  </table>
  
  
</Form>
</body>
</html>



<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Prova">
	<? echo($ScriptRodape);?>
</form>


