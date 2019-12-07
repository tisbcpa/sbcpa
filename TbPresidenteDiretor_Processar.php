<? 
require("Estilo/Estilo.php");
require("Funcoes/PresidenteDiretor.php");

	$Presidente = $_POST["NoPresidente"];
	$Diretor = $_POST["NoDiretor"];
	AlterarDirigente($Presidente,$Diretor);
?>
<Script>
function Redirect()
{window.location.href = 'TbPresidenteDiretor_Formulario.php';}

setTimeout('Redirect()',2000);
</Script>
