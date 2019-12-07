<? require("Estilo/Estilo.php");?>
<? require("Funcoes/RaioX.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarRaioXIdRaioX($Id));

		$NoRaioX = $Valores[0];
		$DsRaioX = $Valores[1];
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoRaioX = "";
		$DsRaioX = "";
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoRaioX;
	ArrayForm[1] = document.Formulario.DsRaioX;
	
	ArrayMsg[0] = " - Preenchimento do Nome da RaioX\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da RaioX\n";

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
<Form name="Formulario" Action="TBRaioX_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdRaioX" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>RaioX de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome RaioX</td>
      <td colspan="3"><input name="NoRaioX" type="text" id="NoRaioX" size="60" maxlength="30" value="<? echo($NoRaioX)?>"></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsRaioX" cols="59" rows="3" id="DsRaioX"><? echo($DsRaioX)?></textarea></td>
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
