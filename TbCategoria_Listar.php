<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Categoria.php");?>

<script>
function Editar(Id)
{window.location.href = 'TbCategoria_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'TbCategoria_Processar.php?Action=D&Id=' + Id;
	}
}		
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoCategoria";}
	
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
	
	ListarTbCategoriaRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Categoria">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
