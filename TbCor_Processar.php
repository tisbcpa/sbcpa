<? 
require("Estilo/Estilo.php");
require("Funcoes/Cor.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdCor"];
		$NoCor = $_POST["NoCor"];
		$DsCor = $_POST["DsCor"];

		if ($Action == "U")
		{AlterarCor($Id,$NoCor,$DsCor);}
		else
		{CadastrarCor($NoCor,$DsCor);}
	}
	else
	{
		$IdCor = $_GET["Id"];
		ExcluirCorIdCor($IdCor);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbCor_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
