<? 
require("Estilo/Estilo.php");
require("Funcoes/Adestrador.php");

	if(!isset($_GET["Action"]))
		{$Action = $_POST["Action"];}
	else
		{$Action = $_GET["Action"];}

	if ($Action != "D")
	{
		$chCriacao = 0;	
		$chTrabalho = 0;
		$chRegional = 0;
		$chEstadual = 0;
		$chNacional = 0;
		$chLocal = 0;
		$chInternacional = 0;
			
		if ($_POST["chCriacao"] == "on")
			$chCriacao = 1;
		if ($_POST["chTrabalho"] == "on")
			$chTrabalho = 1;
		if ($_POST["chRegional"] == "on")
			$chRegional = 1;
		if ($_POST["chEstadual"] == "on")
			$chEstadual = 1;
		if ($_POST["chNacional"] == "on")
			$chNacional = 1;
		if ($_POST["chLocal"] == "on")
			$chLocal = 1;
		if ($_POST["chInternacional"] == "on")
			$chInternacional = 1;
		
		$Id = $_POST["IdAdestrador"];
		$NoAdestrador = $_POST["NoAdestrador"];
		$EdAdestrador = $_POST["EdAdestrador"];
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
		{AlterarAdestrador($Id,$NoAdestrador,$EdAdestrador,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StSocio,$chCriacao,$chTrabalho,$chRegional,$chEstadual,$chNacional,$chLocal,$chInternacional);}
		else
		{CadastrarAdestrador($NoAdestrador,$EdAdestrador,$NoCidade,$SgUF,$NoBairro,$NuCEP,$NoEmail,$NuTelefones,$DsHomePage,$IdClube,$DsObservacao,$StSocio,$chCriacao,$chTrabalho,$chRegional,$chEstadual,$chNacional,$chLocal,$chInternacional);}
	}
	else
	{
		$IdAdestrador = $_GET["Id"];
		ExcluirAdestradorIdAdestrador($IdAdestrador);
	}
?>
<Script>
function Redirect()
{window.location.href = 'Adestrador_Listar.php';}

setTimeout('Redirect()',2000);
</Script>
