<? require("Estilo/Estilo.php");?>
<? require("Funcoes/QualificacaoJuiz.php");?>

<script>
function Editar(Id)
{window.location.href = 'TbQualificacaoJuiz_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'TbQualificacaoJuiz_Processar.php?Action=D&Id=' + Id;
	}
}		
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NoQualificacaoJuiz";}
	
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
	
	ListarTbQualificacaoJuizRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="QualificacaoJuiz">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
