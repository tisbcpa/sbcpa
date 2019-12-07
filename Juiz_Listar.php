<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Juiz.php");?>

<script>
function Editar(Id)
{window.location.href = 'Juiz_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Juiz_Processar.php?Action=D&Id=' + Id;
	}
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoJuiz";}
	
	if (isset($_POST["Parametro"]))
	{
		$Parametro = $_POST["Parametro"];
		$Campo = $_POST["Campo"];
	}
	else
	{
		$Parametro = "";
		$Campo = "NoJuiz";
	}
	
	ListarJuizRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Juiz">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
