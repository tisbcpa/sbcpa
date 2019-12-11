<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cachorro.php");?>
<? require("Funcoes/Sumula.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Id = $_GET["Id"];
		
		$Valores = split(";",PesquisarSumulaIDSumula($Id));
		
		if ($Valores[0] != "")
		{
			$Action = "U";
			$IDSumula = $Valores[0];
			$IDCachorro = $Valores[1];
			$IDJuiz = $Valores[2];
		
			if ($Valores[3] != "0000-00-00" && $Valores[3] != "")
			{
				list($ano, $mes, $dia) = split('[-]',$Valores[3]);
				$DTSumula = "$dia/$mes/$ano";
			}
			else
			{
				$DTSumula = "";
			}

			$NRAltura = $Valores[4];
			$NOPigmentacao = $Valores[5];
			$NOPelagem = $Valores[6];
			$InVencida = $Valores[7];
			if ($InVencida == ""){$InVencida = 0;}
			$DSSumula = $Valores[8];
			$NoCachorro = $Valores[9];
			$IDJuizReselecao = $Valores[10];

			if (($Valores[11] != "0000-00-00") && ($Valores[11] != ""))
			{
				list($ano, $mes, $dia) = split('[-]',$Valores[11]);
				$DTSumulaReselecao = "$dia/$mes/$ano";
			}
			else
			{
				$DTSumulaReselecao = "";
			}
						
			$DSSumulaReselecao = $Valores[12];
		}
		else
		{		
			$Action = "";
			$IDCachorro = $_GET["IdCachorroSumula"];
			$NoCachorro = $_GET["NoCachorroSumula"];
			$IDSumula = "";
			$IDJuiz = "";
			$DTSumula = "";
			$NRAltura = "";
			$NOPigmentacao = "";
			$NOPelagem = "";
			$InVencida = "0";
			$DSSumula = "";
			$IDJuizReselecao = "";
			$DTSumulaReselecao = "";
			$DSSumulaReselecao = "";
		}
	}
	else
	{
		$Action = "";
		$IDCachorro = "";
		$NoCachorro = "";
		$IDSumula = "";
		$IDJuiz = "";
		$DTSumula = "";
		$NRAltura = "";
		$NOPigmentacao = "";
		$NOPelagem = "";
		$InVencida = "0";
		$DSSumula = "";
		$IDJuizReselecao = "";
		$DTSumulaReselecao = "";
		$DSSumulaReselecao = "";
	}
?>

<head>
<script>
function AbrirPopUp(obj)
{
	window.open('ConsultarPreenchimento_Corpo.php?Obj='+obj,'Pesquisar','width=500, height=260');
}

function ValidarCampos()
{
	var ArrayCampos = new Array(2)
	var ArrayMsg = new Array(2)
	
	ArrayCampos[1] = document.Formulario.IDCachorro;
	ArrayMsg[1] = " - Informar o Cachorro Analisado;\n";
	ArrayCampos[2] = document.Formulario.DSSumula;
	ArrayMsg[2] = " - Informar a Descrição da Súmula;\n";	
	
	return ValidarCamposGlobal(ArrayCampos,ArrayMsg);
}

</script>
</head>

<body>
<Form name="Formulario" method="post" OnSubmit="return ValidarCampos()" action="Sumula_Processar.php">
<input type="hidden" name="Action" value="<? echo($Action)?>">
<input type="hidden" name="IDSumula" value="<? echo($IDSumula)?>">
  <table>
    <tr> 
      <td><h3>S&uacute;mula do Cachorro</h3></td>
    </tr>
    <tr> 
      <td>
       
        <table class="SemBorda">
          <tr> 
            <td>Cachorro&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <input type="hidden" name="IDCachorro" value="<? echo($IDCachorro);?>">
            <td><input name="NoCachorro" type="text" size="60" maxlength="50" readonly value="<?echo($NoCachorro);?>"> 
             <? if (!isset($_GET["IdCachorroSumula"])){?>
			  <a href="javascript: AbrirPopUp('Cachorro')"><img src="Imagens/Escolher.gif" border="0"></a>
			 <? }?>  
            </td>
          </tr>
        </table>
		<table class="SemBorda" width="100%" border="0">
          <tr>
            <td>Altura</td>
            <td><input name="NRAltura" type="text" id="NRAltura" value="<? echo($NRAltura);?>" maxlength="10"></td>
            <td>Pelagem</td>
            <td><input name="NOPelagem" type="text" id="NOPelagem" value="<? echo($NOPelagem);?>" maxlength="10"></td>
          </tr>
          <tr>
            <td>Pigmenta&ccedil;&atilde;o</td>
            <td><input name="NOPigmentacao" type="text" id="NOPigmentacao" value="<? echo($NOPigmentacao);?>" maxlength="10"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<hr>
        <table class="SemBorda" width="100%" border="0">
          <tr>
            <td colspan="2"><strong>Sele&ccedil;&atilde;o</strong></td>
          </tr>
          <tr>
            <td width="20%">Nome do Juiz</td>
            <td width="80%"><? echo(MontarCombo("Juiz",377))?></td>
          </tr>
		  <Script>
		  	document.Formulario.IdJuiz.value = '<? echo($IDJuiz)?>';
		  </Script>
          <tr>
            <td>Data</td>
            <td><input name="DTSumula" type="text" id="DTSumula" value="<? echo($DTSumula);?>" maxlength="10" onKeyUp="FormatarData(this)"></td>
          </tr>
          <tr> 
            <td colspan="2">Descri&ccedil;&atilde;o</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="DSSumula" cols="72" rows="3" id="DSSumula"><? echo($DSSumula);?></textarea></td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Re-sele&ccedil;&atilde;o</strong></td>
          </tr>
          <tr>
            <td>Nome do Juiz</td>
            <td><? echo(MontarCombo("JuizReselecao",377))?></td>
          </tr>
		  <Script>
		  	document.Formulario.IdJuizReselecao.value = '<? echo($IDJuizReselecao)?>';
		  </Script>		  
          <tr>
            <td>Data</td>
            <td><input name="DTSumulaReselecao" type="text" id="DTSumulaReselecao" value="<? echo($DTSumulaReselecao);?>" maxlength="10" onKeyUp="FormatarData(this)"></td>
          </tr>
          <tr>
            <td colspan="2">Descri&ccedil;&atilde;o</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="DSSumulaReselecao" cols="72" rows="3" id="DSSumulaReselecao"><? echo($DSSumulaReselecao);?></textarea></td>
          </tr>
        </table>
        <br>
        <table class="SemBorda" border="0">
          <tr>
            <td>Vencida</td>
            <td>&nbsp;&nbsp; 
              <input name="InVencida" type="radio" value="0">
              Não&nbsp; 
              <input type="radio" name="InVencida" value="1">
              Sim</td>
          </tr>
        </table> 
			<Script>document.Formulario.InVencida[<? echo($InVencida);?>].checked = true;</Script>
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

<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Sumula">
</form>
<?
	echo($ScriptRodape);
?>
</body>
</html>
