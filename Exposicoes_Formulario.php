<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cachorro.php");?>
<? require("Funcoes/Exposicoes.php");?>
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
		$Valores = split(";",PesquisarExposicaoIdExposicao($Id));

		$IdClube = $Valores[0];
		$NoExposicao = $Valores[1];
		$EdExposicao = $Valores[2];
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
		$InCINENacional = $Valores[8];
		$InPontosDobrado = $Valores[9];
	}
	else
	{

		if (isset($_POST["IdExposicao"]))
		{
			$Id = $_POST["IdExposicao"];
			$Action = $_POST["Action"];
			$IdClube = $_POST["IdClube"];
			$NoExposicao = $_POST["NoExposicao"];
			$EdExposicao = $_POST["EdExposicao"];
			$DTInicio = $_POST["DTInicio"];
			$DTTermino = $_POST["DTTermino"];
			$InCINENacional = $_POST["InCINENacional"];
			$InPontosDobrado = $_POST["InPontosDobrado"];
			$NoJuizes = $_POST["NoJuizes"];
			
		
			if (isset($_POST["NoCidade"]))
			{$NoCidade = $_POST["NoCidade"];}
			else
			{$NoCidade = "";}		
		
			$SgUF = $_POST["SgUF"];
		}
		else
		{
			$Id = "";
			$Action = "N";
			$IdExposicao = "";
			$IdClube = "";
			$NoExposicao = "";
			$EdExposicao = "";
			$NoCidade = "";
			$SgUF = "";
			$DTInicio = "";
			$DTTermino = "";
			$NoJuizes = "";
			$InCINENacional = "0";
			$InPontosDobrado = "0";
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
</Script>

<body>
<Form name="Formulario" Action="Exposicoes_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdExposicao" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Cadastro de Exposi&ccedil;&otilde;es </h3></td>
    </tr>
    <tr> 
      <td width="78">Sigla Clube</td>
      <td colspan="3"><? echo(MontarCombo("Clube",377))?></td>
    </tr>
	<script>document.Formulario.IdClube.value = '<? echo($IdClube);?>';</script>
    <tr> 
      <td>Nome</td>
      <td colspan="3"><input name="NoExposicao" type="text" size="60" maxlength="50" value="<? echo($NoExposicao)?>"></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o</td>
      <td colspan="3"><input name="EdExposicao" type="text" id="EdExposicao" size="60" maxlength="50" value="<? echo($EdExposicao)?>"></td>
    </tr>
    <tr> 
      <td>Cidade</td>
      <td width="269"> 
        <!--input name="NoCidade" type="text" id="NoCidade" size="40" maxlength="30" value="<? echo($NoCidade)?>"-->
        <? echo(MontarComboMunicipio($SgUFMontarCombo));?> <script>document.Formulario.NoCidade.value = '<? echo($NoCidade) ?>';</script> 
      </td>
      <td width="29">UF</td>
      <td width="86"> <? echo(MontarComboUF('Exposicoes_Formulario.php'));?> <script>document.Formulario.SgUF.value = '<? echo($SgUFMontarCombo)?>';</script> 
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
      <td colspan="4"><table class="SemBorda" width="100%" border="0">
          <tr>
            <td width="21%">Pontua&ccedil;&atilde;o CINE</td>
            <td width="26%"><input type="radio" name="InCINENacional" value="0">
              N&atilde;o 
              <input type="radio" name="InCINENacional" value="1">
              Sim</td>
		<Script>document.Formulario.InCINENacional[<? echo($InCINENacional);?>].checked = true;</Script>
            <td width="27%"><div align="right">Pontos Dobrados</div></td>
            <td width="26%"><input type="radio" name="InPontosDobrado" value="0">
              N&atilde;o 
              <input type="radio" name="InPontosDobrado" value="1">
              Sim</td>
          </tr>
        </table>
		<Script>document.Formulario.InPontosDobrado[<? echo($InPontosDobrado);?>].checked = true;</Script>
		
		</td>
    </tr>
    <tr> 
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> 
          <input type="Submit" value="Gravar Dados da Exposição">
		<? if ($Id != "") {?>
		<input type="button" value="Atualizar/Ver Pontuação" OnClick="GerarPontos(<? echo($Id)?>)">
		<!-- input type="button" value="Imprimir Dados" OnClick="Relatorio(<? echo($Id)?>)" -->
		&nbsp;&nbsp; 
		<? }?>
          <!-- &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
          -->
        </div></td>
    </tr>
	<? if ($Id != "") {?>
	<tr>
		<td colspan="4">
		<br>
		<iframe name="IframeNinhada" src="" width="480" height="300" scrolling="auto" frameborder="0"></iframe>
		</td>
	</tr>
		<script>
		function Relatorio(Id)
		{
			window.open('Exposicoes_Relatorio.php?Id='+Id,'Pedigree','width=780, height=520, scrollbars=yes, menubar=yes');
		}

		function GerarPontos(Id)
		{
			window.open('Exposicoes_GerarResultado.php?Id='+Id,'Pedigree','width=780, height=520, scrollbars=yes, menubar=yes');
		}

		function ListarFilhotes()
		{
			IframeNinhada.location.href = 'Exposicoes_ListarCachorros.php?Id=<? echo($Id);?>';
		}
		
		setTimeout(ListarFilhotes,100);
		</script>
	<? }?>
  </table>
  
  
</Form>

<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Exposicao">
	<? echo($ScriptRodape);?>
</form>
</body>
</html>
