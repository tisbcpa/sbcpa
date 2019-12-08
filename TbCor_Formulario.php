<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cor.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarCorIdCor($Id));

		$NoCor = $Valores[0];
		$DsCor = $Valores[1];
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoCor = "";
		$DsCor = "";
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoCor;
	ArrayForm[1] = document.Formulario.DsCor;
	
	ArrayMsg[0] = " - Preenchimento do Nome da Cor\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da Cor\n";

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
<Form name="Formulario" Action="TBCor_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdCor" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Cores de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome Cor</td>
      <td colspan="3"><input name="NoCor" type="text" id="NoCor" size="60" maxlength="20" value="<? echo($NoCor)?>"></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsCor" cols="59" rows="3" id="DsCor"><? echo($DsCor)?></textarea></td>
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
