<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Cachorro.php");?>

<?
	if (isset($_GET["Id"]))
	{
		$Action = "U";
		$Id = $_GET["Id"];
		
		//$Valores = split(",",PesquisarCachorroIdCachorro($Id));
	
		if (SelecionarPai($Id) <> '')
		{
			$ValoresPai = split(",",SelecionarPai($Id));
			//"$row[NoCachorro],$row[TPSexo],$DaNascimento,$row[IdCachorroPai],$row[IdCachorroMae],$row[NuRegistroNacional],$row[NoTatuagem],$row[IdQualificacaoMaxima],$row[InResistencia],$row[DsObservacao],$row[NuNinhada]"
			$Id = ;
		}
		
		if (SelecionarPai() <> '')
		{
			$ValoresPai = split(",",SelecionarPai($Id));
			//"$row[NoCachorro],$row[TPSexo],$DaNascimento,$row[IdCachorroPai],$row[IdCachorroMae],$row[NuRegistroNacional],$row[NoTatuagem],$row[IdQualificacaoMaxima],$row[InResistencia],$row[DsObservacao],$row[NuNinhada]"
		}
		
	
}
?>
