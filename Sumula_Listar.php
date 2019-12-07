<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Sumula.php");?>

<script>
function Editar(Id)
{window.location.href = 'Sumula_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Sumula_Processar.php?Action=D&Id=' + Id;
	}
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "IDSumula";}
	
	if (isset($_POST["Parametro"]))
	{
		$Parametro = $_POST["Parametro"];
		$Campo = $_POST["Campo"];
	}
	else
	{
		$Parametro = "";
		$Campo = "DTSumula";
	}
	
	ListarSumulaRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Sumula">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
