<? require("Estilo/Estilo.php");?>
<? require("Funcoes/QualificacaoCao.php");?>
<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		$Valores = split(",",PesquisarQualificacaoCaoIdQualificacaoCao($Id));

		$NoQualificacaoCao = $Valores[0];
		$DsQualificacaoCao = $Valores[1];
		$NrPontos = $Valores[2]; 
	}
	else
	{
		$Action = "N";
		$Id = "0";
		$NoQualificacaoCao = "";
		$DsQualificacaoCao = "";
		$NrPontos = "";
	}
?>
<Script>
function ValidarCampo()
{
	var ArrayForm = new Array(6);
	var ArrayMsg = new Array(7);
	var Texto = "Os seguintes passos são obrigatórios para este Formulário:\n";
	var Conferir = Texto;
	
	ArrayForm[0] = document.Formulario.NoQualificacaoCao;
	ArrayForm[1] = document.Formulario.DsQualificacaoCao;
	
	ArrayMsg[0] = " - Preenchimento do Nome da QualificacaoCao\n";
	ArrayMsg[1] = " - Preenchimento da Descrição da QualificacaoCao\n";

	for (var i=0; i<=0; i++)
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
<Form name="Formulario" Action="TBQualificacaoCao_Processar.php" method="post" onSubmit="return ValidarCampo()">
<input type="hidden" name="IdQualificacaoCao" value="<? echo($Id)?>">
<input type="hidden" name="Action" value="<? echo($Action)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Qualificação de C&atilde;es Pastores Alemães</h3></td>
    </tr>
    <tr> 
      <td>Nome Qualificação</td>
      <td colspan="3"><input name="NoQualificacaoCao" type="text" id="NoQualificacaoCao" size="60" maxlength="30" value="<? echo($NoQualificacaoCao)?>"></td>
    </tr>
    <tr> 
      <td>Pontos da Qualificação</td>
      <td colspan="3"><input name="NrPontos" type="text" id="NrPontos" size="5" maxlength="3" value="<? echo($NrPontos)?>"></td>
    </tr>
    <tr> 
      <td>Descri&ccedil;&atilde;o</td>
      <td colspan="3"><textarea name="DsQualificacaoCao" cols="59" rows="3" id="DsQualificacaoCao"><? echo($DsQualificacaoCao)?></textarea></td>
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
