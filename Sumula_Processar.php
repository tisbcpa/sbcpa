<? 
require("Estilo/Estilo.php");
require("Funcoes/Sumula.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IDSumula"];
		$IdCachorro = $_POST["IDCachorro"];
		$IdJuiz = $_POST["IdJuiz"];
		$DTSumula = $_POST["DTSumula"];
		$NRAltura = $_POST["NRAltura"];
		$NOPigmentacao = $_POST["NOPigmentacao"];
		$NOPelagem = $_POST["NOPelagem"];
		$DSSumula = $_POST["DSSumula"];
		$IDJuizReselecao = $_POST["IdJuizReselecao"];
		$DTSumulaReselecao = $_POST["DTSumulaReselecao"];
		$DSSumulaReselecao = $_POST["DSSumulaReselecao"];				
		$InVencida = $_POST["InVencida"];

		if ($Action == "U")
		{AlterarSumula($Id,$IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida,$IDJuizReselecao,$DTSumulaReselecao,$DSSumulaReselecao);}
		else
		{CadastrarSumula($IdCachorro,$IdJuiz,$DTSumula,$NRAltura,$NOPigmentacao,$NOPelagem,$DSSumula,$InVencida,$IDJuizReselecao,$DTSumulaReselecao,$DSSumulaReselecao);}
	}
	else
	{
		$IdSumula = $_GET["Id"];
		ExcluirSumulaIdSumula($IdSumula);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Sumula_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
