<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Exposicoes.php");?>

<script>
function Editar(Id)
{window.location.href = 'Exposicoes_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Exposicoes_Processar.php?Action=D&Id=' + Id;
	}
}	

function Relatorio(Id)
{
	window.open('Exposicoes_Relatorio.php?Id='+Id,'Exposicoes','width=780, height=520, scrollbars=yes, menubar=yes');
}
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "IdExposicao DESC";}
	
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
	
	ListarExposicoesRelacaoCompleta($Tipo,$Parametro,$Campo)
?>
<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Exposicao">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>
