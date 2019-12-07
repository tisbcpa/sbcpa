<? 
require("Estilo/Estilo.php");
require("Funcoes/QualificacaoJuiz.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdQualificacaoJuiz"];
		$NoQualificacaoJuiz = $_POST["NoQualificacaoJuiz"];
		$DsQualificacaoJuiz = $_POST["DsQualificacaoJuiz"];

		if ($Action == "U")
		{AlterarQualificacaoJuiz($Id,$NoQualificacaoJuiz,$DsQualificacaoJuiz);}
		else
		{CadastrarQualificacaoJuiz($NoQualificacaoJuiz,$DsQualificacaoJuiz);}
	}
	else
	{
		$IdQualificacaoJuiz = $_GET["Id"];
		ExcluirQualificacaoJuizIdQualificacaoJuiz($IdQualificacaoJuiz);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbQualificacaoJuiz_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
