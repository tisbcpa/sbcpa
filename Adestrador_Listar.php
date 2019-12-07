<? require("Funcoes/Adestrador.php");?>
<? require("Estilo/Estilo.php");?>


<script>
function Editar(Id)
{window.location.href = 'Adestrador_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Adestrador_Processar.php?Action=D&Id=' + Id;
	}
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoAdestrador";}
	
	if (isset($_POST["Parametro"]))
	{
		$Parametro = $_POST["Parametro"];
		$Campo = $_POST["Campo"];
	}
	else
	{
		$Parametro = "";
		$Campo = "NoAdestrador";
	}
	
	ListarAdestradorRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Adestrador">
</form>
<? if ($Parametro == "")
{
		echo($ScriptRodape);
}
?>
