<? 
require("Estilo/Estilo.php");
require("Funcoes/Adestramento.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdAdestramento"];
		$NoAdestramento = $_POST["NoAdestramento"];
		$DsAdestramento = $_POST["DsAdestramento"];
		$InAdestramento = $_POST["InAdestramento"];

		if ($Action == "U")
		{AlterarAdestramento($Id,$NoAdestramento,$DsAdestramento,$InAdestramento);}
		else
		{CadastrarAdestramento($NoAdestramento,$DsAdestramento,$InAdestramento);}
	}
	else
	{
		$IdAdestramento = $_GET["Id"];
		ExcluirAdestramentoIdAdestramento($IdAdestramento);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbAdestramento_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
