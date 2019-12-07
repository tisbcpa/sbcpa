<? 
require("Estilo/Estilo.php");
require("Funcoes/Selecao.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdSelecao"];
		$NoSelecao = $_POST["NoSelecao"];
		$DsSelecao = $_POST["DsSelecao"];

		if ($Action == "U")
		{AlterarSelecao($Id,$NoSelecao,$DsSelecao);}
		else
		{CadastrarSelecao($NoSelecao,$DsSelecao);}
	}
	else
	{
		$IdSelecao = $_GET["Id"];
		ExcluirSelecaoIdSelecao($IdSelecao);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbSelecao_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
