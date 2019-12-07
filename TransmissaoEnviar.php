<?
if (!isset($_GET["Popup"]))
{
require("Estilo/Estilo.php");	
}

require("Funcoes/Conexao.php");

function FormatarDataTela($Data)
{
	list ($ano, $mes, $dia) = split ('[/.-]', $Data);
	return "$dia/$mes/$ano";
}

/*	list ($ano, $mes, $dia) = split ('[-]', $Data);
	list ($h, $m, $s) = split ('[:]', $Hora);
	$File = "$ano$mes$dia.$h$m$s.xml";


$arquivo1 = "C:\Inetpub\wwwroot\SIPA\Transferencia\Modelo.xml";
$arquivo2 = "C:\Inetpub\wwwroot\SIPA\Transferencia\Arquivo_" . $File;
copy($arquivo1, $arquivo2);
*/

$sql = "select * from TBAcao Where StAtualizacao Is Null or StAtualizacao = '' Order By IdAcao";
$sql_result = mysql_query($sql,$Conn) or die("<p class='MsgErro'>Query invalida: " . mysql_error() . "</p>");
$Texto = '<Atualizacao Data="'. FormatarDataTela($Data) .' '. $Hora .'">';
$c = 0;
while ($row = mysql_fetch_array($sql_result))
{
	$Texto = $Texto . '<row IdAcao="'. $row["IdAcao"] .'" Idusuario="'. $row["IdUsuario"] .'" TpAcao="'. $row["TpAcao"] .'" IdRegistro="'. $row["IdRegistro"] . '" NoTabela="'. $row["NoTabela"] .'" DsAcao="'. $row["DsAcao"] .'" HrAcao="'. $row["HrAcao"] .'" DtAcao="'. $row["DtAcao"] .'" />';
	$c = $c + 1;
}
	$Texto = $Texto . '</Atualizacao>';

mysql_close($Conn);

/*
is_writable($arquivo2);
$handle = fopen($arquivo2, 'a');
fwrite($handle, $Texto);

echo("Gerado com êxito!");
*/


?>

<center>
<Form name="Formulario" method="post" action="http://www.sbcpa.com.br/des/consultas/LerXML.asp">
	<textarea name="DadosNovos" rows="20" Cols="100" style="display: none"><? echo($Texto);?></textarea>
	<br><Br>
	<div id="Mensagem" style="font-family:verdana; font-size:12; font-weight:bold"><font color="#FF0000">Conexão com o SITE ainda NÃO foi estabelecida<br><Br> Aguarde...</font></div>
	<br><br>
	<div style="font-family:verdana; font-size:12; font-weight:bold"><font color="#000000">Quantidade de Modificações: <? echo($c);?></font></div>
	<br><Br>
	<input type="submit" value=">> Transmitir >>" id="Botao" style="display: none">
</Form>
</center>




<script>
function EstabelecerConexao()
{
	Mensagem.innerHTML = '<font color="blue">Pronto para enviar os dados para o site...</font>';
	Formulario.Botao.style.display = '';
	//alert(Mensagem.innerHTML);
}
</script>

<iframe name="TesteDeConexao" style="display: none"></iframe>

<script>
function EnderecarPagina()
{
	//TesteDeConexao.location.href = 'http://www.sbcpa.com.br/des/consultas/TestarConexaoWeb.asp';
}

function TestarConexao()
{
	if (Mensagem.innerHTML != '<FONT color=blue>A Conexão com o SITE foi estabelecida...</FONT>')
	{
		EnderecarPagina();
		//setTimeout(TestarConexao,1000);
	}
}

TestarConexao();
setTimeout(EstabelecerConexao(),5000);
</script>




