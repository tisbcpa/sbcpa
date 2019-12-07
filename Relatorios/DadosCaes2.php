<?php 
function RetornarIrmaos($Id)
{
	require("../Funcoes/Conexao.php");
	$Retorno = "";
	
	if ($Id != "")
	{
		$query = "Select * From TBCachorro Where IDNinhada in (Select a.IDNinhada From TBCachorro as a inner join TBNinhada as b on a.IDNinhada = b.IDNinhada Where IDCachorro = " . $Id . ") and IDCachorro <> " . $Id;
		$result = mysql_query($query) or die("Erro3: " . mysql_error());
		
		
		while ($row = mysql_fetch_array($result))
		{
			if ($Retorno != "")
			{
				$Retorno = $Retorno . ", ";
			}
						
			$v = split(" ",$row["NoCachorro"]);
			$Retorno = $Retorno . $v[0];		
		}
	}

	$Retorno = str_replace("Sudameris_","",$Retorno);
	$Retorno = str_replace("_"," ",$Retorno);
	return $Retorno;
}

	
echo(RetornarIrmaos(53251));
?>