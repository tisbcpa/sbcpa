<?
function PesquisarDirigente($Id)
{
	require("Conexao.php");
	$sql = "select DsUsuario from TBUsuario Where IdUsuario = $Id";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result)){
		$Texto = "$row[DsUsuario]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

function AlterarDirigente($NoPresidente,$NoDiretor)
{
	require("Conexao.php");
	$sql = "Update TBUsuario Set DsUsuario = '$NoPresidente' Where IdUsuario = 2";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");

	$sql = "Update TBUsuario Set DsUsuario = '$NoDiretor' Where IdUsuario = 3";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");


	echo("<p class='MsgExito'>Ação Realizada com Êxito!</p>");
	mysql_close($Conn);
}
?>