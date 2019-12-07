<? 
require("Estilo/Estilo.php");
require("Funcoes/Socio.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdSocio"];
		$NoSocio = $_POST["NoSocio"];
		$EdSocio = $_POST["EdSocio"];
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
		{AlterarSocio($Id,$NoSocio,$EdSocio,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$DsObservacao,$IdClube,$StSocio);}
		else
		{CadastrarSocio($NoSocio,$EdSocio,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$DsObservacao,$IdClube,$StSocio);}
	}
	else
	{
		$IdSocio = $_GET["Id"];
		ExcluirSocioIdSocio($IdSocio);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Socio_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
