<? 
require("Estilo/Estilo.php");
require("Funcoes/Clube.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdClube"];
		$SgClube = $_POST["SgClube"];
		$NoClube = $_POST["NoClube"];
		$NoPais = $_POST["NoPais"];
		$EdClube = $_POST["EdClube"];
		$NoBairro = $_POST["NoBairro"];
		$NuCEP = $_POST["NuCEP"];
		$NoCidade = $_POST["NoCidade"];
		$SgUF = $_POST["SgUF"];
		$NuTelefones = $_POST["NuTelefones"];
		$NoEmail = $_POST["NoEmail"];
		$NoPresidente = $_POST["NoPresidente"];
		$NoDiretoria = $_POST["NoDiretoria"];
		$NoContatos = $_POST["NoContatos"];
		$DsHomePage = $_POST["DsHomePage"];
		$DsUsuario = $_POST["DsUsuario"];
		$DsSenha = $_POST["DsSenha"];
		$STClubeInativo = $_POST["STClubeInativo"];

		if ($Action == "U")
		{AlterarClube($Id,$SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage,$DsUsuario,$DsSenha,$STClubeInativo);}
		else
		{CadastrarClube($SgClube,$NoClube,$NoPais,$EdClube,$NoBairro,$NuCEP,$NoCidade,$SgUF,$NuTelefones,$NoEmail,$NoPresidente,$NoDiretoria,$NoContatos,$DsHomePage,$DsUsuario,$DsSenha,$STClubeInativo);}
	}
	else
	{
		$IdClube = $_GET["Id"];
		ExcluirClubeIdClube($IdClube);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Clube_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
