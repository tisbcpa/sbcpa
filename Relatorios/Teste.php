<?
function RetornarInformacoesCao($Id)
{
	$Retorno = " ";
	$data = date("Y") ."-". date("m") ."-". date("d");

	require("../Funcoes/Conexao.php");
	$query = "Select e.NoQualificacaoCao, a.NuRegistroNacional, b.NoSelecao, c.NoRaioX, d.NoAdestramento, a.NoTatuagem, a.DaSelecao From (((TBCachorro as a left join TBSelecao as b on a.IdSelecao = b.IdSelecao) Left Join TBRaioX as c on a.IdRaioX = c.IdRaioX) left join TBAdestramento as d on a.IDAdestramento = d.IDAdestramento) left join TBQualificacaoCao as e On a.IdQualificacaoCao = e.IdQualificacaoCao Where a.IDCachorro = $Id";

	$result = mysql_query($query) or die("Erro7: " . $query);
	while ($row = mysql_fetch_array($result))
	{
		if ($data > $row["DaSelecao"])
		{$Retorno = "true";}
		else
		{$Retorno = "false";}
	}

	return $Retorno;
}

$Id = 142;
die(RetornarInformacoesCao($Id));


?>