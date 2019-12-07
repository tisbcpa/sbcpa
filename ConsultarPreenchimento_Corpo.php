<? 
$menu = false;
require("Estilo/Estilo.php");
?>
<?
	$obj = $_GET["Obj"];
?>

<Script>
function EnviarConsulta()
{
	document.Formulario.submit();
}

function EscolherItem(Id,No)
{
	self.opener.Formulario.No<?echo($obj)?>.value = No;
	self.opener.Formulario.ID<?echo($obj)?>.value = Id;
	window.close();	
}
</Script>

<body OnLoad="document.Formulario.Parametro.focus()">
<Form name="Formulario" target="Resultado" Action="ConsultarPreenchimento_Iframe.php" method="post">
<input type="hidden" name="Tipo" value="<?echo($obj)?>">
  <table border="0">
    <tr> 
      <td colspan="4"><h3>Consultar para preenchimento</h3></td>
    </tr>
    <tr> 
      <td>Nome <?echo($obj)?></td>
      <td colspan="3"><input name="Parametro" type="text" size="60" maxlength="100" onBlur="EnviarConsulta()"></td>
    </tr>
    <tr> 
      <td colspan="4"><div align="center">
	  <iframe name="Resultado" width="100%" height="100%" frameborder="0"></iframe>
	  </div></td>
    </tr>
  </table>
</Form>

</body>
</html>
