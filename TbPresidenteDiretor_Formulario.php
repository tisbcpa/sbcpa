<? require("Estilo/Estilo.php");?>
<? require("Funcoes/PresidenteDiretor.php");?>
<?
	$NoPresidente = PesquisarDirigente(2); //Presidente
	$NoDiretor = PesquisarDirigente(3); //Diretor


?>
<Script>
function ValidarCampo()
{
	if ((document.Formulario.NoDiretor.value == '') || (document.Formulario.NoPresidente.value == '')){
		alert('Preenchar os dois campos');
		return false;
	}
	else{
		return true;
	}
}
</Script>

<body>
<Form name="Formulario" Action="TBPresidenteDiretor_Processar.php" method="post" onSubmit="return ValidarCampo()">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Presidente e Diretor</h3></td>
    </tr>
    <tr> 
      <td>Nome do Presidente</td>
      <td colspan="3"><input name="NoPresidente" type="text" id="NoPresidente" size="70" maxlength="50" value="<? echo($NoPresidente)?>"></td>
    </tr>
    <tr> 
      <td>Nome do Diretor</td>
      <td colspan="3"><input name="NoDiretor" type="text" id="NoDiretor" size="70" maxlength="50" value="<? echo($NoDiretor)?>"></td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center"> <br>
          <input type="Submit" value="Gravar Dados">
          &nbsp;&nbsp; 
          <input type="reset" value="Limpar Dados">
        </div></td>
    </tr>
  </table>
</Form>

</body>
</html>
