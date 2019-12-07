<? 
require("Estilo/Estilo.php");
require("Funcoes/Cachorro.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$Id = $_POST["IdCachorro"];
		$NoCachorro = $_POST["NoCachorro"];
		$TPSexo = $_POST["TPSexo"];
		$IdCor = $_POST["IdCor"];
		$DtNascimento = $_POST["DtNascimento"];
		$NoPai = $_POST["IDPai"];
		$NoMae = $_POST["IDMae"];
		$IDProprietario = $_POST["IDProprietario"];
		$IDCanil = $_POST["IDCanil"];
		$NoNinhada = $_POST["NoNinhada"];
		$NuRegistroNacional = $_POST["NuRegistroNacional"];
		$NoTatuagem = $_POST["NoTatuagem"];
		$NrMicrochip = $_POST["NrMicrochip"];

		$NuRegistroInternacional = $_POST["NuRegistroInternacional"];
		if ($NuRegistroInternacional == '')
		{$NuRegistroInternacional = 0;}
		
		$NuCBKC = $_POST["NuCBKC"];
		if ($NuCBKC == '')
		{$NuCBKC = 0;}
		
		$NuRegistroRegional = $_POST["NuRegistroRegional"];
		if ($NuRegistroRegional == '')
		{$NuRegistroRegional = 0;}
		
		
		$SgUFRegistro = $_POST["SgUFRegistro"];

		if(isset($_POST["IdRaioX"]))
		{	$IdRaioX = $_POST["IdRaioX"];}
		else
		{	$IdRaioX = 0;}


		if(isset($_POST["IdRaioX1"]))
		{	$IdRaioX1 = $_POST["IdRaioX1"];}
		else
		{	$IdRaioX1 = 0;}

		if(isset($_POST["IdRaioX2"]))
		{	$IdRaioX2 = $_POST["IdRaioX2"];}
		else
		{	$IdRaioX2 = 0;}

		if(isset($_POST["IdRaioX3"]))
		{	$IdRaioX3 = $_POST["IdRaioX3"];}
		else
		{	$IdRaioX3 = 0;}

		if(isset($_POST["IdRaioX4"]))
		{	$IdRaioX4 = $_POST["IdRaioX4"];}
		else
		{	$IdRaioX4 = 0;}

		
		if(isset($_POST["IdAdestramento"]))
		{	$IdAdestramento = $_POST["IdAdestramento"];}
		else
		{	$IdAdestramento = 0;}
				
		if(isset($_POST["IdSelecao"]))
		{	$IdSelecao = $_POST["IdSelecao"];}
		else
		{	$IdSelecao = 0;}

		if(isset($_POST["IdQualificacaoCao"]))
		{	$IdQualificacaoCao = $_POST["IdQualificacaoCao"];}
		else
		{	$IdQualificacaoCao = 0;}


		$DtRaioX = $_POST["DtRaioX"];
		$DtProvaAdestramento = $_POST["DtProvaAdestramento"];
		//$IdAdestramentoAlemanha = $_POST["IdAdestramentoAlemanha"];
		$IdAdestramentoAlemanha = $IdAdestramento;
		$DtSelecao = $_POST["DtSelecao"];
		$InResistencia = $_POST["InResistencia"];
		$DtResistencia = $_POST["DtResistencia"];
		$DsObservacao = $_POST["DsObservacao"];
		$DsAdestramento = $_POST["DsAdestramento"];

		//die("$Id, $NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdAdestramentoAlemanha, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao");

		if ($Action == "U")
		{AlterarCachorro($Id, $NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao,$NrMicrochip, $DsAdestramento,$IdRaioX1,$IdRaioX2,$IdRaioX3,$IdRaioX4);}
		else
		{CadastrarCachorro($NoCachorro, $TPSexo, $IdCor, $DtNascimento, $NoPai, $NoMae, $IDProprietario, $IDCanil, $NoNinhada, $NuRegistroNacional, $NoTatuagem, $NuRegistroInternacional, $NuCBKC, $NuRegistroRegional, $SgUFRegistro, $IdRaioX, $DtRaioX, $IdAdestramento, $DtProvaAdestramento, $IdSelecao, $DtSelecao, $IdQualificacaoCao, $InResistencia, $DtResistencia, $DsObservacao,$NrMicrochip, $DsAdestramento,$IdRaioX1,$IdRaioX2,$IdRaioX3,$IdRaioX4);}
	}
	else
	{
		$IdCachorro = $_GET["Id"];
		ExcluirCachorroIdCachorro($IdCachorro);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Cachorro_Listar.php';}

Redirect();
//setTimeout('Redirect()',500);
</Script>
