<? 
$menu = false;
require("Estilo/Estilo.php");?>
<body leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<? require("Funcoes/Canil.php");?>
<? require("Funcoes/Proprietario.php");?>
<? require("Funcoes/Cachorro.php");?>

<Script>
function Selecionar(Id,No)
{
	parent.EscolherItem(Id,No);
}
</Script>

<?
	$Tipo = $_POST["Tipo"];
	$Parametro = $_POST["Parametro"];
	
	if ($Tipo == "Canil") {ListarTbCanilRelacaoCompleta("NoCanil",$Parametro,"NoCanil","Preenchimento");}
	if ($Tipo == "Proprietario") {ListarProprietarioRelacaoCompleta("NoProprietario",$Parametro,"NoProprietario","Preenchimento");}
	if ($Tipo == "Pai") {ListarTbCachorroRelacaoCompleta("NoCachorro",$Parametro,"NoCachorro","Preenchimento");}
	if ($Tipo == "Mae") {ListarTbCachorroRelacaoCompleta("NoCachorro",$Parametro,"NoCachorro","Preenchimento");}
	if ($Tipo == "Cachorro") {ListarTbCachorroRelacaoCompleta("NoCachorro",$Parametro,"NoCachorro","Preenchimento");}
?>
