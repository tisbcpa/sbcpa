<? require("Estilo/Estilo.php");?>
<? require("Funcoes/Ninhada.php");?>

<script>
function Editar1(Id)
{window.location.href = 'Ninhada_Formulario.php?Id=' + Id;}

function Editar2(Id)
{window.location.href = 'NinhadaEstrangeira_Formulario.php?Id=' + Id;}


function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Ninhada_Processar.php?Action=D&Id=' + Id;
	}
}		
</script>

<?
	if (isset($_GET["Tipo"]))
	{$Tipo = $_GET["Tipo"];}
	else
	{$Tipo = "NuNinhada DESC";}
	
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
	
	//ListarTbNinhadaRelacaoCompleta($Tipo,$Parametro,$Campo)
?>

<?
		//$IdNinhada = $_GET["Id"];
		ListarNinhada($Tipo,$Parametro,$Campo);
?>

<form name="FormPesquisa" action="Formulario_Pesquisa.php" method="get" target="ManorPagina">
	<input type="hidden" name="Tipo" value="Ninhada">
</form>
<? if ($Parametro == "")
{
	echo($ScriptRodape);
}
?>

<script>
function Novo()
{
	window.location.href = 'Ninhada_Formulario.php';
}
</script>