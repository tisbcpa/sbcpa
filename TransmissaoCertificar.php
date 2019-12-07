<?
require("Estilo/Estilo.php");
require("Funcoes/Conexao.php");
$DadosCertificado = $_POST["DadosCertificado"];

if ($DadosCertificado != "")
{
	$sql = "update TBAcao Set StAtualizacao = '1' Where IdAcao in ($DadosCertificado)";
	mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
}


echo("<div style='font-family:verdana; font-size:12; font-weight:bold'><font color=blue>Site Atualizado com êxito</font></div>");
?>