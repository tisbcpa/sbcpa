<? 
require("Estilo/Estilo.php");
require("Funcoes/Categoria.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdCategoria"];
		$NoCategoria = $_POST["NoCategoria"];
		$DsCategoria = $_POST["DsCategoria"];

		if ($Action == "U")
		{AlterarCategoria($Id,$NoCategoria,$DsCategoria);}
		else
		{CadastrarCategoria($NoCategoria,$DsCategoria);}
	}
	else
	{
		$IdCategoria = $_GET["Id"];
		ExcluirCategoriaIdCategoria($IdCategoria);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbCategoria_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
