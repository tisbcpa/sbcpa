<?
function MontarComboUF($pagina)
{
	require("Conexao.php");
	$sql = "select * from TBUF where SGUF <> '00' Order by SGUF";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Texto = "<select name=SgUF OnChange=document.Formulario.action='". $pagina ."';document.Formulario.submit()>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = $Texto .  "<option value='$row[SGUF]'>$row[SGUF]</option>";
	}
	$Texto = $Texto . "</select>";
	
	mysql_close($Conn);
	return $Texto;
}

function MontarComboMunicipio($SgUF)
{
	require("Conexao.php");
	$sql = "select * from TBMunicipio where SGUF = '$SgUF' Order by NOMunicipio";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Texto = "<select name=NoCidade>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = $Texto .  "<option value='$row[NOMunicipio]'>$row[NOMunicipio]</option>";
	}
	$Texto = $Texto . "</select>";
	
	mysql_close($Conn);
	return $Texto;
}


function MontarComboUFFormulario($pagina,$formulario)
{
	require("Conexao.php");
	$sql = "select * from TBUF where SGUF <> '00' Order by SGUF";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$Texto = "<select name=SgUF OnChange=document.". $formulario .".action='". $pagina ."';document.". $formulario .".submit()>";
	while ($row = mysql_fetch_array($sql_result))
	{
		$Texto = $Texto .  "<option value='$row[SGUF]'>$row[SGUF]</option>";
	}
	$Texto = $Texto . "</select>";
	
	mysql_close($Conn);
	return $Texto;
}
?>