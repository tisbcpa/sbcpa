<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Selecao.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarSelecaoIdSelecao($Id));

		$NoSelecao = $Valores[0];
		$DsSelecao = $Valores[1];
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoSelecao = "";
		$DsSelecao = "";
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoSelecao;
	ArrayForm[1] = document.Formulario.DsSelecao;
	
	ArrayMsg[0] = " - Preenchimento do Nome da Selecao\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da Selecao\n";

	for (var i=0; i<=1; i++)
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
<Form name="Formulario" Action="TBSelecao_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdSelecao" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Selecao de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome Selecao</td>
      <td colspan="3"><input name="NoSelecao" type="text" id="NoSelecao" size="60" maxlength="30" value="<? echo($NoSelecao)?>"></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsSelecao" cols="59" rows="3" id="DsSelecao"><? echo($DsSelecao)?></textarea></td>
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
