<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Adestramento.php");?>

<script>
function Editar(Id)
{window.location.href = 'TbAdestramento_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'TbAdestramento_Processar.php?Action=D&Id=' + Id;
	}
}		
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoAdestramento";}
	
	if (isset($_POST["Parametro"]))
	{
		$Parametro = $_POST["Parametro"];
		$Campo = $_POST["Campo"];
	}
	else
	{
		$Parametro = "";
		$Campo = "";
	}
	
	//die("$Tipo,$Parametro,$Campo");
	
	ListarTbAdestramentoRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Adestramento">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
