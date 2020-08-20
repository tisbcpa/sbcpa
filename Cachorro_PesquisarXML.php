<?
	require("Funcoes/Cachorro.php");
	$Acao =  $_GET["Acao"];
	$Parametro = $_GET["Parametro"];

	if ($Acao == "1"){echo(PesquisarNuSBCPAXML($Parametro));}
	if ($Acao == "2"){echo(PesquisarNoCachorroXML($Parametro));}
	if ($Acao == "3"){echo(PesquisarIdCachorroXML($Parametro));}
	if ($Acao == "4")
	{
		$Id = $_GET["Id"];
		$NoCachorro = $_GET["NoCachorro"];
		$TPSexo = $_GET["TPSexo"];
		$IdCor = $_GET["IdCor"];
		$DtNascimento = $_GET["DtNascimento"];
		$NoPai = $_GET["NoPai"];
		$NoMae = $_GET["NoMae"];
		$IDCanil = $_GET["IDCanil"];
		$NoNinhada = $_GET["NoNinhada"];
		$NuRegistroNacional = $_GET["NuRegistroNacional"];
		$NoTatuagem = $_GET["NoTatuagem"];
		$NuCBKC = $_GET["NuCBKC"];
		$Retorno = "Erro";
		
		$Retorno = AlterarDadosCachorroNinhada($Id,$NoCachorro,$TPSexo,$IdCor,$DtNascimento,$NoPai,$NoMae,$IDCanil,$NoNinhada,$NuRegistroNacional,$NoTatuagem,$NuCBKC);
		echo(utf8_encode('<ROOT><row Resultado="'. $Retorno . '" /></ROOT>'));
	}
?>