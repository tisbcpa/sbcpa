<? 
require("Estilo/Estilo.php");
require("Funcoes/Juiz.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdJuiz"];
		$NoJuiz = $_POST["NoJuiz"];
		$DaNascimento = $_POST["DaNascimento"];
		$EdJuiz = $_POST["EdJuiz"];
		$NoCidade = $_POST["NoCidade"];
		$SgUF = $_POST["SgUF"];
		$NoBairro = $_POST["NoBairro"];
		$NuCEP = $_POST["NuCEP"];
		$NoEmail = $_POST["NoEmail"];
		$NuTelefones = $_POST["NuTelefones"];
		$Qualificacoes = $_POST["Qualificacoes"];
		$TPNivel = $_POST["TPNivel"];
		$TPStatus = $_POST["TPStatus"];
		$IdQualificacaoJuiz = $_POST["Qualificacoes"];
		$DSObservacao = $_POST["DSObservacao"];
		$IdQualificacoes = str_replace(",",";",$IdQualificacaoJuiz);
	//	die($IdQualificacoes);

		
		//echo("$NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus");
		if ($Action == "U")
		{AlterarJuiz($Id,$NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus,$IdQualificacaoJuiz,$DSObservacao);}
		else
		{CadastrarJuiz($NoJuiz,$DaNascimento,$EdJuiz,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$TPNivel,$TPStatus,$IdQualificacaoJuiz,$DSObservacao);}
	}
	else
	{
		$IdJuiz = $_GET["Id"];
		ExcluirJuizIdJuiz($IdJuiz);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Juiz_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
