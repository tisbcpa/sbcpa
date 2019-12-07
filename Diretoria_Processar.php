<? 
require("Estilo/Estilo.php");
require("Funcoes/Diretoria.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{		
		$Id = $_POST["IdDiretoria"];
		$NoDiretoria = $_POST["NoDiretoria"];
		$EdDiretoria = $_POST["EdDiretoria"];
		$NoCidade = $_POST["NoCidade"];
		$SgUF = $_POST["SgUF"];
		$NoBairro = $_POST["NoBairro"];
		$NuCEP = $_POST["NuCEP"];
		$NoEmail = $_POST["NoEmail"];
		$NuTelefones = $_POST["NuTelefones"];
		$DsHomePage = $_POST["DsHomePage"];
		$DsObservacao = $_POST["DsObservacao"];
		$IdClube = $_POST["idClube"];
		$StSocio = $_POST["StSocio"];
		

		if ($Action == "U")
		{AlterarDiretoria($Id,$NoDiretoria,$EdDiretoria,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StSocio);}
		else
		{CadastrarDiretoria($NoDiretoria,$EdDiretoria,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StSocio);}
	}
	else
	{
		$IdDiretoria = $_GET["Id"];
		ExcluirDiretoriaIdDiretoria($IdDiretoria);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Diretoria_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
