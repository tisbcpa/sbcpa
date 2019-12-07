<? require("Funcoes/Diretoria.php");?>
<? require("Estilo/Estilo.php");?>


<script>
function Editar(Id)
{window.location.href = 'Diretoria_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Diretoria_Processar.php?Action=D&Id=' + Id;
	}
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoDiretoria";}
	
	if (isset($_POST["Parametro"]))
	{
		$Parametro = $_POST["Parametro"];
		$Campo = $_POST["Campo"];
	}
	else
	{
		$Parametro = "";
		$Campo = "NoDiretoria";
	}
	
	ListarDiretoriaRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Diretoria">
</form>
<? if ($Parametro == "")
{
		echo($ScriptRodape);
}
?>
