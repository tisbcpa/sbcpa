<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Categoria.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarCategoriaIdCategoria($Id));

		$NoCategoria = $Valores[0];
		$DsCategoria = $Valores[1];
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoCategoria = "";
		$DsCategoria = "";
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoCategoria;
	ArrayForm[1] = document.Formulario.DsCategoria;
	
	ArrayMsg[0] = " - Preenchimento do Nome da Categoria\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da Categoria\n";

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
<Form name="Formulario" Action="TBCategoria_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdCategoria" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Categorias de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome Categoria</td>
      <td colspan="3"><input name="NoCategoria" type="text" id="NoCategoria" size="60" maxlength="30" value="<? echo($NoCategoria)?>"></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsCategoria" cols="59" rows="3" id="DsCategoria"><? echo($DsCategoria)?></textarea></td>
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
