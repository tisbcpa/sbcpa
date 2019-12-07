<? 
require("Estilo/Estilo.php");
require("Funcoes/Exposicoes.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
			$Id = $_POST["IdExposicao"];
			$IdClube = $_POST["IdClube"];
			$NoExposicao = $_POST["NoExposicao"];
			$EdExposicao = $_POST["EdExposicao"];
			$DTInicio = $_POST["DTInicio"];
			$DTTermino = $_POST["DTTermino"];
			$InCINENacional = $_POST["InCINENacional"];
			$InPontosDobrado = $_POST["InPontosDobrado"];
			$NoJuizes = $_POST["NoJuizes"];
			$NoCidade = $_POST["NoCidade"];
			$SgUF = $_POST["SgUF"];

		if ($Action == "U")
		{
			AlterarExposicao($Id,$IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF);
			$Pagina = "Exposicoes_Formulario.php?Id=$Id";
		}
		else
		{
			CadastrarExposicao($IdClube,$NoExposicao,$EdExposicao,$DTInicio,$DTTermino,$InCINENacional,$InPontosDobrado,$NoJuizes,$NoCidade,$SgUF);
			$Pagina = "Exposicoes_Listar.php";
		}
	}
	else
	{
		$IdExposicao = $_GET["Id"];
		ExcluirExposicaoIdExposicao($IdExposicao);
		$Pagina = "Exposicoes_Listar.php";
	}
?>
<Script>
function Redirect()
{window.location.href = '<?echo($Pagina);?>';}

setTimeout('Redirect()',2000);
</Script>
