<? 
require("Estilo/Estilo.php");
require("Funcoes/RaioX.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdRaioX"];
		$NoRaioX = $_POST["NoRaioX"];
		$DsRaioX = $_POST["DsRaioX"];

		if ($Action == "U")
		{AlterarRaioX($Id,$NoRaioX,$DsRaioX);}
		else
		{CadastrarRaioX($NoRaioX,$DsRaioX);}
	}
	else
	{
		$IdRaioX = $_GET["Id"];
		ExcluirRaioXIdRaioX($IdRaioX);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbRaioX_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
