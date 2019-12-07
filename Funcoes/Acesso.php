<?
function PesquisarUsuario($usuario,$senha)
{
	$u = str_replace("'","",$usuario);
	$u = str_replace("--","",$u);
	$u = str_replace(" and ","",$u);
	$u = str_replace(" or ","",$u);
	$u = str_replace(" union ","",$u);
	$u = str_replace(";","",$u);

	$s = str_replace("'","",$senha);
	$s = str_replace("--","",$s);
	$s = str_replace(" and ","",$s);
	$s = str_replace(" or ","",$s);
	$s = str_replace(" union ","",$s);
	$s = str_replace(";","",$s);

	require("Conexao.php");
	$sql = "SELECT * FROM tbacaousuario Where noUsuario = '$u' and dsSenha = '$s'";
	$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
	$Texto = "";
	
	while ($row = mysql_fetch_array($sql_result)){
		$Texto = "$row[idUsuario]";
	}
	
	mysql_close($Conn);
	return $Texto;
}

?>