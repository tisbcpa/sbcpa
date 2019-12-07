<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Provas.php");?>

<script>
function Editar(Id)
{window.location.href = 'Provas_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Provas_Processar.php?Action=D&Id=' + Id;
	}
}		

function Relatorio(Id)
{
	window.open('Provas_Relatorio.php?Id='+Id,'Provas','width=780, height=520, scrollbars=yes, menubar=yes');
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "IdProva DESC";}
	
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
	
	ListarProvasRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Prova">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
