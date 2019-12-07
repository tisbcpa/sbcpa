<? 
require("Estilo/Estilo.php");
require("Funcoes/QualificacaoCao.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdQualificacaoCao"];
		$NoQualificacaoCao = $_POST["NoQualificacaoCao"];
		$DsQualificacaoCao = $_POST["DsQualificacaoCao"];
		$NrPontos = $_POST["NrPontos"];

		if ($Action == "U")
		{AlterarQualificacaoCao($Id,$NoQualificacaoCao,$DsQualificacaoCao,$NrPontos);}
		else
		{CadastrarQualificacaoCao($NoQualificacaoCao,$DsQualificacaoCao,$NrPontos);}
	}
	else
	{
		$IdQualificacaoCao = $_GET["Id"];
		ExcluirQualificacaoCaoIdQualificacaoCao($IdQualificacaoCao);
	}
?>
<Script>
function Redirect()
{window.location.href = 'TbQualificacaoCao_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
