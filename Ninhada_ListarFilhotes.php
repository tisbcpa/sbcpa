
<?
 $menu = "false";
 require("Estilo/Estilo.php");?>
 <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? require("Funcoes/Ninhada.php");?>

<script>
function Editar(Id)
{window.location.href = 'Proprietario_Formulario.php?Id=' + Id;}

function Excluir(Id)
{
	if (confirm('Deseja realmente apagar esse registro?'))
	{
		window.location.href = 'Proprietario_Processar.php?Action=D&Id=' + Id;
	}
}

function Novo()
{
	window.open('Ninhada_CadsatrarFilhote.php','NovoFilhote','width=520, height=320');
}

function AtualizariFrame()
{window.location.reload();}

function Atualizar()
{
	setTimeout(500,AtualizariFrame());
}

</script>

<?
	if (isset($_GET["Id"]))
	{
		$IdNinhada = $_GET["Id"];
		ListarFilhotesNinhada($IdNinhada);
	}	
?>
