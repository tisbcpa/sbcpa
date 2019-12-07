<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Adestramento.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarAdestramentoIdAdestramento($Id));

		$NoAdestramento = $Valores[0];
		$DsAdestramento = $Valores[1];
		$InAlemanha = $Valores[2];
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoAdestramento = "";
		$DsAdestramento = "";
		$InAlemanha = 0;
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoAdestramento;
	ArrayForm[1] = document.Formulario.DsAdestramento;
	
	ArrayMsg[0] = " - Preenchimento do Nome da Adestramento\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da Adestramento\n";

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
<Form name="Formulario" Action="TBAdestramento_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdAdestramento" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Adestramento de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome Adestramento</td>
      <td colspan="3"><input name="NoAdestramento" type="text" id="NoAdestramento" size="60" maxlength="30" value="<? echo($NoAdestramento)?>"></td>
    </tr>
    <tr> 
      <td colspan="4">Adestramento Alem&atilde;o? 
        <input type="radio" name="InAdestramento" value="0">
        Não 
        <input type="radio" name="InAdestramento" value="1">
        Sim </td>
    </tr>
	<script>document.Formulario.InAdestramento[<? echo($InAlemanha)?>].checked = true;</script>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsAdestramento" cols="59" rows="3" id="DsAdestramento"><? echo($DsAdestramento)?></textarea></td>
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
