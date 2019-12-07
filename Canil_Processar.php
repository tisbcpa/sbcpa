<? 
require("Estilo/Estilo.php");
require("Funcoes/Canil.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdCanil"];
		$NoProprietarioCanil = $_POST["NoProprietarioCanil"];
		$NoCanil = $_POST["NoCanil"];
		$EdCanil = $_POST["EdCanil"];
		$NoBairro = $_POST["NoBairro"];
		$NuCEP = $_POST["NuCEP"];
		$NoCidade = $_POST["NoCidade"];
		$SgUF = $_POST["SgUF"];
		$TPCanil = $_POST["TPCanil"];
		$NrTelefones = $_POST["NrTelefones"];
		$EdInternet = $_POST["EdInternet"];
		$InDebito = $_POST["InDebito"];
		$DSEmail = $_POST["DSEmail"];
		$DTFiliacao = $_POST["DTFiliacao"];
		$DsObservacao = $_POST["DSObservacao"];

		if ($Action == "U")
		{AlterarCanil($Id,$NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail,$DTFiliacao,$DsObservacao);}
		else
		{CadastrarCanil($NoProprietarioCanil,$NoCanil,$EdCanil,$NoBairro,$NuCEP,$NoCidade,$SgUF,$TPCanil,$NrTelefones,$EdInternet,$InDebito,$DSEmail,$DTFiliacao,$DsObservacao);}
	}
	else
	{
		$IdCanil = $_GET["Id"];
		ExcluirCanilIdCanil($IdCanil);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Canil_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
