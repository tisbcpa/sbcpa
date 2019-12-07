<? 
require("Estilo/Estilo.php");
require("Funcoes/Proprietario.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdProprietario"];

		$NoProprietario = $_POST["NoProprietario"];
		$EdProprietario = $_POST["EdProprietario"];
		$NoCidade = $_POST["NoCidade"];
		$SgUF = $_POST["SgUF"];
		$NoBairro = $_POST["NoBairro"];
		$NuCEP = $_POST["NuCEP"];
		$NoEmail = $_POST["NoEmail"];
		$NuTelefones = $_POST["NuTelefones"];
		$TPAssociado = $_POST["TPAssociado"];
		$DSHomePage = $_POST["DsHomePage"];


		if ($Action == "U")
		{AlterarProprietario($Id,$NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DSHomePage);}
		else
		{CadastrarProprietario($NoProprietario,$EdProprietario,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPAssociado,$DSHomePage);}
	}
	else
	{
		$IdSelecao = $_GET["Id"];
		ExcluirProprietarioIdProprietario($IdSelecao);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Proprietario_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
