<? 
require("Estilo/Estilo.php");
require("Funcoes/Provas.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
			$Id = $_POST["IdProva"];
			$IdClube = $_POST["IdClube"];
			$NoProva = $_POST["NoProva"];
			$EdProva = $_POST["EdProva"];
			$DTInicio = $_POST["DTInicio"];
			$DTTermino = $_POST["DTTermino"];
			$NoTiposProva = $_POST["NoTiposProva"];
			$NoJuizes = $_POST["NoJuizes"];
			$NoCidade = $_POST["NoCidade"];
			$SgUF = $_POST["SgUF"];

		if ($Action == "U")
		{AlterarProva($Id,$IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF);}
		else
		{CadastrarProva($IdClube,$NoProva,$EdProva,$DTInicio,$DTTermino,$NoTiposProva,$NoJuizes,$NoCidade,$SgUF);}
	}
	else
	{
		$IdProva = $_GET["Id"];
		ExcluirProvaIdProva($IdProva);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Provas_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
